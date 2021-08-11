<?php

namespace Mvc;

use Mvc\Controller\UserController;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Routing\RouteCollectorProxy as Collector;
use Slim\App;

class Routes
{
  public static function init(App $app)
  {
    $app->get("/", function (Request $request, Response $response) {
      $file = __DIR__ . '/View/index.html';
      $response->getBody()->write(file_get_contents($file));
      return $response;
    });

    $app->group("/api/v1/users", function (Collector $group) {
      $group->get("", [UserController::class, "list"]);

      $group->get("/{id}", [UserController::class, "show"]);

      $group->post("", [UserController::class, "create"]);

      $group->put("/{id}", [UserController::class, "update"]);

      $group->delete("/{id}", [UserController::class, "destroy"]);
    });
  }
}
