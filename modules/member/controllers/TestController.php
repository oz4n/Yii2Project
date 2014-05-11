<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 5/11/14
 * Time: 5:01 PM
 */

namespace app\modules\member\controllers;

use Yii;
use yii\web\Controller;

class TestController extends Controller
{
    public function actionIndex()
    {
//        Yii::$app->cache->set('ozan', 'Moh Fauzan Azim');
        echo Yii::$app->cache->get('ozan');
    }

}