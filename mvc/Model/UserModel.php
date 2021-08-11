<?php

namespace Mvc\Model;

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
    $pdo = $this->returnConnection();

    $insert = $pdo->prepare("insert into TbUsuarios (name_user,yearOld_user) values(:name,:yearOld)");
    $insert->bindParam(':name', $this->name);
    $insert->bindParam(':yearOld', $this->yearOld);

    return ($insert->execute() ? true : false);
  }

  /**
   * update user data
   *  @return bool
   */
  public function update(): bool
  {
    $pdo = $this->returnConnection();

    $up = $pdo->prepare("UPDATE TbUsuarios set name_user = :name_user, yearOld_user= :yearOld  where id=:id");
    $up->bindParam(":name_user", $this->name);
    $up->bindParam(":yearOld", $this->yearOld);
    $up->bindParam(":id", $this->id);

    return ($up->execute() ? true : false);
  }

  /**
   * delete a use data
   * @return bool
   */
  public function destroy(): bool
  {
    $pdo = $this->returnConnection();

    $del = $pdo->prepare("delete from TbUsuarios where id = :id");
    $del->bindValue(":id", $this->id);

    return ($del->execute() ? true : false);
  }

  /**
   * get all user and get a user by id
   */
  public function list()
  {
    $pdo = $this->returnConnection();

    $where = $this->id ? " where id=" . $this->id : "";

    $sql = $pdo->prepare("select * from TbUsuarios" . $where);

    return ($sql->execute() ? $sql : false);
  }
}
