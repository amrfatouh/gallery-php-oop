<?php ob_start(); ?>
<?php session_start(); ?>
<?php
if (str_contains(getcwd(), "admin")) {
  include("includes/new_config.php");
  include("includes/database.php");
  include("includes/user.php");
  include("includes/session.php");
} else {
  include("admin/includes/new_config.php");
  include("admin/includes/database.php");
  include("admin/includes/user.php");
  include("admin/includes/session.php");
}
