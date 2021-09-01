<?php

namespace Mvc\DTO;

class AuthUserDTO
{
  private string $user;
  private string $passsword;


  public function getUser()
  {
    return $this->user;
  }
  public function setUser($user)
  {
    $this->user = $user;

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
}
