<?php  
  require_once ('controllers\authController.php');
  require_once 'config.php';
  if (!isset($_SESSION['id'])){
    header('location: Client Login');
  exit ();
  } 
  $username = "";
  $email = "";
  $errors = [];

  $conn = new mysqli('localhost', 'root', '', 'divimart');

  if (isset($_POST['submitTemp'])) {
    if (empty($_POST['Temperature'])){
        $errors['Temperature'] = 'Temperature is required *';
    }else{

        $Temperature = $_POST['Temperature'];
        $Fullname = $_POST['Fullname'];
        $Gender = $_POST['Gender'];
        $Age = $_POST['Age'];
        $Email = $_POST['Email'];
        $Address = $_POST['Address'];
        $Contact_Number = $_POST['Contact_Number'];
        $Store_Visited = $_POST['Store_Visited'];
        $Location = $_POST['Location'];
    
    $connection = mysqli_connect("localhost", "root", "");
    $db = mysqli_select_db($connection, 'divimart');
    $query = "INSERT INTO `client_store_entry` (Temperature, Fullname, Gender, Age, Email, Address, Contact_Number, Store_Visited, Location)VALUES('$Temperature', '$Fullname', '$Gender', '$Age', '$Email', '$Address', '$Contact_Number', '$Store_Visited', '$Location')";
     $query_run = mysqli_query($connection, $query);

     if($query_run){
      echo '<script type="text/javascript"> 
                alert("Thank You! Have a nice day :)"); 
                window.location.href = "index";
            </script>;'; 
     }
     else{
       echo '<script type = "text/javascript">alert("Oops something went wrong! Please try again!")</script>';
     }
    
   
    }
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>167 Hypermart Temperature</title>
  <link rel="icon" type="image/png" href="images\167 Hypermart Logo 2b.png"/>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/css/mdb.min.css" rel="stylesheet">
<style>
    .bs-example{
    	margin: 20px;
    }
    body{
      background-image: url("../images/tumblr_ooq9bmus4N1vsjcxvo2_r1_500.gif");
    }
</style>
</head>
<body onload="myFunction()">

<div class="bs-example">
    <div id="myModal" class="modal fade animated bounceIn">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                  <img class="heading lead animated fadeIn" src="images/167 Hypermart Logo 2b.png" alt="" width="100px">
                </div>
                <div class="modal-body">
                   <form action="" method="post">
                    <?php if (count($errors) > 0): ?>
                        <div class="alert alert-danger">
                            <?php foreach ($errors as $error): ?>
                            <li>
                            <?php echo $error; ?>
                            </li>
                            <?php endforeach;?>
                        </div>
                    <?php endif;?>

                      <div class="row text-left">
                        <div class="col-sm-12">
                              <label for="" class="text-left"><i class="fas fa-thermometer-empty"></i> Temperature:</label>
                          <input type="text" class="form-control" name="Temperature" id="Temperature" placeholder="">
                        </div>
                        <div class="col-sm-12" style="display: none;">
                            <?php
                              $count=1;
                              $email="";
                              $email = $_SESSION['email'];
                              $sel_query="SELECT * FROM client_information WHERE email = '$_SESSION[email]'";
                              $result = mysqli_query($con,$sel_query);
                                while($row = mysqli_fetch_assoc($result)) { ?>
                                  <div class="col-sm-12 text-left">
                                    <label for="">Fullname</label>
                                    <input type="text" class="form-control" name="Fullname" id="Fullname" value="<?php echo $row['lastname']; echo ', '; echo $row['firstname']; echo ', '; echo $row['middlename']; ?>">
                                    <label for="">Gender</label>
                                    <input type="text" class="form-control" name="Gender" id="Gender" value="<?php echo $row['gender'] ?>">
                                    <label for="">Age</label>
                                    <input type="text" class="form-control" name="Age" id="Age" value="<?php echo $row['age'] ?>">
                                    <label for="">email</label>
                                    <input type="text" class="form-control" name="Email" id="Email" value="<?php echo $row['email'] ?>">
                                    <label for="">Address</label>
                                    <input type="text" class="form-control" name="Address" id="Address" value="<?php echo $row['barangay']; echo ' '; echo $row ['city_municipality'] ?>">
                                    <label for="">Contact Number</label>
                                    <input type="text" class="form-control" name="Contact_Number" id="Contact_Number" value="<?php echo $row['contact_number'] ?>">
                                    <label for="">Store Visited</label>
                                    <input type="text" class="form-control" name="Store_Visited" id="Store_Visited">
                                    <label for="">Location</label>
                                    <textarea type="text" class="form-control" name="Location" id="demolocation"></textarea>
                                  </div>
                            <?php $count++; } ?>
                        </div>
                      </div>
                      <div class="text-right">
                        <button type="submit" class="btn btn-primary" name = "submitTemp" id="submitTemp" onclick="submitTemp()" style="color: whitesmoke">OKAY</button>
                      </div>
                        <hr>
                        <div class="text-muted" style="font-size: 13px; width: 100%;">
                            © 2020 Copyright: 167 Hypermart
                        </div>
                   </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!--- GEO lOCATION On user Coordinates Change --->
<script>
  document.getElementById("Temperature").onkeyup = function(){
    if (demolocation.value == "14.6010444,120.9761487" || demolocation.value == "14.597448396501795, 120.97479360375962"){
      document.getElementById("Store_Visited").value ="World Trade Exchange Building (Head Office)";
      return true;
    }else{
      document.getElementById("Store_Visited").value ="";
      return false;
    }
    if (demolocation.value == "14.634304032078402, 121.09528297460581" || demolocation.value == "14.634256090392842, 121.09531042182098" || demolocation.value == "14.634255441594457, 121.09529365801527"){
      document.getElementById("Store_Visited").value ="(C1) 167 Hypermart Antipolo";
      return true
    }else{
      document.getElementById("Store_Visited").value ="";
      return false
    }
    if (demolocation.value == "14.634304032078402, 121.09528297460581" || demolocation.value == "14.634256090392842, 121.09531042182098" || demolocation.value == "14.634255441594457, 121.09529365801527"){
      document.getElementById("Store_Visited").value ="(C5) 167 Hypermart Marikina";
      return true
    }else{
      document.getElementById("Store_Visited").value ="";
      return false
    }
    if (demolocation.value == "14.634304032078402, 121.09528297460581" || demolocation.value == "14.634256090392842, 121.09531042182098" || demolocation.value == "14.634255441594457, 121.09529365801527"){
      document.getElementById("Store_Visited").value ="(C5) 167 Hypermart Marikina";
      return true
    }else{
      document.getElementById("Store_Visited").value ="";
      return false
    }

  }
</script>

<script>
 var x = document.getElementById("demolocation");

function myFunction() {
  if (navigator.geolocation) {
    navigator.geolocation.watchPosition(showPosition);
  } else { 
    x.innerHTML = "Geolocation is not supported by this browser.";
  }
}
    
function showPosition(position) {
    x.innerHTML="" + position.coords.latitude +"," + position.coords.longitude;
}

  $(document).ready(function(){
    $('#myModal').modal({
        visible: 'true',
        backdrop: 'static',
        keyboard: false
      });
  });
</script>
    <script lang="javascript" type="text/javascript">
        window.history.forward();
    </script>
</body>

  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/js/mdb.min.js"></script>
  
</html>