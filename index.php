<?php

use Dotenv\Dotenv;
use Slim\Factory\AppFactory;
use Slim\Views\Twig;
use Mvc\Routes\Router;
use Slim\Views\TwigMiddleware;

require __DIR__ . '/vendor/autoload.php';

Dotenv::createImmutable(__DIR__)->load();

$app = AppFactory::create();

//Twig
$twig = Twig::create(__DIR__ . '/mvc/View');
$app->add(TwigMiddleware::create($app, $twig));

//Global middleware
$app->addErrorMiddleware(true, true, true);
$app->addBodyParsingMiddleware();


Router::init($app);
$app->run();
