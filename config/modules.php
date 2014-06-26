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
    'setting' => [
        'class' => 'app\modules\setting\Setting',
    ],
];
