<?php include("includes/header.php"); ?>
<?php include("includes/navigation.php"); ?>


<div id="page-wrapper">

  <div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
      <div class="col-lg-12">
        <h1 class="page-header">Dashboard</h1>
      </div>

      <div class="col-lg-12">
        <a href="add_user.php" class="btn btn-primary"><i class="fa fa-fw fa-plus"></i> Add User</a>
        <br>
        <br>

        <table class="table table-hover">
          <tr>
            <th>User Image</th>
            <th>Username</th>
            <th>First Name</th>
            <th>Last Name</th>
          </tr>

          <?php
          $users = User::findAllRows();
          foreach ($users as $user) {
          ?>
            <tr>
              <td>
                <img src="<?php echo $user->getImagePath() ?>" alt="<?php echo $user->title ?>" width="100" style="margin: auto;display: block;" class="img-thumbnail">
                <hr>
                <div style="display: flex; justify-content: space-evenly;">
                  <a href="edit_user.php?id=<?php echo $user->id ?>" class="btn btn-info">Edit</a>
                  <a href="delete_user.php?id=<?php echo $user->id ?>" class="btn btn-danger">Delete</a>
                </div>
                <br>
              </td>
              <td><?php echo $user->username ?></td>
              <td><?php echo $user->first_name ?></td>
              <td><?php echo $user->last_name ?></td>
            </tr>
          <?php
          }
          ?>

        </table>
      </div>
    </div>

    <?php
    ?>

    <!-- /.row -->
    <!-- /.container-fluid -->

  </div>
  <!-- /#page-wrapper -->

  <?php include("includes/footer.php"); ?>