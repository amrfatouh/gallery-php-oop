<?php include("includes/header.php"); ?>
<?php include("includes/navigation.php"); ?>


<div id="page-wrapper">

  <div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
      <div class="col-lg-12">
        <h1 class="page-header">Comments</h1>
      </div>
      <?php
      ?>
    </div>
    <!-- /.row -->

    <div class="row">
      <div class="col-lg-12">
        <table class="table table-hover">
          <tr>
            <th>Id</th>
            <th>Photo_id</th>
            <th>Author</th>
            <th>Body</th>
            <th>Date</th>
            <th>Delete</th>
          </tr>
          <?php
          if (isset($_GET['photo_id'])) {
            $comments = Comment::findByProperty("photo_id", $_GET['photo_id']);
          } else {
            $comments = Comment::findAllRows();
          }
          foreach ($comments as $comment) {
          ?>
            <tr>
              <td><?php echo $comment->id ?></td>
              <td><?php echo $comment->photo_id ?></td>
              <td><?php echo $comment->author ?></td>
              <td><?php echo $comment->body ?></td>
              <td><?php echo $comment->date ?></td>
              <td><a href="delete_comment.php?id=<?php echo $comment->id ?><?php echo isset($_GET['photo_id']) ? "&photo_id={$_GET['photo_id']}" : "" ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete <?php echo $comment->author ?>\'s comment?')">Delete</a></td>
            </tr>
          <?php
          }
          ?>
        </table>
      </div>
    </div>

  </div>
  <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->

<?php include("includes/footer.php"); ?>