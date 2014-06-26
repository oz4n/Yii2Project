<?php

namespace app\modules\site\controllers;
use Yii;
use yii\web\Controller;

class DefaultController extends Controller
{
    
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionSend()
    {
       echo Yii::$app->mail->compose()
            ->setFrom('moh.fauzan.azim@gmail.com')
            ->setTo('oz4n.rock@gmail.com')
            ->setSubject('Message subject')
            ->setTextBody('Plain text content')
            ->setHtmlBody('<b>HTML content</b>')
            ->send();
    }
}
