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

  public function create()
  {
    $sql = "INSERT INTO users (username, password, first_name, last_name) ";
    $sql .= "VALUES ('$this->username', '$this->password', '$this->first_name', '$this->last_name')";
    $this->id = Database::query($sql);
    return true;
  }

  public function update()
  {
    $sql = "UPDATE users SET ";
    $sql .= "username = '$this->username', ";
    $sql .= "password = '$this->password', ";
    $sql .= "first_name = '$this->first_name', ";
    $sql .= "last_name = '$this->last_name' ";
    $sql .= "WHERE id = $this->id";
    return Database::query($sql);
  }

  public function save()
  {
    if (User::findUserById($this->id)) {
      return $this->update();
    } else {
      return $this->create();
    }
  }

  public function delete()
  {
    $sql = "DELETE FROM users WHERE id = $this->id";
    return Database::query($sql);
  }

  public static function findAllUsers()
  {
    $userObjects = [];
    $users = Database::query("SELECT * FROM users");
    if (!empty($users)) {
      foreach ($users as $user) {
        $userData = [];
        foreach ($user as $value) {
          $userData[] = $value;
        }
        $userObjects[] = new User(...$userData);
      }
    }
    return $userObjects;
  }

  public static function findUserById($id)
  {
    $id = Database::escape($id);
    $assocUser = Database::query("SELECT * FROM users WHERE id = $id");
    $userData = [];
    if (!empty($assocUser)) {
      foreach ($assocUser as $value) {
        $userData[] = $value;
      }
      return new User(...$userData);
    }
    return false;
  }
  public static function findUserByUsername($username)
  {
    $username = Database::escape($username);
    $assocUser = Database::query("SELECT * FROM users WHERE username = '$username'");
    $userData = [];
    foreach ($assocUser as $value) {
      $userData[] = $value;
    }
    return new User(...$userData);
  }

  public static function verifyUser($username, $password)
  {
    $user = Database::query("SELECT password FROM users WHERE username = '$username'");
    return $user['password'] === $password;
  }
}
