<?php

namespace app\modules\filemanager\controllers;

use Yii;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\HttpException;
use yii\filters\VerbFilter;
use app\modules\filemanager\FileManager;
use app\modules\filemanager\models\AlbumModel;
/**
 * AlbumController implements the CRUD actions for AlbumModel model.
 */
class AlbumController extends Controller
{

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

    /**
     * Creates a new AlbumModel model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->can('albumcreate')) {
            $model = new AlbumModel;
            $model->setAttribute('term_id', FileManager::FILE_IMAGE_TERM);
            $model->setAttribute('create_et', date("Y-m-d H:i:s"));
            $model->setAttribute('update_et', date("Y-m-d H:i:s"));
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['/filemanager/image/index', 'action' => 'filemanager-image-list', 'album_id' => $model->id]);
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
     * Updates an existing AlbumModel model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if (Yii::$app->user->can('albumupdate')) {
            $model = $this->findModel($id);

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['/filemanager/image/index', 'action' => 'filemanager-image-list', 'album_id' => $model->id]);
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
     * Deletes an existing AlbumModel model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if (Yii::$app->user->can('albumdelete')) {
            $this->findModel($id)->delete();

            return $this->redirect(['/filemanager/image/index', 'action' => 'filemanager-image-list',]);
        } else {
            throw new HttpException(403, 'You are not allowed to access this page', 0);
        }
    }

    /**
     * Finds the AlbumModel model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AlbumModel the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AlbumModel::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
