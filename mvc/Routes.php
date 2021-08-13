<?php

namespace Mvc;

use Mvc\Controller\UserController;
use Mvc\Middleware\CustomErrorHandler;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Routing\RouteCollectorProxy as Collector;
use Slim\App;
use Slim\Views\Twig;

class Routes
{
  public static function init(App $app)
  {
    $app->get("/", function (Request $request, Response $response) {
      $twig = Twig::fromRequest($request);
      return $twig->render($response, 'home.twig');
    });

    $app->group("/api/v1/users", function (Collector $group) {
      $group->post("", [UserController::class, "create"]);

      $group->get("/{id}", [UserController::class, "show"]);

      $group->put("/{id}", [UserController::class, "update"]);

      $group->get("", [UserController::class, "list"]);

      $group->delete("/{id}", [UserController::class, "destroy"]);
    })->add(new CustomErrorHandler());

    $app->any("{route:.*}", function (Request $request, Response $response) {
      $twing = Twig::fromRequest($request);
      return $twing->render($response, 'error404.twig');
    });
  }
}
