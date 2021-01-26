<?php include("includes/header.php"); ?>

<?php
if (Session::isLoggedIn()) {
  header("Location: admin/index.php");
}
?>

<?php
if (isset($_POST['submit'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];

  $username = Database::escape($username);
  $password = Database::escape($password);

  if (User::verifyUser($username, $password)) {
    Session::login(User::findByProperty("username", $username));
    header("Location: admin/index.php");
  } else $errMessage = "wrong user name or password";
}
?>

<div class="col-md-4 col-md-offset-3">

  <?php if (isset($errMessage)) { ?>
    <div class="alert alert-danger" role="alert">
      <?php echo $errMessage;  ?>
    </div>
  <?php } ?>

  <form id="login-id" action="" method="post">

    <div class="form-group">
      <label for="username">Username</label>
      <input type="text" class="form-control" name="username" value="<?php if (isset($_POST['submit'])) echo $username; ?>">

    </div>

    <div class="form-group">
      <label for="password">Password</label>
      <input type="password" class="form-control" name="password" value="<?php if (isset($_POST['submit'])) echo $password; ?>">

    </div>


    <div class="form-group">
      <input type="submit" name="submit" value="Submit" class="btn btn-primary">

    </div>


  </form>


</div>