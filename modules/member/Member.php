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
define('MEMBER_TRIBE', 8);

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

            'dashboard/member/capas/index/<action:(member-capas-list)>' => 'member/capas/index',
            'dashboard/member/capas/create/<action:(member-capas-create)>' => '/member/capas/create',
            'dashboard/member/capas/update/<action:(member-capas-update)>/<id:.*?>' => '/member/capas/update',
            'dashboard/member/capas/delete/<action:(member-capas-delete)>/<id:.*?>' => '/member/capas/delete',
            'dashboard/member/capas/trash/<action:(member-capas-trash)>/<id:.*?>' => '/member/capas/trash',
            'dashboard/member/capas/view/<action:(member-capas-view)>/<id:.*?>' => '/member/capas/view',

            'dashboard/member/brevetaward/index/<action:(member-brevet-list)>' => '/member/brevetaward/index',
            'dashboard/member/brevetaward/create/<action:(member-brevet-create)>' => '/member/brevetaward/create',
            'dashboard/member/brevetaward/bulk/<action:(member-brevet-bulk)>' => '/member/brevetaward/bulk',
            'dashboard/member/brevetaward/update/<action:(member-brevet-update)>/<id:.*?>' => '/member/brevetaward/update',
            'dashboard/member/brevetaward/delete/<action:(member-brevet-delete)>/<id:.*?>' => '/member/brevetaward/delete',
            'dashboard/member/brevetaward/view/<action:(member-brevet-view)>/<id:.*?>' => '/member/brevetaward/view',
            
            'dashboard/member/lifeskill/index/<action:(member-lifeskill-list)>' => '/member/lifeskill/index',
            'dashboard/member/lifeskill/create/<action:(member-lifeskill-create)>' => '/member/lifeskill/create',
            'dashboard/member/lifeskill/bulk/<action:(member-lifeskill-bulk)>' => '/member/lifeskill/bulk',
            'dashboard/member/lifeskill/update/<action:(member-lifeskill-update)>/<id:.*?>' => '/member/lifeskill/update',
            'dashboard/member/lifeskill/delete/<action:(member-lifeskill-delete)>/<id:.*?>' => '/member/lifeskill/delete',
            'dashboard/member/lifeskill/view/<action:(member-lifeskill-view)>/<id:.*?>' => '/member/lifeskill/view',
            
            'dashboard/member/languageskill/index/<action:(member-languageskill-list)>' => '/member/languageskill/index',
            'dashboard/member/languageskill/create/<action:(member-languageskill-create)>' => '/member/languageskill/create',
            'dashboard/member/languageskill/bulk/<action:(member-languageskill-bulk)>' => '/member/languageskill/bulk',
            'dashboard/member/languageskill/update/<action:(member-languageskill-update)>/<id:.*?>' => '/member/languageskill/update',
            'dashboard/member/languageskill/delete/<action:(member-languageskill-delete)>/<id:.*?>' => '/member/languageskill/delete',
            'dashboard/member/languageskill/view/<action:(member-languageskill-view)>/<id:.*?>' => '/member/languageskill/view',
            
            'dashboard/member/school/index/<action:(member-school-list)>' => '/member/school/index',
            'dashboard/member/school/create/<action:(member-school-create)>' => '/member/school/create',
            'dashboard/member/school/bulk/<action:(member-school-bulk)>' => '/member/school/bulk',
            'dashboard/member/school/update/<action:(member-school-update)>/<id:.*?>' => '/member/school/update',
            'dashboard/member/school/delete/<action:(member-school-delete)>/<id:.*?>' => '/member/school/delete',
            'dashboard/member/school/view/<action:(member-school-view)>/<id:.*?>' => '/member/school/view',
            
            'dashboard/member/area/index/<action:(member-area-list)>' => '/member/area/index',
            'dashboard/member/area/create/<action:(member-area-create)>' => '/member/area/create',
            'dashboard/member/area/bulk/<action:(member-area-bulk)>' => '/member/area/bulk',
            'dashboard/member/area/update/<action:(member-area-update)>/<id:.*?>' => '/member/area/update',
            'dashboard/member/area/delete/<action:(member-area-delete)>/<id:.*?>' => '/member/area/delete',
            'dashboard/member/area/view/<action:(member-area-view)>/<id:.*?>' => '/member/area/view',
            
            'dashboard/member/tribe/index/<action:(member-tribe-list)>' => '/member/tribe/index',
            'dashboard/member/tribe/create/<action:(member-tribe-create)>' => '/member/tribe/create',
            'dashboard/member/tribe/bulk/<action:(member-tribe-bulk)>' => '/member/tribe/bulk',
            'dashboard/member/tribe/update/<action:(member-tribe-update)>/<id:.*?>' => '/member/tribe/update',
            'dashboard/member/tribe/delete/<action:(member-tribe-delete)>/<id:.*?>' => '/member/tribe/delete',
            'dashboard/member/tribe/view/<action:(member-tribe-view)>/<id:.*?>' => '/member/tribe/view',
        ], false);


    }

}
