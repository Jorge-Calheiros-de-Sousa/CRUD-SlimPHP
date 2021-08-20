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

  public function update($id, ModelContract $modelContract): bool
  {
    $bean = R::load($this->table, $id);
    $bean = $this->fillData($bean, $modelContract);
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

  public function list($id = null): array
  {
    $where = $id ? " WHERE id = :ID" : "";
    $binds = $id ? [":ID" => $id] : [];
    return R::beansToArray(R::findAll($this->table, $where, $binds));
  }

  private function fillData(OODBBean $bean, ModelContract $model)
  {
    foreach ($model->getData() as $key => $value) {
      $bean->$key = $value;
    }
    return $bean;
  }
}
