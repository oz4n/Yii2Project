<?php

namespace app\modules\word\controllers;

use Yii;
use yii\web\Controller;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\modules\word\Word;
use app\modules\word\models\CategoryModel;
use app\modules\word\searchs\CategorySerch;

/**
 * CategoryController implements the CRUD actions for Taxonomy model.
 */
class CategoryController extends Controller
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
     * Lists all CategoryModel models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->can('categoryindex')) {
            $searchModel = new CategorySerch;
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
     * Displays a single CategoryModel model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->can('categoryview')) {
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        } else {
            throw new HttpException(403, 'You are not allowed to access this page', 0);
        }
    }

    /**
     * Creates a new CategoryModel model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->can('categorycreate')) {
            $model = new CategoryModel;
            $model->setAttribute('term_id', Word::WORD_CATEGORY);
            $model->setAttribute('create_et', date("Y-m-d H:i:s"));
            $model->setAttribute('update_et', date("Y-m-d H:i:s"));
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view',
                    'action' => 'word-category-view',
                    'id' => $model->id
                ]);
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
     * Updates an existing CategoryModel model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if (Yii::$app->user->can('categoryupdate')) {
            $model = $this->findModel($id);
            $model->setAttribute('update_et', date("Y-m-d H:i:s"));
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view',
                    'action' => 'word-category-view',
                    'id' => $model->id
                ]);
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
        if (Yii::$app->user->can('categorybulk')) {
            if (Yii::$app->request->post() && (Yii::$app->request->post('bulk_action1') == 'delete' || Yii::$app->request->post('bulk_action2') == 'delete')) {
                $this->deleteAll(Yii::$app->request->post('selection'));
                return $this->redirect(['index',
                    'action' => 'word-category-list'
                ]);
            } else {
                return $this->redirect(['index',
                    'action' => 'word-category-list'
                ]);
            }
        } else {
            throw new HttpException(403, 'You are not allowed to access this page', 0);
        }
    }

    /**
     * Deletes an existing CategoryModel model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if (Yii::$app->user->can('categorydelete')) {
            $this->findModel($id)->delete();
            return $this->redirect(['index',
                'action' => 'word-category-list'
            ]);
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
            return $this->redirect(['index', 'action' => 'word-category-list']);
        }
    }

    /**
     * Finds the CategoryModel model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CategoryModel the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CategoryModel::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
