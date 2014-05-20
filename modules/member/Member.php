<?php

namespace app\modules\member;

use yii\base\BootstrapInterface;
use yii\base\Module;
use yii\web\GroupUrlRule;

define('MEMBER_SKILL', 1);
define('MEMBER_LANG_SKILL', 2);
define('MEMBER_JOB', 3);
define('MEMBER_BLOOD', 4);
define('MEMBER_YEAR', 5);
define('MEMBER_AREA', 6);
define('MEMBER_BREVET', 7);

define('MEMBER_TYPE_PPI', 'PPI');
define('MEMBER_TYPE_PASKIBRA', 'Paskibra');
define('MEMBER_TYPE_CAPAS', 'Capas');

define('MEMBER_TRASH_STATUS', 'Trash');
define('MEMBER_PUBLISH_STATUS', 'Publish');
define('MEMBER_DRAFT_STATUS', 'Draft');
define('MEMBER_PENDING_STATUS', 'Pending');

class Member extends Module implements BootstrapInterface
{
    public $controllerNamespace = 'app\modules\member\controllers';

    public function init()
    {
        $this->setLayoutPath('@app/modules/dashboard/views/layouts');
        $this->layout = 'main';
        parent::init();
        // custom initialization code goes here
    }

    public function bootstrap($app)
    {
        $app->getUrlManager()->addRules([
            'dashboard/member/ppi/index/<action:(member-ppi-list)>' => 'member/ppi/index',
            'dashboard/member/ppi/create/<action:(member-ppi-create)>' => '/member/ppi/create',
            'dashboard/member/ppi/update/<action:(member-ppi-update)>/<id:.*?>' => '/member/ppi/update',
            'dashboard/member/ppi/delete/<action:(member-ppi-delete)>/<id:.*?>' => '/member/ppi/delete',
            'dashboard/member/ppi/trash/<action:(member-ppi-trash)>/<id:.*?>' => '/member/ppi/trash',
            'dashboard/member/ppi/view/<action:(member-ppi-view)>/<id:.*?>' => '/member/ppi/view',

            'dashboard/member/paskibra/index/<action:(member-paskibra-list)>' => 'member/paskibra/index',
            'dashboard/member/paskibra/create/<action:(member-paskibra-create)>' => '/member/paskibra/create',
            'dashboard/member/paskibra/update/<action:(member-paskibra-update)>/<id:.*?>' => '/member/paskibra/update',
            'dashboard/member/paskibra/delete/<action:(member-paskibra-delete)>/<id:.*?>' => '/member/paskibra/delete',
            'dashboard/member/paskibra/trash/<action:(member-paskibra-trash)>/<id:.*?>' => '/member/paskibra/trash',
            'dashboard/member/paskibra/view/<action:(member-paskibra-view)>/<id:.*?>' => '/member/paskibra/view',

            
            'dashboard/member/brevetaward/index/<action:(member-brevet-list)>' => '/member/brevetaward/index',
        ], false);


    }

}
