<?php

namespace app\modules\guestbook;

class GuestBook extends \yii\base\Module
{
    public $controllerNamespace = 'app\modules\guestbook\controllers';

    public function init()
    {
        $this->setLayoutPath('@app/modules/dashboard/views/layouts');
        $this->layout = 'main';
        parent::init();

        // custom initialization code goes here
    }
}
