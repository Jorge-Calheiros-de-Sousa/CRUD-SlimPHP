<?php

use Dotenv\Dotenv;
use Slim\Factory\AppFactory;
use Slim\Views\Twig;
use Mvc\Routes\Router;
use Slim\Views\TwigMiddleware;
use Mvc\Middleware\Kernel;

require __DIR__ . '/vendor/autoload.php';

Dotenv::createImmutable(__DIR__)->load();

$app = AppFactory::create();

//Twig
$twig = Twig::create(__DIR__ . '/mvc/View');
$app->add(TwigMiddleware::create($app, $twig));

//Global middleware
Kernel::init($app);

//Router
Router::init($app);
$app->run();
