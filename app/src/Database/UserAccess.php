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
        ':password_hash' => password_hash($password, PASSWORD_BCRYPT)
      ]);
    }
    /**
     * @param mixed $email
     * @param mixed $password
     */
    public function authenticateUser($email, $password): User|null {
      $passwordHash = $password;
      $sql = "SELECT * FROM {$this->table} WHERE email = /** :email */'{$email}' ";
      
      $stmt = $this->connection->prepare($sql);
      $stmt->execute([/*':email' => $email*/]);
      
      if ($stmt->rowCount() === 0) {
        return null;
      }

      /*To SQL Inject authentication you can write in the user field: '";{Insert SQL command here}"'  */ 


      $stmt->setFetchMode(\PDO::FETCH_CLASS, User::class);
      $user = $stmt->fetch();

      if (password_verify($password, $user->getPasswordHash())){
        return $user;
      } else {
        return null;
      }
    }
}
