<?php include("includes/header.php"); ?>

<?php
if (Session::isLoggedIn()) {
  header("Location: index.php");
}
?>

<?php
if (isset($_POST['submit'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];

  $username = Database::escape($username);
  $password = Database::escape($password);

  if (User::verifyUser($username, $password)) {
    Session::login(User::findByProperty("username", $username)[0]);
    header("Location: " . (Session::isAdmin() ? "admin/" : "") . "index.php"); //redirect to root index or admin index
  } else {
    header("Location: login.php?error=true");
  }
}
?>

<?php
if (isset($_GET['error'])) {
  echo "<script>alert('wrong username or password')</script>";
}
?>

<div class="col-md-4 col-md-offset-3">

  <form id="login-id" action="" method="post">

    <div class="form-group">
      <label for="username">Username</label>
      <input type="text" class="form-control" name="username" value="<?php if (isset($_POST['submit'])) echo $username; ?>">

    </div>

    <div class="form-group">
      <label for="password">Password</label>
      <input type="password" class="form-control" name="password" value="<?php if (isset($_POST['submit'])) echo $password; ?>">

    </div>
    <a href="forgot_pass_email.php" style="margin-bottom: 10px;display: inline-block;">forgot password?</a>


    <div class="form-group">
      <input type="submit" name="submit" value="Submit" class="btn btn-primary">

    </div>


  </form>


</div>

<?php include("includes/footer.php") ?>