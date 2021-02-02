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

<?php
if (isset($_GET['success'])) {
  echo "<script>alert('Mail sent! Please check your inbox.');</script>";
}
?>

<?php
if (isset($_GET['error'])) {
  echo "<script>alert('error: no one registered with such e-mail');</script>";
}
?>

<div class="col-md-4 col-md-offset-3">
  <h3>Password Reset</h3>
  <p style="font-size: 16px;">Enter the e-mail you signed up with</p>

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