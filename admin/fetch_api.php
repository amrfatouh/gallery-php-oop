<?php include("includes/init.php"); ?>

<?php
if (isset($_POST['choosePhoto'])) {
  $user = User::findById($_POST['userId']);
  $user->updateImage($_POST['photoId']);
  echo $user->getImagePath();
}
?>

<?php
if (isset($_GET['getPhotoDetails'])) {
  $photo = Photo::findById($_GET['photoId']);
  echo json_encode($photo);
}
?>