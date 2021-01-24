<?php

const SERVER_NAME = "localhost";
const USER_NAME = "root";
const PASSWORD = "";
const DB_NAME = "gallery";

$conn = new mysqli(SERVER_NAME, USER_NAME, PASSWORD, DB_NAME);

if ($conn->connect_error) {
  die("Connection To Database Failed! " . $conn->connect_error);
}
