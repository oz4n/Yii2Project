<?php

namespace app\modules\site\controllers;

use Yii;
use yii\web\Controller;
use app\modules\site\searchs\PostSerch;
use app\modules\site\models\PostModel;
use app\modules\site\models\PageModel;
use app\modules\site\searchs\PageSerch;
use yii\helpers\Json;

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

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionTax()
    {
        $model = new PostSerch;
        $param = Yii::$app->request->getQueryParams();
        if ($model->findTaxBySlug($param['tax'])->type == "menupage") {
            $page = new PageSerch;
            $query = $page->getPage(Yii::$app->request->getQueryParams()); 
            return $this->render('taxpage', [
                        'model' => $query,                       
                        'tax' => $model->findTaxNameBySLug($param['tax']),
                        'other' => Json::decode($query->other_content)
            ]);
        } else {
           
            $dataProvider = $model->search(Yii::$app->request->getQueryParams());            
            return $this->render('taxpost', [
                        'dataProvider' => $dataProvider,
                        'searchModel' => $model,
                        'tax' => $model->findTaxNameBySLug($param['tax']),
            ]);
        }
    }

    public function actionView()
    {
        
        $model = new PostSerch;
        return $this->render('view', [
            'model' => $this->getPostSlug($model),
            'tax' => $this->getTaxName($model),
        ]);
    }
    
    protected function getPostSlug($model)
    {
        $param = Yii::$app->request->getQueryParams();
        if (isset($param['slug'])) {
            return $model->findPostBySlug($param['slug']);
        } else {
            throw new \yii\web\NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function getTaxName($model)
    {
        $param = Yii::$app->request->getQueryParams();
        if (isset($param['tax'])) {
            return $model->findTaxNameBySLug($param['tax']);
        } else {
            throw new \yii\web\NotFoundHttpException('The requested page does not exist.');
        }
    }

//    public function actionInfo()
//    {
//        return $this->render('info');
//    }
//
//    public function actionInfo1()
//    {
//        return $this->render('info_1');
//    }
//
//    public function actionInfo2()
//    {
//        return $this->render('info_2');
//    }
//
//    public function actionInfo3()
//    {
//        return $this->render('info_2');
//    }
//
//    public function actionInfo4()
//    {
//        return $this->render('info_2');
//    }
//
//    public function actionInfo5()
//    {
//        return $this->render('info_5');
//    }
//
//    public function actionInfo6()
//    {
//        return $this->render('info_2');
//    }
//
//    public function actionAbout()
//    {
//        return $this->render('about');
//    }
//
//    public function actionAbout1()
//    {
//        return $this->render('about_1');
//    }
//
//    public function actionContact()
//    {
//        return $this->render('contact');
//    }
//
//    public function actionLogbook()
//    {
//        return $this->render('logbook');
//    }
//
//    public function actionRegulation()
//    {
//        return $this->render('regulation');
//    }
}
