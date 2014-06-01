<?php

namespace app\modules\site;

use yii\base\Module;

class Site extends Module
{
    const WORD_CATEGORY = 13;
    const WORD_TAG = 14;
    const POST_STATUS_PUBLISH = 'Publish';    
    const POST_POST_TYPE_INFO = 'info';
    const POST_POST_TYPE_PAGE = 'page';

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
