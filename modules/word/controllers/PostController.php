<?php

namespace app\modules\word\controllers;

use Yii;
use app\modules\word\models\PostModel;
use app\modules\word\searchs\PostSerch;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\modules\word\Word;

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
        if (Yii::$app->user->can('postindex')) {
            $searchModel = new PostSerch;
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
     * Displays a single PostModel model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->can('postview')) {
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        } else {
            throw new HttpException(403, 'You are not allowed to access this page', 0);
        }
    }

    /**
     * Creates a new PostModel model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->can('postcreate')) {
            $model = new PostModel;
            $model->setAttribute('user_id', Yii::$app->user->getId());
            $model->setAttribute('create_et', date("Y-m-d H:i:s"));
            $model->setAttribute('update_et', date("Y-m-d H:i:s"));
            $model->setAttribute('type', Word::POST_POST_TYPE_INFO);
            if ($model->load(Yii::$app->request->post())) {
                $param = Yii::$app->request->post("PostModel");
                $data = [];
                if (null != $param["category"]) {
                    $cat = $model->findAllCategoryAttrById($param["category"]);
                    $this->category = $param["category"];
                    $data["category"] = $cat;
                } else {
                    $data["category"] = [
                        [
                            'id' => 0,
                            'name' => 'Informasi',
                            'slug' => 'info'
                        ]
                    ];
                }
                if (null != $param['tag']) {
                    $tag = $model->findAllTagAttrById($param["tag"]);
                    $this->tag = $param["tag"];
                    $data['tag'] = $tag;
                }
                $model->other_content = Json::encode($data);
                $model->save();

                if (null != $param['tag']) {
                    $model->saveTagRelation($this->tag, $model->id);
                }

                if (null != $param['category']) {
                    $model->saveCatRelation($this->category, $model->id);
                }
                return $this->redirect(['update', 'action' => 'word-post-update', 'id' => $model->id]);
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
     * Updates an existing PostModel model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if (Yii::$app->user->can('postupdate')) {
            $model = $this->findModel($id);
            $model->setAttribute('update_et', date("Y-m-d H:i:s"));
            if ($model->load(Yii::$app->request->post())) {
                $param = Yii::$app->request->post("PostModel");
                $data = [];
                if (null != $param["category"]) {
                    $cat = $model->findAllCategoryAttrById($param["category"]);
                    $this->category = $param["category"];
                    $data['category'] = $cat;
                } else {
                    $data["category"] = [
                        [
                            'id' => 0,
                            'name' => 'Informasi',
                            'slug' => 'info'
                        ]
                    ];
                }
                if (null != $param['tag']) {
                    $tag = $model->findAllTagAttrById($param["tag"]);
                    $this->tag = $param["tag"];
                    $data['tag'] = $tag;
                }
                $model->other_content = Json::encode($data);
                $model->save();

                if (null != $param['tag']) {
                    $model->deleteTagRelation($this->tag, $model->id);
                    $model->saveTagRelation($this->tag, $model->id);
                }

                if (null != $param['category']) {
                    $model->deleteCatRelation($this->category, $model->id);
                    $model->saveCatRelation($this->category, $model->id);
                }
                return $this->redirect(['update', 'action' => 'word-post-update', 'id' => $model->id]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        } else {
            throw new HttpException(403, 'You are not allowed to access this page', 0);
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
        if (Yii::$app->user->can('postdelete')) {
            $this->findModel($id)->delete();
            return $this->redirect(['index',
                'action' => 'word-post-list'
            ]);
        } else {
            throw new HttpException(403, 'You are not allowed to access this page', 0);
        }
    }

    public function actionBulk()
    {
        if (Yii::$app->user->can('postbulk')) {
        } else {
            throw new HttpException(403, 'You are not allowed to access this page', 0);
        }

    }

    public function actionTrash($id)
    {
        if (Yii::$app->user->can('posttrash')) {
            $model = $this->findModel($id);
            $model->status = 'Trash';
            $model->save();
            return $this->redirect(['index',
                'action' => 'word-post-list'
            ]);
        } else {
            throw new HttpException(403, 'You are not allowed to access this page', 0);
        }
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
