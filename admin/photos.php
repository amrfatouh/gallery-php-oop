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
          <th>Comments</th>
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
            <td>
              <img src="<?php echo $photo->getDisplayPath() ?>" alt="<?php echo $photo->title ?>" width="200" style="margin-bottom: 5px;display: block;">
              <div style="display: flex; justify-content: space-evenly;">
                <a href="../photo.php?id=<?php echo $photo->id ?>" class="btn btn-success">View</a>
                <a href="edit_photo.php?id=<?php echo $photo->id ?>" class="btn btn-info">Edit</a>
                <a href="delete_photo.php?id=<?php echo $photo->id ?>" class="btn btn-danger">Delete</a>
              </div>
            </td>
            <td><?php echo $photo->title ?></td>
            <td><?php echo $photo->description ?></td>
            <td><?php echo $photo->filename ?></td>
            <td><?php echo $photo->type ?></td>
            <td><?php echo $photo->size ?></td>

            <?php
            $comments = $photo->getRelatedComments();
            $commentsCount = empty($comments) ? 0 : count($comments);
            ?>
            <td><a href="<?php echo $commentsCount ? "comments.php?photo_id=$photo->id" : "#" ?>" class="btn btn-info <?php echo !$commentsCount ? "disabled" : "" ?>"><?php echo $commentsCount ?></a></td>
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