<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
 require 'config.php';
                    
    $db = mysqli_connect('localhost', 'root', '', 'divimart');
    $email = "";
    $code = "";
    if (isset($_POST['btn-submit'])) {
      $email = $_POST['email'];
      $sql_e = "SELECT * FROM users WHERE email='$email'";
      $res_e = mysqli_query($db, $sql_e);
    if(mysqli_num_rows($res_e) > 0){
      if(isset($_POST["email"])) {
        $emailTo = $_POST["email"];
    
        $code = mt_rand(100000,999999);
        $query = mysqli_query($con, "INSERT INTO verify_email(code, email)VALUES('$code','$emailTo')");
        if(!$query){
          exit("Coudn't generate OTP try again later!");
        }
        $mail = new PHPMailer(true);
    try {
      $mail->isSMTP();                                            // Send using SMTP
      $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
      $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
      $mail->Username   = 'jmarkrizalon@gmail.com';                     // SMTP username
      $mail->Password   = '@johnlol123';                               // SMTP password
      $mail->SMTPSecure =  'TLS';          // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
      $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
                                        //Recipients
      $mail->setFrom('hypermart167covid19@gmail.com', '167 Hypermart');
      $mail->addAddress("$emailTo");  
      $mail->addReplyTo('no-reply-hypermart167covid19@gmail.com', 'No Reply');
      // Content
      $url ="http://" . $_SERVER["HTTP_HOST"] . dirname($_SERVER["PHP_SELF"]) . "/verify_email.php?code=$code";
      $mail->isHTML(true);                                  // Set email format to HTML
      $mail->Subject = 'ACCOUNT VERIFICATION';
      $mail->Body    = "<h1>ACCOUNT VERIFICATION</h1>
        <p>Copy your verification One Time Password and click the link below and paste your OTP to verify your account</p>
        <h2>$code</h2>
        <p><a href='$url'>Click here to verify your account</a></p>";
    
      $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
      $mail->send();
        echo '<script type = "text/javascript">alert("Verification code has been sent to your email, Copy the code and verify your account.")</script>';
        //header('Location: index.php');
        exit();

    }catch (Exception $e) {
      echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
    exit();
    }	
    }else{
      echo'<div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>System Notice:!</strong> You have currently used an email does not exist in our database.
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
      </button>
      </div>';
    }
  }
?>