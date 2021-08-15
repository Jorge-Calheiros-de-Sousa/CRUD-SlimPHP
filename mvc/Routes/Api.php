<?php

namespace mvc\Routes;

use Mvc\Controller\UserController;
use Mvc\Middleware\CustomErrorHandler;
use Slim\Routing\RouteCollectorProxy as Collector;
use Slim\App;

class Api
{
  public static function init(App $app)
  {
    $app->group("/CRUD-SlimPHP/api/v1/users", function (Collector $group) {
      $group->post("", [UserController::class, "create"]);

      $group->get("/{id}", [UserController::class, "show"]);

      $group->put("/{id}", [UserController::class, "update"]);

      $group->get("", [UserController::class, "list"]);

      $group->delete("/{id}", [UserController::class, "destroy"]);
    })->add(new CustomErrorHandler());

    $app->group("/api/v1/users", function (Collector $group) {
      $group->post("", [UserController::class, "create"]);

      $group->get("/{id}", [UserController::class, "show"]);

      $group->put("/{id}", [UserController::class, "update"]);

      $group->get("", [UserController::class, "list"]);

      $group->delete("/{id}", [UserController::class, "destroy"]);
    })->add(new CustomErrorHandler());
  }
}
