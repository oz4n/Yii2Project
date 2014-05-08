<?php

namespace app\modules\member\controllers;

use Yii;
use app\modules\member\models\MemberModel;
use app\modules\member\models\search\MemberSerch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MemberController implements the CRUD actions for Member model.
 */
class MemberController extends Controller
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
     * Lists all Member models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MemberSerch;
        $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());
        if ((Yii::$app->request->get('bulk_action1') == 'delete' || Yii::$app->request->get('bulk_action2') == 'delete')) {
            $this->deleteAll(Yii::$app->request->get('selection'));
        }
        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }

    /**
     * Displays a single Member model.
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
     * Creates a new Member model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new MemberModel;
        $model->setAttribute('create_et', date("Y-m-d H:i:s"));
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Member model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->setAttribute('update_et', date("Y-m-d H:i:s"));
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionBulk()
    {
        if (Yii::$app->request->post() && (Yii::$app->request->post('bulk_action1') == 'delete' || Yii::$app->request->post('bulk_action2') == 'delete')) {
            $this->deleteAll(Yii::$app->request->post('selection'));
            return $this->redirect(['index']);
        } else {
            return $this->redirect(['index']);
        }

    }

    /**
     * Deletes an existing Member model.
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
            return $this->redirect(['index']);
        }
    }

    /**
     * Finds the Member model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Member the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MemberModel::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
