<?php include("includes/header.php"); ?>
<?php include("includes/navigation.php"); ?>

<?php

if (isset($_POST['submit'])) {
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $first_name = $_POST['first_name'];
  $last_name = $_POST['last_name'];
  $role = $_POST['role'];


  $user = User::constructInstance(null, $username, $email, $password, $first_name, $last_name, $role);
  if ($user->save()) {
    Session::addNotification("user added successfully");
  } else {
    Session::addNotification("error: couldn't add user");
  }

  header("Location: users.php");
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
        <form action="" method="post">
          <div class="form-group">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" class="form-control">
          </div>
          <div class="form-group">
            <label for="email">E-mail</label>
            <input type="email" name="email" id="email" class="form-control">
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
            <label for="role">Role</label>
            <select class="form-control" name="role" id="role">
              <option value="normal">normal</option>
              <option value="admin">admin</option>
            </select>
          </div>
          <input type="submit" value="Submit" name='submit' class="btn btn-primary">
        </form>
      </div>

    </div>



    <!-- /.row -->
    <!-- /.container-fluid -->

  </div>
  <!-- /#page-wrapper -->

  <?php include("includes/footer.php"); ?>