<?php

namespace app\modules\word\controllers;

use Yii;
use yii\web\Controller;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\modules\word\Word;
use app\modules\word\models\TagModel;
use app\modules\word\searchs\TagSerch;

/**
 * TagController implements the CRUD actions for Taxonomy model.
 */
class TagController extends Controller
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
     * Lists all TagModel models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->can('tagindex')) {
            $searchModel = new TagSerch;
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
     * Displays a single TagModel model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->can('tagview')) {
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        } else {
            throw new HttpException(403, 'You are not allowed to access this page', 0);
        }
    }

    /**
     * Creates a new TagModel model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->can('tagcreate')) {
            $model = new TagModel;
            $model->setAttribute('term_id', Word::WORD_TAG);
            $model->setAttribute('create_et', date("Y-m-d H:i:s"));
            $model->setAttribute('update_et', date("Y-m-d H:i:s"));
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'action' => 'word-tag-view', 'id' => $model->id]);
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
     * Updates an existing TagModel model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if (Yii::$app->user->can('tagupdate')) {
            $model = $this->findModel($id);
            $model->setAttribute('update_et', date("Y-m-d H:i:s"));
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view',
                    'action' => 'word-tag-view',
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
        if (Yii::$app->user->can('tagbulk')) {
            if (Yii::$app->request->post() && (Yii::$app->request->post('bulk_action1') == 'delete' || Yii::$app->request->post('bulk_action2') == 'delete')) {
                $this->deleteAll(Yii::$app->request->post('selection'));
                return $this->redirect(['index',
                    'action' => 'word-tag-list'
                ]);
            } else {
                return $this->redirect(['index',
                    'action' => 'word-tag-list'
                ]);
            }
        } else {
            throw new HttpException(403, 'You are not allowed to access this page', 0);
        }
    }

    /**
     * Deletes an existing TagModel model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if (Yii::$app->user->can('tagdelete')) {
            $this->findModel($id)->delete();
            return $this->redirect(['index',
                'action' => 'word-tag-list'
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
            return $this->redirect(['index', 'action' => 'word-tag-list']);
        }
    }

    /**
     * Finds the TagModel model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TagModel the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TagModel::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
