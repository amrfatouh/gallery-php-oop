<?php include("includes/header.php"); ?>

<?php
if (Session::isLoggedIn()) {
  header("Location: index.php");
  exit(0);
}
?>

<?php
if (isset($_POST['submit'])) {
  $error = [];
  $username = $_POST['username'];
  $password = $_POST['password'];
  $first_name = $_POST['first_name'];
  $last_name = $_POST['last_name'];

  if (!empty(User::findByProperty("username", $username))) {
    header("location: signup.php?error=name");
    exit;
  }

  $user = User::constructInstance(null, $username, $password, $first_name, $last_name, "normal", null);
  if ($user->save()) {
    header("location: index.php");
    exit(0);
  } else {
    header("location: signup.php?error=user");
    exit;
  }
}
?>

<?php
if (isset($_GET['error'])) {
  $error = $_GET['error'];
  switch ($error) {
    case "name":
      $errMsg = "Username already exists. Please try another one";
      break;
    case "user":
      $errMsg = "Problem ocurred. Couldn't create user";
      break;
  }
  echo "<script>alert(`$errMsg`)</script>";
}
?>

<div class="col-md-4 col-md-offset-3">

  <form id="login-id" action="" method="post">

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
      <input type="submit" name="submit" value="Submit" class="btn btn-primary">

    </div>


  </form>


</div>
<?php include("includes/footer.php") ?>