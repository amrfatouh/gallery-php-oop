<?php ob_start(); ?>
<?php
session_start();
// $_SESSION['notifications'] = []; //initialize notifications array in session

?>
<?php
define("DS", DIRECTORY_SEPARATOR);
define("ROOT", "C:" . DS . "xampp" . DS . "htdocs" . DS . "gallery" . DS);
define("DISPLAY_ROOT", "http:" . DS . DS . "localhost" . DS . "gallery" . DS);

if (str_contains(getcwd(), "admin")) {
  include("includes/new_config.php");
  include("includes/database.php");
  include("includes/DbObject.php");
  include("includes/user.php");
  include("includes/Photo.php");
  include("includes/Comment.php");
  include("includes/session.php");
  include("includes/Paginate.php");
} else {
  include("admin/includes/new_config.php");
  include("admin/includes/database.php");
  include("admin/includes/DbObject.php");
  include("admin/includes/user.php");
  include("admin/includes/Photo.php");
  include("admin/includes/Comment.php");
  include("admin/includes/session.php");
  include("admin/includes/Paginate.php");
}
