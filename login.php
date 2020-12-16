<?php 
require_once 'controllers/authController.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.min.css" />
    <link rel="icon" type="image/png" href="images\167 Hypermart Logo 2b.png"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
    <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
    <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
    <link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
    <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
    <link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/css/mdb.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/util.css">
    <link rel="stylesheet" type="text/css" href="css/fontawesome.css">
    <link rel="stylesheet" type="text/css" href="css/fontawesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/loader.css">
    <link rel="stylesheet" type="text/css" href="css/masin3.css">

  <title>167 Hypermart / Login</title>
  <script lang="javascript" type="text/javascript">
        window.history.forward();
    </script>
    
</head>
<body onload="myFunction()">
  <div class="limiter animated fadeIn" id="myDiv" style="display:none;">
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
          <br>
          <br>
            <div class="row">
            <div class="col-sm-12">
              <div class="container my-4 py-4 z-depth-1">
                <section class="px-md-5 mx-md-5 text-center text-lg-left dark-grey-text">
                  <div class="row d-flex justify-content-center">
                  <div class="col-md-6 text-center animated fadeInLeft">
                    <img src="images\ATTENDANCE QR2.png" alt="" style="width: 90%;">
                    <p class="text-muted"><i>Add place visited without logging in, SCAN HERE</i> <i class="fas fa-question-circle" style="color: blue; padding-left: 10px;" title="You can use your social media app to scan QR like Dingtalk, Wechat etc.,"></i></p>
                    <hr>
                  </div>
                    <div class="col-md-6 animated fadeInUp"><br>
                        <p class="h4 mb-4 text-center animated bounce infinite slow" style="text-transform: uppercase">Sign in</p>

                        <?php if (count($errors) > 0): ?>
                          <div class="alert alert-danger">
                            <?php foreach ($errors as $error): ?>
                            <li>
                              <?php echo $error; ?>
                            </li>
                            <?php endforeach;?>
                          </div>
                        <?php endif;?>
                      <form class="text-center animated fadeIn" action="" method="POST">

                        <input type="text" name="email" id="defaultLoginFormEmail" class="form-control mb-4" placeholder="E-mail or Username">
                        <input type="password" name="password" id="defaultLoginFormPassword" class="form-control mb-4" placeholder="Password">

                        <div class="d-flex justify-content-around">
                          <div>
                            <div class="custom-control custom-checkbox">
                              <input type="checkbox" class="custom-control-input" id="defaultLoginFormRemember">
                              <label class="custom-control-label" for="defaultLoginFormRemember">Remember me</label>
                            </div>
                          </div>
                          <div><i class="fas fa-lock"></i> Forgot
                            <a href="forget-password.php"> password?</a>
                          </div>
                        </div>
                        <button class="btn btn-info btn-block my-4" type="submit" name="login-btn" id="login"><i class="fas fa-sign-in-alt"></i> Sign in</button>
                        <p>Not a member?
                          <a href="signup.php">Register</a>
                        </p>
                        <p>or sign in with:</p>

                            <a href="#" class="mx-1" role="button"><i class="fab fa-facebook-f animated bounceInRight delay-1s slow"></i></a>
                            <a href="#" class="mx-1" role="button"><i class="fab fa-twitter animated bounceInRight delay-2s slow"></i></a>
                            <a href="#" class="mx-1" role="button"><i class="fab fa-linkedin-in animated bounceInRight delay-3s slow"></i></a>
                            <a href="#" class="mx-1" role="button"><i class="fab fa-google animated bounceInRight delay-4s slow"></i></a>

                      </form>
                      <hr>
                    </div>
                  </div>
                </section>
              </div>
            </div>
            </div>
            <br><br>
            <div class="card-footer text-muted" style="font-size: 13px; width: 100%;">
                © 2020 Copyright: 167 Hypermart
            </div>
    </div>

    <div id="loader-wrapper">
			<div id="loader"></div>
		</div>

      <script>
      var myVar;

      function myFunction() {
        myVar = setTimeout(showPage, 3000);
      }

      function showPage() {
        document.getElementById("loader").style.display = "none";
        document.getElementById("myDiv").style.display = "block";
      }
      </script>
        <style>
        .container-login100-form-btn a{
          width: 100%;
          font-size: 14px; 
        }

        .footer{
          width: 100%;
          background-color: rgb(230, 230, 230);
          padding: 15px;
        }
        
        </style>
  
</body>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="vendor/animsition/js/animsition.min.js"></script>
  <script src="vendor/select2/select2.min.js"></script>
  <script src="vendor/daterangepicker/moment.min.js"></script>
  <script src="vendor/daterangepicker/daterangepicker.js"></script>
  <script src="vendor/countdowntime/countdowntime.js"></script>
  <script src="js/main.js"></script>
  <script src="js/fontawesome.js"></script>
  <script src="js/fontawesome.min.js"></script>
</html>