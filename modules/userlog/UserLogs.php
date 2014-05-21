<?php

namespace app\modules\userlog;

use app\modules\userlog\models\UserLogModel;
use yii\base\Application;
use yii\base\BootstrapInterface;
use yii\base\Module;

class UserLog extends Module implements BootstrapInterface
{
    public $controllerNamespace = 'app\modules\userlog\controllers';

    public $log_tatus = false;

    public function init()
    {
        $this->setLayoutPath('@app/modules/dashboard/views/layouts');
        $this->layout = 'main';

        parent::init();

        // custom initialization code goes here
    }


    /**
     * @inheritdoc
     */
    public function bootstrap($app)
    {
        if ($this->log_tatus == true) {
            $app->on(Application::EVENT_AFTER_ACTION, function () use ($app) {
                $model = new UserLogModel();
                $model->saveActionLog();
            });
        }
        $app->getUrlManager()->addRules([
            'dashboard/userlog/index' => 'userlog/userlog/index'
        ], false);
    }

}
