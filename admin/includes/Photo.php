<?php
class Photo extends DbObject
{
  static protected $table = "photos";
  static protected $className = "Photo";
  static protected $integerProps = ["id"];
  public $id;
  public $title;
  public $description;
  public $filename;
  public $type;
  public $size;
  public $tmpPath;

  static public $uploadDirectory = "admin" . DS . "images" . DS;

  public $customErrors = [];
  public $uploadErrors = array(
    0 => 'There is no error, the file uploaded with success',
    1 => 'The uploaded file exceeds the upload_max_filesize directive in php.ini',
    2 => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form',
    3 => 'The uploaded file was only partially uploaded',
    4 => 'No file was uploaded',
    6 => 'Missing a temporary folder',
    7 => 'Failed to write file to disk.',
    8 => 'A PHP extension stopped the file upload.',
  );

  public static function constructInstance($id = null, $title = null, $description = null, $filename = null, $type = null, $size = null)
  {
    $photo = new Photo;
    $photo->id = $id;
    $photo->title = $title;
    $photo->description = $description;
    $photo->filename = $filename;
    $photo->type = $type;
    $photo->size = $size;
    return $photo;
  }

  public function getDisplayPath()
  {
    return DISPLAY_ROOT . static::$uploadDirectory . $this->filename;
  }
  public function getPath()
  {
    return ROOT . static::$uploadDirectory . $this->filename;
  }

  public function setFile($fileName)
  {
    if (!empty($_FILES[$fileName])) {
      if ($_FILES[$fileName]['error'] === UPLOAD_ERR_OK) {
        $this->filename = $_FILES[$fileName]['name'];
        $this->tmpPath = $_FILES[$fileName]['tmp_name'];
        $this->type = $_FILES[$fileName]['type'];
        $this->size = $_FILES[$fileName]['size'];
        return true;
      } else {
        $this->customErrors[] = $this->uploadErrors[$_FILES[$fileName]['error']];
        return false;
      }
    } else {
      $this->customErrors[] = "No files found.";
      return false;
    }
  }

  public function save()
  {
    $targetPath = ROOT . static::$uploadDirectory . $this->filename;
    if (!$this->filename || !$this->tmpPath) {
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

  public function delete()
  {
    $this->id = Database::escape($this->id);
    $sql = "DELETE FROM " . static::$table . " WHERE id = $this->id";
    if (!Database::query($sql))
      return false;
    return unlink($this->getPath());
  }
}
