<?php

$params = require(__DIR__ . '/params.php');
$db = require(__DIR__ . '/db.php');
$mail = require(__DIR__ . '/mail.php');
$memcache = require(__DIR__ . '/memcache.php');
$modules = require(__DIR__ . '/modules.php');
$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => [
        'log',
        'member',
        'userlog'
    ],
    'extensions' => require(__DIR__ . '/../vendor/yiisoft/extensions.php'),
    'defaultRoute' => 'site/site/index',
    'modules' => $modules,
    'components' => [
        'ipinfo' => [
            'class' => 'app\modules\userlog\librarys\IpInfo',
            'apiKey' => 'bc5985346d51fd2c0d7ee7bc4aed9671606db302bd95b18b03f992a789a21e9e',
            'apiFormat' => 'json'
        ],
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
        'mail' => $mail,
        //'cache' => $memcache
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
//    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = 'yii\debug\Module';

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = 'yii\gii\Module';
}

return $config;
