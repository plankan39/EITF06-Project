<?php

namespace App\Database;

use App\Model\User;

class UserAccess extends DataAccess
{
  private string $table = User::TABLE;
  /**
   * @return array|bool
   */
  public function findAll(): array
  {
    return $this->connection->
      query("SELECT * FROM {$this->table}")->
      fetchAll(\PDO::FETCH_CLASS, User::class);
  }
  /**
   * @param mixed $email
   * @param mixed $password
   * @param mixed $post_address
   */
  public function addUser($email, $password, $post_address): void
  {
    $sql = "INSERT INTO {$this->table}(email, password_hash, post_address) VALUES(:email, :password_hash, :post_address)";
    $statement = $this->connection->prepare($sql)->execute([
      ':email' => $email,
      ':password_hash' => password_hash($password, PASSWORD_BCRYPT),
      ':post_address' => $post_address
    ]);
  }
  /**
   * @param mixed $email
   * @param mixed $password
   */
  public function authenticateUser($email, $password): User|null
  {
    $passwordHash = $password;
    $sql = "SELECT * FROM {$this->table} WHERE email = :email ";

    $stmt = $this->connection->prepare($sql);
    $stmt->execute([':email' => $email]);

    if ($stmt->rowCount() === 0) {
      return null;
    }

    /*To SQL Inject authentication you can write in the user field: '";{Insert SQL command here}"'  */

    $stmt->setFetchMode(\PDO::FETCH_CLASS, User::class);
    $user = $stmt->fetch();

    if (password_verify($password, $user->getPasswordHash())) {
      return $user;
    } else {
      return null;
    }
  }
  /**
   * @param mixed $password
   */
  public function checkPassword($password)
  {
    $sql = "SELECT DISTINCT password FROM password_blacklist";
    $stmt = $this->connection->prepare($sql);
    $stmt->execute();

    $passwords = $stmt->fetchAll();

    $passwords = array_map(function ($item) {
      return strtolower($item["password"]); }, $passwords);


    return !in_array(strtolower($password), $passwords);
  }
}
