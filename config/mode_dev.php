<?php

/**
 * Development configuration.
 */
return [
    // Set YII_DEBUG flag.
    'yiiDebug' => true,

    // Web application configuration.
    'web'=>[
        'bootstrap' => ['log', 'gii', 'debug'],
        'modules' => [
            'gii' => [
                'class' => yii\gii\Module::class,
                'allowedIPs' => ['172.17.42.*', '127.0.0.1']
            ],
            'debug' => yii\debug\Module::class,
        ],
        'components' => [
            'log' => [
                'traceLevel' => 3,
            ],
            'mailer' => [
                'class' => yii\swiftmailer\Mailer::class,
                'useFileTransport' => true,
            ],
        ],
    ],

    // Console application configuration.
    'console'=>[
        'bootstrap' => ['log', 'gii'],
        'modules' => [
            'gii' => yii\gii\Module::class,
        ],
    ],
];
