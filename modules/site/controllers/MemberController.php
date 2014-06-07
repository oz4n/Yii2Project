<?php

namespace app\modules\site\controllers;
use Yii;
use app\modules\site\searchs\MemberSearch;

class MemberController extends \yii\web\Controller
{

    public function actionCapas()
    {
        $searchModel = new MemberSearch;
        $dataProvider = $searchModel->capasMemberSearch(Yii::$app->request->getQueryParams());
        return $this->render('capas',[
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }

  
    public function actionPaskibra()
    {
        $searchModel = new MemberSearch;
        $dataProvider = $searchModel->paskibraMemberSearch(Yii::$app->request->getQueryParams());
        return $this->render('paskibra',[
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }

    public function actionPpi()
    {
        $searchModel = new MemberSearch;
        $dataProvider = $searchModel->ppiMemberSearch(Yii::$app->request->getQueryParams());
        return $this->render('ppi',[
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }

}
