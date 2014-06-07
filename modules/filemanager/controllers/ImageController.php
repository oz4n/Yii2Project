<?php

namespace app\modules\filemanager\controllers;

define("DS", DIRECTORY_SEPARATOR);

use Yii;
use app\modules\dao\ar\File;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\helpers\Json;
use app\modules\filemanager\forms\FormSearch;
use app\modules\filemanager\models\ImageModel;
use app\modules\filemanager\librarys\Image;
use app\modules\filemanager\FileManager;
use app\modules\filemanager\models\TaxImageRelationModel;
use app\modules\filemanager\models\AlbumModel;
use Symfony\Component\Filesystem\Filesystem;
use yii\web\HttpException;

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
        if (Yii::$app->user->can('imageloads')) {
            $images = ImageModel::find();
            $leng = count($images->asArray()->all());
            if (Yii::$app->request->isAjax) {
                $param = Yii::$app->request->getQueryParams();
                $key = isset($param["FormSearch"]['keyword']) ? $param["FormSearch"]['keyword'] : "";
                $per_page = 8;
                if ($param["FormSearch"]['page'] == 0) {
                    $data = $images->onCondition(['type' => FileManager::FILE_TYPE_IMAGE])
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
                    $data = $images->onCondition(['type' => FileManager::FILE_TYPE_IMAGE])
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
        } else {
            throw new HttpException(403, 'You are not allowed to access this page', 0);
        }
    }

    public function actionLoadredactoralbum()
    {
        if (Yii::$app->user->can('imageloadredactoralbum')) {
            if (Yii::$app->request->isAjax) {
                $model = new AlbumModel;
                $data = [];
                foreach ($model->getAllAlbums() as $v) {
                    $data[] = [
                        'id' => $v->id,
                        'name' => $v->name
                    ];
                }
                echo Json::encode($data);
            } else {
                throw new NotFoundHttpException('The requested page does not exist.');
            }
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionUploadredactorimage()
    {
        if (Yii::$app->user->can('imageuploadredactorimage')) {
            if (Yii::$app->request->isAjax || Yii::$app->request->isPost) {
                /**
                 * Upload Image
                 */
                $param = Yii::$app->request->post();
                $file = UploadedFile::getInstanceByName('file');
                if ($file->size === 0) {
                    echo Json::encode([
                        'error' => 'Ukuran file yang anda unggah terlalu besar! Maksimum ' . ini_get('upload_max_filesize')
                    ]);
                } else if (($file->type == "image/jpeg" || $file->type == "image/png") || ($file->type == "image/gif" || $file->type == "image/jpg" )) {
                    $unique_name = preg_replace('/\s+/', '-', date("YmdHis") . '-' . rand(0, 999999999) . '-' . $file->name);

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
                    $model->size = "$file->size";
                    $model->file_type = $file->type;
                    $model->description = "Photo Anggota";
                    $model->create_at = date("Y-m-d H:i:s");
                    $model->update_et = date("Y-m-d H:i:s");
                    $model->save();

                    /**
                     * Save image cate album
                     */
                    if (isset($param['cat_id']) || $param['cat_id'] != null) {
                        $tax = new TaxImageRelationModel;
                        $tax->tax_id = $param['cat_id'];
                        $tax->file_id = $model->id;
                        $tax->save();
                    }

                    $base_path = Yii::getAlias('@web') . DS . 'resources' . DS . 'images' . DS;

                    echo Json::encode([
                        'filelink' => $base_path . 'original' . DS . $unique_name,
                        'uid' => $model->id,
                        'filename' => $file->name,
                        'uniquename' => $unique_name
                    ]);
                } else {
                    echo Json::encode(['error' => 'Tipe file yang anda unggah tidak di izinkan.']);
                }
            } else {
                throw new NotFoundHttpException('The requested page does not exist.');
            }
        } else {
            throw new HttpException(403, 'You are not allowed to access this page', 0);
        }
    }

    public function actionLoadredactorimage()
    {
        if (Yii::$app->user->can('imageloadredactorimage')) {
            if (Yii::$app->request->isAjax) {
                $album = new AlbumModel;
                $param = Yii::$app->request->getQueryParams();
                $page = isset($param["FormSearch"]['page']) ? $param["FormSearch"]['page'] : 0;
                $key = isset($param["FormSearch"]['keyword']) ? $param["FormSearch"]['keyword'] : "";
                $per_page = 8;
                $position = ($page * $per_page);
                $data = [];


                if (isset($param["FormSearch"]['album_id']) && (0 != $param["FormSearch"]['album_id'])) {

                    $query = $album->getImageByAlbumId($param["FormSearch"]['album_id'], $per_page, $position, $key);
                    foreach ($query as $v) {
                        $data[] = [
                            'filelink' => Yii::getAlias('@web') . "/resources/images/original/" . $v->unique_name,
                            'thumb' => Yii::getAlias('@web') . "/resources/images/thumbnail/145x145/" . $v->unique_name,
                            'title' => $v->name,
                            'image' => Yii::getAlias('@web') . "/resources/images/original/" . $v->unique_name,
                            'imguid' => 1,
                            'page' => ($page + 1),
                            'key' => $key,
                            'des' => $v->description,
                            'uniquename' => $v->unique_name,
                            'album_id' => $param["FormSearch"]['album_id'],
                            'album' => $album->getAlbums('Pilih album')
                        ];
                    }
                    echo Json::encode($data);
                } else {
                    $images = ImageModel::find();
                    $query = $images->onCondition(['type' => FileManager::FILE_TYPE_IMAGE])
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
                            'filelink' => Yii::getAlias('@web') . "/resources/images/original/" . $v->unique_name,
                            'thumb' => Yii::getAlias('@web') . "/resources/images/thumbnail/145x145/" . $v->unique_name,
                            'title' => $v->name,
                            'image' => Yii::getAlias('@web') . "/resources/images/original/" . $v->unique_name,
                            'imguid' => 1,
                            'page' => ($page + 1),
                            'key' => $key,
                            'uniquename' => $v->unique_name,
                            'des' => $v->description,
                            'album' => $album->getAlbums('Pilih album')
                        ];
                    }
                    echo Json::encode($data);
                }
            } else {
                throw new NotFoundHttpException('The requested page does not exist.');
            }
        } else {
            throw new HttpException(403, 'You are not allowed to access this page', 0);
        }
    }

    public function actionUpload()
    {
        if (Yii::$app->user->can('imageupload')) {
            if (Yii::$app->request->isAjax) {

                /**
                 * Upload Image
                 */
                $file = UploadedFile::getInstanceByName('file');
                $unique_name = preg_replace('/\s+/', '-', date("YmdHis") . '-' . rand(0, 999999999) . '-' . $file->name);
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
                $model->size = "$file->size";
                $model->file_type = $file->type;
                $model->description = "Photo Anggota";
                $model->create_at = date("Y-m-d H:i:s");
                $model->update_et = date("Y-m-d H:i:s");
                $model->save();

                /**
                 * Ssave image cate album
                 */
                $param = Yii::$app->request->post();
                if ($param['album_id'] != 0) {
                    $tax = new TaxImageRelationModel;
                    $tax->tax_id = $param['album_id'];
                    $tax->file_id = $model->id;
                    $tax->save();
                }

                $base_path = Yii::getAlias('@web') . DS . 'resources' . DS . 'images' . DS;

                echo Json::encode([
                    "files" => [
                        "status" => true,
                        "id" => $model->id,
                        "orginal_name" => $file->name,
                        "unique_name" => $unique_name,
                        "path" => $base_path,
                        "original" => $base_path . 'original' . DS . $unique_name,
                        "thumb" => $base_path . 'thumbnail' . DS . '145x145' . DS . $unique_name,
                    ]
                ]);
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
        if (Yii::$app->user->can('imageindex')) {
            $per_page = 19;
            if (Yii::$app->request->isAjax) {
                $model = new AlbumModel;
                $param = Yii::$app->request->getQueryParams();
                $key = isset($param["FormSearch"]['keyword']) ? $param["FormSearch"]['keyword'] : null;
                $page = $param['page'];
                $position = ($page * $per_page);
                if ((isset($param['album_id']) && $param['album_id'] != 0) && $key == null) {
                    $data = $model->getImageByAlbumId($param['album_id'], $per_page, $position);
                    echo Json::encode([
                        'data' => $data,
                        'page' => ($page + 1)
                    ]);
                } else {
                    $data = $model->getAllImages($per_page, $position, $key);
                    echo Json::encode([
                        'data' => $data,
                        'page' => ($page + 1)
                    ]);
                }
            } else {

                $model = new AlbumModel;
                $searchModel = new FormSearch;
                $param = Yii::$app->request->getQueryParams();
                $key = isset($param["FormSearch"]['keyword']) ? $param["FormSearch"]['keyword'] : null;

                if ((isset($param['album_id']) && $param['album_id'] != 0) && $key == null) {
                    $data = $model->getImageByAlbumId($param['album_id'], $per_page, 0);
                    return $this->render('index', [
                                'model' => $data,
                                'album_id' => $param['album_id'],
                                'album' => $model->getAllAlbums(),
                                'album_name' => $model->getAlbumNameById($param['album_id']),
                                'searchModel' => $searchModel,
                                'keyword' => $key
                    ]);
                } else {

                    $data = $model->getAllImages($per_page, 0, $key);
                    return $this->render('index', [
                                'model' => $data,
                                'album_id' => 0,
                                'album' => $model->getAllAlbums(),
                                'searchModel' => $searchModel,
                                'keyword' => $key
                    ]);
                }
            }
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
        if (Yii::$app->user->can('imageview')) {
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
        if (Yii::$app->user->can('imagecreate')) {
            $model = new File;

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
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
        if (Yii::$app->user->can('imageupdate')) {
            $model = $this->findModel($id);

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
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
    public function actionDelete()
    {
        if (Yii::$app->user->can('imageupdate')) {
            if (Yii::$app->request->isAjax) {
                $system = new Filesystem();
                $param = Yii::$app->request->post();
                $model = $this->findModel($param['id']);
                $system->remove($this->original . $model->unique_name);
                $system->remove($this->thumb_145x145 . $model->unique_name);
                $system->remove($this->thumb_original . $model->unique_name);
                $system->remove($this->thumb_191x128 . $model->unique_name);
                $model->delete();
            }
        } else {
            throw new HttpException(403, 'You are not allowed to access this page', 0);
        }
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
