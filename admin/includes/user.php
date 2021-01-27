<?php

class User extends DbObject
{
  static protected $table = "users";
  static protected $className = "User";
  static protected $integerProps = ["id"];
  public $id;
  public $username;
  public $password;
  public $first_name;
  public $last_name;
  function __construct($id, $username, $password, $first_name, $last_name)
  {
    $this->id = $id;
    $this->username = $username;
    $this->password = $password;
    $this->first_name = $first_name;
    $this->last_name = $last_name;
  }

  public static function verifyUser($username, $password)
  {
    $user = Database::query("SELECT password FROM users WHERE username = '$username'");
    return $user['password'] === $password;
  }
}
