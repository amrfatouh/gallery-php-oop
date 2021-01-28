<?php

class DbObject
{
  static protected $table;
  static protected $className; //used when checking if the property belongs to the class in getByProperty() method
  static protected $integerProps = []; //used when querying integers to database

  public static function constructInstance()
  {
    return new static;
  }

  public function create()
  {
    Database::escapeObjProps($this);
    $queryELements = array_filter(get_object_vars($this), function ($v) {
      return !is_array($v);
    });
    array_shift($queryELements);
    $objKeys = array_keys($queryELements);
    $objValues = array_values($queryELements);
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
      //making conditions for photo objects array properties(for errors) and empty properties (e.g. tmp_path)
      if (!is_array($value) && !empty($value) && $key !== "id")
        $sql .= "$key = '$value',";
    }
    //removing the last comma
    $sql = substr($sql, 0, -1);
    $sql .= " WHERE id = $this->id";
    return Database::query($sql);
  }

  public function save()
  {
    if (static::findById($this->id)) {
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
        $objects[] = static::constructInstance(...$rowData);
      }
    }
    return $objects;
  }

  public static function findById($id)
  {
    $id = Database::escape($id);
    //query returns an array that contains only one associative array representing a db object
    $assocElements = Database::query("SELECT * FROM " . static::$table . " WHERE id = $id");
    $elementData = [];
    if (empty($assocElements)) return false;
    $assocElement = $assocElements[0];
    foreach ($assocElement as $value) {
      $elementData[] = $value;
    }
    return static::constructInstance(...$elementData);
  }

  public static function findByProperty($propertyName, $propertyValue)
  {
    if (property_exists(static::$className, $propertyName)) {
      $propertyValue = Database::escape($propertyValue);
      $propertyValue = (in_array($propertyName, static::$integerProps)) ? $propertyValue : "'" . $propertyValue . "'";
      $assocElements = Database::query("SELECT * FROM " . static::$table . " WHERE $propertyName = $propertyValue");
      $elements = [];
      if (!$assocElements) return false;
      foreach ($assocElements as $assocElement) {
        $elementData = [];
        foreach ($assocElement as $value) {
          $elementData[] = $value;
        }
        // return static::constructInstance(...$elementData);
        $elements[] = static::constructInstance(...$elementData);
      }
      return (count($elements) === 1) ? $elements[0] : $elements;
    }
  }

  public static function totalCount()
  {
    $countArray = Database::query("SELECT COUNT(id) FROM " . static::$table);
    //the count value is a value inside an assoc array which is itself the first element of an indexed array
    $countArray = array_shift($countArray);
    return array_shift($countArray);
  }
}
