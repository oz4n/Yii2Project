<?php

namespace app\modules\site\controllers;

use Yii;
use app\modules\dao\ar\Guestbook;
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
        $model = new Guestbook;
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

}
