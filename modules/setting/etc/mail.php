<?php

use app\modules\setting\models\SettingModel;

$setting = new SettingModel();
return [
    'class' => 'yii\swiftmailer\Mailer',
    'useFileTransport' => false,
    'transport' => [
        'class' => 'Swift_SmtpTransport',
        'host' => 'smtp.gmail.com',
        'username' => $setting->getSettingValueByKey('adminemail'),
        'password' => $setting->getSettingValueByKey('adminemailpass'),
        'port' => '587',
        'encryption' => 'tls',
    ],
    'messageConfig' => [
        'charset' => 'UTF-8',
    ]
];

