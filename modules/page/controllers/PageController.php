<?php

namespace app\modules\page\controllers;

use app\modules\page\models\WidgetModel;
use Yii;
use app\modules\page\models\PageModel;
use app\modules\page\searchs\PageSerch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use yii\imagine\Image;
use Symfony\Component\Filesystem\Filesystem;
use yii\web\HttpException;

/**
 * PageController implements the CRUD actions for Post model.
 */
class PageController extends Controller
{

    public $path;

    public function init()
    {
        $this->path = Yii::$app->getBasePath() . DS . 'web' . DS . 'resources' . DS . 'images' . DS;
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

    /**
     * Lists all Post models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->can('pageindex')) {
            $searchModel = new PageSerch;
            $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());
            if ((Yii::$app->request->get('bulk_action1') == 'delete' || Yii::$app->request->get('bulk_action2') == 'delete')) {
                $this->deleteAll(Yii::$app->request->get('selection'));
            }
            if ((Yii::$app->request->get('bulk_action1') == 'trash' || Yii::$app->request->get('bulk_action2') == 'trash')) {
                $this->trashAll(Yii::$app->request->get('selection'));
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
     * Creates a new Post model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->can('pagecreate')) {
            $model = new PageModel;
            $model->setAttribute('create_et', date("Y-m-d H:i:s"));
            $model->setAttribute('update_et', date("Y-m-d H:i:s"));
            $model->setAttribute('type', 'page');
            $param = Yii::$app->request->post('PageModel');
            $data = [];
            if (isset($param['imgsliderstatus']) && null != $param['imgsliderstatus']) {
                $data['imgsliderstatus'] = $param['imgsliderstatus'];
            } else {
                $data['imgsliderstatus'] = 'Disable';
            }

            if (isset($param['imgslider']) && null != $param['imgslider']) {
                $img = explode(',', $param['imgslider']);
                foreach ($img as $v) {
                    Image::thumbnail($this->path . 'original' . DS . $v, 970, 384)->save($this->path . 'pageslider' . DS . 'page' . DS . $v, ['quality' => 80]);
                }
                $data['imgslider'] = $img;
            }
            $model->setAttribute('other_content', Json::encode($data));
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['update', 'action' => 'page-update', 'id' => $model->id]);
            } else {
                return $this->render('create', [
                            'model' => $model,
                            'other' => ['imgsliderstatus' => 'Disable']
                ]);
            }
        } else {
            throw new HttpException(403, 'You are not allowed to access this page', 0);
        }
    }

    /**
     * Updates an existing Post model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if (Yii::$app->user->can('pageupdate')) {
            $model = $this->findModel($id);
            $model->setAttribute('update_et', date("Y-m-d H:i:s"));
            $param = Yii::$app->request->post('PageModel');

            $data = [];
            if (isset($param['imgsliderstatus']) && null != $param['imgsliderstatus']) {
                $data['imgsliderstatus'] = $param['imgsliderstatus'];
            } else {
                $data['imgsliderstatus'] = 'Disable';
            }

            if (isset($param['imgslider']) && null != $param['imgslider']) {
                if ($param["type"] == "page") {
                    $img = explode(',', $param['imgslider']);
                    $other = Json::decode($model->other_content);
                    if (isset($other['imgslider'])) {
                        foreach ($other['imgslider'] as $v) {
                            $file = new Filesystem();
                            $file->remove($this->path . 'pageslider' . DS . 'page' . DS . $v);
                        }
                    }

                    foreach ($img as $v) {
                        Image::thumbnail($this->path . 'original' . DS . $v, 970, 384)->save($this->path . 'pageslider' . DS . 'page' . DS . $v, ['quality' => 80]);
                    }
                    $images = [];
                    foreach ($img as $k => $v) {
                        $images["img$k"] = $v;
                    }
                    $data['imgslider'] = $images;
                }
                if ($param["type"] == "pagehelper") {
                    $homeimage = json_decode($param['imgslider']);
                    $data['imgslider'] = $homeimage;
                    $data['slider_title1'] = isset($param['slider_title1']) ? $param['slider_title1'] : null;
                    $data['slider_title2'] = isset($param['slider_title2']) ? $param['slider_title2'] : null;
                    $data['slider_title3'] = isset($param['slider_title3']) ? $param['slider_title3'] : null;
                    $data['quotes_today'] = isset($param['quotes_today']) ? $param['quotes_today'] : null;
                    //remove image slider
                    $other = json_decode($model->other_content);
                    if (isset($other->imgslider)) {
                        $this->removeImageSLider($other->imgslider);
                    }

                    //resize image slider                 
                    $this->resizeImageSLider($homeimage);
                }
            }

            if ($model->load(Yii::$app->request->post())) {
                $model->setAttribute('other_content', Json::encode($data));
                $model->save();
                return $this->redirect(['update', 'action' => 'page-update', 'id' => $model->id]);
            } else {
                $widget = new WidgetModel;
                switch ($model->content) {
                    case "pagehome":
                        return $this->render('update', [
                                    'widgetleft' => $widget->loadAllHomeLeftWidget(),
                                    'widgetright' => $widget->loadAllHomeRightWidget(),
                                    'widgetsidebar' => $widget->loadAllHomeSidebarWidget(),
                                    'defaultwidget' => $widget->loadAllDefaultWidget(),
                                    'page' => $id,
                                    'pagename' => $model->title,
                                    'model' => $model,
                                    'pagetype' => $model->content,
                                    'other' => json_decode($model->other_content)
                        ]);
                    case "pagecontact":
                        return $this->render('update', [
                                    'widgetsidebar' => $widget->loadAllContactSidebarWidget(),
                                    'defaultwidget' => $widget->loadAllDefaultWidget(),
                                    'page' => $id,
                                    'pagename' => $model->title,
                                    'pagetype' => $model->content,
                                    'model' => $model,
                                    'other' => json_decode($model->other_content)
                        ]);
                    case "pagememberppi":
                        return $this->render('update', [
                                    'widgetsidebar' => $widget->loadAllPpiSidebarWidget(),
                                    'defaultwidget' => $widget->loadAllDefaultWidget(),
                                    'page' => $id,
                                    'pagename' => $model->title,
                                    'pagetype' => $model->content,
                                    'model' => $model,
                                    'other' => json_decode($model->other_content)
                        ]);
                    case "pagememberpaskibra":
                        return $this->render('update', [
                                    'widgetsidebar' => $widget->loadAllPaskibraSidebarWidget(),
                                    'defaultwidget' => $widget->loadAllDefaultWidget(),
                                    'page' => $id,
                                    'pagename' => $model->title,
                                    'pagetype' => $model->content,
                                    'model' => $model,
                                    'other' => json_decode($model->other_content)
                        ]);
                    case "pagemembercapas":
                        return $this->render('update', [
                                    'widgetsidebar' => $widget->loadAllCapasSidebarWidget(),
                                    'defaultwidget' => $widget->loadAllDefaultWidget(),
                                    'page' => $id,
                                    'pagename' => $model->title,
                                    'pagetype' => $model->content,
                                    'model' => $model,
                                    'other' => json_decode($model->other_content)
                        ]);
                    default :
                        return $this->render('update', [
                                    'widgetleft' => $widget->loadAllHomeLeftWidget(),
                                    'widgetright' => $widget->loadAllHomeRightWidget(),
                                    'widgetsidebar' => $widget->loadAllHomeSidebarWidget(),
                                    'defaultwidget' => $widget->loadAllDefaultWidget(),
                                    'page' => $id,
                                    'pagename' => $model->title,
                                    'model' => $model,
                                    'other' => json_decode($model->other_content)
                        ]);
                }
            }
        } else {
            throw new HttpException(403, 'You are not allowed to access this page', 0);
        }
    }

    /**
     * Deletes an existing Post model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if (Yii::$app->user->can('pagedelete')) {
            $model = $this->findModel($id);
            if ($model->type == "pagehelper") {
                return $this->redirect(['index', 'action' => 'page-list']);
            } else {
                $other = Json::decode($model->other_content);
                if (isset($other['imgslider']) && null != $other['imgslider']) {
                    foreach ($other['imgslider'] as $value) {
                        $file = new Filesystem();
                        $file->remove($this->path . 'pageslider' . DS . 'page' . DS . $value);
                    }
                }
                $model->delete();
                return $this->redirect(['index', 'action' => 'page-list']);
            }
        } else {
            throw new HttpException(403, 'You are not allowed to access this page', 0);
        }
    }

    public function actionTrash($id)
    {
        if (Yii::$app->user->can('pagetrash')) {
            $model = $this->findModel($id);
            $model->status = 'Trash';
            $model->save();
            return $this->redirect(['index', 'action' => 'page-list']);
        } else {
            throw new HttpException(403, 'You are not allowed to access this page', 0);
        }
    }

    protected function trashAll($data)
    {
        if (null != $data) {
            foreach ($data as $id) {
                $model = $this->findModel($id);
                $model->status = 'Trash';
                $model->save();
            }
            return $this->redirect(['index', 'action' => 'page-list']);
        } else {
            return $this->redirect(['index', 'action' => 'page-list']);
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
                if ($model->type !== "pagehelper") {
                    $other = Json::decode($model->other_content);
                    if (isset($other['imgslider']) && null != $other['imgslider']) {
                        foreach ($other['imgslider'] as $value) {
                            $file = new Filesystem();
                            $file->remove($this->path . 'pageslider' . DS . 'page' . DS . $value);
                        }
                    }
                    $model->delete();
                }
            }
            return $this->redirect(['index', 'action' => 'page-list']);
        } else {
            return $this->redirect(['index', 'action' => 'page-list']);
        }
    }

    /**
     * Finds the Post model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Post the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PageModel::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function removeImageSLider($image)
    {
        $file = new Filesystem();
        if ($image->imgslide1 != false) {
            $file->remove($this->path . 'pageslider' . DS . 'helperpage' . DS . $image->imgslide1);
        }
        if ($image->imgslide2 != false) {
            $file->remove($this->path . 'pageslider' . DS . 'helperpage' . DS . $image->imgslide2);
        }
        if ($image->imgslide3 != false) {
            $file->remove($this->path . 'pageslider' . DS . 'helperpage' . DS . $image->imgslide3);
        }

        if ($image->imgslide4 != false) {
            $file->remove($this->path . 'pageslider' . DS . 'helperpage' . DS . $image->imgslide4);
        }
        if ($image->imgslide5 != false) {
            $file->remove($this->path . 'pageslider' . DS . 'helperpage' . DS . $image->imgslide5);
        }
        if ($image->imgslide6 != false) {
            $file->remove($this->path . 'pageslider' . DS . 'helperpage' . DS . $image->imgslide6);
        }
        if ($image->imgslide7 != false) {
            $file->remove($this->path . 'pageslider' . DS . 'helperpage' . DS . $image->imgslide7);
        }
        if ($image->imgslide8 != false) {
            $file->remove($this->path . 'pageslider' . DS . 'helperpage' . DS . $image->imgslide8);
        }
        if ($image->imgslide9 != false) {
            $file->remove($this->path . 'pageslider' . DS . 'helperpage' . DS . $image->imgslide9);
        }
    }

    protected function resizeImageSLider($image)
    {
        if (isset($image->imgslide1) && $image->imgslide1 != false) {
            Image::thumbnail($this->path . 'original' . DS . $image->imgslide1, 1080, 300)->save($this->path . 'pageslider' . DS . 'helperpage' . DS . $image->imgslide1, ['quality' => 80]);
        }
        if (isset($image->imgslide2) && $image->imgslide2 != false) {
            Image::thumbnail($this->path . 'original' . DS . $image->imgslide2, 1080, 300)->save($this->path . 'pageslider' . DS . 'helperpage' . DS . $image->imgslide2, ['quality' => 80]);
        }
        if (isset($image->imgslide3) && $image->imgslide3 != false) {
            Image::thumbnail($this->path . 'original' . DS . $image->imgslide3, 1080, 300)->save($this->path . 'pageslider' . DS . 'helperpage' . DS . $image->imgslide3, ['quality' => 80]);
        }

        if (isset($image->imgslide4) && $image->imgslide4 != false) {
            Image::thumbnail($this->path . 'original' . DS . $image->imgslide4, 150, 130)->save($this->path . 'pageslider' . DS . 'helperpage' . DS . $image->imgslide4, ['quality' => 80]);
        }
        if (isset($image->imgslide5) && $image->imgslide5 != false) {
            Image::thumbnail($this->path . 'original' . DS . $image->imgslide5, 200, 139)->save($this->path . 'pageslider' . DS . 'helperpage' . DS . $image->imgslide5, ['quality' => 80]);
        }
        if (isset($image->imgslide6) && $image->imgslide6 != false) {
            Image::thumbnail($this->path . 'original' . DS . $image->imgslide6, 200, 107)->save($this->path . 'pageslider' . DS . 'helperpage' . DS . $image->imgslide6, ['quality' => 80]);
        }
        if (isset($image->imgslide7) && $image->imgslide7 != false) {
            Image::thumbnail($this->path . 'original' . DS . $image->imgslide7, 150, 180)->save($this->path . 'pageslider' . DS . 'helperpage' . DS . $image->imgslide7, ['quality' => 80]);
        }
        if (isset($image->imgslide8) && $image->imgslide8 != false) {
            Image::thumbnail($this->path . 'original' . DS . $image->imgslide8, 100, 100)->save($this->path . 'pageslider' . DS . 'helperpage' . DS . $image->imgslide8, ['quality' => 80]);
        }
        if (isset($image->imgslide9) && $image->imgslide9 != false) {
            Image::thumbnail($this->path . 'original' . DS . $image->imgslide9, 100, 100)->save($this->path . 'pageslider' . DS . 'helperpage' . DS . $image->imgslide9, ['quality' => 80]);
        }
    }

}
