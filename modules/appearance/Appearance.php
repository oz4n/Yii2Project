<?php

namespace app\modules\appearance;

class Appearance extends \yii\base\Module
{
    const APPEARANCE_MENU_TERM_ITEM = 17;
    const APPEARANCE_MENU_TERM = 18;
    const APPEARANCE_MENU_TERM_POSITION = 19;
    const APPEARANCE_MENU_TERM_TYPE_TERM = 'menuterm';
    const APPEARANCE_MENU_TERM_TYPE_ITEM = 'menuitem';
    const APPEARANCE_MENU_TERM_TYPE_LINK = 'menulink';
    const APPEARANCE_MENU_TERM_TYPE_HELPER = 'helpermenu';

    public $controllerNamespace = 'app\modules\appearance\controllers';

    public function init()
    {
        $this->setLayoutPath('@app/modules/dashboard/views/layouts');
        $this->layout = 'main';
        parent::init();

        // custom initialization code goes here
    }
}
