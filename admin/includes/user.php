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
  public $image;
  public $tmpPath;
  public $customErrors = [];

  static public $uploadErrors = array(
    0 => 'There is no error, the file uploaded with success',
    1 => 'The uploaded file exceeds the upload_max_filesize directive in php.ini',
    2 => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form',
    3 => 'The uploaded file was only partially uploaded',
    4 => 'No file was uploaded',
    6 => 'Missing a temporary folder',
    7 => 'Failed to write file to disk.',
    8 => 'A PHP extension stopped the file upload.',
  );

  static public $uploadDirectory = "admin" . DS . "images" . DS;
  static public $imagePlaceholder = "http://placehold.it/300/597/eee?text=image";

  public static function constructInstance($id = null, $username = null, $password = null, $first_name = null, $last_name = null, $image = null)
  {
    $user = new User;
    $user->id = $id;
    $user->username = $username;
    $user->password = $password;
    $user->first_name = $first_name;
    $user->last_name = $last_name;
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

  public function delete()
  {
    $this->id = Database::escape($this->id);
    $sql = "DELETE FROM " . static::$table . " WHERE id = $this->id";
    if (!Database::query($sql))
      return false;
    return unlink($this->getImageActualPath());
  }

  public static function verifyUser($username, $password)
  {
    $user = Database::query("SELECT password FROM users WHERE username = '$username'");
    return $user['password'] === $password;
  }

  public function setFile($fileName)
  {
    if (!empty($_FILES[$fileName])) {
      if ($_FILES[$fileName]['error'] === UPLOAD_ERR_OK) {
        $this->image = $_FILES[$fileName]['name'];
        $this->tmpPath = $_FILES[$fileName]['tmp_name'];
        return true;
      } else {
        $this->customErrors[] = static::$uploadErrors[$_FILES[$fileName]['error']];
        return false;
      }
    } else {
      $this->customErrors[] = "No files found.";
      return false;
    }
  }

  public function save()
  {
    if (!empty($this->id)) {
      return $this->update();
    }
    $targetPath = $this->getImageActualPath();
    if (!$this->image || !$this->tmpPath) {
      $this->customErrors[] = "File data missing. Couldn't complete process.";
      return false;
    }
    if (file_exists($targetPath)) {
      $this->customErrors[] = "File already exists";
      return false;
    }
    if (!empty($this->customErrors)) {
      return false;
    }

    if (move_uploaded_file($this->tmpPath, $targetPath)) {
      unset($this->tmpPath);
      return $this->create();
    } else {
      $this->customErrors[] = "no permissions to store image";
      return false;
    }
  }
}
