<?php include("includes/header.php"); ?>

<?php
if (isset($_GET['id'])) {
  $comment = Comment::findById($_GET['id']);
  $comment->delete();
  header("Location: comments.php" . (isset($_GET['photo_id']) ? "?photo_id={$_GET['photo_id']}" : ""));
}
?>