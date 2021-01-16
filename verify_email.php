<?php require_once ('controllers\authController.php'); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>167 Hypermart Email verification</title>
        <link rel="icon" type="image/png" href="images\167 Hypermart Logo 2b.png"/>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/css/mdb.min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
        <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
        <link rel="stylesheet" type="text/css" href="css/main.css">
    

    </head>
    <body> 
        <div class="limiter">
            <nav class="mb-1 navbar navbar-expand-lg navbar-dark primary-color">
                    <a class="navbar-brand" href="#"><img src="images/167 Hypermart Logo 2b.png" alt="" width="120px"></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-4"
                    aria-controls="navbarSupportedContent-4" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent-4">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="#" style = "color: black;">
                                    <span class="sr-only">(current)</span>
                                </a>
                                </li>
                            </li>
                        </ul>
                    </div>
                </nav>
            <div class="container-login100">
                <div class="container" style="margin-top: -200px;">
                    <div class="card">
                            <div class="card-header">
                                Account Verification
                            </div>
                            <div class="card-body">
                                <form method="POST" action="" >
                                    <div class="form-group">
                                    <?php 
                                        include("config.php");

                                        if(!isset($_GET["code"])) {
                                            exit("Can't find url request code expired!");
                                        }

                                        $code = $_GET["code"];
                                        $getEmailQuery = mysqli_query($con, "SELECT email FROM verify_email where code='$code'");
                                        if (mysqli_num_rows($getEmailQuery)==0){
                                            exit("<strong>System Notice!</strong><br><br><p class='alert alert-danger' role='alert'>Can't find request url, code expired! you have already virified your account Go back and <a href='login.php' class='btn btn-info'>Login</a></p>");
                                        }

                                        $db = mysqli_connect('localhost', 'root', '', 'divimart');
                                            $code = "";
                                            if (isset($_POST['submit'])) {
                                                $code = $_POST['code'];

                                                $sql_e = "SELECT * FROM verify_email WHERE code='$code'";
                                                $res_e = mysqli_query($db, $sql_e);

                                                if(mysqli_num_rows($res_e) > 0){
                                                    $email = $_POST["email"];

                                                    $query = mysqli_query($db, "UPDATE users SET verified='1' WHERE email='$_POST[email]'");
                                                        if($query) {
                                                            $query = mysqli_query($con, "DELETE FROM verify_email WHERE code='$code'");
                                                            echo '<script type = "text/javascript">alert("Your account has been verified, Go back and login your account")</script>';
                                                            echo'<div class="alert alert-success alert-dismissible fade show" role="alert">
                                                                <strong>Notice:!</strong> Account Verified successfully. <a href="login" class="btn btn-info">Login here</a>
                                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>';
                                                        }	
                                                }else{
                                                    echo'<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                    <strong>Notice!:</strong> Oops! something went wrong, Code not match.
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>';
                                                }
                                            }
                                    ?>
                                    

                                        <input type="email" name="email" id="email" style="display: none;" value="<?php echo $_SESSION['email']?>">
                                        <strong><label for="">Enter your OTP:</label></strong>
                                        <input type="text" name="code" class="form-control" required>
                                    </div>
                                    <button type="submit" name="submit" id="submit" class="btn btn-info" style="width: 100%">Verify</button>
                                </form>

                                <blockquote class="blockquote mb-0">
                                <footer class="blockquote-footer">© 2020 Copyright:<cite title="Source Title"> 167 Hypermart</cite></footer>
                                </blockquote>
                            </div>
                    </div>
                </div>
            </div>
        </div> 
        
    </body>
    
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/js/mdb.min.js"></script>
</html>