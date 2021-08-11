<?php

use Dotenv\Dotenv;
use Slim\Factory\AppFactory;
use Mvc\Routes;

require __DIR__ . '/vendor/autoload.php';

Dotenv::createImmutable(__DIR__)->load();

$app = AppFactory::create();
Routes::init($app);
$app->run();
