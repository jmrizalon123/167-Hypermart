<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

<title>Change password</title>
<link rel="icon" type="image/png" href="images\167 Hypermart Logo 2b.png"/>
<link rel="stylesheet" href="css/loader.css" type="text/css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
  <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
  <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
  <link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
  <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
  <link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
  <link rel="stylesheet" type="text/css" href="css/util.css">
  <link rel="stylesheet" type="text/css" href="css/main.css">
  <link rel="stylesheet" type="text/css" href="css/fontawesome.css">
  <link rel="stylesheet" type="text/css" href="css/fontawesome.min.css">
  <link rel="stylesheet" type="text/css" href="css/loader.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

<script>
	$(document).ready(function(){
		$("#myModal").modal('show');
	});
</script>
</head>
<body onload="myFunction()">
<div id="myModal" class="modal fade">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create new password</h5>
                <a href="login.php" class="close" data-dismiss="modal">&times;</a>
            </div>
            <div class="modal-body">
                <?php 
                    include("config.php");

                    if(!isset($_GET["code"])) {
                        exit("Can't find url request seesion expired!");
                    }

                    $code = $_GET["code"];
                    $getEmailQuery = mysqli_query($con, "SELECT email FROM password_reset where code='$code'");
                    if (mysqli_num_rows($getEmailQuery)==0){
                        exit("<strong>System Notice!</strong><br><br><p class='alert alert-danger' role='alert'>Can't find request url, code expired! you have already change your password Go back and <a href='login.php' class='btn btn-info'>Login</a></p>");
                    }

                    if(isset($_POST["password"])) {
                        $pw = password_hash($_POST['password'], PASSWORD_DEFAULT);

                        $row = mysqli_fetch_array($getEmailQuery);
                        $email = $row["email"];

                        $query = mysqli_query($con, "UPDATE users SET password='$pw' WHERE email='$email'");

                        if($query) {
                            $query = mysqli_query($con, "DELETE FROM password_reset WHERE code='$code'");
                            echo'<div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Notice!</strong> Password change successfully.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>';
                        }else{
                            exit("Someting went wrong!");
                        }
                    }
                    ?>

                <form method="POST">
                    <div class="form-group">
                        <strong><label for="">Enter new password</label></strong>
                        <input type="password" name="password" class="form-control" placeholder="password" autocomplete="off" required>
                    </div>
                    <button name="submit" class="btn btn-info" style="width: 100%">Submit</button><br>
                    
                </form>
                <br>
                <a href="login.php">Login</a>
            </div>
        </div>
    </div>
</div>
<div id="loader"></div> 
<script>
    var myvar;
    function myFunction(){
        myvar = setTimeout(showPage, 3000)
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
</html>