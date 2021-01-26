<?php

class User
{
  static private $table = "users";
  static private $className = "User";
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

  public function create()
  {
    Database::escapeObjProps($this);
    $objKeys = array_keys(get_object_vars($this));
    array_shift($objKeys);
    $objValues = array_values(get_object_vars($this));
    array_shift($objValues);
    $sql = "INSERT INTO " . static::$table . " (" . implode(",", $objKeys) . ") ";
    $sql .= "VALUES ('" . implode("','", $objValues) . "')";
    $this->id = Database::query($sql);
    return true;
  }

  public function update()
  {
    Database::escapeObjProps($this);
    $sql = "UPDATE " . static::$table . " SET ";
    foreach (get_object_vars($this) as $key => $value) {
      if ($key !== "id") $sql .= "$key = '$value',";
    }
    //removing the last comma
    $sql = substr($sql, 0, -1);
    $sql .= " WHERE id = $this->id";
    return Database::query($sql);
  }

  public function save()
  {
    if (User::findById($this->id)) {
      return $this->update();
    } else {
      return $this->create();
    }
  }

  public function delete()
  {
    $this->id = Database::escape($this->id);
    $sql = "DELETE FROM " . static::$table . " WHERE id = $this->id";
    return Database::query($sql);
  }

  public static function findAllRows()
  {
    $objects = [];
    $rows = Database::query("SELECT * FROM " . static::$table);
    if (!empty($rows)) {
      foreach ($rows as $row) {
        $rowData = [];
        foreach ($row as $value) {
          $rowData[] = $value;
        }
        $objects[] = new User(...$rowData);
      }
    }
    return $objects;
  }

  public static function findById($id)
  {
    $id = Database::escape($id);
    $assocElement = Database::query("SELECT * FROM " . static::$table . " WHERE id = $id");
    $elementData = [];
    if (!empty($assocElement)) {
      foreach ($assocElement as $value) {
        $elementData[] = $value;
      }
      return new self(...$elementData);
    }
    return false;
  }
  public static function findByProperty($propertyName, $propertyValue)
  {
    if (property_exists(static::$className, $propertyName)) {
      $propertyValue = Database::escape($propertyValue);
      $assocElements = Database::query("SELECT * FROM " . static::$table . " WHERE $propertyName = '$propertyValue'");
      $elements = [];
      foreach ($assocElements as $assocElement) {
        $elementData = [];
        foreach ($assocElement as $value) {
          $elementData[] = $value;
        }
        $elements[] = new self(...$elementData);
      }
      return (count($elements) === 1) ? $elements[0] : $elements;
    }
  }

  public static function verifyUser($username, $password)
  {
    $user = Database::query("SELECT password FROM users WHERE username = '$username'");
    return $user['password'] === $password;
  }
}
