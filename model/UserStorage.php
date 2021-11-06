<?php

class UserStorage {
  /**
   * @return User[]
   */
  public function getAll(): array
  {
      try {
          return Db::conn()
              ->query("SELECT * FROM users")
              ->fetchAll(PDO::FETCH_CLASS, User::class);
      }  catch (\PDOException $e) {
          die($e->getMessage());
      }
  }
}