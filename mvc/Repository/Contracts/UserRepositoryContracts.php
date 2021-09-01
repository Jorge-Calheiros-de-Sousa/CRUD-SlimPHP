<?php

namespace Mvc\Repository\Contracts;

use Mvc\Model\ModelContract;

interface UserRepositoryContracts
{
  public function create(ModelContract $modelContract): bool;

  public function update_name($id, ModelContract $modelContract): bool;

  public function update_email($id, ModelContract $modelContract): bool;

  public function update_password($id, ModelContract $modelContract): bool;

  public function destroy($id): bool;

  public function list($id = null): array;

  public function auth(string  $user, string $password);

  public function authAdmin(string $user, string $password);

  public function verifik_user(string $user);

  public function verifik_password(int $id, string $password);
}
