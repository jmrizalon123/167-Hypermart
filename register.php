<?php include 'controllers/authController.php';

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

  <title>167 Hypermart / Create account</title>
</head>
<body onload="myFunction()">
  <div class="limiter" id ="myDiv" style="display:none; margin-bottom:-350px;">
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
    <div class="container my-5 py-5 z-depth-1 animated bounceIn">
      <section class="px-md-5 mx-md-5 text-center text-lg-left dark-grey-text">
        <div class="row d-flex justify-content-center">
          <div class="col-md-6">
            <form class="text-left" action="" method="POST">
            <span class="h4 mb-4 text-center" style="text-transform: uppercase">Create account</span>
            <?php if (count($errors) > 0): ?>
              <div class="alert alert-danger">
                <?php foreach ($errors as $error): ?>
                <li>
                  <?php echo $error; ?>
                </li>
                <?php endforeach;?>
              </div>
            <?php endif;?>
              <div class="form-group">
              <br>
                  <div class="account" style="display: none;"> 
                    <label for="">Account Type:</label>
                    <select id="account_type" name="account_type" type="text" class="form-control form-control-lg" style="font-size: 14px;">
                    <option value="Client">Client</option>
                    </select>
                    <span id="SPaccount" class="animated shake"></span>
                  </div>
                <br>
              <label>Username:</label>
              <input type="text" name="username" id="username" class="form-control form-control-lg" autocomplete = "off" style="font-size: 14px;">
              <span id = "SPusername" class="animated shake"> </span>
              <i class="fa fa-check-circle" style = "color: green; display: none; position relative" id = "usernameico"></i>
            </div>
            <div class="form-group">
              <label>Email:</label>
              <input type="email" name="email" id="email" class="form-control form-control-lg" autocomplete = "off" style="font-size: 14px;">
                <span id="SPemail" class="animated shake"></span>
            </div>
            <div class="form-group">
              <label>Password:</label>
              <input type="password" name="password" id="password" class="form-control form-control-lg" style="font-size: 14px;">
                <span id="SPpassword" class="animated shake"></span>
                <small id="defaultRegisterFormPasswordHelpBlock" class="form-text text-muted mb-4">
              At least 6 characters and 1 digit
            </small>
            </div>  
            <div class="form-group">
              <label>Confirm Password:</label>
              <input type="password" name="passwordConf" id ="confirm_password" class="form-control form-control-lg" style="font-size: 14px;">
                <span id = "SPcpassword" class="animated shake"></span>
                <small id="defaultRegisterFormPhoneHelpBlock" class="form-text text-muted mb-4">
              Optional - for two step authentication and two password should match
            </small>
            </div>
              <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="defaultRegisterFormNewsletter" required>
                <label class="custom-control-label" for="defaultRegisterFormNewsletter">Agree with our terms or service</label>
              </div>
              <button class="btn btn-info my-4 btn-block" type="submit" name="signup-btn" id="signup-btn" style="width: 100%">SIGN-UP</button>
              <small id="defaultRegisterFormPhoneHelpBlock" class="form-text text-muted mb-4">
                Already have an account? <a href="login">Login Now</a>
            </small>
              
              <hr>
              <p>By clicking
                <em>Sign-up</em> you agree to our
                <a href="" target="_blank">terms of service</a>

            </form>
          </div>
        </div>
      </section>
      <div class="text-muted" style="font-size: 13px; width: 100%;">
        © 2020 Copyright: 167 Hypermart
      </div>
    </div>
    </div>

  <style>
    .form-group span{
      font-size: 13px;
    }
  </style>

  <div id="loader-wrapper">
			<div id="loader"></div>
		</div>


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
  <script src="js/signup.js"></script>
</html>