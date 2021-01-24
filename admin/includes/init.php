<?php ob_start() ?>
<?php
if (str_contains(getcwd(), "admin")) {
  include("includes/new_config.php");
  include("includes/database.php");
  include("includes/user.php");
} else {
  include("admin/includes/new_config.php");
  include("admin/includes/database.php");
  include("admin/includes/user.php");
}
