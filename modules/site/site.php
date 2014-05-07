<?php

namespace app\modules\site;

use yii\base\Module;

class site extends Module
{

    public $controllerNamespace = 'app\modules\site\controllers';

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
