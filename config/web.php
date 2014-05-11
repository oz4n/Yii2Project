<?php

$params = require(__DIR__ . '/params.php');
$db = require(__DIR__ . '/db.php');
$mail = require(__DIR__ . '/mail.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'extensions' => require(__DIR__ . '/../vendor/yiisoft/extensions.php'),
    'defaultRoute' => 'site/site/index',
    'modules' => [
        'gii' => [
            'class' => 'yii\gii\Module',
        ],
        'dashboard' => [
            'class' => 'app\modules\dashboard\dashboard',
        ],
        'word' => [
            'class' => 'app\modules\word\word',
        ],
        'member' => [
            'class' => 'app\modules\member\Member',
        ],
        'userlog' => [
            'class' => 'app\modules\userlog\userlog',
        ],
        'users' => [
            'class' => 'app\modules\users\users',
        ],
        'user' => [
            'class' => 'dektrium\user\Module',
//            'allowUnconfirmedLogin' => true,
            'confirmWithin' => 21600,
            'cost' => 12,
            'admins' => ['ozan']
        ],
        'site' => [
            'class' => 'app\modules\site\site',
        ],
    ],
    'components' => [
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'index' => '/site/site/index',
                'info' => '/site/site/info',
                'info1' => '/site/site/info1',
                'info2' => '/site/site/info2',
                'about' => '/site/site/about',
                'about1' => '/site/site/about1',
                'contact' => '/site/site/contact',
                'logbook' => '/site/site/logbook',
                'regulation' => '/site/site/regulation',
                'dashboard' => '/dashboard/dashboard/index'
            ]
        ],
//        'view' => [
//            'theme' => [
//                'pathMap' => [
//                    '@dektrium/user/views' => '@app/modules/users/views'
//                ],
//            ],
//        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/site/error',
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
        'mail' => $mail
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = 'yii\debug\Module';

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = 'yii\gii\Module';
}

return $config;
