<?php

namespace Mvc\Repository\Implementations;

use RedBeanPHP\R;
use Mvc\Model\ModelContract;
use RedBeanPHP\OODBBean;

abstract class AbstractRepository
{
  protected string $table;

  public function __construct()
  {
    try {
      $_dbHostname = $_ENV['DB_HOST'];
      $_dbName = $_ENV['DB_DATABASE'];
      $_dbUsername = $_ENV['DB_USERNAME'];
      $_dbPassword = $_ENV['DB_PASSWORD'];

      R::setup("mysql:host=$_dbHostname; dbname=$_dbName;", $_dbUsername, $_dbPassword);
    } catch (\Exception $e) {
      echo "Falha ao conectar: " . $e->getMessage();
    }
  }
  public function create(ModelContract $modelContract): bool
  {
    $bean = R::dispense($this->table);
    $bean = $this->fillData($bean, $modelContract);
    return R::store($bean) > 0;
  }

  public function update_name($id, ModelContract $modelContract): bool
  {
    $bean = R::load($this->table, $id);
    $bean = $this->fillDataUser($bean, $modelContract);
    return R::store($bean) > 0;
  }

  public function update_email($id, ModelContract $modelContract): bool
  {
    $bean = R::load($this->table, $id);
    $bean = $this->fillDataEmail($bean, $modelContract);
    return R::store($bean) > 0;
  }

  public function update_password($id, ModelContract $modelContract): bool
  {
    $bean = R::load($this->table, $id);
    $bean = $this->fillDataPassword($bean, $modelContract);
    return R::store($bean) > 0;
  }

  public function destroy($id): bool
  {
    try {
      $bean = R::load($this->table, $id);
      R::trash($bean);
      return true;
    } catch (\Throwable $e) {
      return false;
    }
  }

  public function list($user = null): array
  {
    $where = $user ? " WHERE user = :user and tipo = 2" : " WHERE tipo = 2";
    $binds = $user ? [":user" => $user] : [];
    return R::beansToArray(R::findAll($this->table, $where, $binds));
  }

  private function fillData(OODBBean $bean, ModelContract $model)
  {
    foreach ($model->getDataAll() as $key => $value) {
      $bean->$key = $value;
    }
    return $bean;
  }
  private function fillDataUser(OODBBean $bean, ModelContract $model)
  {
    foreach ($model->getDataUser() as $key => $value) {
      $bean->$key = $value;
    }
    return $bean;
  }
  private function fillDataEmail(OODBBean $bean, ModelContract $model)
  {
    foreach ($model->getDataEmail() as $key => $value) {
      $bean->$key = $value;
    }
    return $bean;
  }
  private function fillDataPassword(OODBBean $bean, ModelContract $model)
  {
    foreach ($model->getDataPassword() as $key => $value) {
      $bean->$key = $value;
    }
    return $bean;
  }
}
