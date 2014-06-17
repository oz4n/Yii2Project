<?php

namespace app\modules\member\controllers;

use Yii;
use app\modules\member\models\BrevetAwardModel;
use app\modules\member\searchs\BrevetAwardSerch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\HttpException;

/**
 * BrevetawardController implements the CRUD actions for BrevetAwardModel model.
 */
class BrevetawardController extends Controller
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
     * Lists all BrevetAwardModel models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->can('brevetawardindex')) {
            $searchModel = new BrevetAwardSerch;
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
     * Displays a single BrevetAwardModel model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->can('brevetawardview')) {
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        } else {
            throw new HttpException(403, 'You are not allowed to access this page', 0);
        }
    }

    /**
     * Creates a new BrevetAwardModel model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->can('brevetawardcreate')) {
            $model = new BrevetAwardModel;
            $model->setAttribute('term_id', MEMBER_BREVET);
            $model->setAttribute('create_et', date("Y-m-d H:i:s"));
            $model->setAttribute('update_et', date("Y-m-d H:i:s"));
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'action' => 'member-brevet-view', 'id' => $model->id]);
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
     * Updates an existing BrevetAwardModel model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if (Yii::$app->user->can('brevetawardupdate')) {
            $model = $this->findModel($id);
            $model->setAttribute('update_et', date("Y-m-d H:i:s"));
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'action' => 'member-brevet-view', 'id' => $model->id]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        } else {
            throw new HttpException(403, 'You are not allowed to access this page', 0);
        }
    }

    public function actionBulk()
    {
        if (Yii::$app->user->can('brevetawardbulk')) {
            if (Yii::$app->request->post() && (Yii::$app->request->post('bulk_action1') == 'delete' || Yii::$app->request->post('bulk_action2') == 'delete')) {
                $this->deleteAll(Yii::$app->request->post('selection'));
                return $this->redirect(['index', 'action' => 'member-brevet-list']);
            } else {
                return $this->redirect(['index', 'action' => 'member-brevet-list']);
            }
        } else {
            throw new HttpException(403, 'You are not allowed to access this page', 0);
        }
    }

    /**
     * Deletes an existing BrevetAwardModel model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if (Yii::$app->user->can('brevetawarddelete')) {
            $this->findModel($id)->delete();

            return $this->redirect(['index', 'action' => 'member-brevet-list']);
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
                $this->findModel($id)->delete();
            }
        } else {
            return $this->redirect(['index', 'action' => 'member-brevet-list']);
        }
    }

    /**
     * Finds the BrevetAwardModel model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BrevetAwardModel the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BrevetAwardModel::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
