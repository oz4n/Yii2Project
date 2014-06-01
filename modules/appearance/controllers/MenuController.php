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
use app\modules\appearance\models\TaxonomyModel;

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
        $model = new MenuModel;
        $param = Yii::$app->request->getQueryParams();
        return $this->render('index', [
                    'model' => isset($param['id']) ? $this->findModel($param['id']) : $model,
                    'termmenu' => $model->getTermMenus(),
                    'taxmenu' => isset($param['id']) ? $param['id'] : null,
                    'menuitemlength' => isset($param['id']) ? $model->countMenuItem($param['id']) : null
        ]);
    }

    /**
     * Displays a single MenuModel model.
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
     * Creates a new MenuModel model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
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
    }

    public function actionAddpagetomenu()
    {        
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
    }

    /**
     * Creates a new MenuModel model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionAddcattomenu()
    {

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
    }

    public function actionAddlinktomenu()
    {

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
    }

    /**
     * Updates an existing MenuModel model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->setAttribute('update_et', date("Y-m-d H:i:s"));
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'action' => 'appearance-menu-list', 'id' => $model->id]);
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionUpdateposition()
    {
        if (Yii::$app->request->isAjax) {
            $param = Yii::$app->request->post();
            foreach ($this->parseJsonArray(Json::decode($param['data'])) as $key => $v) {
                $model = $this->findModel($v['id']);
                $model->parent_id = $v['parent'];
                $model->position = $key;
                $model->save();
            }
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
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

    /**
     * Deletes an existing MenuModel model.
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

    protected function parseJsonArray($jsonArray, $parentID = NULL)
    {
        $return = array();
        foreach ($jsonArray as $subArray) {
            $returnSubSubArray = array();
            if (isset($subArray['children'])) {
                $returnSubSubArray = $this->parseJsonArray($subArray['children'], $subArray['id']);
            }
            $return[] = array('id' => $subArray['id'], 'parent' => $parentID);
            $return = array_merge($return, $returnSubSubArray);
        }
        return $return;
    }

}
