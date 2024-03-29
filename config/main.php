<?php
/**
 * Main configuration.
 * All properties can be overridden in mode_<mode>.php files.
 */
use app\models\User;
use yii\twig\ViewRenderer;
use yii\caching\MemCache;
use yii\helpers\ArrayHelper;
use yii\log\SyslogTarget;
use yii\swiftmailer\Mailer;
use yii\web\View;

$common = [
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'layout' => 'main.twig',
    'components' => [
        'view' => [
            'class' => View::class,
            'renderers' => [
                'twig' => [
                    'class' => ViewRenderer::class,
                    'cachePath' => '@runtime/Twig/cache',
                    'options' => [
                        'auto_reload' => true,
                    ],
                    'globals' => [
                        'html' => '\yii\helpers\Html',
                        'yii' => 'Yii',
                    ],
                    'uses' => ['yii\bootstrap'],
                ],
            ],
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [],
        ],
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
                    'identity' => 'dnb',
                ],
                [
                    'class' => SyslogTarget::class,
                    'levels' => ['error', 'warning'],
                    'identity' => 'dnb',
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
            'id' => 'dnb',
            'components' => [
                'request' => [
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
            'id' => 'dnb-console',
            'bootstrap' => ['log'],
            'controllerNamespace' => 'app\commands',
            'components' => [
            ],
        ]),
];
