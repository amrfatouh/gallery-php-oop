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
  public static function constructInstance($id = null, $username = null, $password = null, $first_name = null, $last_name = null)
  {
    $user = new User;
    $user->id = $id;
    $user->username = $username;
    $user->password = $password;
    $user->first_name = $first_name;
    $user->last_name = $last_name;
    return $user;
  }

  public static function verifyUser($username, $password)
  {
    $user = Database::query("SELECT password FROM users WHERE username = '$username'");
    return $user['password'] === $password;
  }
}
