<?php

namespace app\modules\site\controllers;

use yii\web\Controller;

class SiteController extends Controller
{

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionInfo()
    {
        return $this->render('info');
    }

    public function actionInfo1()
    {
        return $this->render('info_1');
    }

    public function actionInfo2()
    {
        return $this->render('info_2');
    }

    public function actionInfo3()
    {
        return $this->render('info_2');
    }

    public function actionInfo4()
    {
        return $this->render('info_2');
    }

    public function actionInfo5()
    {
        return $this->render('info_5');
    }

    public function actionInfo6()
    {
        return $this->render('info_2');
    }

    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionAbout1()
    {
        return $this->render('about_1');
    }

    public function actionContact()
    {
        return $this->render('contact');
    }

    public function actionLogbook()
    {
        return $this->render('logbook');
    }

    public function actionRegulation()
    {
        return $this->render('regulation');
    }

}
