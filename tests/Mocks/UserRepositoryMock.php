<?php

namespace Tests\Mocks;

use Mvc\DTO\AuthUserDTO;
use Mvc\Model\ModelContract;
use Mvc\Repository\Contracts\UserRepositoryContracts;

class UserRepositoryMock implements UserRepositoryContracts
{

  public function create(ModelContract $modelContract): bool
  {
    return true;
  }

  public function list($id = null): array
  {
    return ["Teste"];
  }

  public function destroy($id): bool
  {
    return true;
  }

  public function update_name($id, ModelContract $modelContract): bool
  {
    return true;
  }

  public function update_email($id, ModelContract $modelContract): bool
  {
    return true;
  }

  public function update_password($id, ModelContract $modelContract): bool
  {
    return true;
  }

  public function auth(string $user, string $password)
  {
    return (new AuthUserDTO())
      ->setUser("Jorge")
      ->setPassword("jorge");
  }

  public function authAdmin(string $user, string $password)
  {
    return (new AuthUserDTO())
      ->setUser("Jorge")
      ->setPassword("jorge");
  }

  public function verifik_user(string $user)
  {
    return true;
  }

  public function verifik_password(int $id, string $password)
  {
    return true;
  }
}
