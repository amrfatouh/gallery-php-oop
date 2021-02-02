<?php include("includes/header.php"); ?>

<?php
if (Session::isLoggedIn()) {
  header("Location: index.php");
}
?>

<?php
if (!isset($_GET['token'])) {
  header("location: index.php");
  exit;
}
if (!($user = User::findByProperty("token", $_GET['token'])[0])) {
  header("location: index.php");
  exit;
}
?>

<?php
if (isset($_POST['submit'])) {
  $password = $_POST['password'];
  $user->password = $password;
  $user->save();
  header("location: index.php");
}
?>

<div class="col-md-4 col-md-offset-3">
  <form id="login-id" action="" method="post">
    <div class="form-group">
      <label for="password">New Password</label>
      <input type="password" class="form-control" name="password">
    </div>
    <div class="form-group">
      <input type="submit" name="submit" value="Submit" class="btn btn-primary">
    </div>
  </form>
</div>

<?php include("includes/footer.php") ?>