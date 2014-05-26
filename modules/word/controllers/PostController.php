<?php

namespace app\modules\word\controllers;

use Yii;
use app\modules\word\models\PostModel;
use app\modules\word\searchs\PostSerch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PostModelController implements the CRUD actions for PostModel model.
 */
class PostController extends Controller
{

    private $category;
    private $tag;

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
     * Lists all PostModel models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PostSerch;
        $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());

        return $this->render('index', [
                    'dataProvider' => $dataProvider,
                    'searchModel' => $searchModel,
        ]);
    }

    /**
     * Displays a single PostModel model.
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
     * Creates a new PostModel model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PostModel;
        $model->setAttribute('user_id', Yii::$app->user->getId());
        $model->setAttribute('create_et', date("Y-m-d H:i:s"));
        $model->setAttribute('update_et', date("Y-m-d H:i:s"));
        if ($model->load(Yii::$app->request->post())) {
            $param = Yii::$app->request->post("PostModel");
            $data = [];
            if (null != $param["category"]) {
                $cat = $model->findAllCategoryNameById($param["category"]);
                $this->category = $param["category"];
                array_push($data, ["category" => $cat]);
            }
            if (null != $param['tag']) {
                $tag = $model->findAllTagNameById($param["tag"]);
                $this->tag = $param["tag"];
                array_push($data, ['tag' => $tag]);
            }
            $model->other_content = \yii\helpers\Json::encode($data);
            $model->save();

            if (null != $param['tag']) {
                $model->saveTaxRelation($this->tag, $model->id);
            }

            if (null != $param['category']) {
                $model->saveTaxRelation($this->category, $model->id);
            }
            return $this->redirect(['view', 'action' => 'word-post-view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing PostModel model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->setAttribute('update_et', date("Y-m-d H:i:s"));
        if ($model->load(Yii::$app->request->post())) {
            $param = Yii::$app->request->post("PostModel");
            $data = [];
            if (null != $param["category"]) {
                $cat = $model->findAllCategoryNameById($param["category"]);
                $this->category = $param["category"];
                array_push($data, ["category" => $cat]);
            }
            if (null != $param['tag']) {
                $tag = $model->findAllTagNameById($param["tag"]);
                $this->tag = $param["tag"];
                array_push($data, ['tag' => $tag]);
            }
            $model->other_content = \yii\helpers\Json::encode($data);
            $model->save();

            if (null != $param['tag']) {
                $model->saveTaxRelation($this->tag, $model->id);
            }

            if (null != $param['category']) {
                $model->saveTaxRelation($this->category, $model->id);
            }
            return $this->redirect(['view', 'action' => 'word-post-view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing PostModel model.
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
     * Finds the PostModel model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PostModel the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PostModel::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
