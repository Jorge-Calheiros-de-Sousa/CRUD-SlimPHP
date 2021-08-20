<?php

namespace Mvc\Repository\Implementations;

use Mvc\Repository\Contracts\UserRepositoryContracts;

class UserRepository extends AbstractRepository implements UserRepositoryContracts
{
  protected string $table = "tbusuarios";
}
