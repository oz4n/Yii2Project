<?php

return [
    'gii' => [
        'class' => 'yii\gii\Module',
    ],
    'userrbac' => [
        'class' => 'app\modules\userrbac\UserRbac',
        'layout' => '@app/modules/dashboard/views/layouts/main'
    ],
    'dashboard' => [
        'class' => 'app\modules\dashboard\Dashboard',
        'layout' => '@app/modules/dashboard/views/layouts/main'
    ],
    'word' => [
        'class' => 'app\modules\word\Word',
        'layout' => '@app/modules/dashboard/views/layouts/main'
    ],
    'member' => [
        'class' => 'app\modules\member\Member',
        'layout' => '@app/modules/dashboard/views/layouts/main'
    ],
    'userlog' => [
        'class' => 'app\modules\userlog\UserLog',
        'layout' => '@app/modules/dashboard/views/layouts/main',
        'log_tatus' => true
    ],
    'filemanager' => [
        'class' => 'app\modules\filemanager\FileManager',
        'layout' => '@app/modules/dashboard/views/layouts/main'
    ],
    'guestbook' => [
        'class' => 'app\modules\guestbook\GuestBook',
        'layout' => '@app/modules/dashboard/views/layouts/main'
    ],

    'user' => [
        'class' => 'dektrium\user\Module',
        'controllerMap' => [
            'admin' => 'app\modules\users\controllers\UserController',
            'registration' => 'app\modules\site\controllers\RegistrationController'
        ],
        'components' => [
            'manager' => [
                'userClass' => 'app\modules\users\models\UserModel',
            ],
        ],
        'layout' => '@app/modules/site/views/layouts/main',
        'confirmable' => true,
        'allowUnconfirmedLogin' => false,
        'confirmWithin' => 86400,
        'cost' => 19,
        'rememberFor' => 1209600,
        'recoverWithin' => 21600,
        'admins' => ['administrator']
    ],
    'appearance' => [
        'class' => 'app\modules\appearance\Appearance',
        'layout' => '@app/modules/dashboard/views/layouts/main'
    ],
    'page' => [
        'class' => 'app\modules\page\Page',
        'layout' => '@app/modules/dashboard/views/layouts/main'
    ],
    'site' => [
        'class' => 'app\modules\site\Site',
    ],
];
