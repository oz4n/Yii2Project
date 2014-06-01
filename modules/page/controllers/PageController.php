<?php

namespace app\modules\page\controllers;
define("DS", DIRECTORY_SEPARATOR);
use Yii;
use app\modules\page\models\PageModel;
use app\modules\page\searchs\PageSerch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use yii\imagine\Image;
use Symfony\Component\Filesystem\Filesystem;

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
        $searchModel = new PageSerch;
        $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());

        return $this->render('index', [
                    'dataProvider' => $dataProvider,
                    'searchModel' => $searchModel,
        ]);
    }

    /**
     * Displays a single Post model.
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
     * Creates a new Post model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PageModel;
        $model->setAttribute('create_et', date("Y-m-d H:i:s"));
        $model->setAttribute('update_et', date("Y-m-d H:i:s"));
        $model->setAttribute('type', 'page');
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                        'model' => $model,
                        'other' => ['imgsliderstatus' => 'Disable']
            ]);
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
            $img = explode(',', $param['imgslider']);
            $other = Json::decode($model->other_content);
            foreach ($other['imgslider'] as $v) {
                $file = new Filesystem();
                $file->remove($this->path . 'pageslider' . DS . 'page' . DS . $v);
            }
            foreach ($img as $v) {
                Image::thumbnail($this->path . 'original' . DS . $v, 1024, 384)->save($this->path . 'pageslider' . DS . 'page' . DS . $v);
            }            
            $data['imgslider'] = $img;
        }

        if ($model->load(Yii::$app->request->post())) {
            $model->setAttribute('other_content', Json::encode($data));
            $model->save();
            return $this->redirect(['update', 'action' => 'page-update', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                        'model' => $model,
                        'other' => Json::decode($model->other_content)
            ]);
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
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
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

}
