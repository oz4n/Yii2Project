<?php

namespace app\modules\page;

class Page extends \yii\base\Module
{

    const POST_TYPE_PAGE = 'page';
    const POST_TYPE_PAGE_HELPER = 'pagehelper';

    public $controllerNamespace = 'app\modules\page\controllers';

    public function init()
    {
        $this->setLayoutPath('@app/modules/dashboard/views/layouts');
        $this->layout = 'main';
        parent::init();

        // custom initialization code goes here
    }

}
