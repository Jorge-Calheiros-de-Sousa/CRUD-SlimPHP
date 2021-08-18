<?php

namespace Mvc\Utils;

use DI\Container;
use Slim\Views\Twig;

class AppContainers
{
  public static function init(Container $container)
  {
    $container->set("view", function () {
      return Twig::create(__DIR__ . '/../View/templates');
    });

    $container->set("error", function () {
      return Twig::create(__DIR__ . '/../View/templates');
    });
  }
}
