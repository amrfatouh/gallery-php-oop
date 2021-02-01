<?php include("includes/header.php"); ?>

<?php
if (isset($_GET['id'])) {
  $user = User::findById($_GET['id']);
  if ($user->delete() && $user->deleteRelatedComments()) {
    Session::addNotification("user is deleted successfully");
  } else {
    Session::addNotification("error: couldn't delete user");
  }
  header("Location: users.php");
}
?>