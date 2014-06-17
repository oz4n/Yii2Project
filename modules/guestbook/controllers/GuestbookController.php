<?php

namespace app\modules\guestbook\controllers;

use Yii;
use app\modules\guestbook\models\GuestbookModel;
use app\modules\guestbook\searchs\GuestbookSerch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\HttpException;

/**
 * GuestbookController implements the CRUD actions for Guestbook model.
 */
class GuestbookController extends Controller
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
     * Lists all Guestbook models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->can('guestbookindex')) {
            $searchModel = new GuestbookSerch;
            $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());
            if ((Yii::$app->request->get('bulk_action1') == 'delete' || Yii::$app->request->get('bulk_action2') == 'delete')) {
                $this->deleteAll(Yii::$app->request->get('selection'));
            }
            return $this->render('index', [
                        'dataProvider' => $dataProvider,
                        'searchModel' => $searchModel,
            ]);
        } else {
            throw new HttpException(403, 'You are not allowed to access this page', 0);
        }
    }

    /**
     * Updates an existing Guestbook model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if (Yii::$app->user->can('guestbookupdate')) {
            $model = $this->findModel($id);

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['update', 'action' => 'guestbook-update', 'id' => $model->id]);
            } else {
                return $this->render('update', [
                            'model' => $model,
                ]);
            }
        } else {
            throw new HttpException(403, 'You are not allowed to access this page', 0);
        }
    }

    public function actionReplay($id)
    {
        $model = $this->findModel($id);
        $new = new GuestbookModel;
        $new->setAttribute("create_et", date("Y-m-d H:i:s"));
        $new->setAttribute("update_et", date("Y-m-d H:i:s"));
        $new->setAttribute("status", "Publish");
        if ($new->load(Yii::$app->request->post()) && $new->save()) {
            $model->status = 'Publish';
            $model->save();
            return $this->redirect(['replay', 'action' => 'guestbook-replay', 'id' => $id]);
        } else {
            return $this->render('replay', [
                        'model' => $model,
                        'child' => $model->findAllByParentId($id)
            ]);
        }
    }

    /**
     * Deletes an existing Guestbook model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if (Yii::$app->user->can('guestbookdelete')) {
            $model = $this->findModel($id);
            $model->deleteAll(['parent_id' => $id]);
            $model->delete();
            return $this->redirect(['index', 'action' => 'guestbook-list']);
        } else {
            throw new HttpException(403, 'You are not allowed to access this page', 0);
        }
    }
    
    /**
     * @param array $data
     * @return \yii\web\Response
     */
    protected function deleteAll($data)
    {
        if (null != $data) {

            foreach ($data as $id) {
                $model = $this->findModel($id);  
                $model->deleteAll(['parent_id' => $id]);
                $model->delete();
            }
            return $this->redirect(['index', 'action' => 'guestbook-list']);
        } else {
            return $this->redirect(['index', 'action' => 'guestbook-list']);
        }
    }

    /**
     * Finds the Guestbook model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return GuestbookModel the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = GuestbookModel::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
