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
      return $result->num_rows === 1 ? $result->fetch_all(MYSQLI_ASSOC)[0] : $result->fetch_all(MYSQLI_ASSOC);
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
}
