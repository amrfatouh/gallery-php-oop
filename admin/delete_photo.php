<?php include("includes/header.php"); ?>

<?php
if (isset($_GET['id'])) {
  $photo = Photo::findById($_GET['id']);
  $photo->delete();
  header("Location: photos.php");
}
?>