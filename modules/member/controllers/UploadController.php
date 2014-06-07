<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\modules\member\controllers;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use app\modules\filemanager\librarys\Image;
use app\modules\member\models\ImageModel;

/**
 * Description of UploadController
 *
 * @author melengo
 */
class UploadController extends Controller
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

    public function actionImage()
    {
        if (Yii::$app->user->can('uploadimage')) {
            
        } else {
            throw new HttpException(403, 'You are not allowed to access this page', 0);
        }
    }

    public function actionUpload()
    {
        if (Yii::$app->user->can('uploadupload')) {
            if (Yii::$app->request->isAjax) {
                /**
                 * Upload Image
                 */
                $file = UploadedFile::getInstanceByName('file');
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
                $model->type = FILE_TYPE_IMAGE;
                $model->size = Yii::$app->request->post('size');
                $model->file_type = $file->type;
                $model->description = "Photo Anggota";
                $model->create_at = date("Y-m-d H:i:s");
                $model->update_et = date("Y-m-d H:i:s");
                $model->save();

                $base_path = Yii::getAlias('@web') . DIRECTORY_SEPARATOR . 'resources' . DIRECTORY_SEPARATOR . 'member' . DIRECTORY_SEPARATOR;

                echo Json::encode([
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
        } else {
            throw new HttpException(403, 'You are not allowed to access this page', 0);
        }
    }

}
