<?php

use DI\Bridge\Slim\Bridge as AppFactoryBrige;
use DI\Container;
use Dotenv\Dotenv;
use Mvc\Routes\Router;
use Mvc\Middleware\Kernel;
use Mvc\Utils\AppContainers;

require __DIR__ . '/vendor/autoload.php';

Dotenv::createImmutable(__DIR__)->load();

$container = new Container();
$app = AppFactoryBrige::create($container);
AppContainers::init($container);

//Global middleware
Kernel::init($app);

//Router
Router::init($app);
$app->run();
