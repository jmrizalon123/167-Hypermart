<?php 
require_once 'controllers\admin_controller.php';
?>
<?php
  require('config.php');
  if(isset($_POST['submit']))
  {
      $myInput = $_POST['myInput'];
      $query = "SELECT * FROM `client_data` WHERE CONCAT(`id`, `fname`, `lname`, `email`) LIKE '%".$myInput."%'";
      $search_result = filterTable($query);
      
  }
  else{
      $query = "SELECT * FROM `client_data`";
      $search_result = filterTable($query);
  }

  function filterTable($query)
  {
      $connect = mysqli_connect("localhost", "root", "", "divimart");
      $filter_Result = mysqli_query($connect, $query);
      return $filter_Result;
  }
?>

<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/png" href="images\167 Hypermart Logo 2b.png"/>
    <title>167 Hypermart | Admin login</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/css/mdb.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/fontawesome.css">
    <link rel="stylesheet" type="text/css" href="css/fontawesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/loader.css">

</head>
<body onload="myFunction()">
    <div id="myDiv" style="display:none;">  
        <nav class="mb-1 navbar navbar-expand-lg navbar-dark primary-color">
            <a class="navbar-brand" href="#"><img src="images/167 Hypermart Logo 2b.png" alt="" width="150px"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-4"
                aria-controls="navbarSupportedContent-4" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent-4">
                <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#basicExampleModal" style="width:95%">
                   Login
                    </button>
                </li>
                </ul>
            </div>
        </nav>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

            <form action="" method="post">
                <div class="modal fade animated zoomIn" id="basicExampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document" id="modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header primary-color white-text">
                                <h4 class="title">
                                <i class="fa fa-key"></i> <strong>ADMIN</strong></h4>
                                <button type="button" class="close waves-effect waves-light" data-dismiss="modal"
                                aria-label="Close">
                                <span aria-hidden="true">×</span>
                                </button>
                            </div>
                        <div class="modal-body">
                           <strong> <p>Enter your admin credentials to continue!</p></strong>
                           <?php if (count($errors2) > 0): ?>
                                <div class="alert alert-danger">
                                <?php foreach ($errors2 as $error): ?>
                                <li>
                                    <?php echo $error; ?>
                                </li>
                                <?php endforeach;?>
                                </div>
                            <?php endif;?>
                        <div class="md-form">
                            <input type="email" name="email" id="email" class="form-control" value = "<?php echo $email; ?>">
                            <label for="Form-email3">Your email</label>
                        </div>

                        <div class="md-form pb-1 pb-md-3">
                            <input type="password" name="password" id="password" class="form-control">
                            <label for="Form-pass3">Your password</label>
                            <p class="font-small grey-text d-flex justify-content-end">Forgot <a href="#"
                                class="dark-grey-text ml-1 font-weight-bold"> Password?</a></p>
                        </div>
                        </div>  
                        <div class="modal-footer">
                            <button type="submit" name="login-btn" id="login-btn" class="btn btn-primary">SIGN IN</button>
                        </div>
                        </div>
                    </div>
                </div>
            </form>
            <script>
                $(document).ready(function(){
                    $('#basicExampleModal').modal({
                        visible: 'true',
                        backdrop: 'static',
                        keyboard: false
                    });
                });
            </script>
    </div>
    
        <div id="loader-wrapper">
			<div id="loader"></div>
		</div>
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
        <script src = "MD/js/bootstrap.min.js"></script>
        <script src = "js/excel_export.js"></script>
        <script src = "js/export_pdf.js"></script>
        <script src = "js/word_export.js"></script>
        <script src = "MD/js/bootstrap.js"></script>
        <script src = "MD/js/jquery.min.js"></script>
        <script src = "MD/js/mdb.min.js"></script>
        <script src = "MD/js/mdb.js"></script>
        <script src="js/fontawesome.js"></script>
        <script src="js/fontawesome.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/js/mdb.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src="vendor/animsition/js/animsition.min.js"></script>
        <script src="vendor/select2/select2.min.js"></script>
        <script src="vendor/daterangepicker/moment.min.js"></script>
          
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.22/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
</html>