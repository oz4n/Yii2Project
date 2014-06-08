<?php

namespace app\modules\userrbac;

class UserRbac extends \yii\base\Module
{
    const RBAC_RULE_AKSES_TYPE_GROUP = 2;
    const RBAC_RULE_AKSES_TYPE_ROUTE = 3;
    public $controllerNamespace = 'app\modules\userrbac\controllers';

    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
