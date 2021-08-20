<?php

namespace Mvc\Repository\Contracts;

use Mvc\Model\ModelContract;

interface UserRepositoryContracts
{
  public function create(ModelContract $modelContract): bool;

  public function update($id, ModelContract $modelContract): bool;

  public function destroy($id): bool;

  public function list($id = null): array;
}
