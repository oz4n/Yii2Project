<?php

return [
    'class' => 'yii\swiftmailer\Mailer',
    'useFileTransport' => false,
    'transport' => [
        'class' => 'Swift_SmtpTransport',
        'host'     => 'smtp.gmail.com',
        'username'   => 'moh.fauzan.azim@gmail.com',
        'password'   => '',
        'port'     => '587',
        'encryption' => 'tls',
    ],
    'messageConfig' => [
        'charset' => 'UTF-8',
    ]
];

