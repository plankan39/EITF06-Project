<?php

namespace App\Database;

use App\Model\Task;

class TaskAccess extends DataAccess {
    private string $table = Task::TABLE;
    /**
     * @return array|bool
     */
    public function findAll(): array {
      return $this->connection->
        query("SELECT * FROM {$this->table}")->
        fetchAll(\PDO::FETCH_CLASS, Task::class);
    }
}
