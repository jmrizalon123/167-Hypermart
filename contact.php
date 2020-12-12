<?php
  require_once 'controllers/authController.php';
  require_once 'vendor/autoload.php';
  require_once 'controllers\auth.php';
  include_once('processForm2.php');
  
    if (!isset($_SESSION['id'])){
      header('location: login.php');
    exit ();
    } 

    $msg = "";
    $msg_class = "";
    $conn = mysqli_connect("localhost", "root", "", "divimart");
    if (isset($_POST['save_profile'])) {
      // for the database
      $bio = stripslashes($_POST['bio']);
      $profileImageName = time() . '-' . $_FILES["profileImage"]["name"];
      // For image upload
      $target_dir = "profiles/";
      $target_file = $target_dir . basename($profileImageName);
      // VALIDATION
      // validate image size. Size is calculated in Bytes
      if($_FILES['profileImage']['size'] > 200000) {
        $msg = "Image size should not be greated than 200Kb";
        $msg_class = "Profile Uploaded successfully";
      }
      // check if file exists
      if(file_exists($target_file)) {
        $msg = "File already exists";
        $msg_class = "Profile Uploaded successfully";
      }
      // Upload image only if no errors
      if (empty($error)) {
        if(move_uploaded_file($_FILES["profileImage"]["tmp_name"], $target_file)) {
          $sql = "UPDATE users_profile SET profile_image='$profileImageName', bio='$bio' WHERE email='$_SESSION[email]'";
          if(mysqli_query($conn, $sql)){
            $msg = "Image uploaded and saved in the Database";
            $msg_class = "alert-success";
          } else {
            $msg = "There was an error in the database";
            $msg_class = "Profile Uploaded successfully"; 
          }
        } else {
          $error = "There was an erro uploading the file";
          $msg = "Profile Uploaded successfully";
        }
      }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>167 Hypermart / Contact Us</title>
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
<!-- CHANGE PROFILE--->
<div class="modal fade animated bounceIn" id="modalSubscriptionForm22" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <strong>PROFILE </strong>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body mx-3">
      <form action="index.php" method="post" enctype="multipart/form-data">
          <div class="form-group text-center" style="position: relative;" >
            <span class="img-div">
                <?php
                    $conn = mysqli_connect("localhost", "root", "", "divimart");
                    $results = mysqli_query($conn, "SELECT * FROM users_profile WHERE email = '$_SESSION[email]'");
                    $users = mysqli_fetch_all($results, MYSQLI_ASSOC);
                ?>
                <?php
                    $count=1;
                    $email="";
                    $email = $_SESSION['email'];
                    $sel_query="SELECT * FROM users_profile WHERE email = '$_SESSION[email]'";
                    $result = mysqli_query($con,$sel_query);
                    while($row = mysqli_fetch_assoc($result)) { ?>
                    <?php foreach ($users as $user):?>
                        <a href="profiles/<?php echo $row['profile_image'] ?>" target="_blank"><img  src="<?php echo 'profiles/' . $user['profile_image'] ?>" class="img z-depth-0"></a>
                    <?php endforeach; ?>
                <?php $count++; } ?>
                    <br><br>
                    <?php
                        $count=1;
                        $email="";
                        $email = $_SESSION['email'];
                        $sel_query="SELECT * FROM client_information WHERE email = '$_SESSION[email]'";
                        $result = mysqli_query($con,$sel_query);
                        while($row = mysqli_fetch_assoc($result)) { ?> 
                        <p class="text-muted" style="text-transform: uppercase; font-weight: bold; font-size: 80%"><?php echo $row['firstname']; echo ' '; echo $row['middlename']; echo ' '; echo $row['lastname']?></p>
                        <p class="text-muted" style="font-size: 80%; margin-top: -15px"><?php echo $row['email'];?></p>
                        <?php if (!$_SESSION['administrator']): ?>
                            <?php else: ?>
                                <small class="text-muted" style="font-size: 70%;">ADMINISTRATOR</small>
                        <?php endif; ?>
                        <hr>
                        <a href="#" id="social_medai_show" title="Link social media accounts"><i class="fas fa-link"></i><p style="color: grey;">LINK ACCOUNTS</p></a>
                        <div class="container-fluid animated bounceInUp" id="socia_media" style="display: none;">
                            <form action="" method="post">
                            <p class="text-muted" style="font-size:80%;">NOTE: you can change your linked accounts anytime you want it.</p>
                                <input type="text" class="form-control" name="email" value="<?php echo $_SESSION['email'] ?>" style="display:none;">

                                <p class="text-left" name="facebook" id="facebook">FACEBOOK</p>
                                <input type="text" class="form-control" name="facebook_account" id="facebook_account" placeholder="https://www.facebook.com/your username" value="<?php echo $row['facebook_account'] ?>">

                                <p class="text-left" name="twitter" id="twitter">TWITTER</p>
                                <input type="text" class="form-control" name="twitter_account" id="twitter_account" placeholder="https://twitter.com/your username" value="<?php echo $row['twitter_account'] ?>">

                                <p class="text-left" name="instagram" id="instagram">INSTAGRAM</p>
                                <input type="text" class="form-control" name="instagram_account" id="instagram_account" placeholder="https://www.instagram.com/your username" value="<?php echo $row['instagram_account'] ?>">
                                    <small>NOTE: Make sure you entered a correct username address, any misspelled characters will lead to incorrect IP address!</small>
                                <br>
                                <div class="text-left">
                                <input type="submit" name="link-accounts" id="link-accounts" value="SAVE CHANGE" class="btn btn-primary">
                                </div>
                            <br><br>
                            </form>
                        </div>
                            <a href="<?php echo $row['facebook_account'] ?>" target="_blank" title="FACEBOOK" class="card-img-100 d-inline-flex justify-content-center align-items-center rounded-circle grey lighten-3 hoverable" style="width: 40px; height: 40px; margin-top: -5px; margin-right: 5px; color: #0d47a1"><i class="fab fa-facebook-f"></i></i></a>
                            <a href="<?php echo $row['twitter_account'] ?>" target="_blank" title="TWITTER" class="card-img-100 d-inline-flex justify-content-center align-items-center rounded-circle grey lighten-3 hoverable" style="width: 40px; height: 40px; margin-top: -5px; margin-right: 5px; color: #0d47a1"><i class="fab fa-twitter"></i></a>
                            <a href="<?php echo $row['instagram_account'] ?>" target="_blank" title="INSTAGRAM" class="card-img-100 d-inline-flex justify-content-center align-items-center rounded-circle grey lighten-3 hoverable" style="width: 40px; height: 40px; margin-top: -5px; margin-right: 5px; color: #0d47a1"><i class="fab fa-instagram" style="font-weight:bold;"></i></a>  
                            <br><br>
                     <?php $count++; } ?>
            </span>
            <div class="container">
                <?php
                    $count=1;
                    $email="";
                    $email = $_SESSION['email'];
                    $sel_query="SELECT * FROM users_profile WHERE email = '$_SESSION[email]'";
                    $result = mysqli_query($con,$sel_query);
                    while($row = mysqli_fetch_assoc($result)) { ?> 
                    <strong>BIO</strong>
                    <p><?php echo $row['bio']?></p>
                <?php $count++; } ?>
            </div>    
          </div>
          <hr>
        </form>    
      </div>
      
    </div>
  </div>
</div>

<div class="modal fade animated bounceInDown" id="modalSubscriptionForm222" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h4 class="modal-title w-100 font-weight-bold text-left">CHANGE PROFILE</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body mx-3">
      <form action="index.php" method="post" enctype="multipart/form-data">
          <?php if (!empty($msg)): ?>
            <div class="alert <?php echo $msg_class ?>" role="alert">
              <?php echo $msg; ?>
            </div>
          <?php endif; ?>
          <div class="form-group text-center" style="position: relative;" >
            <span class="img-div">
            <h4><b>CHOOSE YOUR PROFILE</b></h4><br><br>
            <?php
                $conn = mysqli_connect("localhost", "root", "", "divimart");
                $results = mysqli_query($conn, "SELECT * FROM users_profile WHERE email = '$_SESSION[email]'");
                $users = mysqli_fetch_all($results, MYSQLI_ASSOC);
                ?>
                <?php foreach ($users as $user):?>
                    <img  src="<?php echo 'profiles/' . $user['profile_image'] ?>" class="rounded-circle z-depth-1"
                    alt="thumbnail" height="41" onClick="triggerClick()" id="profileDisplay" >
                <?php endforeach; ?>
            </span>
            <input type="file" name="profileImage" onChange="displayImage(this)" id="profileImage" class="form-control" style="display: none;">     
          </div>
          <div class="form-group">
            <label>Bio</label>
            <?php
                $count=1;
                $email="";
                $email = $_SESSION['email'];
                $sel_query="SELECT * FROM users_profile WHERE email = '$_SESSION[email]'";
                $result = mysqli_query($con,$sel_query);
                while($row = mysqli_fetch_assoc($result)) { ?>
                <textarea name="bio" class="form-control" value=""><?php echo $row['bio'] ?></textarea>
            <?php $count++; } ?>
          </div>
          <div class="modal-footer d-flex justify-content-center">
          
          <?php echo $_SESSION['email'] ?>
            <button type="submit" name="save_profile" class="btn btn-indigo">SAVE CHANGE <i class="fas fa-paper-plane-o ml-1"></i></button>
        </div>
        </form>    
      </div>
      
    </div>
  </div>
</div>
<style>
    #userProfile{ display: block; height: 40px; width: 40px; margin: 0px auto; border-radius: 50%; box-shadow: 0px 0px 5px; }
    .form-div { margin-top: 100px; border: 1px solid #e0e0e0; }
    #profileDisplay { display: block; height: 210px; width: 210px; margin: 0px auto; border-radius: 50%; }
    .img-placeholder {
    width: 60%;
    color: white;
    height: 100%;
    background: black;
    opacity: .7;
    height: 210px;
    border-radius: 50%;
    z-index: 2;
    position: absolute;
    left: 50%;
    transform: translateX(-50%);
    display: none;
    }
    .img-placeholder h4 {
    margin-top: 40%;
    color: white;
    }
    .img-div:hover .img-placeholder {
    display: block;
    cursor: pointer;
    }
    .img{
        width:100%;
    }
  </style>
<script>
    function triggerClick(e) {
        document.querySelector('#profileImage').click();
        }
        function displayImage(e) {
        if (e.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e){
            document.querySelector('#profileDisplay').setAttribute('src', e.target.result);
            }
            reader.readAsDataURL(e.files[0]);
        }
        }
  </script>

<!-- Profile Update -->
<div class="modal fade" id="modalSocial22" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog cascading-modal" role="document">
    <div class="modal-content">
      <div class="modal-header light-blue darken-3 white-text">
        <h4 class="title"><i class="far fa-edit"></i> Edit Profile</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
            aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body mb-0 text-left">
        <form class="" action="" method="POST">
            <div class="login100-form-logo" style="text-align: center; margin-top: -50px;">
                <img src="images/167 Hypermart Logo 2b.png" alt="" style="width: 180px;">
            </div><br>

            <div class="form-row mb-2">
                <div class="row">
                    <div class="form-group col-md-6">
                        <input type="text" class="form-control" id="id" name="id" value = "<?php echo $_SESSION['id'] ?>" style="display: none;" onkeyup="firstname()">
                        <label for="inputfname">Firstname:</label>
                        <input type="text" class="form-control" id="firstname" name="firstname" onkeyup="firstname()">
                        <span id="SPname"></span>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputlastname">Lastname:</label>
                        <input type="text" class="form-control" id="lastname" name="lastname" onkeyup="lastname()">
                        <span id="SPlname"></span>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="inputfname">Middlename:</label>
                        <input type="text" class="form-control" id="middlename" name="middlename" onkeyup="middlename()">
                        <span id="SPmiddlename"></span>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputlastname">Contact Number:</label>
                        <input type="text" class="form-control" id="contact_number" name="contact_number" onkeyup="contact_number()">
                        <span id="SPlcontact_number"></span>
                    </div>

                </div>

            </div>
                <input type="text" id="address2" name="address2" class="form-control mb-4" placeholder="Province Address">
                <span id="address"></span>

            <label for="inputlastname">Current Address:</label>
            <input type="text" id="barangay" name="barangay" class="form-control" placeholder="floor/unit/brgy/st." aria-describedby="defaultRegisterFormPasswordHelpBlock">
            <span id="brgy"></span>
            <small id="defaultRegisterFormPasswordHelpBlock" class="form-text text-muted mb-4">
                Special character included
            </small>

            <input type="text" id="city_municipality" name="city_municipality" class="form-control" placeholder="Municippality" aria-describedby="defaultRegisterFormPhoneHelpBlock">
            <span id="MU"></
            span>
            <small id="defaultRegisterFormPhoneHelpBlock" class="form-text text-muted mb-4">
                Optional - for two step authentication
            </small>
            <button class="btn btn-info my-4 btn-block" name="profile" id="profile" type="submit"><i class="fas fa-paper-plane"></i> Submit</button>
            <hr>
        </form>
      </div>

    </div>
  </div>
</div>


<div class="modal fade my-5" id="modalConfirmDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-sm modal-notify modal-danger" role="document">
    <div class="modal-content text-center">
      <div class="modal-header d-flex justify-content-center">
        <p class="heading">Confirm logout</p>
      </div>
      <div class="modal-body">
        <p>Are you sure do you want to logout?</p>
        <i class="fas fa-sign-out-alt fa-4x animated rotateIn"></i>

      </div>
      <div class="modal-footer flex-center">
        <a type="button" class="btn  btn-danger waves-effect" data-dismiss="modal">No</a>
        <a href="index.php?logout=1" class="btn  btn-outline-danger">Yes</a>
      </div>
    </div>
  </div>
</div>
<!--Modal: modalConfirmlogout-->

<div class="modal fade right" id="fullHeightModalRight" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-full-height modal-right modal-notify modal-info" role="document">

        <div class="modal-content" >
        <div class="modal-header">
                <h5 class="modal-title w-100" id="myModalLabel">SYMPTOMS As of today<p id="datenow"></p></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style = "color: white">
                <span aria-hidden="true">&times;</span>
                </button>
        </div>
        <form action="index.php" method = "POST">
            <div class="modal-body text-center">
                <input type="text" name="email" id="email" value="<?php echo $_SESSION['email'] ?>" style="display: none;">
                <?php if (count($errors) > 0): ?>
                    <div class="alert alert-danger">
                        <?php foreach ($errors as $error): ?>
                        <li>
                        <?php echo $error; ?>
                        </li>
                        <?php endforeach;?>
                    </div>
                    <?php endif;?>
                <h3 class=""><i class="fas fa-book-medical fa-4x animated rotateIn my-4"></i></h3>
                <strong>Hi, </strong><input style="text-transform: uppercase; font-size: 16px; text-align:center; width: 90px;" name="username" value="<?php echo $_SESSION['username']?>">
                <p class="t">Tell us what you feel rigth now!</p>
                <!-- Material input -->
                <div class="md-form">
                    <input type="text" id="form1" class="form-control" name="temperature">
                    <label for="form1"><strong>Temperature:</strong></label>
                    <span id="temp"></span>

                <!-- Default unchecked -->
                <div class="custom-control custom-checkbox" style="margin-left: 25px; text-align: left; line-height: 20px;">
                    <input type="checkbox" class="custom-control-zinput" id="defaultIndeterminate1" name="check_list[]" value="Shortness of breath or difficulty breathing">
                    <label class="custom-control-label" for="defaultIndeterminate1" style="font-size: 14px; color: black">1. Shortness of breath or difficulty breathing.</label>
                </div>
                <div class="custom-control custom-checkbox" style="margin-left: 25px; margin-top:12px;">
                    <input type="checkbox" class="custom-control-input" id="defaultIndeterminate2" name="check_list[]" value="Repeated shaking with chills">
                    <label class="custom-control-label" for="defaultIndeterminate2" style="font-size: 14px; color: black">2. Repeated shaking with chills.</label>
                </div>
                <div class="custom-control custom-checkbox" style="margin-left: 25px; margin-top:7px;">
                    <input type="checkbox" class="custom-control-input" id="defaultIndeterminate3" name="check_list[]" value="New loss of taste or smell">
                    <label class="custom-control-label" for="defaultIndeterminate3" style="font-size: 14px; color: black">3. New loss of taste or smell.</label>
                </div>
                <div class="custom-control custom-checkbox" style="margin-left: 25px; margin-top:7px;">
                    <input type="checkbox" class="custom-control-input" id="defaultIndeterminate4" name="check_list[]" value="Fever">
                    <label class="custom-control-label" for="defaultIndeterminate4" style="font-size: 14px; color: black">4. Fever.</label>
                </div>
                <div class="custom-control custom-checkbox" style="margin-left: 25px; margin-top:7px;">
                    <input type="checkbox" class="custom-control-input" id="defaultIndeterminate5" name="check_list[]" value="Cough">
                    <label class="custom-control-label" for="defaultIndeterminate5" style="font-size: 14px; color: black">5. Cough.</label>
                </div>
                <div class="custom-control custom-checkbox" style="margin-left: 25px; margin-top:7px;">
                    <input type="checkbox" class="custom-control-input" id="defaultIndeterminate6" name="check_list[]" value="Muscle pain">
                    <label class="custom-control-label" for="defaultIndeterminate6" style="font-size: 14px; color: black">6. Muscle pain.</label>
                </div>
                <div class="custom-control custom-checkbox" style="margin-left: 25px; margin-top:7px;">
                    <input type="checkbox" class="custom-control-input" id="defaultIndeterminate7" name="check_list[]" value="Chills">
                    <label class="custom-control-label" for="defaultIndeterminate7" style="font-size: 14px; color: black">7. Chills.</label>
                </div>
                <div class="custom-control custom-checkbox" style="margin-left: 25px; margin-top:7px;">
                    <input type="checkbox" class="custom-control-input" id="defaultIndeterminate8" name="check_list[]" value="Headache">
                    <label class="custom-control-label" for="defaultIndeterminate8" style="font-size: 14px; color: black">8. Headache.</label>
                </div>
                <div class="custom-control custom-checkbox" style="margin-left: 25px; margin-top:7px;">
                    <input type="checkbox" class="custom-control-input" id="defaultIndeterminate9" name="check_list[]" value="Sore throat">
                    <label class="custom-control-label" for="defaultIndeterminate9" style="font-size: 14px; color: black">9. Sore throat.</label>
                </div>

                <div class="custom-control custom-checkbox" style="margin-left: 25px; margin-top:7px;">
                    <input type="checkbox" class="custom-control-input" id="defaultIndeterminate10" name="check_list[]" value="None">
                    <label class="custom-control-label" for="defaultIndeterminate10" style="font-size: 14px; color: black">10. None.</label>
                </div>

                </div>
                <div class="other" >
                    <label for="symptoms" class="text-left" style="margin-top: 10px;"><strong>Other Symptoms:</strong></label>
                    <input type="text" name="other_symptoms" id="other_symptoms" class="form-control" style="margin-top: 10px;">
                        
                </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i> Close</button>
                    <button type="submit" name="submit" id="btn-submit" class="btn btn-primary"><i class="fas fa-paper-plane"></i> Save changes</button>
                </div>
            </div>
        </form>
  </div>
</div>

<div class="modal fade" id="basicExampleModal101" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="border-radius: 50px; height: 60px;">
      <div class="modal-body text-center">
            <a href="" class="card-img-100 d-inline-flex justify-content-center align-items-center rounded-circle grey lighten-3 hoverable animated bounceIn" style="width: 40px; height: 40px; margin-top: -5px; margin-right: 5px; color: #0d47a1"><i class="fas fa-lock"></i></a>
            <a href="" class="card-img-100 d-inline-flex justify-content-center align-items-center rounded-circle grey lighten-3 hoverable animated bounceIn delay-1s" style="width: 40px; height: 40px; margin-top: -5px; margin-right: 5px; color: #0d47a1"><i class="fas fa-camera"></i></a>
            <a href="" class="card-img-100 d-inline-flex justify-content-center align-items-center rounded-circle grey lighten-3 hoverable animated bounceIn delay-2s" style="width: 40px; height: 40px; margin-top: -5px; margin-right: 5px; color: #0d47a1"  data-toggle="modal" data-target="#modalSubscriptionForm222"><i class="fas fa-user-alt"></i></a>
            <a href="" class="card-img-100 d-inline-flex justify-content-center align-items-center grey lighten-3 hoverable" style="width: 65; border-radius: 20px; height: 40px; margin-top: -5px; margin-right: 5px; color: #880e4f" data-toggle="modal" data-target="#modalConfirmDelete"><i class="fas fa-sign-out-alt"></i> <strong>Logout</strong></a>

            <a href="navbarDropdownMenuLink-4" class="text-right d-inline-flex justify-content-center align-items-center nav-link dropdown-toggle widget-subheading " data-toggle="dropdown"aria-haspopup="true" style="width: 40px; height: 40px; margin-top: -5px; color: #0d47a1"><i class="fas fa-cog"></i></a>
            <div class="dropdown-menu dropdown-menu-right dropdown-info animated fadeIn  z-depth-1" aria-labelledby="navbarDropdownMenuLink-4">
            <?php if (!$_SESSION['administrator']): ?>
                <?php else: ?>
                    <a class="dropdown-item animated bounceInLeft" href="admin_login.php"><i class="fas fa-user-tie"></i> Admin Panel</a>
                    <a class="dropdown-item animated bounceInRight" href="report.php" data-toggle="modal" data-target="#AddADminProfile"><i class="fas fa-user-plus" style="color: maroon"></i> Add Admin</a>
                    <a class="dropdown-item animated bounceInUp" href="report.php"><i class="fas fa-exclamation-triangle" style="color: maroon"></i> Report Log</a>
                <?php endif;?>
            </div>
      </div>
    </div>
  </div>
</div>
<style>
.dropdown-menu{
    margin-top: 10px;
    width: 60%;
}
</style>

        <div class="limiter animated fadeIn">
            <nav class="navbar navbar-expand-lg navbar-dark primary-color">
                <div class="container">
                    <a class="navbar-brand" href="index.php"><img src="images/167 Hypermart Logo 2b.png" alt="" width="120px"></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#basicExampleNav"
                        aria-controls="basicExampleNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="basicExampleNav">
                        <ul class="navbar-nav mr-auto text-uppercase">
                            <li class="nav-item">
                                <a class="nav-link font-weight-normal" href="index.php"><i class="fas fa-home"></i> Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" data-toggle="modal" data-target="#fullHeightModalRight"><i class="fas fa-briefcase-medical"></i> Health check</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" id="QRclick"><i class="fas fa-qrcode"></i> QR Code</a>
                            </li>
                                <li class="nav-item active">
                                    <a class="nav-link" href="contact.php"><i class="fas fa-envelope"></i> Contact Us</a>
                                </li>
                        </ul>
                        <!-- Links -->
                        
                        <ul class="nav navbar-nav nav-flex-icons ml-auto">
                            <li class="nav-item">
                                    <a class="nav-link" href="#" style = "color: black;">
                                        <span class="sr-only">(current)</span> 
                                    </a>
                                </li>
                                <li class="nav-item" style = "color: black;">
                                        <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-4" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false" name="email">
                                        <?php echo $_SESSION['email'] ?></a>
                                </li>
                                <li class="nav-item dropdown" style = "color: black;">
                                        <a class="nav-link dropdown-toggle widget-subheading" id="navbarDropdownMenuLink-4" data-toggle="modal" data-target="#basicExampleModal101"
                                        aria-haspopup="true" aria-expanded="false" name="email">
                                        <i class="fas fa-user-cog"></i></a>
                                </li>
                                <li class="nav-item avatar" style = "color: black;">
                                    <a class="nav-link p-0" href="#">
                                    <?php
                                        $conn = mysqli_connect("localhost", "root", "", "divimart");
                                        $results = mysqli_query($conn, "SELECT * FROM users_profile WHERE email = '$_SESSION[email]'");
                                        $users = mysqli_fetch_all($results, MYSQLI_ASSOC);
                                        ?>
                                    <?php foreach ($users as $user):?>
                                        <img  src="<?php echo 'profiles/' . $user['profile_image'] ?>" class="avatar rounded-circle card-img-35 z-depth-1 d-flex ml-3" id="usserProfile"
                                        alt="thumbnail" height="41" data-toggle="modal" data-target="#modalSubscriptionForm22">
                                    <?php endforeach; ?>
                                    </a>
                                </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <br>
                <div class="container animated jackInTheBox" id="showQR" style = "display: none;">
                    <div class="row">
                        <div class="col-md-12 animated fadeIn" style="margin-top: 10px;">
                            <as href="#!" class="card hoverable">
                                <div class="card">
                                    <div class="card-header">
                                        <i class="fas fa-qrcode" style="color: #3F729B"></i><strong style="color: #3F729B"> QR CODE</strong>
                                    </div>
                                    <div class="card-body text-center">
                                        <?php
                                            $conn = mysqli_connect("localhost", "root", "", "howtoqr");
                                            $results = mysqli_query($conn, "SELECT * FROM qrcodes WHERE email = '$_SESSION[email]'");
                                            $users = mysqli_fetch_all($results, MYSQLI_ASSOC);
                                            ?>
                                            <?php
                                                $count=1;
                                                $email="";
                                                $email = $_SESSION['email'];
                                                $sel_query="SELECT * FROM howtoqr.qrcodes WHERE email = '$_SESSION[email]'";
                                                $result = mysqli_query($con,$sel_query);
                                                while($row = mysqli_fetch_assoc($result)) { ?>
                                                <?php foreach ($users as $user):?>
                                                    <a href="userQr/<?php echo $row["qrImg"]?>" target="_blank"><img  src="<?php echo 'userQr/' . $user['qrImg'] ?>" class="images" alt="thumbnail" height="300px" width="300px"></a>
                                                <?php endforeach; ?>
                                                <br><a href="userQr/<?php echo $row["qrImg"]?>" target="_blank"><?php echo $row["qrlink"]?></a>
                                        <?php $count++; } ?><br>
                                        <small>use your QR to get your attendance</small>
                                    </div>
                                </div>
                            </as>
                        </div>              
                    </div>
                </div>
            
            <div class="container my-5 py-5 z-depth-1">
                <section class="text-center dark-grey-text mb-5">

                    <style>
                    .map-container {
                        height: 230px;
                        position: relative;
                    }

                    .map-container iframe {
                        left: 0;
                        top: 0;
                        height: 100%;
                        width: 100%;
                        position: absolute;
                    }
                    </style>
                    <div class="row d-flex justify-content-center">
                    <div class="col-md-6 text-center">

                        <h3 class="font-weight-bold">Contact Us</h3>

                        <p class="text-muted">Write your concerns below, and we will do our best to fixed it. Thank you have a nice day.!</p>
                        <?php if (count($errors) > 0): ?>
                          <div class="alert alert-danger">
                            <?php foreach ($errors as $error): ?>
                            <li>
                              <?php echo $error; ?>
                            </li>
                            <?php endforeach;?>
                          </div>
                        <?php endif;?>
                    <br>
                    </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-12 mb-4 mb-md-0">
                            <form action="contact.php" method="POST">
                                <div class="md-form md-outline mt-3">
                                <input type="email" id="form-email" name="email" class="form-control disabled" value="<?php echo $_SESSION['email'] ?>">
                                <label for="form-email">E-mail</label>
                                </div>
                                <div class="md-form md-outline">
                                <input type="text" id="form-subject" name="subject" class="form-control">
                                <label for="form-subject">Subject</label>
                                </div>
                                <div class="md-form md-outline mb-3">
                                <textarea id="form-message" name="message" class="md-textarea form-control" rows="3"></textarea>
                                <label for="form-message">How we can help?</label>
                                </div>
                                <button type="submit" name="contact" class="btn btn-info btn-sm ml-0">Submit<i class="far fa-paper-plane ml-2"></i></button>
                            </form>
                        </div>
                        <div class="col-lg-6 col-md-12 mb-0 mb-md-0">
                            <div id="map-container-google-1" class="z-depth-1 map-container mb-4">
                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3861.029556889149!2d120.97259891535184!3d14.597391681067464!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397ca1095e450e7%3A0x618f8576850b77d9!2sWorld%20Trade%20Exchange%20Building!5e0!3m2!1sen!2sph!4v1605073336208!5m2!1sen!2sph" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>

                            </div>
                            <div class="address text-left">
                            <b>Head Office: </b>
                            <p class="text-muted text-left">World Trade Exchange Building, Juan Luna Street, Binondo, Manila, Metro Manila </p>

                            </div>
                        </div>
                    </div>
                </section>
            </div>


            </div>
        </div>
            <div class="card-footer text-muted" style="font-size: 13px; width: 100%;">
                © 2020 Copyright: 167 Hypermart
            </div>
            <style>
              #userProfile{ display: block; height: 40px; width: 40px; margin: 0px auto; border-radius: 50%; box-shadow: 0px 0px 5px; }
              .form-div { margin-top: 100px; border: 1px solid #e0e0e0; }
              #profileDisplay { display: block; height: 210px; width: 210px; margin: 0px auto; border-radius: 50%; }
              .img-placeholder {
              width: 60%;
              color: white;
              height: 100%;
              background: black;
              opacity: .7;
              height: 210px;
              border-radius: 50%;
              z-index: 2;
              position: absolute;
              left: 50%;
              transform: translateX(-50%);
              display: none;
              }
              .img-placeholder h4 {
              margin-top: 40%;
              color: white;
              }
              .img-div:hover .img-placeholder {
              display: block;
              cursor: pointer;
              }
              .img{
                  width:50%;
                  border-radius: 100%;
              }
            </style>

<script>
document.getElementById("link-accounts").onclick = function() {
    if(facebook_account.value == ""){
        document.getElementById("facebook").style.color = "red";
        document.getElementById("instagram").style.color = "red";
        document.getElementById("twitter").style.color = "red";
        return false;
    }else{
        document.getElementById("facebook").style.color = "green";
        document.getElementById("instagram").style.color = "green";
        document.getElementById("twitter").style.color = "green";
        return true;
    }
}
document.getElementById("facebook_account").onkeyup = function(){
    if(facebook_account.value == ""){
        document.getElementById("facebook").style.color = "red";
        return false;
    }else{
        document.getElementById("facebook").style.color = "green";
        return true;
    }
}
document.getElementById("twitter_account").onkeyup = function(){
    if(twitter_account.value == ""){
        document.getElementById("twitter").style.color = "red";
        return false;
    }else{
        document.getElementById("twitter").style.color = "green";
        return true;
    }
}
document.getElementById("instagram_account").onkeyup = function(){
    if(instagram_account.value == ""){
        document.getElementById("instagram").style.color = "red";
        return false;
    }else{
        document.getElementById("instagram").style.color = "green";
        return true;
    }
}

document.getElementById("social_medai_show").onclick = function() {
    document.getElementById("socia_media").style.display = "block";
}

</script>

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
                document.getElementById("QRclick").onclick = function (){
                    document.getElementById("showQR").style.display = "block";
                }
            </script>
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