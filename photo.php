<?php include("includes/header.php"); ?>

<?php
if (isset($_GET['id'])) {
  $photo = Photo::findById($_GET['id']);
}
?>

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
      <form role="form">
        <div class="form-group">
          <textarea class="form-control" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>

    <hr>

    <!-- Posted Comments -->

    <!-- Comment -->
    <div class="media">
      <a class="pull-left" href="#">
        <img class="media-object" src="http://placehold.it/64x64" alt="">
      </a>
      <div class="media-body">
        <h4 class="media-heading">Start Bootstrap
          <small>August 25, 2014 at 9:30 PM</small>
        </h4>
        Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
      </div>
    </div>


  </div>

</div>
<!-- /.row -->

<hr>
<?php include("includes/footer.php"); ?>