<?php

namespace app\modules\page;

class Page extends \yii\base\Module
{

    const POST_TYPE_PAGE = 'page';
    const POST_TYPE_PAGE_HELPER = 'pagehelper';
    const WIDGET_HOME_RIGHT_POSITION = 'homeright';
    const WIDGET_HOME_LEFT_POSITION = 'homeleft';
    const WIDGET_HOME_SIDEBAR_POSITION = 'homesidebar';
    const WIDGET_CONTACT_SIDEBAR_POSITION = 'contactsidebar';
    const WIDGET_MEMBER_PPI_SIDEBAR_POSITION = 'memberppisidebar'; 
    const WIDGET_MEMBER_PASKIBRA_SIDEBAR_POSITION = 'memberpaskibrasidebar'; 
    const WIDGET_MEMBER_CAPAS_SIDEBAR_POSITION = 'membercapassidebar'; 
    const WIDGET_GUESTBOOK_SIDEBAR_POSITION = 'guestbooksidebar';
    const WIDGET_DEFAULT_HOME = 'HomeDefaultWidget';

    public $controllerNamespace = 'app\modules\page\controllers';

    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }

}
