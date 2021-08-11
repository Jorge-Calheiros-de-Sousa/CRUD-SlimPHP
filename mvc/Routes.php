<?php

namespace Mvc;

use Mvc\Controller\UserController;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
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

    $app->get("/api/v1/users", [UserController::class, "list"]);

    $app->post("/api/v1/users", [UserController::class, "create"]);

    $app->put("/api/v1/users", [UserController::class, "update"]);

    $app->delete("/api/v1/users", [UserController::class, "destroy"]);
  }
}
