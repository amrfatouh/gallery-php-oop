<?php include("includes/header.php"); ?>

<?php
$photos = Photo::findAllRows();
?>

<div class="row">

  <!-- Blog Entries Column -->
  <div class="col-md-12">
    <?php
    foreach ($photos as $photo) {
    ?>
      <div class="col-lg-3 col-md-4 col-sm-6">
        <a href="photo.php?id=<?php echo $photo->id ?>">
          <img src="<?php echo $photo->getDisplayPath() ?>" alt="<?php echo $photo->title ?>" class="img-thumbnail" style="height: 150px; width: 200px; object-fit: cover;margin-bottom: 20px;">
        </a>
      </div>
    <?php
    }
    ?>
  </div>

  <!-- /.row -->

  <?php include("includes/footer.php"); ?>