<?php

namespace app\modules\appearance\controllers;


use Yii;
use app\modules\appearance\models\WidgetModel;
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
     * Creates a new Widget model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id)
    {
        if (Yii::$app->user->can('widgetcreate')) {
            $model = $this->findModel($id);

            $new = new WidgetModel;
            $new->setAttribute('create_et', date("Y-m-d H:i:s"));
            $new->setAttribute('update_et', date("Y-m-d H:i:s"));

            if (($param = Yii::$app->request->post('WidgetModel'))) {
                switch ($model->type) {
                    case "RecentPosts":
                        $new->setPostAttr($new, $param);
                        break;
                    case "Contact";
                        $new->setContactAttr($new, $param);
                        break;
                    case "SosialNetwork";
                        $new->setSosialNetworkAttr($new, $param);
                        break;
                }

            }

            if ($new->load(Yii::$app->request->post()) && $new->save()) {
                return $this->redirect(['update', 'action' => 'appearance-widget-update', 'id' => $new->id]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                    "new" => $new
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

            if (($param = Yii::$app->request->post('WidgetModel'))) {
                switch ($model->type) {
                    case "RecentPosts":
                        $new->setPostAttr($new, $param);
                        break;
                    case "Contact";
                        $new->setContactAttr($new, $param);
                        break;
                    case "SosialNetwork";
                        $new->setSosialNetworkAttr($new, $param);
                        break;
                }
            }
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['update', 'action' => 'appearance-widget-update', 'id' => $model->id]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                    "new" => $model
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


    public function actionDeletewidgetitem()
    {
        if (Yii::$app->user->can('widgetdeleteitem')) {
            if (Yii::$app->request->isAjax) {
                $param = Yii::$app->request->post();
                $this->findModel($param['dataid'])->delete();
                echo Json::encode([
                    'status' => true,
                    'Info' => 'Berhasil',
                    'text' => 'Widget item berhasil di hapus'
                ]);
            } else {
                throw new NotFoundHttpException('The requested page does not exist.');
            }
        } else {
            throw new HttpException(403, 'You are not allowed to access this page', 0);
        }
    }

    /**
     * Finds the Widget model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return WidgetModel the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = WidgetModel::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
