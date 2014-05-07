<?php

namespace app\modules\member;

class memeber extends \yii\base\Module
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
