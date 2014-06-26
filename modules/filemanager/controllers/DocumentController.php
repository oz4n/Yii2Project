<?php

namespace app\modules\filemanager\controllers;

use Yii;
use app\modules\dao\ar\File;
use app\modules\filemanager\searchs\DocumentSearc;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use Symfony\Component\Filesystem\Filesystem;
use app\modules\filemanager\FileManager;
use yii\web\UploadedFile;
use app\modules\filemanager\models\DocumentModel;
use yii\web\HttpException;

/**
 * DocumentController implements the CRUD actions for File model.
 */
class DocumentController extends Controller
{

    public $path;
    public $filesystem;

    public function init()
    {
        $this->path = Yii::$app->getBasePath() . DS . 'web' . DS . 'resources' . DS . 'documents' . DS;
        $this->filesystem = new Filesystem();
        parent::init();
    }

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    public function actionUploaddredactorfile()
    {
        if (Yii::$app->user->can('documentuploaddredactorfile')) {
            $file = UploadedFile::getInstanceByName('file');
            if ($file->size === 0) {
                echo Json::encode([
                    'error' => 'Ukuran file yang anda unggah terlalu besar! Maksimum ' . ini_get('upload_max_filesize')
                ]);
            } else {
                $dir = date("Ym");
                $this->filesystem->mkdir($this->path . $dir);
                $unique_name = preg_replace('/\s+/', '-', date("YmdHis") . '-' . rand(0, 999999999) . '-' . $file->name);

                $file->saveAs($this->path . $dir . DS . $unique_name);

                /**
                 * Save DocumentModel name and order attr to database
                 */
                $model = new DocumentModel;

                $model->user_id = Yii::$app->user->identity->getId();
                $model->name = $file->name;
                $model->orginal_name = $file->name;
                $model->unique_name = $unique_name;
                $model->type = FileManager::FILE_TYPE_DOCUMENT;
                $model->size = "$file->size";
                $model->file_type = $file->type;
                $model->description = "Tidak ada keterangan";
                $model->create_at = date("Y-m-d H:i:s");
                $model->update_et = date("Y-m-d H:i:s");
                $model->save();

                $base_path = Yii::getAlias('@web') . DS . 'resources' . DS . 'documents' . DS;
                echo Json::encode([
                    'filelink' => $base_path . $dir . DS . $unique_name,
                    'uid' => $model->id,
                    'filename' => $file->name,
                    'size' => $file->size,
                    'maxsize' => ini_get('upload_max_filesize')
                ]);
            }
        } else {
            throw new HttpException(403, 'You are not allowed to access this page', 0);
        }
    }

    public function actionLoadredactorfile()
    {
        if (Yii::$app->user->can('documentloadredactorfile')) {
            if (Yii::$app->request->isAjax) {
                $file = DocumentModel::find();
                $param = Yii::$app->request->getQueryParams();
                $data = [];
                $per_page = 6;
                $page = isset($param["FormSearch"]['page']) ? $param["FormSearch"]['page'] : 0;
                $key = isset($param["FormSearch"]['keyword']) ? $param["FormSearch"]['keyword'] : "";
                $position = ($page * $per_page);
                $query = $file->onCondition(['type' => FileManager::FILE_TYPE_DOCUMENT])
                        ->orFilterWhere(['like', 'name', $key])
                        ->orFilterWhere(['like', 'orginal_name', $key])
                        ->orFilterWhere(['like', 'unique_name', $key])
                        ->orFilterWhere(['like', 'description', $key])
                        ->orderBy(['create_at' => SORT_DESC])
                        ->limit($per_page)
                        ->offset($position)
                        ->all();
                /** @var File $v */
                foreach ($query as $v) {
                    $data[] = [
                        'filelink' => Yii::getAlias('@web') . "/resources/documents/" . date('Ym', strtotime($v->create_at)) . '/' . $v->unique_name,
                        'title' => $v->name,
                        'des' => $v->description,
                        'size' => $v->size,
                        'page' => ($page + 1),
                        'key' => $key
                    ];
                }

                echo Json::encode($data);
            } else {
                throw new NotFoundHttpException('The requested page does not exist.');
            }
        } else {
            throw new HttpException(403, 'You are not allowed to access this page', 0);
        }
    }

