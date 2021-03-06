<?php

//$params = require(__DIR__ . '/params.php');
$db = require(__DIR__ . '/db.php');
//$mail = require(__DIR__ . '/mail.php');
$memcache = require(__DIR__ . '/memcache.php');
$modules = require(__DIR__ . '/modules.php');
$components = require(__DIR__ . '/components.php');
$config = [
    'id' => '1.0',  
    'basePath' => dirname(__DIR__),
    'bootstrap' => [
        'log',
        'dashboard',
        'member',
        'userlog',
        'page',
        'word',
        'site',
        'setting'
    ],
    'extensions' => require(__DIR__ . '/../vendor/yiisoft/extensions.php'),
    'defaultRoute' => 'site/site/index',
    'modules' => $modules,
    'components' => $components,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
//    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = 'yii\debug\Module';

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = 'yii\gii\Module';
}

return $config;
