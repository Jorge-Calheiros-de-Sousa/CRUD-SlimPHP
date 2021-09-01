<?php

namespace Mvc\Repository\Implementations;

use Mvc\DTO\AuthUserDTO;
use RedBeanPHP\R;
use Mvc\Repository\Contracts\UserRepositoryContracts;

class UserRepository extends AbstractRepository implements UserRepositoryContracts
{
  protected string $table = "tbusuarios";

  public function auth(string $user, string $password)
  {
    try {
      $where = "WHERE user = :user and tipo = 2";
      $binds = [":user" => $user];
      $user = R::beansToArray(R::findAll($this->table, $where, $binds));
      if (!isset($user[0])) {
        throw new \Exception();
      }
      if (!password_verify($password, $user[0]["password"])) {
        throw new \Exception();
      }
      return (new AuthUserDTO())
        ->setUser($user[0]["user"])
        ->setPassword($user[0]["password"]);
    } catch (\Throwable $th) {
      return false;
    }
  }

  public function verifik_user(string $user)
  {
    try {
      $where = "WHERE user = :user";
      $binds = [":user" => $user];
      $user = R::beansToArray(R::findAll($this->table, $where, $binds));
      if (isset($user[0])) {
        throw new \Exception();
      }
      return true;
    } catch (\Throwable $th) {
      return false;
    }
  }

  public function verifik_password(int $id, string $password)
  {
    try {
      $where = "WHERE id = :id";
      $binds = [":id" => $id];
      $query = R::beansToArray(R::findAll($this->table, $where, $binds));

      if (!isset($query[0])) {
        throw new \Exception();
      }

      if (!password_verify($password, $query[0]["password"])) {
        throw new \Exception();
      }
      return true;
    } catch (\Throwable $th) {
      return false;
    }
  }

  public function authAdmin(string $user, string $password)
  {
    try {
      $where = "WHERE user = :user and tipo = 1";
      $binds = [":user" => $user];
      $user = R::beansToArray(R::findAll($this->table, $where, $binds));

      if (!isset($user[0])) {
        throw new \Exception();
      }

      if ($password != $user[0]["password"]) {
        throw new \Exception();
      }

      return (new AuthUserDTO())
        ->setUser($user[0]["user"])
        ->setPassword($user[0]["password"]);
    } catch (\Throwable $th) {
      //throw $th;
    }
  }
}
