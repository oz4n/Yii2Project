<?php

namespace app\modules\appearance\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use app\modules\appearance\Appearance;
use app\modules\appearance\models\MenuModel;
use app\modules\appearance\models\PageModel;
use yii\web\HttpException;

/**
 * MenuController implements the CRUD actions for MenuModel model.
 */
class MenuController extends Controller
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
     * Lists all MenuModel models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->can('menuindex')) {
            $model = new MenuModel;
            $param = Yii::$app->request->getQueryParams();
            return $this->render('index', [
                        'model' => isset($param['id']) ? $this->findModel($param['id']) : $model,
                        'termmenu' => $model->getTermMenus(),
                        'taxmenu' => isset($param['id']) ? $param['id'] : null,
                        'menuitemlength' => isset($param['id']) ? $model->countMenuItem($param['id']) : null
            ]);
        } else {
            throw new HttpException(403, 'You are not allowed to access this page', 0);
        }
    }

    /**
     * Creates a new MenuModel model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->can('menucreate')) {
            $model = new MenuModel;
            $model->setAttribute('term_id', Appearance::APPEARANCE_MENU_TERM);
            $model->setAttribute('type', Appearance::APPEARANCE_MENU_TERM_TYPE_TERM);
            $model->setAttribute('create_et', date("Y-m-d H:i:s"));
            $model->setAttribute('update_et', date("Y-m-d H:i:s"));
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['index', 'action' => 'appearance-menu-list', 'id' => $model->id]);
            } else {
                return $this->render('create', [
                            'model' => $model,
                ]);
            }
        } else {
            throw new HttpException(403, 'You are not allowed to access this page', 0);
        }
    }

    public function actionAddpagetomenu()
    {
        if (Yii::$app->user->can('menuaddpagetomenu')) {
            if (Yii::$app->request->isAjax) {
                $param = Yii::$app->request->post();
                if (isset($param['Page'])) {
                    foreach ($param['Page'] as $id) {
                        $page = PageModel::findOne($id);
                        $model = new MenuModel;
                        $model->term_id = Appearance::APPEARANCE_MENU_TERM_ITEM;
                        $model->type = $page->type == "pagehelper" ? Appearance::APPEARANCE_MENU_TERM_TYPE_HELPER : Appearance::APPEARANCE_MENU_TERM_TYPE_PAGE;
                        $model->taxmenu = $param['MenuModel']['id'];
                        $model->create_et = date("Y-m-d H:i:s");
                        $model->update_et = date("Y-m-d H:i:s");
                        $model->slug = $page->type == "pagehelper" ? '/' . str_replace("-", "/", $page->slug) : $page->slug;
                        $model->name = $page->title;
                        $model->description = "Menu item " . $page->title;
                        $model->save();
                    }
                    echo Json::encode([
                        'status' => true,
                    ]);
                } else {
                    echo Json::encode([
                        'status' => false,
                        'type' => 'error',
                        'info' => 'Pilih salah satu kategory yang akan dijadikan menu.'
                    ]);
                }
            } else {
                throw new NotFoundHttpException('The requested page does not exist.');
            }
        } else {
            throw new HttpException(403, 'You are not allowed to access this page', 0);
        }
    }

    /**
     * Creates a new MenuModel model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionAddcattomenu()
    {
        if (Yii::$app->user->can('menuaddcattomenu')) {
            if (Yii::$app->request->isAjax) {
                $param = Yii::$app->request->post();
                if (isset($param['Category'])) {
                    foreach ($param['Category'] as $id) {
                        $cat = $this->findModel($id);
                        $model = new MenuModel;
                        $model->term_id = Appearance::APPEARANCE_MENU_TERM_ITEM;
                        $model->type = Appearance::APPEARANCE_MENU_TERM_TYPE_ITEM;
                        $model->taxmenu = $param['MenuModel']['id'];
                        $model->create_et = date("Y-m-d H:i:s");
                        $model->update_et = date("Y-m-d H:i:s");
                        $model->slug = $cat->slug;
                        $model->name = $cat->name;
                        $model->description = "Menu item " . $cat->name;
                        $model->save();
                    }
                    echo Json::encode([
                        'status' => true,
                    ]);
                } else {
                    echo Json::encode([
                        'status' => false,
                        'type' => 'error',
                        'info' => 'Pilih salah satu kategory yang akan dijadikan menu.'
                    ]);
                }
            } else {
                throw new NotFoundHttpException('The requested page does not exist.');
            }
        } else {
            throw new HttpException(403, 'You are not allowed to access this page', 0);
        }
    }

    public function actionAddlinktomenu()
    {
        if (Yii::$app->user->can('menuaddlinktomenu')) {

            if (Yii::$app->request->isAjax) {
                $param = Yii::$app->request->post();
                $model = new MenuModel;
                $model->term_id = Appearance::APPEARANCE_MENU_TERM_ITEM;
                $model->type = Appearance::APPEARANCE_MENU_TERM_TYPE_LINK;
                $model->taxmenu = $param['MenuModel']['id'];
                $model->name = $param['MenuModel']['name'];
                $model->slug = $param['MenuModel']['slug'];
                $model->create_et = date("Y-m-d H:i:s");
                $model->update_et = date("Y-m-d H:i:s");
                if ($model->save()) {
                    echo Json::encode([
                        'status' => true,
                    ]);
                } else {
                    echo Json::encode([
                        'status' => false,
                        'type' => 'error',
                        'info' => 'Pilih salah satu kategory yang akan dijadikan menu.'
                    ]);
                }
            } else {
                throw new NotFoundHttpException('The requested page does not exist.');
            }
        } else {
            throw new HttpException(403, 'You are not allowed to access this page', 0);
        }
    }

    /**
     * Updates an existing MenuModel model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if (Yii::$app->user->can('menuupdate')) {
            $model = $this->findModel($id);
            $model->setAttribute('update_et', date("Y-m-d H:i:s"));
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['index', 'action' => 'appearance-menu-list', 'id' => $model->id]);
            } else {
                throw new NotFoundHttpException('The requested page does not exist.');
            }
        } else {
            throw new HttpException(403, 'You are not allowed to access this page', 0);
        }
    }

    public function actionTest()
    {
        if (Yii::$app->user->can('menutest')) {
            $data = '[{"parent":"","position":0,"id":78},{"parent":"","position":1,"id":121,"children":[{"parent":"","position":3,"id":126},{"parent":"","position":2,"id":62},{"parent":"","position":4,"id":122},{"parent":"","position":5,"id":125}]},{"parent":"","position":6,"id":74},{"parent":"","position":7,"id":72},{"parent":"","position":8,"id":79},{"parent":"","position":9,"id":63},{"parent":"","position":10,"id":76},{"parent":"","position":11,"id":124},{"parent":"","position":12,"id":123}]';
            $d = $this->parseJsonArray(Json::decode($data));
            echo "<pre>";
            print_r($d);
        } else {
            throw new HttpException(403, 'You are not allowed to access this page', 0);
        }
    }

    public function actionUpdateposition()
    {
        if (Yii::$app->user->can('menuupdateposition')) {
            if (Yii::$app->request->isAjax) {
                $param = Yii::$app->request->post();
                $data = Json::decode($param['data']);
//            print_r($data);
//             foreach ($data as $v) {  
//               $model = $this->findModel($v['id']);
//                $model->parent_id = $v['parent'];
//                $model->position = $v['position'];
//                $model->save();
////                 echo $v['id'];
////                $model = $this->findModel($v['id']);
////                $model->parent_id = $v['parent'];
////                $model->position = "$key";
////                $model->save();
//            }
                foreach ($this->parseJsonArray($data) as $v) {
                    $model = $this->findModel($v['id']);
                    $model->parent_id = $v['parent'] != null ? $v['parent'] : NULL;
                    $model->position = $v['position'];
                    $model->save();
                }
            } else {
                throw new NotFoundHttpException('The requested page does not exist.');
            }
        } else {
            throw new HttpException(403, 'You are not allowed to access this page', 0);
        }
    }

    public function actionDeletemenuitem()
    {
        if (Yii::$app->request->isAjax) {
            $param = Yii::$app->request->post();
            $this->findModel($param['dataid'])->delete();
            echo Json::encode([
                'status' => true,
                'Info' => 'Berhasil',
                'text' => 'Menu item berhasil di hapus'
            ]);
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionDeletemenuterm()
    {
        if (Yii::$app->user->can('menudeletemenuterm')) {
            if (Yii::$app->request->isAjax) {
                $param = Yii::$app->request->post();
                $model = new MenuModel;
                $model->deleteAll(['taxmenu' => $param['dataid']]);
                $this->findModel($param['dataid'])->delete();
                echo Json::encode([
                    'status' => true,
                    'Info' => 'Berhasil',
                    'text' => 'Menu item berhasil di hapus'
                ]);
            } else {
                throw new NotFoundHttpException('The requested page does not exist.');
            }
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Deletes an existing MenuModel model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if (Yii::$app->user->can('menudelete')) {
            $this->findModel($id)->delete();
            return $this->redirect(['index']);
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Finds the MenuModel model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MenuModel the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MenuModel::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findAllTaxMenu($taxmenu)
    {
        if (($model = MenuModel::findAllMenuByTaxMenu($taxmenu)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function parseJsonArray($jsonArray, $parentID = NULL)
    {
        $return = [];
        foreach ($jsonArray as $subArray) {
            $returnSubSubArray = [];
            if (isset($subArray['children'])) {
                $returnSubSubArray = $this->parseJsonArray($subArray['children'], $subArray['id']);
            }
            $return[] = ['id' => $subArray['id'], 'parent' => $parentID, 'position' => $subArray['position']];
            $return = array_merge($return, $returnSubSubArray);
        }
        return $return;
    }

}
