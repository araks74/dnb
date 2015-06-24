<?php
/**
 * Main configuration.
 * All properties can be overridden in mode_<mode>.php files.
 */
use app\models\User;
use yii\caching\MemCache;
use yii\helpers\ArrayHelper;
use yii\log\SyslogTarget;
use yii\swiftmailer\Mailer;

$common = [
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'components' => [
        'cache' => [
            'class' => MemCache::class,
            'servers' => [
                ['host' => 'localhost', 'port' => 11211]
            ],
        ],
        'mailer' => [
            'class' => Mailer::class,
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => 0,
            'targets' => [
                [
                    'class' => SyslogTarget::class,
                    'levels' => ['info'],
                    'categories' => ['application'],
                    'logVars' => [],
                    'identity' => $_SERVER['HTTP_HOST'],
                ],
                [
                    'class' => SyslogTarget::class,
                    'levels' => ['error', 'warning'],
                    'identity' => $_SERVER['HTTP_HOST'],
                    'except' => ['except' => 'yii\web\HttpException:404'],
                ],
            ],
        ],
        'db' => require(__DIR__ . '/db.php'),
    ],
    'params' => [
        'adminEmail' => 'admin@example.com',
    ],
];

return [
    // Set Yii framework path.
    'yiiPath' => dirname(__DIR__) . '/vendor/yiisoft/yii2/Yii.php',
    // Set YII_DEBUG flag.
    'yiiDebug' => false,
    // Path aliases.
    'aliases' => [
        '@uploads' => dirname(__DIR__) . '/web/uploads',
    ],
    // Web application configuration.
    'web' => ArrayHelper::merge(
        $common,
        [
            'id' => 'basic',
            'components' => [
                'request' => [
                    // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
                    'cookieValidationKey' => 'ce2Nx6qwzHm2OxYLqlAGqRYA7u02Jq5A',
                ],
                'user' => [
                    'identityClass' => User::class,
                    'enableAutoLogin' => true,
                ],
                'errorHandler' => [
                    'errorAction' => 'site/error',
                ],
            ],
        ]),
    // Console application configuration.
    'console' => ArrayHelper::merge(
        $common,
        [
            'id' => 'basic-console',
            'bootstrap' => ['log'],
            'controllerNamespace' => 'app\commands',
            'components' => [
            ],
        ]),
];
