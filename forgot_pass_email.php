<?php include("includes/header.php"); ?>

<?php
if (Session::isLoggedIn()) {
  header("Location: index.php");
}
?>

<?php
if (isset($_POST['submit'])) {
  $email = $_POST['email'];
  if (!($user = User::findByProperty("email", $email)[0])) {
    header("location: forgot_pass_email.php?error=email");
    exit;
  }
  $user->token = bin2hex(random_bytes(32));
  $user->save();
  // $_SESSION['change_password_user'] = $user;

  header("location: send_email.php?email=$email&token=$user->token");
}
?>

<div class="col-md-4 col-md-offset-3">

  <form id="login-id" action="" method="post">

    <div class="form-group">
      <input type="email" class="form-control" name="email" placeholder="person@example.com">
    </div>

    <div class="form-group text-center">
      <input type="submit" name="submit" value="Send Reset Email" class="btn btn-primary">
    </div>


  </form>


</div>

<?php include("includes/footer.php") ?>