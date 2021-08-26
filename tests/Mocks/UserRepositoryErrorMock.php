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

  public function update($id, ModelContract $modelContract): bool
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
}
