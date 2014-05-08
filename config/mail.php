<?php

return [
    'class' => 'yii\swiftmailer\Mailer',
    'useFileTransport' => true,
    'transport' => [
        'class' => 'Swift_SmtpTransport',
        'host' => 'smtp.gmail.com', // e.g. smtp.mandrillapp.com or smtp.gmail.com
        'username' => 'moh.fauzan.azim@gmail.com',
        'password' => '',
        'port' => '465', // Port 25 is a very common port too
        'encryption' => 'ssl', // It is often used, check your provider or mail server specs
    ],
];

