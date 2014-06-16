<?php

return [
    'request' => [
        'enableCsrfValidation' => true,
        'enableCookieValidation' => true
    ],
    'ipinfo' => [
        'class' => 'app\modules\userlog\librarys\IpInfo',
        'apiKey' => 'bc5985346d51fd2c0d7ee7bc4aed9671606db302bd95b18b03f992a789a21e9e',
        'apiFormat' => 'json'
    ],
    'urlManager' => [
        'enablePrettyUrl' => true,
        'showScriptName' => false,
    ],
    'authManager' => [
        'class' => 'yii\rbac\DbManager',
        'defaultRoles' => ['administrator', 'admin'],
    ],
    'view' => [
        'theme' => [
            'pathMap' => [
                '@dektrium/user/views' => '@app/modules/site/views/user'
            ],
        ],
    ],
    'cache' => [
        'class' => 'yii\caching\FileCache',
    ],

    'log' => [
        'traceLevel' => YII_DEBUG ? 3 : 0,
        'targets' => [
            [
                'class' => 'yii\log\FileTarget',
                'levels' => ['error', 'warning'],
            ],
        ],
    ],
    'db' => $db,
    'mail' => $mail,
    //'cache' => $memcache
];