    /**
     * Lists all File models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->can('documentindex')) {
            $searchModel = new DocumentSearc;
            $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());

            return $this->render('index', [
                        'dataProvider' => $dataProvider,
                        'searchModel' => $searchModel,
            ]);
        } else {
            throw new HttpException(403, 'You are not allowed to access this page', 0);
        }
    }

    /**
     * Displays a single File model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->can('documentview')) {
            return $this->render('view', [
                        'model' => $this->findModel($id),
            ]);
        } else {
            throw new HttpException(403, 'You are not allowed to access this page', 0);
        }
    }

    /**
     * Creates a new File model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->can('documentcreate')) {
            $model = new DocumentModel;
            if (Yii::$app->request->post()) {
                $file = UploadedFile::getInstanceByName('file');
                if ($file->size === 0 && $file == null) {
                    return $this->render('create', [
                                'model' => $model,
                    ]);
                } else {
                    $dir = date("Ym");
                    $this->filesystem->mkdir($this->path . $dir);
                    $unique_name = preg_replace('/\s+/', '-', date("YmdHis") . '-' . rand(0, 999999999) . '-' . $file->name);

                    $file->saveAs($this->path . $dir . DS . $unique_name);
                    $model->setAttribute("create_at", date("Y-m-d H:i:s"));
                    $model->setAttribute("update_et", date("Y-m-d H:i:s"));
                    $model->setAttribute("user_id", Yii::$app->user->identity->getId());
                    $model->setAttribute("orginal_name", $file->name);
                    $model->setAttribute("unique_name", $unique_name);
                    $model->setAttribute("size", "$file->size");
                    $model->setAttribute("file_type", $file->type);
                    $model->setAttribute("type", FileManager::FILE_TYPE_DOCUMENT);
                    if ($model->load(Yii::$app->request->post()) && $model->save()) {
                        return $this->redirect(['index', 'action' => 'filemanager-document-list']);
                    } else {
                        return $this->render('create', [
                                    'model' => $model,
                        ]);
                    }
                }
            } else {
                return $this->render('create', [
                            'model' => $model,
                ]);
            }
        } else {
            throw new HttpException(403, 'You are not allowed to access this page', 0);
        }
    }

    /**
     * Updates an existing File model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if (Yii::$app->user->can('documentupdate')) {
            $model = $this->findModel($id);
            $model->setAttribute("update_et", date("Y-m-d H:i:s"));
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['update', 'action' => 'filemanager-document-update', 'id' => $model->id]);
            } else {
                return $this->render('update', [
                            'model' => $model,
                ]);
            }
        } else {
            throw new HttpException(403, 'You are not allowed to access this page', 0);
        }
    }

    /**
     * Deletes an existing File model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if (Yii::$app->user->can('documentdelete')) {
            $model = $this->findModel($id);
            $dir = date("Ym", strtotime($model->create_at));
            $this->filesystem->remove($this->path . $dir . DS . $model->unique_name);
            $model->delete();
            return $this->redirect(['index', 'action' => 'filemanager-document-list']);
        } else {
            throw new HttpException(403, 'You are not allowed to access this page', 0);
        }
    }

    public function actionBulk()
    {
        if (Yii::$app->user->can('documentbulk')) {
            if (Yii::$app->request->post() && (Yii::$app->request->post('bulk_action1') == 'delete' || Yii::$app->request->post('bulk_action2') == 'delete')) {
                $this->deleteAll(Yii::$app->request->post('selection'));
                return $this->redirect(['index', 'action' => 'filemanager-document-list']);
            } else {
                return $this->redirect(['index', 'action' => 'filemanager-document-list']);
            }
        } else {
            throw new HttpException(403, 'You are not allowed to access this page', 0);
        }
    }

    /**
     * @param array $data
     * @return \yii\web\Response
     */
    private function deleteAll($data)
    {
        if (null !== $data) {
            foreach ($data as $id) {
                $model = $this->findModel($id);
                $dir = date("Ym", strtotime($model->create_at));
                $this->filesystem->remove($this->path . $dir . DS . $model->unique_name);
                $model->delete();
            }
            return $this->redirect(['index', 'action' => 'filemanager-document-list']);
        } else {
            return $this->redirect(['index', 'action' => 'filemanager-document-list']);
        }
    }

    /**
     * Finds the File model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return DocumentModel the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = DocumentModel::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function bytes($val)
    {
        $val = trim($val);
        $last = strtolower($val[strlen($val) - 1]);
        switch ($last) {
            // The 'G' modifier is available since PHP 5.1.0
            case 'GB':
                $val *= 1024;
            case 'MB':
                $val *= 1024;
            case 'KB':
                $val *= 1024;
        }
        return $val;
    }

}
