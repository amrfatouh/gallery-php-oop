<?php

class Database
{

  public static function checkQuery($queryResult)
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
    }
  }

  public static function escape($str)
  {
    global $conn;
    return $conn->real_escape_string($str);
  }
}
