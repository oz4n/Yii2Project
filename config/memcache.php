<?php
return [
    'class' => '\yii\caching\MemCache',
    'servers' => [
        [
            'host' => '127.0.0.1',
            'port' => 11211,
            'weight' => 100,
        ],
//        [
//            'host' => '127.0.0.1',
//            'port' => 11211,
//            'weight' => 50,
//        ],
    ],
];