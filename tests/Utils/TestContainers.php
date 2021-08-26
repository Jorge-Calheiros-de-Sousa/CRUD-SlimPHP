<?php

namespace Tests\Utils;

use DI\Container;
use Mvc\Model\UserModel;
use Mvc\Repository\Contracts\UserRepositoryContracts;
use Tests\Mocks\UserRepositoryMock;
use Tests\Mocks\UserRepositoryErrorMock;

class TestContainers
{
  private const CONTAINERS_TO_MAKE = [
    UserRepositoryContracts::class => UserRepositoryMock::class,
    "Error" => UserRepositoryErrorMock::class
  ];

  public static function init(Container $container)
  {
    $container->set("userModel", function () {
      return new UserModel();
    });

    foreach (static::CONTAINERS_TO_MAKE as $contract => $implementation) {
      $container->set($contract, \DI\autowire($implementation));
    }
  }
}
