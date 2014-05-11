<?php

namespace app\modules\member;

use yii\base\Module;

define('MEMBER_SKILL', 1);
define('MEMBER_LANG_SKILL', 2);
define('MEMBER_JOB', 3);
define('MEMBER_BLOOD', 4);
define('MEMBER_YEAR', 5);
define('MEMBER_AREA', 6);
define('MEMBER_BREVET', 7);

class Member extends Module
{
    public $controllerNamespace = 'app\modules\member\controllers';

    public function init()
    {
        $this->setLayoutPath('@app/modules/dashboard/views/layouts');
        $this->layout = 'main';
        parent::init();
        // custom initialization code goes here
    }


}
