<?php

namespace app\modules\word;

use yii\base\BootstrapInterface;

use yii\base\Module;

class Word extends Module implements BootstrapInterface
{
    const WORD_CATEGORY = 13;
    const WORD_TAG = 14;
    const POST_POST_TYPE_INFO = 'info';
    const POST_POST_TYPE_PAGE = 'page';
    const POST_POST_TYPE_PAGE_HELPER = 'pagehelper';
    public $controllerNamespace = 'app\modules\word\controllers';

    public function init()
    {
        $this->setLayoutPath('@app/modules/dashboard/views/layouts');
        $this->layout = 'main';
        parent::init();
    }

    public function bootstrap($app)
    {
        $app->getUrlManager()->addRules([
            'dashboard/word/post/index/<action:(word-post-list)>' => '/word/post/index',
            'dashboard/word/post/create/<action:(word-post-create)>' => '/word/post/create',
            'dashboard/word/post/update/<action:(word-post-update)>/<id:.*?>' => '/word/post/update',
            'dashboard/word/post/delete/<action:(word-post-delete)>/<id:.*?>' => '/word/post/delete',
            'dashboard/word/post/trash/<action:(word-post-trash)>/<id:.*?>' => '/word/post/trash',
            'dashboard/word/post/view/<action:(word-post-view)>/<id:.*?>' => '/word/post/view',

            'dashboard/word/post/category/index/<action:(word-category-list)>' => '/word/category/index',
            'dashboard/word/post/category/create/<action:(word-category-create)>' => '/word/category/create',
            'dashboard/word/post/category/update/<action:(word-category-update)>/<id:.*?>' => '/word/category/update',
            'dashboard/word/post/category/delete/<action:(word-category-delete)>/<id:.*?>' => '/word/category/delete',
            'dashboard/word/post/category/trash/<action:(word-category-trash)>/<id:.*?>' => '/word/category/trash',
            'dashboard/word/post/category/view/<action:(word-category-view)>/<id:.*?>' => '/word/category/view',

            'dashboard/word/post/tag/index/<action:(word-tag-list)>' => '/word/tag/index',
            'dashboard/word/post/tag/create/<action:(word-tag-create)>' => '/word/tag/create',
            'dashboard/word/post/tag/update/<action:(word-tag-update)>/<id:.*?>' => '/word/tag/update',
            'dashboard/word/post/tag/delete/<action:(word-tag-delete)>/<id:.*?>' => '/word/tag/delete',
            'dashboard/word/post/tag/trash/<action:(word-tag-trash)>/<id:.*?>' => '/word/tag/trash',
            'dashboard/word/post/tag/view/<action:(word-tag-view)>/<id:.*?>' => '/word/tag/view',
        ], false);
        if (!Yii::$app->user->isGuest) {
            $app->getErrorHandler()->errorAction = '/dashboard/dashboard/error';
        }
    }

}
