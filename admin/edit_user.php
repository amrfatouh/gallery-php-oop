<?php include("includes/header.php"); ?>
<?php include("includes/navigation.php"); ?>
<?php include("includes/photo_modal.php") ?>

<?php

if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $user = User::findById($id);
  if (isset($_POST['submit'])) {
    $user->username = $_POST['username'];
    $user->email = $_POST['email'];
    $user->password = $_POST['password'];
    $user->first_name = $_POST['first_name'];
    $user->last_name = $_POST['last_name'];
    $user->role = $_POST['role'];
    if ($user->save()) {
      Session::addNotification("user is updated successfully");
    } else {
      Session::addNotification("error: couldn't update user");
    }
    header("Location: users.php");
  }
}



?>

<div id="page-wrapper">

  <div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
      <div class="col-lg-12">
        <h1 class="page-header">Edit User</h1>
      </div>

      <div class="row">
        <div class="col-lg-6">
          <img id="edit_user_photo" data-toggle="modal" data-target="#photoModal" class="img-responsive" src="<?php echo $user->getImagePath() ?>" alt="<?php echo $user->username ?>" style="margin: auto; cursor: pointer;">
        </div>
        <div class="col-lg-6">
          <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
              <label for="username">Username</label>
              <input value="<?php echo $user->username ?>" type="text" name="username" id="username" class="form-control">
            </div>
            <div class="form-group">
              <label for="email">E-mail</label>
              <input value="<?php echo $user->email ?>" type="email" name="email" id="email" class="form-control">
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input required type="password" name="password" id="password" class="form-control">
            </div>
            <div class="form-group">
              <label for="first_name">First Name</label>
              <input value="<?php echo $user->first_name ?>" type="text" name="first_name" id="first_name" class="form-control">
            </div>
            <div class="form-group">
              <label for="last_name">Last Name</label>
              <input value="<?php echo $user->last_name ?>" type="text" name="last_name" id="last_name" class="form-control">
            </div>
            <div class="form-group">
              <label for="role">Role</label>
              <select class="form-control" name="role" id="role">
                <option value="normal">normal</option>
                <option value="admin" <?php if ($user->role === "admin") echo "selected" ?>>admin</option>
              </select>
            </div>
            <input type="submit" value="Submit" name='submit' class="btn btn-primary">
          </form>
        </div>
      </div>

    </div>

    <?php
    ?>

    <!-- /.row -->
    <!-- /.container-fluid -->

  </div>
  <!-- /#page-wrapper -->

  <?php include("includes/footer.php"); ?>