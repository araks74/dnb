<?php
require(__DIR__ . '/../vendor/autoload.php');

(new Dotenv\Dotenv(__DIR__ . '/../'))->load();

$env = new \janisto\environment\Environment(dirname(__DIR__) . '/config');
$env->setup();
(new yii\web\Application($env->web))->run();
