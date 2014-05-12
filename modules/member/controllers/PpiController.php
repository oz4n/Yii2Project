<?php

namespace app\modules\member\controllers;

use Yii;
use app\modules\member\models\PpiModel;
use app\modules\member\searchs\PpiSerch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Session;
use yii\web\UploadedFile;

/**
 * PpiController implements the CRUD actions for PpiModel model.
 */
class PpiController extends Controller
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
     * Lists all PpiModel models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PpiSerch;
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
     * Displays a single PpiModel model.
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
     * Creates a new PpiModel model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PpiModel;
        $model->setAttribute('create_et', date("Y-m-d H:i:s"));
        $model->setAttribute('update_et', date("Y-m-d H:i:s"));
        $model->type_member = MEMBER_TYPE_PPI;
        if ($model->load(Yii::$app->request->post())) {
            $front_photo = UploadedFile::getInstance($model, 'front_photo');
            $side_photo = UploadedFile::getInstance($model, 'side_photo');
            $identity_card = UploadedFile::getInstance($model, 'identity_card');

            if ($front_photo->name == null) {
                Yii::$app->session->setFlash('front_photo_error', 'Tidak boleh kosong.');
            }

            if ($side_photo->name == null) {
                Yii::$app->session->setFlash('side_photo_error', 'Tidak boleh kosong.');
            }

            if ($identity_card->name == null) {
                Yii::$app->session->setFlash('identity_card_error', 'Tidak boleh kosong.');
            }

            if (($front_photo->name == null || $side_photo == null) || $identity_card == null) {
                return $this->render('create', [
                    'model' => $model,
                ]);
            } else {
                $front_photo_name = preg_replace('/\s+/', '-', date("Y-m-d-H:i:s") . '-' . rand(0, 999999999) . '-' . $front_photo->name);
                $side_photo_name = preg_replace('/\s+/', '-', date("Y-m-d-H:i:s") . '-' . rand(0, 999999999) . '-' . $side_photo->name);
                $identity_card_name = preg_replace('/\s+/', '-', date("Y-m-d-H:i:s") . '-' . rand(0, 999999999) . '-' . $identity_card->name);

                $model->setAttribute('front_photo', $front_photo_name);
                $model->setAttribute('side_photo', $side_photo_name);
                $model->setAttribute('identity_card', $identity_card_name);

                if ($model->save()) {
                    $front_photo->saveAs(Yii::$app->getBasePath() . DIRECTORY_SEPARATOR . 'web' . DIRECTORY_SEPARATOR . 'resources' . DIRECTORY_SEPARATOR . 'member' . DIRECTORY_SEPARATOR . $front_photo_name);
                    $side_photo->saveAs(Yii::$app->getBasePath() . DIRECTORY_SEPARATOR . 'web' . DIRECTORY_SEPARATOR . 'resources' . DIRECTORY_SEPARATOR . 'member' . DIRECTORY_SEPARATOR . $side_photo_name);
                    $side_photo->saveAs(Yii::$app->getBasePath() . DIRECTORY_SEPARATOR . 'web' . DIRECTORY_SEPARATOR . 'resources' . DIRECTORY_SEPARATOR . 'member' . DIRECTORY_SEPARATOR . $identity_card_name);
                }

                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing PpiModel model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->setAttribute('update_et', date("Y-m-d H:i:s"));
        if ($model->load(Yii::$app->request->post())) {
            $front_photo = UploadedFile::getInstance($model, 'front_photo');
            $side_photo = UploadedFile::getInstance($model, 'side_photo');
            $identity_card = UploadedFile::getInstance($model, 'identity_card');

            if ($front_photo->name == null) {
                Yii::$app->session->setFlash('front_photo_error', 'Tidak boleh kosong.');
            }

            if ($side_photo->name == null) {
                Yii::$app->session->setFlash('side_photo_error', 'Tidak boleh kosong.');
            }

            if ($identity_card->name == null) {
                Yii::$app->session->setFlash('identity_card_error', 'Tidak boleh kosong.');
            }

            if (($front_photo->name == null || $side_photo == null) || $identity_card == null) {
                return $this->redirect(['update', 'id' => $model->id]);
            } else {
                $front_photo_name = preg_replace('/\s+/', '-', date("Y-m-d-H:i:s") . '-' . rand(0, 999999999) . '-' . $front_photo->name);
                $side_photo_name = preg_replace('/\s+/', '-', date("Y-m-d-H:i:s") . '-' . rand(0, 999999999) . '-' . $side_photo->name);
                $identity_card_name = preg_replace('/\s+/', '-', date("Y-m-d-H:i:s") . '-' . rand(0, 999999999) . '-' . $identity_card->name);

                $model->setAttribute('front_photo', $front_photo_name);
                $model->setAttribute('side_photo', $side_photo_name);
                $model->setAttribute('identity_card', $identity_card_name);

                if ($model->save()) {
                    $front_photo->saveAs(Yii::$app->getBasePath() . DIRECTORY_SEPARATOR . 'web' . DIRECTORY_SEPARATOR . 'resources' . DIRECTORY_SEPARATOR . 'member' . DIRECTORY_SEPARATOR . $front_photo_name);
                    $side_photo->saveAs(Yii::$app->getBasePath() . DIRECTORY_SEPARATOR . 'web' . DIRECTORY_SEPARATOR . 'resources' . DIRECTORY_SEPARATOR . 'member' . DIRECTORY_SEPARATOR . $side_photo_name);
                    $side_photo->saveAs(Yii::$app->getBasePath() . DIRECTORY_SEPARATOR . 'web' . DIRECTORY_SEPARATOR . 'resources' . DIRECTORY_SEPARATOR . 'member' . DIRECTORY_SEPARATOR . $identity_card_name);
                }

                return $this->redirect(['view', 'id' => $model->id]);
            }

        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing PpiModel model.
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
    protected function deleteAll($data)
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
     * Finds the PpiModel model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PpiModel the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PpiModel::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
