<?php include 'controllers\admin_controller.php';

?>
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

  <title>167 Hypermart | Admin Registration</title>
</head>
<body onload="myFunction()">
  <div class="limiter" id ="myDiv" style="display:none;">
    <div class="container-login100">
    <div class="ro">
        <div class="col">
          <img src="images/167 Hypermart Logo 2b.png" alt="" width ="100%" class="animated zoomIn">
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
      
      <div class="wrap-login100 animated fadeIn">
        <form action="admin_register.php" method="post">
        <span class="login100-form-title p-b-8 p-t-8" style = "margin-top: -20px">Admin Account</span>

        <?php if (count($errors2) > 0): ?>
          <div class="alert alert-danger">
            <?php foreach ($errors2 as $error): ?>
            <li>
              <?php echo $error; ?>
            </li>
            <?php endforeach;?>
          </div>
        <?php endif;?>
          <div class="form-group">
          <br>
            <label for="">Account Type:</label>
          <select id="account_type" name="account_type" type="text" class="form-control form-control-lg" style="font-size: 14px;">
            <option value=""></option>
            <option value="Employee">IT-Admin</option>
            <option value="Client">Admin</option>
            </select>
            <span id="SPaccount"></span>
              <br>
            <label>Username:</label>
            <input type="text" name="username" id="username" class="form-control form-control-lg" autocomplete = "off" style="font-size: 14px;">
            <span id = "SPusername"> </span>
            <i class="fa fa-check-circle" style = "color: green; display: none; position relative" id = "usernameico"></i>
          </div>
          <div class="form-group">
            <label>Email:</label>
            <input type="email" name="email" id="email" class="form-control form-control-lg" autocomplete = "off" style="font-size: 14px;">
              <span id="SPemail"></span>
          </div>
          <div class="form-group">
            <label>Password:</label>
            <input type="password" name="password" id="password" class="form-control form-control-lg" style="font-size: 14px;">
              <span id="SPpassword"></span>
          </div>  
          <div class="form-group">
            <label>Confirm Password:</label>
            <input type="password" name="passwordConf" id ="confirm_password" class="form-control form-control-lg" style="font-size: 14px;">
              <span id = "SPcpassword"></span>
          </div>
          <div class="container-login100-form-btn">
            <button type="submit" name="signup-btn" id="signup-btn" style="width: 100%" class="btn blue-gradient btn-rounded my-1 waves-effect"> <i class="fa fa-sign-in"></i> Submit</button>
              
          </div>
        </form>

            <div class="col text-left p-t-50">
            <p class ="txt1">Already have an account? <a href="login.php">Login</a></p>
            </div>
      </div>
    </div>
                <footer class="page-footer font-small grey lighten-3 py-4 dark-grey-text">
                    <div class="container">

                        <div class="row">
                          <div class="col-sm">
                              <ul class="list-unstyled d-flex justify-content-center mb-0 mt-4">
                              <li>
                                  <a class="mx-3" role="button">About</a>
                              </li>
                              <li>
                                  <a class="mx-3" role="button">Contact</a>
                              </li>
                              <li>
                                  <a class="mx-3" role="button">Privacy & Policy</a>
                              </li>
                              <li>
                                  <a class="mx-3" role="button">Cookies</a>
                              </li>
                              </ul>
                          </div>
                          <div class="col-sm">
                              <div class="footer-copyright text-center bg-transparent dark-grey-text mt-2">
                              <a class="dark-grey-text" href="#"> All rights reserved.</a> 167 HYPERMART @2020
                              </div>
                          </div>
                        </div>

                    </div>
                </footer>
    </div>

  <style>
    .form-group span{
      font-size: 13px;
    }
  </style>

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
  <script src="signup.js"></script>
</html>