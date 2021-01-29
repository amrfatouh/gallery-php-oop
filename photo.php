<?php include("includes/header.php"); ?>

<?php if (empty($_GET['id'])) header("Location: index.php"); ?>

<?php
if (isset($_POST['submit'])) {
  $comment = Comment::constructInstance(null, (int)$_GET['id'], $_POST['author'], $_POST['body'], null);
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
          <label for="author">Author</label>
          <input type="text" name="author" id="author" class="form-control">
        </div>
        <div class="form-group">
          <label for="body">Comment</label>
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
    ?>
        <div class="media">
          <a class="pull-left" href="#">
            <img class="media-object" src="http://placehold.it/64x64" alt="">
          </a>
          <div class="media-body">
            <h4 class="media-heading"><?php echo $comment->author ?>
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