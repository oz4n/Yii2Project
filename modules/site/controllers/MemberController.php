<?php

namespace app\modules\site\controllers;

use Yii;
use app\modules\site\searchs\MemberSearch;
use app\modules\site\searchs\PostSerch;

class MemberController extends \yii\web\Controller
{

    public function actionCapas()
    {
        $searchModel = new MemberSearch;
        $model = PostSerch::find()->onCondition(['content' => 'pagemembercapas', "type" => 'pagehelper'])->one();
        $dataProvider = $searchModel->capasMemberSearch(Yii::$app->request->getQueryParams());
        return $this->render('capas', [
                    'dataProvider' => $dataProvider,
                    'searchModel' => $searchModel,
                    'model' => $model,
                    'param' => Yii::$app->request->get('tax')
        ]);
    }

    public function actionPaskibra()
    {
        $searchModel = new MemberSearch;
        $dataProvider = $searchModel->paskibraMemberSearch(Yii::$app->request->getQueryParams());
        $model = PostSerch::find()->onCondition(['content' => 'pagememberpaskibra', "type" => 'pagehelper'])->one();
        return $this->render('paskibra', [
                    'dataProvider' => $dataProvider,
                    'searchModel' => $searchModel,
                    'model' => $model,
                    'param' => Yii::$app->request->get('tax')
        ]);
    }

    public function actionPpi()
    {
        $searchModel = new MemberSearch;
        $dataProvider = $searchModel->ppiMemberSearch(Yii::$app->request->getQueryParams());
        $model = PostSerch::find()->onCondition(['content' => 'pagememberppi', "type" => 'pagehelper'])->one();
        return $this->render('ppi', [
                    'dataProvider' => $dataProvider,
                    'searchModel' => $searchModel,
                    'model' => $model,
                    'param' => Yii::$app->request->get('tax')
        ]);
    }

}
