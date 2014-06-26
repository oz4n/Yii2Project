<?php

namespace app\modules\setting;

define('DS', DIRECTORY_SEPARATOR);

use Yii;
use yii\base\Application;
use yii\base\BootstrapInterface;
use yii\base\Module;
use app\modules\setting\models\SettingModel;

/**
 * @property Application $app
 */
class Setting extends Module implements BootstrapInterface
{

    public $controllerNamespace = 'app\modules\setting\controllers';
    public $setting;

    public function init()
    {
        parent::init();
        $this->setting = new SettingModel;
    }

    public function bootstrap($app)
    {

        $app->name = $this->setting->getSettingValueByKey('site_tittle');

        $app->components = [
            'mail' => require(__DIR__ . DS . 'etc' . DS . 'mail.php')
        ];
        $app->modules = [
            'user' => [
                'class' => 'dektrium\user\Module',
                'controllerMap' => [
                    'admin' => 'app\modules\users\controllers\UserController',
                    'registration' => 'app\modules\site\controllers\RegistrationController'
                ],
                'components' => [
                    'manager' => [
                        'userClass' => Yii::$app->user->isGuest ? 'app\modules\site\models\UserModel' : 'app\modules\users\models\UserModel',
                    ],                    
                ],
                'layout' => '@app/modules/site/views/layouts/main',
                'confirmable' => true, //true to send email
                'allowUnconfirmedLogin' => false,
                'confirmWithin' => 86400,
                'cost' => 19,
                'rememberFor' => 1209600,
                'recoverWithin' => 21600,
                'admins' => ['administrator']
            ],
        ];
        $app->params = require(__DIR__ . DS . 'etc' . DS . 'params.php');
        if ((Yii::$app->user->isGuest || Yii::$app->user->identity->role === "ppimember") || (Yii::$app->user->identity->role === "paskibramember" || Yii::$app->user->identity->role === "capasmember")) {
            $app->getErrorHandler()->errorAction = '/site/site/error';
        } else {
            $app->getErrorHandler()->errorAction = '/dashboard/error/error';
        }
      
    }

}
