<?php

namespace app\modules\dashboard;

use yii\base\BootstrapInterface;
use yii\base\Module;

class Dashboard extends Module implements BootstrapInterface
{
    const MESSAGE_STATUS_UNCONFIRMED = 'Unconfirmed';

    public $controllerNamespace = 'app\modules\dashboard\controllers';

    public function init()
    {
        parent::init();
    }

    public function bootstrap($app)
    {
        $app->getUrlManager()->addRules([
            'dashboard/index/<action:(dashboard-list)>' => '/dashboard/dashboard/index',
        ], false);
    }
}
