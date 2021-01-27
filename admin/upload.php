<?php include("includes/header.php"); ?>
<?php include("includes/navigation.php"); ?>

<?php

if (isset($_POST['submit'])) {
  $photo = new Photo;
  $photo->title = $_POST['title'];
  $photo->description = $_POST['description'];
  $photo->setFile("uploaded_image");
  if ($photo->save()) {
    $message = "Photo uploaded successfully!";
  } else {
    $message = implode("<br>", $photo->customErrors);
  }
}

?>

<div id="page-wrapper">

  <div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
      <div class="col-lg-12">
        <h1 class="page-header">Upload</h1>

        <div class="row">
          <div class="col-xs-6">
            <p><?php echo isset($_POST['submit']) ? $message : null ?></p>
            <form action="" method="post" enctype="multipart/form-data">
              <div class="form-group">
                <label for="title">Photo Title</label>
                <input type="text" name="title" id="title" class="form-control">
              </div>
              <div class="form-group">
                <label for="description">Photo Description</label>
                <textarea name="description" id="description" rows="6" class="form-control"></textarea>
              </div>
              <div class="form-group">
                <input type="file" name="uploaded_image">
              </div>
              <input type="submit" value="Upload" name='submit' class="btn btn-primary">
            </form>
          </div>
        </div>

      </div>
    </div>
    <!-- /.row -->

  </div>
  <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->

<?php include("includes/footer.php"); ?>