<?php include("includes/header.php"); ?>

<?php
if (isset($_GET['id'])) {
  $photo = Photo::findById($_GET['id']);
  if ($photo->delete() && $photo->handleRelatedUsers()) {
    Session::addNotification("photo is deleted successfully");
  } else {
    Session::addNotification("error: couldn't delete photo");
  }
  header("Location: photos.php");
}
?>