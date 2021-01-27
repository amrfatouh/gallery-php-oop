<?php ob_start(); ?>
<?php session_start(); ?>
<?php
define("DS", DIRECTORY_SEPARATOR);
define("ROOT", "C:" . DS . "xampp" . DS . "htdocs" . DS . "gallery" . DS);

if (str_contains(getcwd(), "admin")) {
  include("includes/new_config.php");
  include("includes/database.php");
  include("includes/DbObject.php");
  include("includes/user.php");
  include("includes/Photo.php");
  include("includes/session.php");
} else {
  include("admin/includes/new_config.php");
  include("admin/includes/database.php");
  include("admin/includes/DbObject.php");
  include("admin/includes/user.php");
  include("admin/includes/Photo.php");
  include("admin/includes/session.php");
}
