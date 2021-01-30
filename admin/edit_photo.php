<?php include("includes/header.php"); ?>
<?php include("includes/navigation.php"); ?>

<?php
if (isset($_GET['id'])) {
  $photo = Photo::findById($_GET['id']);
}
?>

<?php
if (isset($_POST['update'])) {
  $photo->title = $_POST['title'];
  $photo->description = $_POST['description'];
  if ($photo->save()) {
    Session::addNotification("photo is updated successfully");
  } else {
    Session::addNotification("error: couldn't update photo");
  }
  header("Location: edit_photo.php?id={$_GET['id']}");
}
?>

<div id="page-wrapper">

  <div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
      <div class="col-lg-12">
        <h1 class="page-header">Edit Photo</h1>

        <div class="row">
          <form action="" method="post" enctype="multipart/form-data">
            <div class="col-md-8">
              <div class="form-group">
                <label for="title">Photo Title</label>
                <input value="<?php echo $photo->title ?>" type="text" name="title" id="title" class="form-control">
              </div>
              <div class="form-group">
                <label for="richtextarea">Photo Description</label>
                <textarea name="description" id="richtextarea" rows="6" class="form-control"><?php echo $photo->description ?></textarea>
              </div>
              <img src="<?php echo $photo->getDisplayPath() ?>" alt="<?php echo $photo->title ?>" width="400" class="img-thumbnail" style="margin: auto; display: block;">
            </div>

            <div class="col-md-4">
              <div class="photo-info-box">
                <div class="info-box-header">
                  <h4>Save <span id="toggle" class="glyphicon glyphicon-menu-up pull-right"></span></h4>
                </div>
                <div class="inside">
                  <div class="box-inner">
                    <p class="text">
                      <span class="glyphicon glyphicon-calendar"></span> Uploaded on: April 22, 2030 @ 5:26
                    </p>
                    <p class="text ">
                      Photo Id: <span class="data photo_id_box">34</span>
                    </p>
                    <p class="text">
                      Filename: <span class="data">image.jpg</span>
                    </p>
                    <p class="text">
                      File Type: <span class="data">JPG</span>
                    </p>
                    <p class="text">
                      File Size: <span class="data">3245345</span>
                    </p>
                  </div>
                  <div class="info-box-footer clearfix">
                    <div class="info-box-delete pull-left">
                      <a href="delete_photo.php?id=<?php echo $photo->id; ?>" class="btn btn-danger btn-lg ">Delete</a>
                    </div>
                    <div class="info-box-update pull-right ">
                      <input type="submit" name="update" value="Update" class="btn btn-primary btn-lg ">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </form>

        </div>

      </div>
    </div>
    <!-- /.row -->

  </div>
  <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->

<?php include("includes/footer.php"); ?>