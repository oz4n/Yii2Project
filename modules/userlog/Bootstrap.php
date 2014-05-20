<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 5/15/14
 * Time: 9:16 PM
 */

namespace app\modules\userlog;


use yii\base\Application;
use yii\base\BootstrapInterface;
use yii\base\Module;
use yii\web\GroupUrlRule;

class Bootstrap extends Module
{

    public function init()
    {
        $this->bootstrap();
    }


    /**
     * @inheritdoc
     */
    public function bootstrap()
    {

//        $this->setModule('userlog', [
//            'class' => 'app\modules\userlog\UserLog'
//        ]);

//        $this->get('urlManager')->rules[] = new GroupUrlRule([
//            'prefix' => 'dashboard/userlog',
//            'rules' => [
//                'index' => '/userlog/userlog/index',
//            ]
//        ]);


//        $app->get('i18n')->translations['userlog*'] = [
//            'class' => 'yii\i18n\PhpMessageSource',
//            'basePath' => __DIR__ . '/messages',
//        ];
    }
} 