<?php

namespace App\Database;

use App\Model\Item;

class ItemAccess extends DataAccess
{
  private string $table = Item::TABLE;
  /**
   * @return array|bool
   */
  public function findAll(): array
  {
    return $this->connection->
      query("SELECT * FROM {$this->table}")->
      fetchAll(\PDO::FETCH_CLASS, Item::class);
  }
}
