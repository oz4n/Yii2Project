<?php

namespace app\modules\site\controllers;
use Yii;
use app\modules\site\models\GuestbookModel;

class ContactController extends \yii\web\Controller
{

    public function actionIndex()
    {
        $model = new GuestbookModel;
        $model->setAttribute('create_et', date("Y-m-d H:i:s"));
        $model->setAttribute('update_et', date("Y-m-d H:i:s"));
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
             Yii::$app->session->setFlash('success', 'Pesan berhasil terkirim. pesan akan ditampilkan setelah dikonfiramsi oleh admin');
            return $this->redirect(['index']);
        } else {
            return $this->render('index', [
                        'model' => $model
            ]);
        }
    }

}
