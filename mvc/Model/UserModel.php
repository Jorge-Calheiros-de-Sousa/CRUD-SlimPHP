<?php

namespace Mvc\Model;

use RedBeanPHP\R;

class UserModel extends BaseModel
{
  private ?int $id = null;
  private string $name;
  private int $yearOld;

  public function getId(): int
  {
    return $this->id;
  }

  public function setId(?int $id): self
  {
    $this->id = $id;
    return $this;
  }

  public function getName(): string
  {
    return $this->name;
  }

  public function setName(string $name): self
  {
    $this->name = $name;
    return $this;
  }

  public function getYearOld(): int
  {
    return $this->yearOld;
  }

  public function setYearOld(string $yearOld): self
  {
    $this->yearOld = $yearOld;
    return $this;
  }

  /**
   * create a new user
   *  @return bool
   */
  public function create(): bool
  {
    $user = R::dispense("tbusuarios");
    $user->name = $this->name;
    $user->year_old = $this->yearOld;

    return R::store($user) > 0;
  }

  /**
   * update user data
   *  @return bool
   */
  public function update(): bool
  {
    $user = R::load("tbusuarios", $this->id);
    $user->name = $this->name;
    $user->year_old = $this->yearOld;

    return R::store($user) > 0;
  }

  /**
   * delete a use data
   * @return bool
   */
  public function destroy(): bool
  {
    $user = R::load("tbusuarios", $this->id);
    R::trash($user);
    return true;
  }

  /**
   * get all user and get a user by id
   */
  public function list()
  {
    $where = $this->id ? " WHERE id = :ID" : "";
    $binds = $this->id ? [":ID" => $this->id] : [];
    return R::beansToArray(R::findAll("tbusuarios", $where, $binds));
  }
}
