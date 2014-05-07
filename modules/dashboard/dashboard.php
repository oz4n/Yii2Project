<?php

namespace app\modules\dashboard;

class dashboard extends \yii\base\Module
{
    public $controllerNamespace = 'app\modules\dashboard\controllers';

    public function init()
    {
        
        $this->getLayoutPath();
        
        $this->getLayout();   
        parent::init();

        // custom initialization code goes here
    }
    public function getLayout()
    {
        $this->layout = 'main';
        return $this->layout;
    }
}
