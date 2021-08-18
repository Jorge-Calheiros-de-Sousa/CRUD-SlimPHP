<?php

namespace mvc\Routes;

use Mvc\Controller\UserController;
use Slim\App;

class Web
{
  public static function init(App $app)
  {
    $app->get("/CRUD-SlimPHP/", [UserController::class, "render"]);
    $app->get("/", [UserController::class, "render"]);
  }
}
