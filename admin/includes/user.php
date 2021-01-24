<?php

class User
{
  function __construct($id, $username, $password, $first_name, $last_name)
  {
    $this->id = $id;
    $this->username = $username;
    $this->password = $password;
    $this->first_name = $first_name;
    $this->last_name = $last_name;
  }

  public static function findAllUsers()
  {
    $userObjects = [];
    $users = Database::query("SELECT * FROM users");
    foreach ($users as $user) {
      $userData = [];
      foreach ($user as $value) {
        $userData[] = $value;
      }
      $userObjects[] = new User(...$userData);
    }
    return $userObjects;
  }

  public static function findUserById($id)
  {
    $id = Database::escape($id);
    $assocUser = Database::query("SELECT * FROM users WHERE id = $id");
    $userData = [];
    foreach ($assocUser as $value) {
      $userData[] = $value;
    }
    return new User(...$userData);
  }
}
