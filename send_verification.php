<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Divimart | Send verification code</title>
  
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/main.css">

</head>
<body>
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
                    if (isset($_POST['send_code'])) {
                        $email = $_POST['email'];

                        $sql_e = "SELECT * FROM users WHERE email='$email'";
                        $res_e = mysqli_query($db, $sql_e);

                        if(mysqli_num_rows($res_e) > 0){
                            if(isset($_POST["email"])) {
                                $emailTo = $_POST["email"];
    
                                $code = uniqid(true);
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
                                    $mail->setFrom('jmarkrizalon@gmail.com', 'Divimart');
                                    $mail->addAddress("$emailTo");  
                                    $mail->addReplyTo('no-reply-jmarkrizalon@gmail.com', 'No Reply');
    
    
                                    // Content
                                    $url ="http://" . $_SERVER["HTTP_HOST"] . dirname($_SERVER["PHP_SELF"]) . "/code?code=$code";
                                    $mail->isHTML(true);                                  // Set email format to HTML
                                    $mail->Subject = 'ACCOUNT VERIFICATION';
                                    $mail->Body    = "<h1>ACCOUNT OTP VERIFICATION</h1><br>
                                                        <p><a href='$url'>Click the link below and enter your <h4>ONE TIME PASSWORD</h4> to activate you account</a></p>";
    
                                    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    
                                    $mail->send();
                                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>Notice!</strong> Reset password link has been sent to your <a href="https://mail.google.com/">Gmail</a> account click the link to login your account
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>';
                                } catch (Exception $e) {
                                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                                }
    
                                exit();
                                
                        }	
                        }else{
                            echo'<div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>System Notice:!</strong> You have entered email address, does not exist in our database.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>';
                        }
                    }

                        
?>
    <div class="limiter">
    <div class="container-login100">
    <div class="wrap-login100">
          <span class="login100-form-title p-b-10 p-t-10" style="margin-top: -30px;">
                verrify account
          </span><br>
          <form action="" method="post">
                    <!-- Display messages -->
        <?php if (isset($_SESSION['message'])): ?>
        <div class="alert <?php echo $_SESSION['alert-class'] ?>">
          <?php
            echo $_SESSION['message'];
            unset($_SESSION['message']);
            unset($_SESSION['alert-class']);
          ?>
        </div>
        <?php endif;?>

        <h4>Welcome, <?php echo $_SESSION['username']; ?></h4>
        <a href="index.php?logout=1" class="logout" style="color: red">Logout</a>

        <?php if (!$_SESSION['verified']): ?>
          <div class="alert alert-warning alert-dismissible fade show" role="alert">
            You need to verify your email address!  
            Sign into your email account and click
            on the verification link we just emailed you
            at
            <input type = "text" name= "email" id="email" style="border-style: none; background-color: transparent;" value="<?php echo $_SESSION['email']; ?>">
            <button type="submit" name="submit" class="btn btn-info" style="width: 100%">Send OTP</button><br>
          </div>
        <?php else: ?>
          <button class="btn btn-lg btn-primary btn-block">I'm verified!!!</button>
        <?php endif;?>
        </form> 
        </div>
    </div>
       
    </div>
              

</body>
</html>