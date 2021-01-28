<?php include("includes/header.php"); ?>

<?php
if (isset($_GET['id'])) {
  $user = User::findById($_GET['id']);
  $user->delete();
  header("Location: users.php");
}
?>