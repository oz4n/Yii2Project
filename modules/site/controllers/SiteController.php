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

        if ($this->findTaxBySlug() != false) {
            if ($this->findTaxBySlug()->type == "menupage") {
                $page = new PageSerch;
                $query = $page->getPage(Yii::$app->request->getQueryParams());
                return $this->render('taxpage', [
                            'model' => $query,
                            'tax' => $model->findTaxNameBySLug($param['tax']),
                            'other' => Json::decode($query->other_content)
                ]);
            } else if ((isset($param['tax']) && $param['tax'] != null) && $this->findTaxBySlug() !== true) {
                $dataProvider = $model->searchPost(Yii::$app->request->getQueryParams());
                $form = new PostModel;
                return $this->render('taxpost', [
                            'dataProvider' => $dataProvider,
                            'searchModel' => $model,
                            'model' => $form,
                            'param' => Yii::$app->request->getQueryParams(),
                            'tax' => $this->getTaxName($model),
                ]);
            }
        } else if ((isset($param['tax']) && $param['tax'] != null) && $param['tax'] == "info") {
            $dataProvider = $model->searchPost(Yii::$app->request->getQueryParams());
            $form = new PostModel;
            return $this->render('taxpost', [
                        'dataProvider' => $dataProvider,
                        'searchModel' => $model,
                        'model' => $form,
                        'param' => Yii::$app->request->getQueryParams(),
                        'tax' => $this->getTaxName($model),
            ]);
        } else {
            throw new \yii\web\NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionView()
    {
        $model = new PostSerch;
        return $this->render('taxpost_view_more_detail', [
                    'model' => $this->getPostSlug($model),
                    'tax' => $this->getTaxName($model),
                    'param' => Yii::$app->request->getQueryParams()
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
        if (($query = $model->findTaxNameBySLug($param['tax'])) && isset($param['tax'])) {
            return $query;
        } else {
            return "Informasi";
        }
    }

    protected function findTaxBySlug()
    {
        $model = new PostSerch;
        $param = Yii::$app->request->getQueryParams();
        if (isset($param['tax']) && ($query = $model->findTaxBySlug($param['tax'])) != false) {
            return $query;
        } else {
            return false;
        }
    }

}
