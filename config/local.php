<?php

return [
    'web' => [
        'components' => [
            'db' => [
                'class' => 'yii\db\Connection',
                'dsn' => 'mysql:host=localhost;dbname=dnb2',
                'username' => 'root',
                'password' => '123456',
                'charset' => 'utf8',
            ]
        ]
    ],
    'console' => [
        'components' => [
            'db' => [
                'class' => 'yii\db\Connection',
                'dsn' => 'mysql:host=localhost;dbname=dnb2',
                'username' => 'root',
                'password' => '123456',
                'charset' => 'utf8',
            ]
        ]
    ]
];
