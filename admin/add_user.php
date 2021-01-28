<?php include("includes/header.php"); ?>
<?php include("includes/navigation.php"); ?>

<?php

if (isset($_POST['submit'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];
  $first_name = $_POST['first_name'];
  $last_name = $_POST['last_name'];


  $user = User::constructInstance(null, $username, $password, $first_name, $last_name);
  $user->setFile("user_image");
  if ($user->save()) {
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
        <h1 class="page-header">Add User</h1>
      </div>

      <div class="col-lg-6">
        <p><?php if (isset($_POST['submit'])) echo $message ?></p>
        <form action="" method="post" enctype="multipart/form-data">
          <div class="form-group">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" class="form-control">
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="form-control">
          </div>
          <div class="form-group">
            <label for="first_name">First Name</label>
            <input type="text" name="first_name" id="first_name" class="form-control">
          </div>
          <div class="form-group">
            <label for="last_name">Last Name</label>
            <input type="text" name="last_name" id="last_name" class="form-control">
          </div>

          <div class="form-group">
            <input type="file" name="user_image">
          </div>

          <input type="submit" value="Submit" name='submit' class="btn btn-primary">
        </form>
      </div>

    </div>

    <?php
    ?>

    <!-- /.row -->
    <!-- /.container-fluid -->

  </div>
  <!-- /#page-wrapper -->

  <?php include("includes/footer.php"); ?>