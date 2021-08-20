<?php

namespace Mvc\Utils;

use DI\Container;
use Mvc\Model\UserModel;
use Mvc\Repository\Contracts\UserRepositoryContracts;
use Mvc\Repository\Implementations\UserRepository;
use Slim\Views\Twig;

class AppContainers
{
  private const CONTAINERS_TO_MAKE = [
    UserRepositoryContracts::class => UserRepository::class
  ];

  public static function init(Container $container)
  {
    $container->set("view", function () {
      return Twig::create(__DIR__ . '/../View/templates');
    });

    $container->set("userModel", function () {
      return new UserModel();
    });

    foreach (static::CONTAINERS_TO_MAKE as $contract => $implementation) {
      $container->set($contract, \DI\autowire($implementation));
    }
  }
}
