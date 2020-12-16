<?php
require_once ('controllers\authController.php');
$conn = mysqli_connect("localhost", "root", "");
$db = mysqli_select_db($conn, 'chat');

if (isset($_POST['success'])){
    $profile_image = $_POST['profile_image'];
    $email = $_POST['email'];

    $query = "UPDATE `chat_login` SET profile_image = '$_POST[profile_image]' WHERE email = '$_POST[email]'";
    $query_run = mysqli_query($conn, $query);
    if ($query_run){
      header("Location: index.php");

    }else{
     echo '<script type = "text/javascript">alert("Oops, Someting went wrong! Try again later")</script>';

    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>167Hypermart | Success</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/css/mdb.min.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="images\167 Hypermart Logo 2b.png"/>
    <link rel="stylesheet" type="text/css" href="css/loader.css">

</head>
<body onload="myFunction()"><br><br><br><br><br><br>
    <div class="container animated bounceIn delay-1s" id="showmessage" style="display: none;">
        <section class="text-center">
                <div class="row">
                    <div class="col-md-6 mx-auto">
                        <div class="card">
                            <div class="modal-header" style="height: 60px;">
                                <img class="heading lead animated fadeIn" src="images/167 Hypermart Logo 2b.png" alt="" width="100px">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"  style="color: rgb(1, 28, 68);">
                                    <span aria-hidden="true" class="black-text"><a href="">&times;</a></span>
                                </button>
                            </div>
                                <i class="fas fa-check fa-4x mb-3 animated rotateIn" style="color:rgb(48, 177, 48); font-size: 80px; margin-bottom: -40px;" ></i>
                            <div class="card-body">
                                <form method = "POST" class="text-center" action="" style="color: #757575;">
                                        <h2 class="animated fadeIn" style="color: rgb(8, 60, 95);">Thank You!</h2>
                                        <P>Stay Safe!</P>
                                    <div class="text-right modal-footer" style="margin-bottom: -30px;">
                                        <input type="text" name="email" value = "<?php echo $_SESSION['email'] ?>" style="display: none;">
                                        <?php
                                                $count=1;
                                                $email="";
                                                $email = $_SESSION['email'];
                                                $sel_query="SELECT * FROM users_profile WHERE email = '$_SESSION[email]'";
                                                $result = mysqli_query($con,$sel_query);
                                                while($row = mysqli_fetch_assoc($result)) { ?>
                                                <input type="text" name ="profile_image" value = <?php echo $row['profile_image']?> style="display: none;">
                                        <?php $count++; } ?>
                                        <button type="submit" name="success" class="btn btn-primary">Okay</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    </div>
        <div id="loader-wrapper">
			<div id="loader"></div>
		</div>
      <script>
          var myVar;

          function myFunction() {
              myVar = setTimeout(showPage, 2000);
          }
          function showPage () {
              document.getElementById("loader").style.display = "none";
              document.getElementById("showmessage").style.display = "block";
              document.getElementById("footer").style.display = "block";
          }
      </script>
</body>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/js/mdb.min.js"></script>
</html>