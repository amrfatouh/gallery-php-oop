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
  public $role;
  public $image;

  static public $uploadDirectory = "admin" . DS . "images" . DS;
  static public $imagePlaceholder = "http://placehold.it/300/597/eee?text=image";

  public static function constructInstance($id = null, $username = null, $password = null, $first_name = null, $last_name = null, $role = null, $image = null)
  {
    $user = new User;
    $user->id = $id;
    $user->username = $username;
    $user->password = $password;
    $user->first_name = $first_name;
    $user->last_name = $last_name;
    $user->role = $role;
    $user->image = $image;
    return $user;
  }

  public function getImagePath()
  {
    if (empty($this->image))
      return static::$imagePlaceholder;
    return DISPLAY_ROOT . static::$uploadDirectory . $this->image;
  }

  public function getImageActualPath()
  {
    return ROOT . static::$uploadDirectory . $this->image;
  }

  public static function verifyUser($username, $password)
  {
    $usersArray = Database::query("SELECT password FROM users WHERE username = '$username'");
    if (empty($usersArray)) return false;
    //get the first user of sent array (the array should contain only one user)
    $user = array_shift($usersArray);
    return $user['password'] === $password;
  }

  public function updateImage($photo_id)
  {
    $photo = Photo::findById($photo_id);
    $this->image = $photo->filename;
    return $this->update();
  }

  public function getRelatedComments()
  {
    if (!isset($this->id)) return false;
    return $comments = Comment::findByProperty("user_id", $this->id);
  }
  public function deleteRelatedComments()
  {
    $flag = true;
    foreach ($this->getRelatedComments() as $comment) {
      $flag = $comment->delete();
    }
    return $flag;
  }
}
