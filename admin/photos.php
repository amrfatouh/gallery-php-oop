<?php include("includes/header.php"); ?>
<?php include("includes/navigation.php"); ?>


<div id="page-wrapper">

  <div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
      <div class="col-lg-12">
        <h1 class="page-header">Photos</h1>
      </div>

      <table class="table table-hover">
        <tr>
          <th>Id</th>
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
            <td><?php echo $photo->id ?></td>
            <td class="text-center">
              <img src="<?php echo $photo->getDisplayPath() ?>" alt="<?php echo $photo->title ?>" width="200" style="margin-bottom: 5px;" class="img-thumbnail">
              <div style="display: flex; justify-content: center;">
                <a href="../photo.php?id=<?php echo $photo->id ?>" class="btn btn-success" style="border-radius: 5px 0 0 5px;">View</a>
                <a href="edit_photo.php?id=<?php echo $photo->id ?>" class="btn btn-info" style="border-radius: 0;">Edit</a>
                <a href="delete_photo.php?id=<?php echo $photo->id ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete <?php echo $photo->title ?>?')" style="border-radius: 0 5px 5px 0;">Delete</a>
              </div>
            </td>
            <td><?php echo $photo->title ?></td>
            <td><?php echo strlen($photo->description) > 30 ? substr($photo->description, 0, 30) . "..." : $photo->description ?></td>
            <td><?php echo strlen($photo->filename) > 30 ? substr($photo->filename, 0, 30) . "..." : $photo->filename ?></td>
            <td><?php echo $photo->type ?></td>
            <td><?php echo $photo->size . " Bytes" ?></td>

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