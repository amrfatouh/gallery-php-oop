<?php include("includes/header.php"); ?>

<?php if (empty($_GET['id'])) header("Location: index.php"); ?>

<?php
if (isset($_POST['submit'])) {
  if (!Session::isLoggedIn()) {
    header("location: login.php");
    exit(0);
  }
  $comment = Comment::constructInstance(null, (int)$_GET['id'], $_SESSION['user_id'], $_POST['body'], null);
  $comment->create();
}
?>

<?php $photo = Photo::findById($_GET['id']) ?>

<div class="row">

  <!-- Blog Post Content Column -->
  <div class="col-lg-10 col-lg-offset-1">

    <h1><?php echo $photo->title ?></h1>
    <hr>
    <img class="img-responsive" src="<?php echo $photo->getDisplayPath() ?>" alt="<?php echo $photo->title ?>">
    <hr>
    <p><?php echo $photo->description ?></p>
    <hr>

    <!-- Blog Comments -->
    <!-- Comments Form -->
    <div class="well">
      <h4>Leave a Comment:</h4>
      <form action="" method="post">
        <div class="form-group">
          <textarea name="body" id="body" class="form-control" rows="4"></textarea>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>

    <hr>

    <!-- Posted Comments -->

    <?php
    $comments = $photo->getRelatedComments();
    if (!empty($comments)) {
      foreach ($comments as $comment) {
        $user = $comment->getUser();
    ?>
        <div class="media">
          <a class="pull-left" href="#">
            <img class="media-object" src="<?php echo $user->getImagePath() ?>" alt="<?php echo $user->username ?>" style="width: 60px;height: 60px;object-fit: cover;">
          </a>
          <div class="media-body">
            <h4 class="media-heading"><?php echo $user->first_name . $user->last_name ?>
              <small><?php echo $comment->date ?></small>
            </h4>
            <?php echo $comment->body ?>
          </div>
        </div>
    <?php
      }
    }
    ?>


  </div>

</div>
<!-- /.row -->

<hr>
<?php include("includes/footer.php"); ?>