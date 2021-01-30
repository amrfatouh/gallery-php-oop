<?php include("includes/header.php"); ?>

<?php
if (isset($_GET['id'])) {
  $comment = Comment::findById($_GET['id']);
  if ($comment->delete()) {
    Session::addNotification("comment is deleted successfully");
  } else {
    Session::addNotification("error: couldn't delete comment");
  }
  header("Location: comments.php" . (isset($_GET['photo_id']) ? "?photo_id={$_GET['photo_id']}" : ""));
}
?>