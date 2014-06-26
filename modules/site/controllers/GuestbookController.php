<?php

namespace app\modules\site\controllers;

use Yii;
use app\modules\site\models\GuestbookModel;
use app\modules\site\searchs\GuestbookSerch;
use yii\web\Controller;

/**
 * GuestbookController implements the CRUD actions for Guestbook model.
 */
class GuestbookController extends Controller
{

    
    
    /**
     * Lists all Guestbook models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new GuestbookSerch;
        $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());
        $model = new GuestbookModel;
        $model->setAttribute('create_et', date("Y-m-d H:i:s"));
        $model->setAttribute('update_et', date("Y-m-d H:i:s"));
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Pesan berhasil terkirim. pesan akan ditampilkan setelah dikonfiramsi oleh admin');
            return $this->redirect(['index']);
        } else {
            return $this->render('index', [
                        'dataProvider' => $dataProvider,
                        'searchModel' => $searchModel,
                        'model' => $model
            ]);
        }
    }

    public function actionReply($id)
    {
        $data = $this->findModel($id);
        $model = new GuestbookModel;
        $model->setAttribute('create_et', date("Y-m-d H:i:s"));
        $model->setAttribute('update_et', date("Y-m-d H:i:s"));
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Pesan berhasil terkirim. pesan akan ditampilkan setelah dikonfiramsi oleh admin');
            return $this->redirect(['reply', 'id' => $id]);
        } else {
            return $this->render('reply', [
                        'data' => $data,
                        'model' => $model
            ]);
        }
    }

    protected function findModel($id)
    {
        if (($model = GuestbookModel::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
