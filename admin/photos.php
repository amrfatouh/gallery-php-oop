<?php include("includes/header.php"); ?>
<?php include("includes/navigation.php"); ?>


<div id="page-wrapper">

  <div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
      <div class="col-lg-12">
        <h1 class="page-header">Dashboard</h1>
      </div>

      <table class="table table-hover">
        <tr>
          <th>Photo</th>
          <th>Title</th>
          <th>Description</th>
          <th>File Name</th>
          <th>Type</th>
          <th>Size</th>
        </tr>

        <?php
        $photo = Photo::findById(5);
        if ($photo) {
          print_r($photo->getDisplayPath());
        }
        $photos = Photo::findAllRows();
        foreach ($photos as $photo) {
        ?>
          <tr>
            <td><img src="<?php echo $photo->getDisplayPath() ?>" alt="<?php echo $photo->title ?>" width="200"></td>
            <td><?php echo $photo->title ?></td>
            <td><?php echo $photo->description ?></td>
            <td><?php echo $photo->filename ?></td>
            <td><?php echo $photo->type ?></td>
            <td><?php echo $photo->size ?></td>
          </tr>
        <?php
        }
        ?>

      </table>
    </div>

    <?php
    ?>

    <!-- /.row -->
    <!-- /.container-fluid -->

  </div>
  <!-- /#page-wrapper -->

  <?php include("includes/footer.php"); ?>