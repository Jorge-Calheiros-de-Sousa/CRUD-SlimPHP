<?php

namespace Mvc\Model;



class UserModel implements ModelContract
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

  public function getData(): array
  {
    return [
      "name" => $this->name,
      "yearOld" => $this->yearOld
    ];
  }
}
