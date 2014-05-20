<?php

namespace app\modules\filemanager\controllers;

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
use app\modules\filemanager\models\AlbumModel;

/**
 * ImageController implements the CRUD actions for File model.
 */
class ImageController extends Controller
{

    public $img_path;
    public $img_thumb_path;
    public $img_150x150_thumb_path;

    public function init()
    {
        $this->img_path = Yii::$app->getBasePath() . DIRECTORY_SEPARATOR . 'web' . DIRECTORY_SEPARATOR . 'resources' . DIRECTORY_SEPARATOR . 'member' . DIRECTORY_SEPARATOR;
        $this->img_thumb_path = $this->img_path . 'thumbnail' . DIRECTORY_SEPARATOR;
        $this->img_150x150_thumb_path = $this->img_thumb_path . '150x150' . DIRECTORY_SEPARATOR;
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

    public function findData($id)
    {
        return \app\modules\filemanager\models\ImageModel::findOne($id);
    }

    public function actionTest()
    {


        $model = AlbumModel::findOne(1);
//        $model = \app\modules\member\models\PpiModel::findOne(45);
//        $d = $model->getImagefilerelations(1)->all();
        $c = $model->getImagesByAlbum()->all();
        $dataProvider = new \yii\data\ActiveDataProvider([
            'query' => $c,
            'pagination' => [
                'pageSize' => 2
            ]
        ]);
        echo count($dataProvider);
        foreach ($dataProvider->query as $v) {
            echo $v->unique_name . "<br>";
        }
        echo "<pre>";
//        print_r($c);
//        print_r($dataProvider);
    }

    public function actionLoads()
    {
        $album = AlbumModel::findOne(1);
        if (Yii::$app->request->isAjax) {
            $param = Yii::$app->request->getQueryParams();
            $key = isset($param['keyword']) ? $param['keyword'] : "";
            if ($param['page'] == 0) {                
                $data = $album->getImagesByAlbum()
                                ->orFilterWhere(['like', 'name', $key])
                                ->orFilterWhere(['like', 'orginal_name', $key])
                                ->orFilterWhere(['like', 'description', $key])
                                ->orderBy(['create_at' => SORT_DESC])
                                ->offset($param['page'])
                                ->limit(8)->asArray()->all();
                echo Json::encode([
                    'page' => $param['page'] + 8,
                    'data' => $data
                ]);
            } else {
                $page = $param['page'] + 8;
                $data = $album->getImagesByAlbum()
                                ->orFilterWhere(['like', 'name', $key])
                                ->orFilterWhere(['like', 'orginal_name', $key])
                                ->orFilterWhere(['like', 'description', $key])
                                ->orderBy(['create_at' => SORT_DESC])
                                ->offset($page)->limit(8)
                                ->asArray()->all();
                echo Json::encode([
                    'page' => $page,
                    'data' => $data
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
//            echo json_encode($form);
//            exit();
            /**
             * Upload Image
             */
            $file = UploadedFile::getInstance($model, 'file');
            $unique_name = preg_replace('/\s+/', '-', date("Y-m-d-H:i:s") . '-' . rand(0, 999999999) . '-' . $file->name);
            $file->saveAs($this->img_path . $unique_name);

            /**
             * Resize Image
             */
            $img = new Image();
            $img->adaptiveResize($this->img_path . $unique_name, $this->img_150x150_thumb_path . $unique_name, 150, 150);
            $img->adaptiveResize($this->img_path . $unique_name, $this->img_thumb_path . $unique_name, 399, 600);
            $img->resize($this->img_path . $unique_name, $this->img_path . $unique_name, 1024);

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

            $base_path = Yii::getAlias('@web') . DIRECTORY_SEPARATOR . 'resources' . DIRECTORY_SEPARATOR . 'member' . DIRECTORY_SEPARATOR;

            echo Json::encode([
                "form" => $form,
                "status" => true,
                "id" => $model->id,
                "orginal_name" => $file->name,
                "unique_name" => $unique_name,
                "path" => $base_path,
                "thumb_path" => $base_path . 'thumbnail' . DIRECTORY_SEPARATOR,
                "thumb_path_150x150" => $base_path . 'thumbnail' . DIRECTORY_SEPARATOR . '150x150' . DIRECTORY_SEPARATOR,
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
