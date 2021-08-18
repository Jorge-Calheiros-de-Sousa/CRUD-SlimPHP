<?php

namespace mvc\Routes;

use DI\Container;
use Slim\App;
use Psr\http\Message\ResponseInterface as Response;

class Web
{
  public static function init(App $app)
  {
    $app->get("/CRUD-SlimPHP/", function (Response $response, Container $container) {
      $twig = $container->get("view");
      return $twig->render($response, "home.twig", ['baseURL' => $_ENV['APP_URL']]);
    });

    $app->get("/", function (Response $response, Container $container) {
      $twig = $container->get("view");
      return $twig->render($response, "home.twig", ['baseURL' => $_ENV['APP_URL']]);
    });
  }
}
