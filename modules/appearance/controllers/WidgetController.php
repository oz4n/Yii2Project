<?php

namespace app\modules\appearance\controllers;

use Yii;
use app\modules\dao\ar\Widget;
use app\modules\appearance\searchs\WidgetSearc;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\HttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;

/**
 * WidgetController implements the CRUD actions for Widget model.
 */
class WidgetController extends Controller
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
     * Lists all Widget models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->can('widgetindex')) {
            $model = new WidgetSearc;
            return $this->render('index', [
                        'defaultwidget' => $model->loadAllDefaultWidget(),
                        'sidebarwidget' => $model->loadAllSidebarWidget(),
                        'footerwidget' => $model->loadAllFooterWidget()
            ]);
        } else {
            throw new HttpException(403, 'You are not allowed to access this page', 0);
        }
    }

    /**
     * Displays a single Widget model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->can('widgetview')) {
            return $this->render('view', [
                        'model' => $this->findModel($id),
            ]);
        } else {
            throw new HttpException(403, 'You are not allowed to access this page', 0);
        }
    }

    /**
     * Creates a new Widget model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->can('widgetcreate')) {
            $model = new Widget;

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
     * Updates an existing Widget model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if (Yii::$app->user->can('widgetupdate')) {
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

    public function actionUpdateposition()
    {
        if (Yii::$app->request->isAjax) {
            $param = Yii::$app->request->post();
            $data = Json::decode($param['data']);

            foreach ($data as $k => $v) {
                $model = $this->findModel($v['id']);
                $model->position = $k;
                $model->layoute_position = $v['layoute'];
                $model->save();
            }
            echo Json::encode([
                'text' => 'Posisi berhasil diperbaharui.'
            ]);
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Deletes an existing Widget model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if (Yii::$app->user->can('widgetdelete')) {
            $this->findModel($id)->delete();

            return $this->redirect(['index']);
        } else {
            throw new HttpException(403, 'You are not allowed to access this page', 0);
        }
    }

    /**
     * Finds the Widget model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Widget the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Widget::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
