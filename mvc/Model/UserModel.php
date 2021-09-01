<?php

namespace Mvc\Model;

class UserModel implements ModelContract
{
  private ?int $id = null;
  private string $user;
  private string $email;
  private string $passsword;
  private const TYPE_USER = 2;

  public function getId()
  {
    return $this->id;
  }

  public function getUser()
  {
    return $this->user;
  }
  public function setUser($user)
  {
    $this->user = $user;
    return $this;
  }

  public function getEmail()
  {
    return $this->email;
  }
  public function setEmail($email)
  {
    $this->email = $email;
    return $this;
  }

  public function getPassword()
  {
    return $this->passsword;
  }
  public function setPassword($pass)
  {
    $this->passsword = $pass;
    return $this;
  }

  public function getDataAll(): array
  {
    return [
      "user" => $this->user,
      "email" => $this->email,
      "password" => $this->passsword,
      "tipo" => UserModel::TYPE_USER,
    ];
  }

  public function getDataUser(): array
  {
    return [
      "user" => $this->user
    ];
  }

  public function getDataEmail(): array
  {
    return [
      "email" => $this->email
    ];
  }
  public function getDataPassword(): array
  {
    return [
      "password" => $this->passsword
    ];
  }
}
