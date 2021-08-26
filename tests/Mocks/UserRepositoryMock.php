<?php

namespace Tests\Mocks;

use Mvc\Model\ModelContract;
use Mvc\Repository\Contracts\UserRepositoryContracts;

class UserRepositoryMock implements UserRepositoryContracts
{

  public function create(ModelContract $modelContract): bool
  {
    return true;
  }

  public function update($id, ModelContract $modelContract): bool
  {
    return true;
  }

  public function list($id = null): array
  {
    return [1, 2, 3];
  }

  public function destroy($id): bool
  {
    return true;
  }
}
