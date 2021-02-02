<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';
if (isset($_GET['email']) && isset($_GET['token'])) {
  $token = $_GET['token'];
  $changePasswordEmailBody = "<div> <h4>Click this link to change your password:</h4> <a href='http://localhost/gallery/forgot_pass_change_password.php?token={$token}'>Change password</a> <p style='color: #555'>if you didn't request to change your password, just ignore this message.</p> </div>";
  // Instantiation and passing `true` enables exceptions
  $mail = new PHPMailer(true);

  try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'phpmailer14@gmail.com';                     // SMTP username
    $mail->Password   = 'helloPHPMAILER12345';                               // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('amrfatouh@photogallery.com', 'Fatouh Co.');
    $mail->addAddress($_GET['email']);     // Add a recipient

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Change Password';
    $mail->Body = $changePasswordEmailBody;
    $mail->send();

    header("location: forgot_pass_email.php?success=true");
  } catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
  }
}
