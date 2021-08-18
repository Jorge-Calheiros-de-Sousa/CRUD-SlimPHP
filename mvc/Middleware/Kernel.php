<?php

namespace Mvc\Middleware;

use Slim\App;
use Slim\Views\TwigMiddleware;

class Kernel
{
  public static function init(App $app)
  {
    $app->addErrorMiddleware(true, true, true);
    $app->addBodyParsingMiddleware();
    $app->add(TwigMiddleware::createFromContainer($app));
  }
}
