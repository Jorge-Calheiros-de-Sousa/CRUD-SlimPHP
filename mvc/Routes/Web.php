<?php

namespace mvc\Routes;

use Slim\App;
use Psr\http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;

class Web
{
  public static function init(App $app)
  {
    $app->get("/CRUD-SlimPHP/", function (Request $request, Response $response) {
      $twig = Twig::fromRequest($request);
      return $twig->render($response, "home.twig", ['baseURL' => $_ENV['APP_URL']]);
    });

    $app->get("/", function (Request $request, Response $response) {
      $twig = Twig::fromRequest($request);
      return $twig->render($response, "home.twig", ['baseURL' => $_ENV['APP_URL']]);
    });
  }
}
