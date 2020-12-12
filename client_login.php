<?php include 'controllers/authController.php' ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.min.css" />
    <link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
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
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/fontawesome.css">
    <link rel="stylesheet" type="text/css" href="css/fontawesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/loader.css">

  <title>Login</title>
</head>
<body onload="myFunction()">
  <div class="limiter" id="myDiv" style="display:none;" class="animate-bottom">

      <div class="container-login100">
          <div class="ro">
            <div class="col">
              <img src="images/167 Hypermart Logo 2b.png" alt="" class="animated zoomIn" width="100%">
            </div>
            <br>
            <div class="row" style="width: 45%; margin-left: 30%">
              <div class="col-sm text-center animated rotateIn">
                <b style="font-weight: bold;">Gratitude</b>
              </div>
              <div class="col-sm text-center animated rotateIn">
                <b style="font-weight: bold;">Kindness</b>
              </div>
              <div class="col-sm text-center animated rotateIn">
              <b style="font-weight: bold;">Responsibility</b>
              </div>
              <div class="col-sm text-center animated rotateIn">
              <b style="font-weight: bold;">Modesty</b>
              </div>
            </div>
          <br>
          </div>
          <div class="wrap-login100">
              <form action="login.php" method="post" class="login100-form validate-form" style = "margin-top: -30px;">
                  <span class="login100-form-title p-b-10 p-t-10">
                    Client-Sign in
                  </span>

                  <?php if (count($errors) > 0): ?>
                    <div class="alert alert-danger">
                      <?php foreach ($errors as $error): ?>
                      <li>
                        <?php echo $error; ?>
                      </li>
                      <?php endforeach;?>
                    </div>
                  <?php endif;?>
                  
                  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role=document>
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Choose account type</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                        <a href="signup.php" class="btn btn-danger"style="width:100%">Employee</a><br>
                        <a href="client.php" class="btn btn-secondary"style="width:100%">Client</a>

                        <div class="modal-footer">
                        
                        </div>
                        </div>
                      </div>
                    </div>
                  </div>

                <div class="wrap-input100 validate-input" data-validate = "Email is required">
                 
                  <input type="email" name="email" class="input100" placeholder="Email">
                  <span class="focus-input100" data-placeholder="&#xf207;"></span>
                </div>

                <div class="wrap-input100 validate-input" data-validate = "Password is required">
                  <input type="password" name="password" class="input100" placeholder="password">
                  <span class="focus-input100" data-placeholder="&#xf191;"></span>
                </div>

                <div class="contact100-form-checkbox">
                    <input type="checkbox" name="remember-me" class="input-checkbox100" id="ckb1">
                    <label for="ckb1" class="label-checkbox100">
                      Remember me
                    </label>
                 </div>

                <div class="container-login100-form-btn">
                  <button type="submit" name="login-btn"  style="width: 100%" class="btn peach-gradient btn-rounded my-1 waves-effect"> <i class="fa fa-sign-in"></i> Login</button>
                </div>
                <span0 style="margin-left: 45%; font-weight:bold">Or</span>

                <div class="container-login100-form-btn">
                <a href="login.php" class="btn btn-info"><i class ="fa fa-user-md"></i> Login as employee</a>
                
                </div>

                <div class="container-login100-form-btn">
                  <a href="#" class="btn btn-primary"><i class="fa fa-facebook"></i> Continue with facebook</a>
                </div>

                <div class="container-login100-form-btn">
                <a href="#" class="btn btn-danger"><i class="fa fa-google"></i> Continue with google</a>
                </div>

                <div class="row" style = "margin-top: -50px; font-size: 12px;">
                        <div class="col text-left p-t-90">
                        <a href="forget-password.php" class="txt1"><i class="fa fa-lock"></i>
                          Forgot Password?
                        </a>
                        </div>

                        <div class="col text-right p-t-90">
                        <p style="float: right; font-size: 12px">Don't yet have an account? </p><br> <a href="signup.php" class="text2" style="float: right; color: red;">Create Account</a>
                        </div>
                </div>
              </form>
          </div>
      </div>
              <div class="footer text-center">
                <p>Alright resered 2020 copyrigth @Divimart</p>
              </div>
  </div>
        
      <div id="loader"></div>
      <script>
      var myVar;

      function myFunction() {
        myVar = setTimeout(showPage, 2000);
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