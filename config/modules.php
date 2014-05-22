<?php
return [
    'gii' => [
        'class' => 'yii\gii\Module',
    ],
    'dashboard' => [
        'class' => 'app\modules\dashboard\Dashboard',
    ],
    'word' => [
        'class' => 'app\modules\word\Word',
    ],
    'member' => [
        'class' => 'app\modules\member\Member',
    ],
    'userlog' => [
        'class' => 'app\modules\userlog\UserLog',
        'log_tatus' => false
    ],
    'filemanager' => [
        'class' => 'app\modules\filemanager\FileManager',
    ],
    'guestbook' => [
        'class' => 'app\modules\guestbook\GuestBook'
    ],
    'user' => [
        'class' => 'dektrium\user\Module',
        'allowUnconfirmedLogin' => true,
        'confirmWithin' => 21600,
        'cost' => 12,
        'admins' => ['ozan']
    ],
    'site' => [
        'class' => 'app\modules\site\site',
    ],

];