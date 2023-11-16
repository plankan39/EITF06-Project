<?php

namespace App\Database;

use App\Database\Connection;

abstract class DataAccess {
  protected \PDO $connection;

  public function __construct() {
    $this->connection = Connection::getInstance()->getPdo();
  }
}
