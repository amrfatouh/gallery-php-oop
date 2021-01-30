<?php include("includes/init.php"); ?>

<?php
if (isset($_POST['choosePhoto'])) {
  $user = User::findById($_POST['userId']);
  if ($user->updateImage($_POST['photoId'])) {
    Session::addNotification("user photo is changed successfully");
  } else {
    Session::addNotification("error: user photo couldn't be changed");
  }
  echo $user->getImagePath();
}
?>

<?php
if (isset($_GET['getPhotoDetails'])) {
  $photo = Photo::findById($_GET['photoId']);
  echo json_encode($photo);
}
?>

<?php
if (isset($_POST['emptyNotifications'])) {
  Session::emptyNotifications();
}
?>