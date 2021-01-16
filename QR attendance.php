<?php
  require_once 'controllers/authController.php';
  require_once 'vendor/autoload.php';
  require_once 'controllers\auth.php';
  //include_once('processForm2.php');
  
    if (!isset($_SESSION['id'])){
      header('location: login');
    exit ();
    } 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>167 Hypermart / Add Visited Place</title>
    <link rel="icon" type="image/png" href="images\167 Hypermart Logo 2b.png"/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/css/mdb.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css\fontawesome.css">
    <link rel="stylesheet" href="css\fontawesome.min.css">
    <link rel="stylesheet" href="css/loader.css">
</head>
<body onload="loadFunction()">

        <div class="limiter animated fadeIn">
            <nav class="navbar navbar-expand-lg navbar-dark primary-color">
                <div class="container">
                    <a class="navbar-brand" href="index"><img src="images/167 Hypermart Logo 2b.png" alt="" width="120px"></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#basicExampleNav"
                        aria-controls="basicExampleNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="basicExampleNav">
                    </div>
                </div>
            </nav>
                <div class="container" style="margin-top: 30px;">
                    <form class=" border border-light p-3" action="" method="POST">
                    <p class="h4 mb-4 text-center" style="text-transform: uppercase;">SCAN QR</p>
                    <p class="text-center"></p>

                    <textarea name="location_address" style="width: 100%; display: none;">Locating...</textarea>
                    <script>
                        const address = document.querySelector("textarea");

                        function onError() {
                            address.textContent = "Oops someting went wrong.";
                        }
                        async function onSuccess(position) {
                            const geocode = await fetch(`https://geocode.xyz/${position.coords.latitude},${position.coords.longitude}?json=1`);
                            const geoResponse = await geocode.json();

                            address.textContent = `${geoResponse.stnumber} ${geoResponse.staddress}
                            ${geoResponse.city}
                            ${geoResponse.postal}
                            ${geoResponse.country}`;
                            }

                            if (!navigator.geolocation) {
                                onError();
                            } else {
                                navigator.geolocation.getCurrentPosition(onSuccess, onError);
                            }
                    </script>
                    <?php
                        require_once("config.php");
                        $db = mysqli_connect('localhost', 'root', '', 'divimart');
                            $email = "";
                        if (isset($_POST['QR-add'])) {
                            if (empty($_POST['email'])){
                                $errors['email'] = 'Email is required *';
                            }
                            if (empty($_POST['temperature'])){
                                $errors['temperature'] = 'Temperature is required *';
                            }
                            if (empty($_POST['place_visited'])){
                                $errors['place_visited'] = 'Place to be visit is required *';
                            }
                            if (empty($_POST['date_visited'])){
                                $errors['date_visited'] = 'Date is required *';
                            }else{

                                $email=$_POST['email'];
                                $place_visited = $_POST['place_visited'];
                                $username = $_POST['username'];
                                $date_visited = $_POST['date_visited'];
                                $temperature = $_POST['temperature'];
                                $location_address = $_POST['location_address'];

                                $sql_e = "SELECT * FROM users WHERE email='$email'";
                                $res_e = mysqli_query($db, $sql_e);

                                if(mysqli_num_rows($res_e) > 0){
                                    $query = "INSERT INTO `place_visited` (location_address, temperature, username, email, place_visited, date_visited)VALUES
                                    ('$location_address', '$temperature', '$username', '$email', '$place_visited', '$date_visited')";
                                    $query_run = mysqli_query($conn, $query);
                                if($query_run) {
                                    echo'<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>Notice:!</strong> Visited place added successfully
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>';
                                }	
                                }else{
                                    echo'<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>Notice:!</strong> Oops! Something went wrong,! email coudnt be found in our database!
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                         </div>';
                                    }
                            }
                        }
                    ?>
                     <?php if (count($errors) > 0): ?>
                    <div class="alert alert-danger">
                      <?php foreach ($errors as $error): ?>
                      <li>
                        <?php echo $error; ?>
                      </li>
                      <?php endforeach;?>
                    </div>
                  <?php endif;?>
                    <div class="qr-image text-center">
                        <canvas></canvas>
                    </div>
                    <div class="md-form md-outline mt-3" style="display: none;">
                        <input type="email" id="form-email" name="email" class="form-control" value="<?php echo $_SESSION['email'] ?>">
                        <input type="text" id="form-email" name="username" class="form-control" value="<?php echo $_SESSION['username'] ?>">
                        <label for="form-email">Enter your E-mail</label>
                    </div>
                    <div class="md-form md-outline">
                        <input type="text" id="form-subject" name="temperature" class="form-control">
                        <label for="form-subject">Temperature</label>
                    </div>
                    <div class="md-form md-outline">
                        <input type="text" id="form-subject" name="place_visited" class="form-control">
                        <label for="form-subject">Place Visited</label>
                    </div>
                    <div class="md-form md-outline mb-3" style="display: none;">
                        <input type="text" id="nowdate" name="date_visited" class="form-control">
                    </div>
                    <button class="btn btn-info btn-block" name="QR-add" type="submit">SUBMIT</button>
                    </form>
                </div>
            </div>
        <br>
            <div class="card-footer text-muted" style="font-size: 13px; width: 100%;">
                © 2020 Copyright: 167 Hypermart
            </div>
            <script>
                function loadFunction() {
                    var loadmodal;
                    loadmodal = setTimeout(showmodal, 3000)
                    function showmodal() {
                        document.getElementById("basicExampleModal2").style.display = "visible";
                    }
                }
            </script>
            <script>
                var today = new Date();
                var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
                var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
                var dateTime = date+' '+time;

                document.getElementById("nowdate").value = dateTime;
            </script>
            <style>
                canvas{
                    border-style: dotted;                  
                    width: 75%;
                }
            </style>
</body>

    <script type="text/javascript" src="js\fontawesome.min.js"></script>
    <script type="text/javascript" src="js\fontawesome.js"></script>
    <script type="text/javascript" src="js/symptoms.js"></script>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/js/mdb.min.js"></script>
</html>