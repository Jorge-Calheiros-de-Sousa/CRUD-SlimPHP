<?php

namespace Mvc\Model;

interface ModelContract
{
  public function getDataAll(): array;
  public function getDataUser(): array;
  public function getDataEmail(): array;
  public function getDataPassword(): array;
}
