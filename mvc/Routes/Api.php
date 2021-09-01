<?php

namespace mvc\Routes;

use Mvc\Controller\AuthController;
use Mvc\Controller\UserController;
use Mvc\Middleware\AuthMiddleware;
use Mvc\Middleware\CustomErrorHandler;
use Slim\Routing\RouteCollectorProxy as Collector;
use Slim\App;

class Api
{
  public static function init(App $app)
  {
    $baseRoute = $_ENV["APP_BASE_ROUTE"];
    $app->group($baseRoute . "api/v1", function (Collector $collector) {
      //Public Routes
      $collector->group("", function (Collector $collector) {
        $collector->post("/auth", [AuthController::class, "login"]);
        $collector->post("/auth/adm/", [AuthController::class, "loginAdmin"]);
        $collector->post("/auth/cadastrar/", [AuthController::class, "cadastrar"]);
      });

      //Protected Routes
      $collector->group("", function (Collector $collector) {
        $collector->get("/users/all", [UserController::class, "list"]);
        $collector->get("/users/{user}", [UserController::class, "show"]);
        $collector->put("/users/editar-nome/{id}", [UserController::class, "update_user"]);
        $collector->put("/users/editar-email/{id}", [UserController::class, "update_email"]);
        $collector->put("/users/editar-senha/{id}", [UserController::class, "update_senha"]);
        $collector->get("/users", [UserController::class, "header"]);
        $collector->delete("/users/{id}", [UserController::class, "destroy"]);
      })->add(new AuthMiddleware());
    })->add(new CustomErrorHandler());
  }
}
