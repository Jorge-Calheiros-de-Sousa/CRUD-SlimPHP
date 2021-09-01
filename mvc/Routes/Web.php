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

    $app->get($baseRoute . "adm/", [UserController::class, "renderloginadm"]);

    $app->get($baseRoute . "cadastro/", [UserController::class, "rendercadastro"]);

    $app->get($baseRoute . "login/", [UserController::class, "renderlogin"]);

    $app->get($baseRoute . "adm/home/", [UserController::class, "rendernadmhome"]);

    $app->get($baseRoute . "editar-nome/", [UserController::class, "rendereditarnome"]);

    $app->get($baseRoute . "editar-email/", [UserController::class, "rendereditaremail"]);

    $app->get($baseRoute . "editar-senha/", [UserController::class, "rendereditarsenha"]);
  }
}
