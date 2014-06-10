<?php

namespace app\modules\page;

class Page extends \yii\base\Module
{

    const POST_TYPE_PAGE = 'page';
    const POST_TYPE_PAGE_HELPER = 'pagehelper';
    const WIDGET_HOME_RIGHT_POSITION = 'homeright';
    const WIDGET_HOME_LEFT_POSITION = 'homeleft';
    const WIDGET_HOME_SIDEBAR_POSITION = 'homesidebar';

    public $controllerNamespace = 'app\modules\page\controllers';

    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }

}
