<?php

namespace app\modules\appearance\controllers;

use Yii;
use yii\web\Controller;
use yii\helpers\Json;
use app\modules\appearance\Appearance;
use app\modules\appearance\models\TaxonomyModel;

class DefaultController extends Controller
{

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionAddcattomenu()
    {

        if (Yii::$app->request->isAjax) {
            $param = Yii::$app->request->post();
            if (isset($param['Category'])) {
                foreach ($param['Category'] as $id) {
                    $model = new TaxonomyModel;
                    $model->term_id = Appearance::APPEARANCE_MENU_TERM_ITEM;
                    $model->type = Appearance::APPEARANCE_MENU_TERM_TYPE_ITEM;
                    $model->taxmenu = $param['MenuModel']['id'];
                    $model->create_et = date("Y-m-d H:i:s");
                    $model->update_et = date("Y-m-d H:i:s");
                    $model->slug = TaxonomyModel::findOne($id)->slug;
                    $model->name = TaxonomyModel::findOne($id)->name;
                    $model->description = "Menu item " . TaxonomyModel::findOne($id)->name;
                    $model->save();
                }
                echo Json::encode([
                    'status' => true,
                ]);
            } else {
                echo Json::encode([
                    'status' => false,
                    'type' => 'error',
                    'info' => 'Pilih salah satu kategory yang akan dijadikan menu.'
                ]);
            }
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
