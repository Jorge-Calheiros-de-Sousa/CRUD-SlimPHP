<?php

namespace Tests\Mocks;

use Mvc\Model\ModelContract;
use Mvc\Repository\Contracts\UserRepositoryContracts;

class UserRepositoryErrorMock implements UserRepositoryContracts
{

  public function create(ModelContract $modelContract): bool
  {
    return false;
  }

  public function update_name($id, ModelContract $modelContract): bool
  {
    return false;
  }

  public function update_email($id, ModelContract $modelContract): bool
  {
    return false;
  }

  public function update_password($id, ModelContract $modelContract): bool
  {
    return false;
  }

  public function list($id = null): array
  {
    return [];
  }

  public function destroy($id): bool
  {
    return false;
  }
  public function auth(string $user, string $password)
  {
    throw new \Exception();

    return false;
  }

  public function authAdmin(string $user, string $password)
  {
    throw new \Exception();

    return false;
  }

  public function verifik_user(string $user)
  {
  }
}
