<?php

namespace mvc\Routes;

use DI\Container;
use Slim\App;
use Mvc\Routes\Api;
use Mvc\Routes\Web;
use Psr\Http\Message\ResponseInterface as Response;

class Router
{
  public static function init(App $app)
  {
    /**
     * Start API routes
     */
    Api::init($app);

    /**
     * Start Web routes
     */
    Web::init($app);

    /**
     * Geral routes
     */
    $app->any("{route:.*}", function (Response $response, Container $container) {
      $twig = $container->get("error");
      return $twig->render($response, "error404.twig", ['baseURL' => $_ENV['APP_URL']]);
    });
  }
}
