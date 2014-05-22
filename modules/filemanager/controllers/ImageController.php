<?php

namespace app\modules\filemanager\controllers;
define("DS", DIRECTORY_SEPARATOR);


use Yii;
use app\modules\dao\ar\File;
use app\modules\filemanager\searchs\ImageSearc;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\helpers\Json;
use app\modules\filemanager\models\ImageModel;
use app\modules\filemanager\librarys\Image;
use app\modules\filemanager\forms\ModalForm;
use app\modules\filemanager\FileManager;
use app\modules\filemanager\models\TaxImageRelationModel;
use app\modules\filemanager\forms\FormSearch;
use app\modules\filemanager\models\AlbumModel;

/**
 * ImageController implements the CRUD actions for File model.
 */
class ImageController extends Controller
{

    public $path;
    public $original;
    public $thumb_145x145;
    public $thumb_191x128;
    public $thumb_original;


    public function init()
    {
        $this->path = Yii::$app->getBasePath() . DS . 'web' . DS . 'resources' . DS . 'images' . DS;
        $this->original = $this->path . 'original' . DS;
        $this->thumb_145x145 = $this->path . 'thumbnail' . DS . '145x145' . DS;
        $this->thumb_191x128 = $this->path . 'thumbnail' . DS . '191x128' . DS;
        $this->thumb_original = $this->path . 'thumbnail' . DS . 'original' . DS;

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


    public function actionLoads()
    {
        $album = AlbumModel::findOne(1);
        $leng = count($album->getImagesByAlbum()->asArray()->all());
        if (Yii::$app->request->isAjax) {
            $param = Yii::$app->request->getQueryParams();
            $key = isset($param["FormSearch"]['keyword']) ? $param["FormSearch"]['keyword'] : "";
            $per_page = 8;
            if ($param["FormSearch"]['page'] == 0) {
                $data = $album->getImagesByAlbum()
                    ->orFilterWhere(['like', 'name', $key])
                    ->orFilterWhere(['like', 'orginal_name', $key])
                    ->orFilterWhere(['like', 'unique_name', $key])
                    ->orFilterWhere(['like', 'description', $key])
                    ->orderBy(['create_at' => SORT_DESC])
                    ->limit(8)
                    ->offset(0)
                    ->asArray()->all();
                echo Json::encode([
                    'page' => 1,
                    'data' => $data,
                    'keyword' => $key,
                    'count' => $leng
                ]);
            } else {
                $page = $param["FormSearch"]['page'];
                $position = ($page * $per_page);
                $data = $album->getImagesByAlbum()
                    ->orFilterWhere(['like', 'name', $key])
                    ->orFilterWhere(['like', 'orginal_name', $key])
                    ->orFilterWhere(['like', 'unique_name', $key])
                    ->orFilterWhere(['like', 'description', $key])
                    ->orderBy(['create_at' => SORT_DESC])
                    ->limit($per_page)
                    ->offset($position)
                    ->asArray()->all();
                echo Json::encode([
                    'page' => ($page + 1),
                    'data' => $data,
                    'keyword' => $key,
                    'count' => $leng
                ]);
            }
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionUpload()
    {
        if (Yii::$app->request->isAjax) {
            $model = new ModalForm;
            $form = Yii::$app->request->post('ModalForm');

            /**
             * Upload Image
             */
            $file = UploadedFile::getInstance($model, 'file');
            $unique_name = preg_replace('/\s+/', '-', date("Y-m-d-H:i:s") . '-' . rand(0, 999999999) . '-' . $file->name);
            $file->saveAs($this->original . $unique_name);

            /**
             * Resize Image
             */
            $img = new Image();
            $img->adaptiveResize($this->original . $unique_name, $this->thumb_145x145 . $unique_name, 145, 145);
            $img->adaptiveResize($this->original . $unique_name, $this->thumb_191x128 . $unique_name, 191, 128);
            $img->resize($this->original . $unique_name, $this->thumb_original . $unique_name, 256);
            $img->resize($this->original . $unique_name, $this->original . $unique_name, 1024);

            /**
             * Save Image name and order attr to database
             */
            $model = new ImageModel;
            $model->user_id = Yii::$app->user->identity->getId();
            $model->name = $file->name;
            $model->orginal_name = $file->name;
            $model->unique_name = $unique_name;
            $model->type = FileManager::FILE_TYPE_IMAGE;
            $model->size = $form['size'];
            $model->file_type = $file->type;
            $model->description = "Photo Anggota";
            $model->create_at = date("Y-m-d H:i:s");
            $model->update_et = date("Y-m-d H:i:s");
            $model->save();

            /**
             * Ssave image cate album
             */
            $tax = new TaxImageRelationModel;
            $tax->tax_id = FileManager::FILE_IMAGE_CAT_PPI;
            $tax->file_id = $model->id;
            $tax->save();

            $base_path = Yii::getAlias('@web') . DS . 'resources' . DS . 'images' . DS;

            echo Json::encode([
                "form" => $form,
                "status" => true,
                "id" => $model->id,
                "orginal_name" => $file->name,
                "unique_name" => $unique_name,
                "path" => $base_path,
                "thumb_path" => $base_path . 'thumbnail' . DS . 'original' . DS,
                "thumb_path_145x145" => $base_path . 'thumbnail' . DS . '145x145' . DS,
            ]);
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Lists all File models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ImageSearc;
        $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }

    /**
     * Displays a single File model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new File model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new File;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
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
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
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
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the File model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return File the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = File::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
