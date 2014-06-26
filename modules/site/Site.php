<?php

namespace app\modules\site;

use Yii;
use yii\base\Application;
use yii\base\BootstrapInterface;
use yii\base\Module;

/**
 * @property Application $app
 */
class Site extends Module implements BootstrapInterface
{

    const WORD_CATEGORY = 13;
    const WORD_TAG = 14;
    const POST_STATUS_PUBLISH = 'Publish';
    const POST_POST_TYPE_INFO = 'info';
    const POST_POST_TYPE_PAGE = 'page';
    const MENU_STATUS_PUBLISH = 'Publish';
    const MENU_HEADER_TERM = 18;
    const GUESTBOOK_PUBLISH_STATUS = "Publish";

    public $controllerNamespace = 'app\modules\site\controllers';
    public $_action;
    

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

    public function bootstrap($app)
    {

        $app->getUrlManager()->addRules([
            'index' => '/site/site/index',
            'tax/<tax:.*?>' => '/site/site/tax',
            'view/<tax:.*?>/<slug:.*?>' => '/site/site/view',
            'guestbook' => '/site/guestbook/index',
            'guestbook/reply' => '/site/guestbook/reply',
            'contact' => '/site/contact/index',
            'user/settings/<role:.*>/<slug:.*>' => '/site/member/index',           
            'paskibra' => '/site/member/paskibra',
            'ppi' => '/site/member/ppi',
            'capas' => '/site/member/capas',
            'login' => '/user/security/login',
            'forget' => '/user/recovery/request',
            'resend' => '/user/registration/resend',
            'register' => 'user/registration/register'
                ], false);
        
    }

}
