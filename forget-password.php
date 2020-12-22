<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie-edge">
<title>Change Password</title>
<link rel="stylesheet" href="css/loader.css" type="text/css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

</head>
<body onload="myFunction()">
<script>
 $(document).ready(function(){
    $('#myModal').modal({
        visible: 'true',
        backdrop: 'static',
        keyboard: false
      });
  });
</script>
<div id="myModal" class="modal fade">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content"> 
            <div class="modal-header">
            
                <h5 class="modal-title">Change Password</h5>
                <a href="login" class="close" data-dismiss="modal">&times;</a>
            </div>
            <div class="modal-body">
                    <?php
                        // Import PHPMailer classes into the global namespace
                        // These must be at the top of your script, not inside a function
                        use PHPMailer\PHPMailer\PHPMailer;
                        use PHPMailer\PHPMailer\Exception;

                        require 'PHPMailer/src/Exception.php';
                        require 'PHPMailer/src/PHPMailer.php';
                        require 'PHPMailer/src/SMTP.php';
                        require 'config.php';
                        
                        $db = mysqli_connect('localhost', 'root', '', 'divimart');
                        $email = "";
                        if (isset($_POST['submit'])) {
                            $email = $_POST['email'];

                            $sql_e = "SELECT * FROM users WHERE email='$email'";
                            $res_e = mysqli_query($db, $sql_e);

                            if(mysqli_num_rows($res_e) > 0){
                                if(isset($_POST["email"])) {
                                    $emailTo = $_POST["email"];
        
                                    $code = uniqid(true);
                                    $query = mysqli_query($con, "INSERT INTO password_reset(code, email)VALUES('$code','$emailTo')");
                                    if(!$query){
                                        exit("Coudn't generate a code!");
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
                                        $url ="http://" . $_SERVER["HTTP_HOST"] . dirname($_SERVER["PHP_SELF"]) . "/reset-password.php?code=$code";
                                        $mail->isHTML(true);                                  // Set email format to HTML
                                        $mail->Subject = 'CHANGE PASSWORD';
                                        $mail->Body    = "<h1>Reset password link has been created</h1><br>
                                                            <p><a href='$url'>Click the link to reset your password</a></p>";
        
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
                <form method="POST" action="" >
                    <div class="form-group">
                    <p style="font-size: 12px;">Forgot your password, don't worry enter your registered email address below and we will send you a link to reset your password!</p>
                        <strong><label for="">Enter email address:</label></strong>
                        <input type="email" name="email" class="form-control" placeholder="Email" autocomplete="off" required>
                    </div>

                   
                    <button name="submit" id="submit" class="btn btn-info" style="width: 100%">Send code</button>
                </form>
                <br>
                <div class="footer">
                <a href="login">Go Back</a>
                </div>
            </div>
            
            
        </div>
    </div>
</div>
        <div id="loader-wrapper">
			<div id="loader"></div>
		</div>
<script>
    var myvar;
    function myFunction(){
        myvar = setTimeout(showPage, 3000)
    }
</script>
</body>
</html>