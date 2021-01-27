<?php

class Database
{

  private static function checkQuery($queryResult)
  {
    global $conn;
    if (!$queryResult) {
      die("Query Failed! " . $conn->error);
    }
  }

  public static function query($sql)
  {
    global $conn;
    $result = $conn->query($sql);
    Database::checkQuery($result);
    if (stripos($sql, "select") !== false && $result->num_rows > 0) {
      return $result->fetch_all(MYSQLI_ASSOC);
    } else if (stripos($sql, "insert") !== false) {
      return $conn->insert_id;
    } else {
      return $conn->affected_rows;
    }
  }

  public static function escape($str)
  {
    global $conn;
    return $conn->real_escape_string($str);
  }

  public static function escapeObjProps($obj)
  {
    foreach (get_object_vars($obj) as $key => $value) {
      if (is_string($value)) {
        $obj->$key = Database::escape($value);
      }
    }
  }
}
