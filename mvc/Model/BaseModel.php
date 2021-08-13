<?php

namespace Mvc\Model;

use RedBeanPHP\R;

class BaseModel
{
  private $pdo;

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
}
