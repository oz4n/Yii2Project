<?php

$params = require(__DIR__ . '/params.php');
$db = require(__DIR__ . '/db.php');
$mail = require(__DIR__ . '/mail.php');
$memcache = require(__DIR__ . '/memcache.php');
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

                'dashboard' => '/dashboard/dashboard/index',
                'dashboard/member/index' => '/member/member/index',
                'dashboard/member/create' => 'member/member/create',
                'dashboard/member/update' => '/member/member/update',
                'dashboard/member/delete' => '/member/member/delete',
                'dashboard/member/view' => '/member/member/view',
                'dashboard/member/brevetaward/index' => '/member/brevetaward/index',
                'dashboard/member/brevetaward/create' => '/member/brevetaward/create',
                'dashboard/member/brevetaward/update' => '/member/brevetaward/update',
                'dashboard/member/brevetaward/delete' => '/member/brevetaward/delete',
                'dashboard/member/brevetaward/view' => '/member/brevetaward/view',

                'dashboard/member/lifeskill/index' => '/member/lifeskill/index',
                'dashboard/member/lifeskill/create' => '/member/lifeskill/create',
                'dashboard/member/lifeskill/update' => '/member/lifeskill/update',
                'dashboard/member/lifeskill/delete' => '/member/lifeskill/delete',
                'dashboard/member/lifeskill/view' => '/member/lifeskill/view',

                'dashboard/member/languageskill/index' => '/member/languageskill/index',
                'dashboard/member/languageskill/create' => '/member/languageskill/create',
                'dashboard/member/languageskill/update' => '/member/languageskill/update',
                'dashboard/member/languageskill/delete' => '/member/languageskill/delete',
                'dashboard/member/languageskill/view' => '/member/languageskill/view',

                'dashboard/member/school/index' => '/member/school/index',
                'dashboard/member/school/create' => '/member/school/create',
                'dashboard/member/school/update' => '/member/school/update',
                'dashboard/member/school/delete' => '/member/school/delete',
                'dashboard/member/school/view' => '/member/school/view',

                'dashboard/member/area/index' => '/member/area/index',
                'dashboard/member/area/create' => '/member/area/create',
                'dashboard/member/area/update' => '/member/area/update',
                'dashboard/member/area/delete' => '/member/area/delete',
                'dashboard/member/area/view' => '/member/area/view',

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
        'cache' => $memcache
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
