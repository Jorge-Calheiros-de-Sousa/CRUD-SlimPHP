<?php

namespace mvc\Routes;

use Mvc\Controller\UserController;
use Slim\App;

class Web
{
  public static function init(App $app)
  {
    $baseRoute = $_ENV["APP_BASE_ROUTE"];
    $app->get($baseRoute, [UserController::class, "render"]);
  }
}
