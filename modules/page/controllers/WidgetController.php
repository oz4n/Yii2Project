<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 6/11/14
 * Time: 1:55 AM
 */

namespace app\modules\page\controllers;

use Yii;
use app\modules\appearance\models\WidgetModel;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\HttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;

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
     * Creates a new Widget model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id)
    {
        if (Yii::$app->user->can('pagewidgetcreate')) {
            $model = $this->findModel($id);
            $get = $this->getPage();
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
                    case "GuestBook";
                        $new->setGuestBookAttr($new, $param);
                        break;
                }
            }

            if ($new->load(Yii::$app->request->post()) && $new->save()) {
                return $this->redirect(['update', 'action' => 'appearance-widget-update', 'id' => $new->id, "page" => $get['page'],  'pagename' => $get['pagename'], 'pagetype' => $get['pagetype']]);
            } else {
                return $this->render('create', [
                            'model' => $model,
                            "new" => $new,
                            "pagename" => $get["pagename"],
                            "page" => $get['page'],
                            'pagetype' => $get['pagetype']
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
        if (Yii::$app->user->can('pagewidgetupdate')) {
            $model = $this->findModel($id);
            $get = $this->getPage();
            if (($param = Yii::$app->request->post('WidgetModel'))) {
                switch ($model->type) {
                    case "RecentPosts":
                        $model->setPostAttr($model, $param);
                        break;
                    case "Contact";
                        $model->setContactAttr($model, $param);
                        break;
                    case "SosialNetwork";
                        $model->setSosialNetworkAttr($model, $param);
                        break;
                    case "GuestBook";
                        $model->setGuestBookAttr($model, $param);
                        break;
                }
            }
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['update', 'action' => 'appearance-widget-update', 'id' => $model->id, "pagename" => $get["pagename"], "page" => $get['page'], 'pagetype' => $get['pagetype']]);
            } else {
                return $this->render('update', [
                            'model' => $model,
                            "new" => $model,
                            "pagename" => $get["pagename"],
                            "page" => $get['page'],
                            'pagetype' => $get['pagetype']
                ]);
            }
        } else {
            throw new HttpException(403, 'You are not allowed to access this page', 0);
        }
    }

    public function actionUpdateposition()
    {
        if (Yii::$app->user->can('pagewidgetupdateposition')) {
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
        } else {
            throw new HttpException(403, 'You are not allowed to access this page', 0);
        }
    }

    public function actionDeletewidgetitem()
    {
        if (Yii::$app->user->can('pagewidgetdeleteitem')) {
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

    protected function getPage()
    {
        $page = Yii::$app->request->getQueryParams();
        if ((isset($page['page']) && isset($page['pagename']) && ($page['page'] != null && $page['pagename'] != null) && (isset($page['pagetype']) && $page['pagetype'] != null))) {
            return $page;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
