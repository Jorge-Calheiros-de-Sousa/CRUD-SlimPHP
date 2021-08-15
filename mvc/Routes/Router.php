<?php

namespace mvc\Routes;

use Slim\App;
use Mvc\Routes\Api;
use Mvc\Routes\Web;
use Psr\http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Views\Twig;

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
    $app->any("{route:.*}", function (Request $request, Response $response) {
      $twig = Twig::fromRequest($request);
      return $twig->render($response, "error404.twig");
    });
  }
}
