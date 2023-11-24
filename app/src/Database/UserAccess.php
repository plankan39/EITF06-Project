<?php

namespace App\Database;

use App\Model\User;

class UserAccess extends DataAccess {
    private string $table = User::TABLE;
    /**
     * @return array|bool
     */
    public function findAll(): array {
      return $this->connection->
        query("SELECT * FROM {$this->table}")->
        fetchAll(\PDO::FETCH_CLASS, User::class);
    }
    /**
     * @param mixed $email
     * @param mixed $password
     */
    public function addUser($email, $password): void {
      $sql = "INSERT INTO {$this->table}(email, password_hash) VALUES(:email, :password_hash)";
      $statement = $this->connection->prepare($sql)->execute([
        ':email' => $email,
        ':password_hash' => $password
      ]);
    }
    /**
     * @param mixed $email
     * @param mixed $password
     */
    public function authenticateUser($email, $password): User|null {
      $passwordHash = $password;
      $sql = "SELECT * FROM {$this->table} WHERE email = :email AND password_hash = :password_hash";
      $stmt = $this->connection->prepare($sql);
      $stmt->execute([':email' => $email, ':password_hash' => $passwordHash]);
      
      if ($stmt->rowCount() === 0) {
        return null;
      }

      $stmt->setFetchMode(\PDO::FETCH_CLASS, User::class);
      return $stmt->fetch();

    }
}
