<?php

namespace Mvc\Middleware;

use Slim\App;

class Kernel
{
  public static function init(App $app)
  {
    $app->addErrorMiddleware(true, true, true);
    $app->addBodyParsingMiddleware();
  }
}
