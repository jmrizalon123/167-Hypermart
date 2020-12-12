<?php
 require_once 'controllers\authController.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>167 hypermart / Generate user QR</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.min.css" />
    <link rel="icon" type="image/png" href="images\167 Hypermart Logo 2b.png"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/css/mdb.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/util.css">
    <link rel="stylesheet" type="text/css" href="css/fontawesome.css">
    <link rel="stylesheet" type="text/css" href="css/fontawesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/loader.css">

</head>
<body>
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
        <div class="container-fluid animated fadeIn">
          
          <div class="container my-5 py-5 z-depth-1">
              <section class="px-md-5 mx-md-5 text-center text-lg-left dark-grey-text">
              <div class="row d-flex justify-content-center">
                  <div class="col-md-6">
                      <p class="h4 mb-4">Generare Your QR Code</p>
    
                      <p>One last thing upload your profile picture.</p>
    
                      <p>
                      <a href="" target="_blank">This is the custom default avater you can change your profile once you activate your account!</a>
                      </p>
                      <form action="upload.php" method="post" enctype="multipart/form-data">
                          <div class="form-group text-left" style="position: relative;" >
                              
                              <label class="text-left">Username</label><br>
                              <input type="text" name="qrUname" class = "form-control" value="<?php if(isset($_POST['create'])){ echo $_POST['qrUname']; } ?>"><br>

                              <label for="" class="text-left">E-mail</label>
                              <input type="text" name="email" class = "form-control" value="<?php if(isset($_POST['create'])){ echo $_POST['email']; } ?>">
                          </div>
                          <div class="form-group">
                              <button type="submit" name="save_profile" class="btn btn-primary btn-block">GENERATE</button>
                          </div>
                      </form>
                  </div>
              </div>
              </section>
          </div>
        </div>
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