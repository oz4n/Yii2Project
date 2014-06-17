<?php

namespace app\modules\userrbac\controllers;

use Yii;
use app\modules\userrbac\search\RuleSerch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\modules\userrbac\models\RuleModel;
use yii\web\HttpException;

/**
 * RuleController implements the CRUD actions for RuleModel model.
 */
class RuleController extends Controller
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
     * Lists all RuleModel models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->can('ruleindex')) {
            $searchModel = new RuleSerch;
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
     * Creates a new RuleModel model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->can('rulecreate')) {
            $model = new RuleModel;
            $model->setAttribute('created_at', time());
            $model->setAttribute('updated_at', time());
            $param = Yii::$app->request->post('RuleModel');
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                $model->saveRuleRelation(isset($param['rules']) ? $param['rules'] : [], $model->name);
                return $this->redirect(['update', 'action' => 'user-rule-update', 'id' => $model->name]);
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
     * Updates an existing RuleModel model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if (Yii::$app->user->can('ruleupdate')) {
            $model = $this->findModel($id);
            $param = Yii::$app->request->post('RuleModel');
            $model->setAttribute('updated_at', time());
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                $model->deleteRuleRelation($id);
                $model->saveRuleRelation(isset($param['rules']) ? $param['rules'] : [], $id);
                return $this->redirect(['update', 'action' => 'user-rule-update', 'id' => $model->name]);
            } else {
                return $this->render('update', [
                            'model' => $model,
                            'ruleparent' => $id
                ]);
            }
        } else {
            throw new HttpException(403, 'You are not allowed to access this page', 0);
        }
    }

    /**
     * Deletes an existing RuleModel model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if (Yii::$app->user->can('ruledelete')) {
            $this->findModel($id)->delete();
            return $this->redirect(['index', 'action' => 'user-rule-list']);
        } else {
            throw new HttpException(403, 'You are not allowed to access this page', 0);
        }
    }

    public function actionBulk()
    {
        if (Yii::$app->user->can('rulebulk')) {
            if (Yii::$app->request->post() && (Yii::$app->request->post('bulk_action1') == 'delete' || Yii::$app->request->post('bulk_action2') == 'delete')) {
                $this->deleteAll(Yii::$app->request->post('selection'));
                return $this->redirect(['index', 'action' => 'user-rule-list']);
            } else {
                return $this->redirect(['index', 'action' => 'user-rule-list']);
            }
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
            return $this->redirect(['index', 'action' => 'user-rule-list']);
        }
    }

    /**
     * Finds the RuleModel model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return RuleModel the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = RuleModel::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
