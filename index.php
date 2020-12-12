<?php
  require_once 'controllers/authController.php';
  require_once 'vendor/autoload.php';
  require_once 'controllers\auth.php';
  include('database_connection.php');
  include_once('processForm2.php');
  include_once('processForm3.php');
  include_once('processForm4.php');
  include_once('search_conn.php');
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

//RAPID TEST FILE UPLOAD
$msg = "";
    $msg_class = "";
    $conn = mysqli_connect("localhost", "root", "", "divimart");
    if (isset($_POST['submitTest'])) {
      // for the database
      $profileImageName = time() . '-' . $_FILES["RapidTestfile"]["name"];
      // For image upload
      $target_dir = "RapidTestFiles/";
      $target_file = $target_dir . basename($profileImageName);
      // VALIDATION
      // validate image size. Size is calculated in Bytes
      if($_FILES['RapidTestfile']['size'] > 200000) {
        $msg = "Image size should not be greated than 200Kb";
        $msg_class = "RAPID TEST FILE UPLOADED SUCCESSFULLY";
      }
      // check if file exists
      if(file_exists($target_file)) {
        $msg = "File already exists";
        $msg_class = "RAPID TEST FILE UPLOADED SUCCESSFULLY";
      }
      // Upload image only if no errors
      if (empty($error)) {
        if(move_uploaded_file($_FILES["RapidTestfile"]["tmp_name"], $target_file)) {
            $sql = "UPDATE client_data SET rapid_test_file='$profileImageName' WHERE email='$_SESSION[email]'";
          if(mysqli_query($conn, $sql)){
            $msg = "Image uploaded and saved in the Database";
            $msg_class = "alert-success";
          } else {
            $msg = "There was an error in the database";
            $msg_class = "RAPID TEST FILE UPLOADED SUCCESSFULLY"; 
          }
        } else {
          $error = "There was an erro uploading the file";
          $msg = "RAPID TEST FILE UPLOADED SUCCESSFULLY";
        }
      }
    }

    //SWAB TEST FILE UPLOAD
$msg = "";
$msg_class = "";
$conn = mysqli_connect("localhost", "root", "", "divimart");
if (isset($_POST['submitSwabTest'])) {
  // for the database
  $profileImageName = time() . '-' . $_FILES["SwabTestfile"]["name"];
  // For image upload
  $target_dir = "SwabTestFiles/";
  $target_file = $target_dir . basename($profileImageName);
  // VALIDATION
  // validate image size. Size is calculated in Bytes
  if($_FILES['SwabTestfile']['size'] > 200000) {
    $msg = "Image size should not be greated than 200Kb";
    $msg_class = "SWAB TEST FILE UPLOADED SUCCESSFULLY";
  }
  // check if file exists
  if(file_exists($target_file)) {
    $msg = "File already exists";
    $msg_class = "SWAB TEST FILE UPLOADED SUCCESSFULLY";
  }
  // Upload image only if no errors
  if (empty($error)) {
    if(move_uploaded_file($_FILES["SwabTestfile"]["tmp_name"], $target_file)) {
        $sql = "UPDATE client_data SET swab_test_file='$profileImageName' WHERE email='$_SESSION[email]'";
      if(mysqli_query($conn, $sql)){
        $msg = "Image uploaded and saved in the Database";
        $msg_class = "alert-success";
      } else {
        $msg = "There was an error in the database";
        $msg_class = "SWAB TEST FILE UPLOADED SUCCESSFULLY"; 
      }
    } else {
      $error = "There was an erro uploading the file";
      $msg = "SWAB TEST FILE UPLOADED SUCCESSFULLY";
    }
  }
}

//CHATROOM LOGIN 
$message = '';
if(isset($_SESSION['user_id']))
{
  header('location:index.php');
}

if(isset($_POST["chat-login"]))
{
 $query = "
   SELECT * FROM chat_login 
    WHERE username = :username
 ";
 $statement = $connect->prepare($query);
 $statement->execute(
    array(
      ':username' => $_POST["username"]
     )
  );
  $count = $statement->rowCount();
  if($count > 0)
 {
  $result = $statement->fetchAll();
    foreach($result as $row)
    {
        $_SESSION['user_id'] = $row['user_id'];
        $_SESSION['username'] = $row['username'];
        $sub_query = "
        INSERT INTO login_details 
        (user_id) 
        VALUES ('".$row['user_id']."')
        ";
        $statement = $connect->prepare($sub_query);
        $statement->execute();
        $_SESSION['login_details_id'] = $connect->lastInsertId();
        header("location:chat_index.php");
    }
 }
 else
 {
  echo'<script type = "text/javascript">alert("Oops! Something went wrong! cant find you username")</script>';
 }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>167 Hypermart</title>
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


<!-- Central Modal Small -->
<div class="modal fade" id="centralModalSm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">

  <!-- Change class .modal-sm to change the size of the modal -->
  <div class="modal-dialog modal-lg" role="document">


    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title w-100" id="myModalLabel">USERS</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="table-responsive-sm" id="roll">
        <input type="search" id="myInput" class="form-control search-input" placeholder="Search" data-table="customers-list" style="margin-top: 10px; width: 90%; margin-left: 20px; border-radius: 20px; padding-left: 15px; margin-bottom: 10px;" >
        <table class="table customers-list" id="myTable">
                <thead>
                    <tr>
                    <th>No</th>
                    <th>Profile</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>QR Image</th>
                    </tr>
                </thead>
                    
                <tbody>
                    <?php
                        $count=1;
                        $email="";
                        $email = $_SESSION['email'];
                        $sql_query="SELECT * FROM howtoqr.qrcodes ORDER BY id ASC;";
                        $result = mysqli_query($con,$sql_query);
                            while($row = mysqli_fetch_assoc($result)) { ?>
                                <tr>
                                    <td class="text-left" style="font-size: 100%;"><?php echo $row["id"]; ?></td>
                                    <td>
                                    <?php
                                        $conn = mysqli_connect("localhost", "root", "", "divimart");
                                        $results = mysqli_query($conn, "SELECT * FROM divimart.users_profile WHERE email = '$row[email]'");
                                        $users2 = mysqli_fetch_all($results, MYSQLI_ASSOC);
                                    ?>
                                    <?php foreach ($users2 as $user):?>
                                        <a href="#"><img  src="<?php echo 'profiles/'. $user['profile_image'] ?>" class="avatar rounded-circle card-img-35 z-depth-1 d-flex mr-3" id="myImg" height="50px" width="50px"></a>
                                    <?php endforeach; ?>
                                    </td>
                                    <td class="text-left" style="font-size: 100%;"><?php echo $row["qrUsername"];?></td>
                                    <td class="text-left" style="font-size: 100%;"><?php echo $row["email"]; ?></td>
                                    <td>
                                    <?php
                                        $conn = mysqli_connect("localhost", "root", "", "howtoqr");
                                        $results = mysqli_query($conn, "SELECT * FROM qrcodes WHERE email = '$_SESSION[email]'");
                                        $users = mysqli_fetch_all($results, MYSQLI_ASSOC);
                                    ?>
                                    <?php foreach ($users as $user):?>
                                        <a href="userQr/<?php echo $row['qrImg'] ?>" target="_blank"><img  src="<?php echo 'userQr/' . $user['qrImg'] ?>" class="rounded-circle card-img-35 z-depth-1 d-flex mr-3" height="50px"></a>
                                    <?php endforeach; ?>
                                    </td>
                                </tr>
                    <?php $count++; } ?>
                
                </tbody>
        </table>
            <style>
                #roll{
                    height: 450px;
                    overflow-y: auto;
                    }
            </style>
        </div>
      </div>
      <div class="modal-footer">
      <small class="text-muted" style="float: left"> © 2020 Copyright: 167 Hypermart</small>
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script>
        (function(document) {
            'use strict';

            var TableFilter = (function(myArray) {
                var search_input;

                function _onInputSearch(e) {
                    search_input = e.target;
                    var tables = document.getElementsByClassName(search_input.getAttribute('data-table'));
                    myArray.forEach.call(tables, function(table) {
                        myArray.forEach.call(table.tBodies, function(tbody) {
                            myArray.forEach.call(tbody.rows, function(row) {
                                var text_content = row.textContent.toLowerCase();
                                var search_val = search_input.value.toLowerCase();
                                row.style.display = text_content.indexOf(search_val) > -1 ? '' : 'none';
                            });
                        });
                    });
                }

                return {
                    init: function() {
                        var inputs = document.getElementsByClassName('search-input');
                        myArray.forEach.call(inputs, function(input) {
                            input.oninput = _onInputSearch;
                        });
                    }
                };
            })(Array.prototype);

            document.addEventListener('readystatechange', function() {
                if (document.readyState === 'complete') {
                    TableFilter.init();
                }
            });

        })(document);
    </script>

<!--- MEDICAL TEST UPLOADING FILES --->

<div class="modal fade" id="modalLRForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog cascading-modal" role="document">
    <div class="modal-content">
      <div class="modal-c-tabs">
        <div class="tab-content">
          <div class="tab-pane fade in show active" id="panel7" role="tabpanel">
            <div class="modal-body mb-1">
                <form action="index.php" method="post" enctype="multipart/form-data">
                <strong>UPLOAD RAPID TEST FILE</strong><br><br>
                    Select Image or PDF File to Upload:
                    <input type="file" name="RapidTestfile" id="RapidTestfile" class="form-control">
                   <button class="btn btn-primary" type="submit" name="submitTest" id="submitTest">Upload</button>
                </form>
            </div>
            <script>
                document.getElementById("submitTest").onclick = function() {
                    if (RapidTestfile.value == ""){
                    alert("No file selected!");
                    return false;
                    } else
                    { 
                        alert("Rapid Test File Uploaded Successfully");
                        return true; 
                    }
                }
            </script>
            <div class="modal-footer">
              <button type="button" class="btn btn-outline-info waves-effect ml-auto" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalLRForm22" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog cascading-modal" role="document">
    <!--Content-->
    <div class="modal-content">

      <!--Modal cascading tabs-->
      <div class="modal-c-tabs">
            <div class="modal-body">
                <form action="index.php" method="post" enctype="multipart/form-data">
                <strong>UPLOAD SWAB TEST FILE</strong><br><br>
                    Select Image or PDF File to Upload:
                    <input type="file" name="SwabTestfile" id="SwabTestfile" class="form-control">
                    <button class="btn btn-primary" type="submit" name="submitSwabTest" id="submitSwabTest">Upload</button>
                </form>
            </div>
            <script>
                document.getElementById("submitSwabTest").onclick = function() {
                    if (SwabTestfile.value == ""){
                    alert("No file selected");
                    return false;
                    } else
                    { 
                        alert("Swab Test File Uploaded Successfully");
                        return true; 
                    }
                }
            </script>

            <div class="modal-footer">
              <button type="button" class="btn btn-outline-info waves-effect ml-auto" data-dismiss="modal">Close</button>
            </div>
      </div>
    </div>
  </div>
</div>

<!--Add Admin-->
<div class="modal fade" id="AddADminProfile" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog cascading-modal modal-avatar modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <img src="images\userimage.png" alt="avatar" class="rounded-circle img-responsive">
      </div>
      <div class="modal-body text-center mb-1">

        <form action="index.php" method="POST">
            <h5 class="mt-1 mb-2">Create Admin</h5>
            <p class="text-left">To add admin account, Please provide registered email address.</p>

            <div class="md-form ml-0 mr-0">
            <input type="password" type="text" id="form29" class="form-control form-control-sm validate ml-0">
            <label data-error="wrong" data-success="right" for="form29" class="ml-0">What's the email address?</label>
            </div>

            <div class="text-center mt-4">
            <button type="submit" name="add-admin" class="btn btn-cyan mt-1">Create Admin <i class="fas fa-sign-in ml-1"></i></button>
            </div>
            </div>
        </form>

    </div>
  </div>
</div>

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
<!--- PROFILE CHANGE MODAL --->
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

<!--- MODAL REQUEST FOR A CHAT --->
<div class="modal fade animated bounceIn" id="enterChatRoom222" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h4 class="modal-title w-100 font-weight-bold text-left" style="color: #3F729B">ENTER CHATROOM</h4>
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
            <span class="img-div"><br>
            <?php
                $conn = mysqli_connect("localhost", "root", "", "divimart");
                $results = mysqli_query($conn, "SELECT * FROM users_profile WHERE email = '$_SESSION[email]'");
                $users = mysqli_fetch_all($results, MYSQLI_ASSOC);
                ?>
                <?php foreach ($users as $user):?>
                    <img  src="<?php echo 'profiles/' . $user['profile_image'] ?>" class="rounded-circle z-depth-0"
                    alt="thumbnail" height="100" id="chatroom" width="100px">
                <?php endforeach; ?>
            </span>     
          </div>
          <div class="text-center">
          <p id="cancel"></p>
            <?php
                $count=1;
                $email="";
                $email = $_SESSION['email'];
                $sel_query="SELECT * FROM `client_information` WHERE email = '$_SESSION[email]'";
                $result = mysqli_query($con,$sel_query);        
                while($row = mysqli_fetch_assoc($result)) { ?>
                <?php if (!$_SESSION['chat_activation']): ?>
                    <small>NOTE: This features requires the administrator permission to enter the Chatroom</small><br>
                    <a class="badge badge-danger" id="send-request">Send request</a>
                    <input href="" type="button" class="btn btn-primary disabled" value="CONTAINUE AS <?php echo $row["firstname"]; echo" "; echo $row["middlename"]; echo" "; echo $row["lastname"] ?>">
                <?php else: ?>
                    <form method="post">
                        <p class="text-danger"><?php echo $message; ?></p>
                        <div class="form-group">
                            <input type="text" name = "username" class="form-control" value="<?php echo $_SESSION['username'] ?>" style="display: none">
                            <input type="submit" href="" target="_blank" name="chat-login" class="btn btn-primary" value="CONTAINUE AS <?php echo $row["firstname"]; echo" "; echo $row["middlename"]; echo" "; echo $row["lastname"] ?>">
                        </div>
                    </form>
                <?php endif; ?>
            <?php $count++; } ?>
        </div>
        </form>  
        <hr>  
      </div>
    </div>
  </div>
</div>
<script>
    document.getElementById("send-request").onclick = function() {
        var txt;
        var r = confirm("Would you like to send a request to activate your chatroom account?");
        if (r == true) {
            window.location.href = "contact.php";
        } else {
            txt = "You pressed Cancel!";
        }
        document.getElementById("cancel").innerHTML = txt;
    }
</script>
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
        height: 210px; width: 210px; margin: 0px auto; border-radius: 50%;
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
                <?php
                    $count=1;
                    $email="";
                    $email = $_SESSION['email'];
                    $sel_query="SELECT * FROM client_information WHERE email = '$_SESSION[email]'";
                    $result = mysqli_query($con,$sel_query);
                        while($row = mysqli_fetch_assoc($result)) { ?>

                <div class="row">
                    <div class="form-group col-md-6">
                        <input type="text" class="form-control" id="id" name="id" value = "<?php echo $_SESSION['id'] ?>" style="display: none;" onkeyup="firstname()">
                        <label for="inputfname">Firstname:</label>
                        <input type="text" class="form-control" id="firstname" name="firstname" onkeyup="firstname()" value="<?php echo $row['firstname'] ?>">
                        <span id="SPname"></span>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputlastname">Lastname:</label>
                        <input type="text" class="form-control" id="lastname" name="lastname" onkeyup="lastname()" value="<?php echo $row['lastname'] ?>">
                        <span id="SPlname"></span>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="inputfname">Middlename:</label>
                        <input type="text" class="form-control" id="middlename" name="middlename" onkeyup="middlename()" value="<?php echo $row['middlename'] ?>">
                        <span id="SPmiddlename"></span>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputlastname">Contact Number:</label>
                        <input type="text" class="form-control" id="contact_number" name="contact_number" onkeyup="contact_number()" value="<?php echo $row['contact_number'] ?>">
                        <span id="SPlcontact_number"></span>
                    </div>

                </div>
            </div>
            <input type="text" id="address2" name="address2" class="form-control mb-4" placeholder="Province Address" value="<?php echo $row['address2'] ?>">
            <span id="address"></span>

            <label for="inputlastname">Current Address:</label>
            <input type="text" id="barangay" name="barangay" class="form-control" placeholder="floor/unit/brgy/st." aria-describedby="defaultRegisterFormPasswordHelpBlock" value="<?php echo $row['barangay'];?>">
            <span id="brgy"></span>
            <small id="defaultRegisterFormPasswordHelpBlock" class="form-text text-muted mb-4">
                Special character included
            </small>

            <input type="text" id="city_municipality" name="city_municipality" class="form-control" placeholder="Municippality" aria-describedby="defaultRegisterFormPhoneHelpBlock" value="<?php echo $row['city_municipality'] ?>">
            <span id="MU"></span>
            <small id="defaultRegisterFormPhoneHelpBlock" class="form-text text-muted mb-4">
                Optional - for two step authentication
            </small>
            <button class="btn btn-info my-4 btn-block" name="profile" id="profile" type="submit"><i class="fas fa-paper-plane"></i> Save changes</button>
            <hr>
            
            <?php $count++; } ?>
        </form>
      </div>

    </div>
  </div>
</div>


<div class="modal top my-5 animated bounceIn" id="modalConfirmDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                <strong>Hi, </strong><input style="text-transform: uppercase; font-size: 16px; text-align:center; width: 90px; border-style: none;" name="username" value="<?php echo $_SESSION['username']?>">
                <p class="t">Tell us what you feel rigth now!</p>
                <!-- Material input -->
                <div class="md-form">
                    <input type="text" id="form1" class="form-control" name="temperature">
                    <label for="form1"><strong>Temperature:</strong></label>
                    <span id="temp"></span>

                <!-- Default unchecked -->
                
                <div class="custom-control custom-checkbox" style="margin-left: 25px; margin-top:12px;">
                    <input type="checkbox" class="custom-control-input" id="defaultIndeterminate1" name="check_list[]" value="Shortness of breath or difficulty breathing">
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
    <!-- Quarantine Modal -->
    <div class="modal fade animated bounceIn" id="modalSocial" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
            <div class="modal-dialog cascading-modal" role="document">
                <div class="modal-content">
                    <div class="modal-header light-blue darken-3 white-text">
                        <h4 class="title"><i class="fas fa-key"></i> Add Quarantine Status</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span>
                        </button>
                    </div>
                        <form action="" method = "POST">
                            <div class="modal-body mb-0 text-left">
                                <div class="animated fadeIn form-group" id="content2">
                                    <div class="login100-form-logo" style="text-align: center; margin-top: -50px;">
                                        <img src="images/167 Hypermart Logo 2b.png" alt="" style="width: 180px;">
                                    </div>
                                    <br><br>
                                    <p for="are_you_currently_on_strict_quarantine">Are you currently on Strict Quarantine?</p><br>
                                    <input type="text" name="email" id="email" value="<?php echo $_SESSION['email'] ?>" style="display: none;">
                                    <select id="q1" name="are_you_currently_on_strict_quarantine" class="form-control"style="text-transform: uppercase" onkeyup="q1()">
                                        <option></option>
                                        <option>YES</option>
                                        <option>NO</option>
                                    </select>
                                    <span id="SPq1"></span>

                                    <div class="form-group animated fadeIn" id="show1" style= "margin-top: 10px; display: none;">
                                        
                                            <p for="inputyes">2. Specify the date range of quarantine. </p>

                                            <p style = "margin-top: 10px">Start Date:</p>
                                            <input type="date" name="start_date" id="start_date" class="form-control">

                                            <p style = "margin-top: 10px">End Date:</p>
                                            <input type="date" name="end_date" id="end_date" class="form-control">

                                            <p style = "margin-top: 10px">3. Having a close contact with anyone during Quarantine period.?</p>
                                            <select id="close_contact" name="close_contact" class="form-control">
                                                <option selected></option>
                                                <option>YES</option>
                                                <option>NO</option>
                                            </select>

                                            <p style = "margin-top: 10px">4. Having a close contact with anyone who is identified as COVID19 Positive, a PUI or PUM.?</p>
                                            <select id="positive_contact" name="positive_contact" class="form-control">
                                                <option selected></option>
                                                <option>YES</option>
                                                <option>NO</option>
                                            </select>

                                            <p style = "margin-top: 10px">5. Quarantine Facility</p>
                                            <select id="quarantine_facility" name="quarantine_facility" class="form-control">
                                                <option selected></option>
                                                <option>Home</option>
                                                <option>Hospital</option>
                                                <option>Quarantine Facility</option>    
                                            </select>

                                            <label for="loacation" style = "margin-top: 10px">6. Quarantine Address</label>
                                            <input type="text" name="quarantine_address" id="quarantine_address" class="form-control">
                                            <br>
                                    </div>
                                    <div class="modal-footer justify-content-center">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i> Close</button>
                                        <button type="submit" name="submitQ" id="submit" class="btn btn-primary" onclick="submit()"><i class="fas fa-paper-plane"></i> Save changes</button>
                                        
                                    </div>
                                    <hr class="my-2">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    </div>

    <div class="modal fade animated bounceIn" id="modalSocial2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog cascading-modal" role="document">
            <div class="modal-content">
            <div class="modal-header light-blue darken-3 white-text">
                <h4 class="title"><i class="fas fa-stethoscope"></i> Add Swab Test</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
            </div>
                <div class="modal-body mb-0 text-left">
                    <form action="" method="POST">
                        <div class="form2 animated fadeIn" id = "form2">
                            <div class="login100-form-logo" style="text-align: center; margin-top: -50px;">
                                <img src="images/167 Hypermart Logo 2b.png" alt="" style="width: 180px;">
                            </div>
                            <br>
                                <p for="rapid_test">Have you undergo Swab Testing.?</p><br>
                            <select id="swab_testing" name="swab_testing" class="form-control" oninput="swab_testing()">
                                <option></option>
                                <option>YES</option>
                                <option>NO</option>
                            </select>
                            <span id="SPswab_testing"></span>
                            <br>
                            <div class="form-group animated fadeIn" style="display: none" id="swab">
                                <label for="inputyes">Swab Result.?</label>
                                <select id="swab_result" name="swab_result" class="form-control">
                                    <option selected></option>
                                    <option>Positive</option>
                                    <option>Negative</option>
                                    <option>Not yet result</option>
                                </select>
                                <br>
                                <label for="Date">Swab Date</label>
                                <input type="date" name="swab_date" id="swab_date" class="form-control">
                                <br>
                                <label for="loacation">Swab place</label>
                                    <input type="text" name="swab_place" id="swab_place" class="form-control">
                                    <br>
                            </div>
                            <div class="modal-footer justify-content-center">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i> Close</button>
                                <button type="submit" name="submit2" id="submit2" class="btn btn-primary" onclick="submit2()"><i class="fas fa-paper-plane"></i> Save changes</button>
                                <input type="text" name="email" id="email" value="<?php echo $_SESSION['email'] ?>" style="display: none;">
                            </div>    
                            <hr class="my-2">
                        </div>
                    </form>                           
                </div>
            </div>
        </div>
    </div>
<!--Rapid: Test Modal-->

    <div class="modal fade animated bounceIn" id="modalSocial3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog cascading-modal" role="document">
            <div class="modal-content">
                <div class="modal-header light-blue darken-3 white-text">
                    <h4 class="title"><i class="fas fa-stethoscope"></i> Add Rapid Test</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body mb-0 text-left">
                    <div class="form animated fadeIn" id="form">
                        <div class="login100-form-logo" style="text-align: center; margin-top: -50px;">
                            <img src="images/167 Hypermart Logo 2b.png" alt="" style="width: 180px;">
                        </div>
                        <br>
                           <form action="" method = "POST">
                                <input type="text" name = "email" id = "email" value="<?php echo $_SESSION['email'] ?>" style="display: none;">
                                <label for="rapid_test">Have you undergo rapid testing.?</label><br>
                                    <select id="rapid_testing" name="rapid_testing" class="form-control" onclick="rapid_testing()">
                                        <option></option>
                                        <option>YES</option>
                                        <option>NO</option>
                                    </select>
                                    <span id="SPrapid_testing"></span>

                                    <br>
                                    <div class="form-group animated fadeIn" style="display: none" id="rapid">
                                        <label for="inputyes">Test Result.?</label>
                                        <select id="test_result" name="test_result" class="form-control">
                                            <option selected></option>
                                            <option>Positive</option>
                                            <option>Negative</option>
                                            <option>Not yet result</option>
                                        </select>
                                        <br>
                                        <label for="Date">Date</label>
                                        <input type="date" name="test_date" id="test_date" class="form-control">
                                    
                                        <br>
                                        <label for="loacation">Location held.?</label>
                                        <input type="text" name="test_location" id="test_location" class="form-control">
                                        <br>
                                    </div>
                                    <div class="modal-footer justify-content-center">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i> Close</button>
                                        <button type="submit" name="next3" id="btn" class="btn btn-primary"><i class="fas fa-paper-plane"></i> Save changes</button>
                                    </div>
                                    <hr class="my-2">
                           </form>
                            
                    </div>                    
                </div>
            </div>
        </div>
    </div>
    <!--Modal: Place Visited-->

    <div class="modal fade animated bounceIn" id="modalSocial4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog cascading-modal" role="document">
            <form action="" method="POST">
                <div class="modal-content">
                    <div class="modal-header light-blue darken-3 white-text">
                        <h4 class="title"><i class="fas fa-map-marker-alt"></i> Add Place Visited</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                            
                    </div>
                    <div class="modal-body mb-0 text-left">
                        <div class="login100-form-logo" style="text-align: center; margin-top: -50px;">
                            <img src="images/167 Hypermart Logo 2b.png" alt="" style="width: 180px;">
                        </div>
                        <input type="text" name="username" style="display: none;" value="<?php echo $_SESSION['username']?> ">            
                        <input type="text" name="email" style="display: none;" value="<?php echo $_SESSION['email']?> "><br>
                        <p>Temperature:</p>           
                        <input type="text" class="form-control" name="temperature" id="temperature"> 

                        <p>Place/Location:</p>           
                        <input type="text" class="form-control" name="place_visited" id="place_visited">   
                        <p>Date:</p>
                        <input type="datetime-local" class="form-control" name="date_visited" id="date_visited">
                        <span id="modalConfirmDeleteErr"></span>
                        <div class="modal-footer justify-content-center">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i> Close</button>
                            <button type="submit" name="place-visited" id="place-visited" class="btn btn-primary"><i class="fas fa-paper-plane"></i> Save changes</button>
                        </div>
                        <hr class="my-2">
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
            <a href="QR attendance.php" class="card-img-100 d-inline-flex justify-content-center align-items-center rounded-circle grey lighten-3 hoverable animated bounceIn" style="width: 40px; height: 40px; margin-top: -5px; margin-right: 5px; color: #0d47a1"><i class="fas fa-camera"></i></a>
            <a href="" class="card-img-100 d-inline-flex justify-content-center align-items-center rounded-circle grey lighten-3 hoverable animated bounceIn" style="width: 40px; height: 40px; margin-top: -5px; margin-right: 5px; color: #0d47a1" data-toggle="modal" data-target="#modalSubscriptionForm222"><i class="fas fa-user-alt"></i></a>
            <a href="navbarDropdownMenuLink-4" class="text-right d-inline-flex justify-content-center align-items-center nav-link dropdown-toggle widget-subheading " data-toggle="dropdown"aria-haspopup="true" style="width: 40px; height: 40px; margin-top: -5px; color: #0d47a1"><i class="fas fa-cog"></i></a>
            <div class="dropdown-menu dropdown-menu-right dropdown-info animated fadeIn z-depth-1" aria-labelledby="navbarDropdownMenuLink-4">
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
                    <a class="navbar-brand" href="index.php"><img src="images/167 Hypermart Logo 2b.png" alt="" width="120px" class="animated rubberBand infinite slow delay-1s"></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#basicExampleNav"
                        aria-controls="basicExampleNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="basicExampleNav">
                        <ul class="navbar-nav mr-auto text-uppercase">
                            <li class="nav-item active">
                                <a class="nav-link font-weight-normal" href="index.php"><i class="fas fa-home"></i> Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" data-toggle="modal" data-target="#fullHeightModalRight"><i class="fas fa-briefcase-medical"></i> Health check</a>
                            </li>
                            <?php if (!$_SESSION['administrator']): ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="#" id="QRclick"><i class="fas fa-qrcode"></i> QR Code</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#" id="sendMSG"><i class="far fa-envelope-open"></i> Message Us</a>
                                </li>
                                <?php else: ?>
                                    <li class="nav-item">
                                    <a class="nav-link" href="#" id="QRclick"><i class="fas fa-qrcode"></i> QR Code</a>
                                </li>
                                <li class="nav-item">
                                <a class="nav-link" href="#" id="QRclickd" data-toggle="modal" data-target="#centralModalSm"><i class="fas fa-qrcode"></i> Users</a>
                                </li>
                                    
                                <?php endif; ?>
                        </ul>
                        <!-- Links -->
                        
                        <ul class="nav navbar-nav nav-flex-icons ml-auto">
                                <li class="nav-item" style = "color: black;">
                                        <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-4" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false" name="email">
                                        <?php echo $_SESSION['email'] ?></a>
                                </li>
                                <?php if (!$_SESSION['administrator']): ?>
                                    <li class="nav-item dropdown" style = "color: black;">
                                        <a class="nav-link widget-subheading" data-toggle="modal" data-target="#enterChatRoom222">
                                        <i class="fas fa-envelope"></i></a>
                                    </li>
                                    <?php else: ?>
                                    
                                    <li class="nav-item dropdown" style = "color: black;">
                                            <a class="nav-link widget-subheading" id="navbarDropdownMenuLink-4" data-toggle="modal" data-target="#enterChatRoom222"><span class="label label-pill label-danger badge red z-depth-1 mr-0" style="margin-left:10px;border-radius:10px;"></span>
                                            <i class="fas fa-envelope"></i></a>
                                    </li>

                                    <li class="nav-item dropdown">
                                        <a href="" class="nav-link widget-subheading notifMSG" data-toggle="dropdown"><span class="label label-pill label-danger count badge red z-depth-1 mr-0" style="border-radius:10px;"></span> <i class="fas fa-bell"></i></span></a>
                                         
                                        <ul class="dropdown-menu notify dropdown-menu-right" style="text-align: left; padding: 5px; width: 300px;">
                                        </ul>
                                    </li>
                                <?php endif;?>
                                <li class="nav-item dropdown" style = "color: black;">
                                        <a class="nav-link dropdown-toggle widget-subheading" id="navbarDropdownMenuLink-4" data-toggle="modal" data-target="#basicExampleModal101"
                                        aria-haspopup="true" aria-expanded="false" name="email">
                                        <i class="fas fa-user-cog"></i></a>
                                </li>
                                <a type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalConfirmDelete"style="border-radius: 20px;">Logout <i class="fas fa-chevron-circle-left"></i></a>
                                <li class="nav-item avatar" style = "color: black;">
                                    <a class="nav-link p-0" href="#">
                                    <?php
                                        $conn = mysqli_connect("localhost", "root", "", "divimart");
                                        $results = mysqli_query($conn, "SELECT * FROM users_profile WHERE email = '$_SESSION[email]'");
                                        $users = mysqli_fetch_all($results, MYSQLI_ASSOC);
                                        ?>
                                    <?php foreach ($users as $user):?>
                                        <img  src="<?php echo 'profiles/' . $user['profile_image'] ?>" class="avatar rounded-circle card-img-35 z-depth-1 d-flex mr-3" id="userProfile"
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
                    <div class="row animated">
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
                                        <small>Scan you QR to our partner establishments</small>
                                    </div>
                                </div>
                            </as>
                        </div>              
                    </div>
                </div>

                <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
                <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
                <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
                <script src="https://cdn.rawgit.com/mervick/emojionearea/master/dist/emojionearea.min.js"></script>
                        <div class="container animated jackInTheBox" id="messageshow" style="display: none;">
                    <nav class="navbar navbar-inverse">
                        <div class="container-fluid">
                        <div class="navbar-header">
                        <a class="navbar-brand" href="#">Message us</a>
                        </div>
                        </div>
                    </nav>
                    <br />
                    <form method="post" action="index.php" id="comment_form">
                        <div class="form-group">
                            <label>FROM:</label>
                                <input type="email" name="email" class="form-control disabled" id="" value = "<?php echo $_SESSION['email'] ?>">
                            </div>
                        
                        
                        <div class="form-group">
                        <label>Enter Subject</label>
                        <input type="text" name="subject" id="subject" class="form-control" value = "<?php echo $_SESSION['username'] ?>">
                        </div>
                        <div class="form-group">
                        <label>Enter Comment</label>
                        <textarea name="comment" id="comment" class="form-control" rows="5"></textarea>
                        </div>
                        <div class="form-group">
                        <button type="submit" name="post" id="post" class="btn btn-info" value="Post">SEND</button>
                        </div>
                    </form>
                </div>
                <script>
                    $(document).ready(function(){
                    
                    function load_unseen_notification(view = '')
                    {
                    $.ajax({
                    url:"fetch.php",
                    method:"POST",
                    data:{view:view},
                    dataType:"json",
                    success:function(data)
                    {
                        $('.notify').html(data.notification);
                        if(data.unseen_notification > 0)
                        {
                        $('.count').html(data.unseen_notification);
                        }
                    }
                    });
                    }
                    
                    load_unseen_notification();
                    
                    $('#comment_form').on('submit', function(event){
                    event.preventDefault();
                    if($('#subject').val() != '' && $('#comment').val() != '')
                    {
                    var form_data = $(this).serialize();
                    $.ajax({
                        url:"insert.php",
                        method:"POST",
                        data:form_data,
                        success:function(data)
                        {
                        $('#comment_form')[0].reset();
                        load_unseen_notification();
                        }
                    });
                    }
                    else
                    {
                    alert("Both Fields are Required");
                    }
                    });
                    
                    $(document).on('click', '.notifMSG', function(){
                    $('.count').html('');
                    load_unseen_notification('yes');
                    });
                    
                    setInterval(function(){ 
                    load_unseen_notification();; 
                    }, 5000);
                    
                    });
                </script>

                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-4 animated bounceInLeft" style="margin-top: 10px;">
                            <as href="#!" class="hoverable">
                                <div class="card">
                                    <div class="card-header">
                                    <i class="fas fa-user-cog" style="color: #3F729B"></i><strong style="color: #3F729B"> PROFILE</strong>
                                    </div>
                                    <div class="card-body text-center">
                                    <form action="" method="post">
                                        <h5><?php if (isset($_SESSION['message'])):?></h5>
                                        <div class="alert alert-info alert-dismissible fade show" role="alert" style="margin-top: -20px; padding: 2px;">
                                        <p>
                                        
                                        <p><?php echo $_SESSION['message']; echo $_SESSION['username']?></p>
                                        <?php
                                            unset($_SESSION['message']);
                                            unset($_SESSION['alert-class']);
                                        ?>
                                        </p>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        </div>
                                        <?php endif;?>
                                        
                                        <?php if (!$_SESSION['verified']): ?>
                                        <div class="alert alert-info alert-dismissible fade show" role="alert" style = "padding-left: 15px; padding-right: 15px;">
                                            <p>We need to verify your account, click send code and login to your email copy and paste the verification code and verify your account!</p>
                                            <br>
                                            <input type = "text" name= "email" id="email" style="border-style: none; background-color: transparent;  width:100%; text-align: center;" value="<?php echo $_SESSION['email'];?>">
                                        </div>
                                        <button type="submit" name="btn-submit" id="btn-submit" class="btn btn-info" style="width: 100%">Send code</button>
                                         <p class="text-muted text-right">Account not verified</p>
                                        <?php else: ?>
                                            <div class="row">
                                                <div class="container-fluid">
                                                    <section class="dark-grey-text">
                                                        <div class="card-body">
                                                            <div class="row">
                                                                <div class="col-sm-12 text-center" style="width: 100%; margin-top: -30px;">
                                                                    <i class="text-muted"style="font-size: 12px; float:right; ">VERIFIED</i><br>
                                                                    <strong style="color: #3F729B">PERSONAL INFORMATION</strong><br>
                                                                        <?php
                                                                            $count=1;
                                                                            $email="";
                                                                            $email = $_SESSION['email'];
                                                                            $sel_query="SELECT * FROM users_profile WHERE email = '$_SESSION[email]'";
                                                                            $result = mysqli_query($con,$sel_query);
                                                                            while($row = mysqli_fetch_assoc($result)) { ?>
                                                                            <tr>
                                                                            <td class="text-muted text-center"><i style="font-size: 12px;"><i class="fas fa-quote-right"></i> <?php echo $row['bio'] ?></i></td>
                                                                            </tr> 
                                                                        <?php $count++; } ?>
                                                                        <br>
                                                                    <table style="width: 100%; margin-top: -60px" class="table">
                                                                        <thead class="text-center">
                                                                        </thead>
                                                                        <tbody>
                                                                            <p name="email" style="display:none;"><?php echo $_SESSION['email']; ?></p>
                                                                            <?php
                                                                                $count=1;
                                                                                $email="";
                                                                                $email = $_SESSION['email'];
                                                                                $sel_query="SELECT * FROM `client_information` WHERE email = '$_SESSION[email]'";
                                                                                $result = mysqli_query($con,$sel_query);
                                                                                while($row = mysqli_fetch_assoc($result)) { ?>
                                                                                            
                                                                                <tr>
                                                                                    <th class="text-left"><strong>Complete name:</strong></th>
                                                                                    <td class="text-center text-muted" style="text-transform: uppercase"><?php echo $row["firstname"]; echo" "; echo $row["middlename"]; echo" "; echo $row["lastname"] ?></td>
                                                                                </tr><br>
                                                                                <tr>
                                                                                    <th class="text-left"><strong>Mobile Number: </strong></th>
                                                                                    <td class="text-center text-muted">+63 <?php echo $row["contact_number"]; ?></td>
                                                                                </tr><br>

                                                                                <tr>
                                                                                    <th class="text-left"><strong>Address: </strong></th>
                                                                                    <td class="text-muted text-center">Barangay<?php echo" "; echo $row["barangay"]; echo" "; echo $row["city_municipality"] ?></td>           
                                                                                </tr><br>
                                                                            <?php $count++; } ?>
                                                                        </tbody>
                                                                    </table>             
                                                                </div>
                                                            </div>
                                                        </div>    
                                                    </section>
                                                    <div class="text-center" style="width: 100%;">
                                                        <a href="#" class="btn btn-secondary btn-sm" data-dismiss="modal"data-toggle="modal" data-target="#modalSocial22"> PROFILE</a>
                                                        <a href="forget-password.php" class="btn btn-primary btn-sm"> Change Password</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                        </div>
                                        <hr>
                                    </div>
                            </as>
                        </div>
                        <div class="col-md-8 animated fadeInDown">
                            <div class="card" style="margin-top: 10px;">
                            <as href="#!" class="hocverable">
                                <div class="card-header">
                                    <i class="fas fa-map-marked" style="color: #3F729B"></i></i><strong style="color: #3F729B"> TRAVEL HISTORY</strong>
                                </div>
                                <div class="container-fluid">
                                        <div class="row" style="width: 100%;">                                          
                                            <div class="col-sm-8" style="padding-right: 0px">
                                                <div class="roll">
                                                <?php if (!$_SESSION['administrator']): ?>
                                                            <?php else: ?>
                                                                <input type="text" id="search_text" class="form-control" placeholder="Search" style="margin-top: 10px; width: 90%; margin-left: 20px; border-radius: 20px; padding-left: 15px; margin-bottom: 10px;" >
                                                        <?php endif; ?><br>
                                                    <table class="table text-center" id="table-data" style="width: 100%; margin-top: -100px; font-size:13px;">
                                                        
                                                        <thead>
                                                            <th><b style="font-size: 80%; color: #092855"><i class="fas fa-temperature-low" style="color: #3F729B"></i> TEMP</b></th><br>
                                                            <?php if (!$_SESSION['administrator']): ?>
                                                                <?php else: ?>
                                                            <th><b style="font-size: 80%; color: #092855"><i class="fas fa-home" style="color: #3F729B"></i> USERNAME</b></th><br>
                                                            <?php endif; ?>
                                                            <th><b style="font-size: 80%; color: #092855"><i class="fas fa-home" style="color: #3F729B"></i> PLACE VISITED</b></th><br>
                                                            <th><b style="font-size: 80%; color: #092855"><i class="fas fa-map-marker-alt" style="color: #3F729B"></i> LOCATION</b></th><br>
                                                            <th><b style="font-size: 80%; color: #092855"><i class="fas fa-clock" style="color: #3F729B"></i> TIME-IN</b></th>   
                                                        </thead>
                                                        <?php if (!$_SESSION['administrator']): ?>
                                                            <?php
                                                                $count=1;
                                                                $email="";
                                                                $email = $_SESSION['email'];
                                                                $sel_query="SELECT * FROM place_visited WHERE email = '$_SESSION[email]'";
                                                                $result = mysqli_query($con,$sel_query);
                                                                while($row = mysqli_fetch_assoc($result)) { ?>
                                                                <tr>
                                                                    <td class="text-left"><?php echo $row["temperature"]; ?></td>
                                                                    <td class="text-left"><?php echo $row["place_visited"]; ?></td>
                                                                    <td class="text-left"><?php echo $row["location_address"]; ?></td>
                                                                    <td class="text-left"><?php echo $row["date_visited"]; ?></td>
                                                                </tr>
                                                            <?php $count++; } ?>
                                                            <?php else: ?>
                                                                <?php
                                                                    $count=1;
                                                                    $email="";
                                                                    $email = $_SESSION['email'];
                                                                    $sql_query="SELECT * FROM place_visited ORDER BY id ASC;";
                                                                    $result = mysqli_query($con,$sql_query);
                                                                    while($row = mysqli_fetch_assoc($result)) { ?>
                                                                    <tr>
                                                                    <td class="text-left" style="font-size: 100%;"><?php echo $row["temperature"]; ?></td>
                                                                    <td class="text-left" style="font-size: 100%;"><?php echo $row["username"]; ?></td>
                                                                    <td class="text-left" style="font-size: 100%;"><?php echo $row["place_visited"]; ?></td>
                                                                    <td class="text-left" style="font-size: 100%;"><?php echo $row["location_address"]; ?></td>
                                                                    <td class="text-left" style="font-size: 100%;"><?php echo $row["date_visited"]; ?></td>
                                                                    </tr>

                                                                <?php $count++; }?>
                                                        <?php endif; ?>
                                                        
                                                    </table>
                                                </div>
                                            </div>
                                            <style>
                                                .roll{
                                                    height: 350px;
                                                    overflow-y: auto;
                                                }
                                            </style>
                                            <div class="col-sm-4" style="width: 100%; margin-top: 30px;">
                                                <span class="card-img-100 d-inline-flex justify-content-center align-items-center rounded-circle grey lighten-3 mr-4" style="width: 80px; height: 80px;">
                                                    <i class="fas fa-user-md fa-2x green-text"></i>
                                                </span>
                                                    <table style="width: 100%; font-size: 100%;" class="text-center">
                                                        <strong style="font-size: 90%; color: #3F729B">MEDICAL HISTORY</strong>
                                                        <thead>
                                                            <th><b style="font-size: 100%; color: #092855"><i class="fas fa-vial" style="color: #3F729B"></i> COVID19 Tested?</b><hr></th><br>
                                                            <th><b style="font-size: 100%; color: #092855"><i class="fas fa-caret-right" style="color: #3F729B"></i> RESULT</b><hr></th>
                                                            
                                                        </thead>
                                                        <?php
                                                            $count=1;
                                                            $email="";
                                                            $email = $_SESSION['email'];
                                                            $sel_query="SELECT * FROM client_data WHERE email = '$_SESSION[email]'";
                                                            $result = mysqli_query($con,$sel_query);
                                                            while($row = mysqli_fetch_assoc($result)) { ?>
                                                            <tr>
                                                                <th><a href="" class="card-img-100 d-inline-flex justify-content-center align-items-center rounded-circle grey lighten-3 animated bounceIn" title="Add Rapid Test File" style="width: 40px; height: 40px; margin-top: -5px; margin-right: 5px; color: #0d47a1" data-toggle="modal" data-target="#modalLRForm"><i class="fas fa-file-medical"></i></a> RAPID TESTING: <strong class="text-muted"><?php echo $row['rapid_testing'] ?></strong></th>
                                                                <td class="text-center"><?php echo $row["test_result"]; ?><hr></td>
                                                            </tr><br>
                                                            <tr>
                                                                <th> <a href="" class="card-img-100 d-inline-flex justify-content-center align-items-center rounded-circle grey lighten-3 animated bounceIn" title="Add Swab Test File" style="width: 40px; height: 40px; margin-top: -5px; margin-right: 5px; color: #0d47a1" data-toggle="modal" data-target="#modalLRForm22"><i class="fas fa-file-medical"></i></a> SWAB TESTING: <strong class="text-muted"><?php echo $row['swab_testing'] ?></strong></th>  
                                                                <td class="text-center" style="color: green;"><?php echo $row["swab_result"]; ?><hr></td> 
                                                            </tr>
                                                            
                                                               
                                                               
                                                    <?php $count++; } ?>
                                                    </table><br>
                                                    <?php
                                                        $count=1;
                                                        $email="";
                                                        $email = $_SESSION['email'];
                                                        $sql_query="SELECT * FROM  client_data WHERE email = '$_SESSION[email]'";
                                                        $result = mysqli_query($con,$sql_query);
                                                            while($row = mysqli_fetch_assoc($result)) { ?>
                                                                <div class="text-center">
                                                                    <a href="RapidTestFiles/<?php echo $row["rapid_test_file"]; ?>" target="_blank" style="font-size:12px;"><?php echo $row["rapid_test_file"]; ?></a>
                                                                    <a href="SwabTestFiles/<?php echo $row["swab_test_file"]; ?>" target="_blank" class="text-left" style="font-size:12px;"><?php echo $row["swab_test_file"]; ?></a>
                                                                </div>
                                                    <?php $count++; }?>
                                            </div>
                                        </div>
                                </div>
                                <hr>
                            </div>
                            </as>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8 animated fadeInLeft" style="margin-top: 10px;">
                            <as href="#!" class="hoverable">
                                <div class="card">
                                    <div class="card-header">
                                        <i class="fas fa-chart-bar" style="color: #3F729B"></i><strong style="color: #3F729B"> 167 HYPERMART COVID19 CHART</strong>
                                    </div>
                                    <div class="card-body text-center">
                                        <div id="chartContainer" style="height: 370px; width: 100%;"></div>
                                    </div>
                                </div>
                            </as>
                        </div>
                        <script>
                                window.onload = function () {
                                    
                                var chart = new CanvasJS.Chart("chartContainer", {
                                    animationEnabled: true,
                                    theme: "light2", // "light1", "light2", "dark1", "dark2"
                                    title:{
                                        text: "COVID19 Result as of Today"
                                    },
                                    axisY: {
                                        title: "COVID19 Case"
                                    },
                                    data: [{        
                                        type: "column",  
                                        showInLegend: true, 
                                        legendMarkerColor: "grey",
                                        legendText: "Results updated from time to time",
                                        dataPoints: [      
                                            { y: 15, label: "CONFIRMED CASE" },
                                            { y: 14,  label: "ACTIVE" },
                                            { y: 12,  label: "DIED" },
                                            { y: 10,  label: "RECOVERED" },
                                            { y: 13,  label: "ACTIVE FOR SWABBING" },
                                            { y: 9, label: "ACTIVE AWAITING FOR RESULTS" },
                                            { y: 8,  label: "PUM" },
                                            { y: 18,  label: "TOTAL PUI WITH NEGATIVE RESULTS" }
                                        ]
                                    }]
                                });
                                chart.render();
                                }
                            </script>
                        <div class="col-md-4 animated slideInRight" style="margin-top: 10px;">
                            <as href="#!" class="hoverable">
                                <div class="card">
                                    <div class="card-header">
                                        <i class="fas fa-file-medical-alt" style="color: #3F729B"></i> <strong style="color: #3F729B"><b>PERSONAL STATISTICS</b></strong>
                                    </div>
                                    <div class="card-body text-center" >
                                        <h5 class="card-title" style="color: #092855"># NOT APPLICABLE</h5>
                                        <p class="text-muted"><i>Curently on active Quarantine? _ </i>
                                        
                                        <?php
                                        $count=1;
                                        $email="";
                                        $email = $_SESSION['email'];
                                        $sel_query="SELECT * FROM client_data WHERE email = '$_SESSION[email]'";
                                        $result = mysqli_query($con,$sel_query);
                                        while($row = mysqli_fetch_assoc($result)) { ?>
                                        <tr>
                                        <td class="text-left" style="color: red;"> <?php echo $row["are_you_currently_on_strict_quarantine"]; ?><hr></td>
                                        </tr>
                                        <?php $count++; } ?>
                                        </p>
                                        <button type="button" class="btn btn-primary" style="width: 95%" data-toggle="modal" data-target="#modalSocial"><i class="fas fa-plus-square"></i> Add Quaratine Status</button>
                                        <button type="button" class="btn btn-primary" style="width: 95%" data-toggle="modal" data-target="#modalSocial2"><i class="fas fa-plus-square"></i> Add Swad Test Result</button>
                                        <button type="button" class="btn btn-primary" style="width: 95%" data-toggle="modal" data-target="#modalSocial3"><i class="fas fa-plus-square"></i> Add Rapid Test Result</button>
                                        <button type="button" class="btn btn-primary" style="width: 95%" data-toggle="modal" data-target="#modalSocial4"><i class="fas fa-plus-square"></i> Add Visited Place</button>
                                    </div>
                                        <div class="card-footer text-muted" style="font-size: 13px;">
                                            Update your status once in a month!
                                        </div>
                                    </div>
                                </div>
                            </as>
                        </div>
                    
                    <?php endif;?>
                </div>
            </div>
        </div><br>
            <div class="card-footer text-muted" style="font-size: 13px; width: 100%;">
                © 2020 Copyright: 167 Hypermart
            </div>
            
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
                document.getElementById("submit").onclick = function () {
                    if (q1.value ==""){
                        document.getElementById("SPq1").innerHTML="Fields is required *";
                        document.getElementById("SPq1").style.color = "red";
                        document.getElementById("SPq1").style.display = "block";
                        return false;
                    }else{
                        document.getElementById("submit").innerHTML = "Please Wait...";
                        var loading;
                        loading = setTimeout(btnload, 3000);
                        function btnload() {
                        document.getElementById("submit").innerHTML = "SUBMIT";
                        return true;
                        }
                    }
                }

                document.getElementById("q1").onclick = function () {
                    if (q1.value == ""){
                        document.getElementById("SPq1").innerHTML = "Fields is required *";
                        document.getElementById("SPq1").style.display = "block";
                        document.getElementById("SPq1").style.color = "red";
                        document.getElementById("show1").style.display = "none";
                    }
                }
                    document.getElementById("q1").oninput = function() {
                    if(q1.value === ""){
                        document.getElementById("SPq1").innerHTML = "Fields is required *";
                        document.getElementById("SPq1").style.display = "block";
                        document.getElementById("SPq1").style.color = "red";
                        document.getElementById("show1").style.display = "none";
                    }
                    if (q1.value =="YES"){
                        document.getElementById("show1").style.display = "block";
                    }
                    
                    if (q1.value =="NO"){
                        document.getElementById("show1").style.display = "none";
                        document.getElementById("SPq1").style.display = "none";
                    } 
                    
                    else{
                        document.getElementById("SPq1").style.display = "none";
                        return true;
                    }
                }

                document.getElementById("submit2").onclick = function () {
                    if (swab_testing.value == ""){
                        document.getElementById("SPswab_testing").innerHTML = "Field is required *";
                        document.getElementById("SPswab_testing").style.display = "block";
                        document.getElementById("SPswab_testing").style.color = "red";
                        document.getElementById("swab").style.display = "none";
                        return false;

                    }else{
                        document.getElementById("submit2").innerHTML = "Please Wait...";
                        var loading;
                        loading = setTimeout(btnload, 3000);
                        function btnload() {
                        document.getElementById("submit2").innerHTML = "SUBMIT";
                        return true;
                        }
                    }
                }

                document.getElementById("swab_testing").oninput = function () {
                    if (swab_testing.value == "YES") {
                        document.getElementById("swab").style.display = "block";
                        document.getElementById("SPswab_testing").style.display = "none";

                    }else if (swab_testing.value == "NO"){
                        document.getElementById("swab").style.display = "none";
                        document.getElementById("SPswab_testing").style.display = "none";

                    }else if (swab_testing.value == ""){
                        document.getElementById("SPswab_testing").innerHTML = "Field is required *";
                        document.getElementById("SPswab_testing").style.display = "block";
                        document.getElementById("SPswab_testing").style.color = "red";
                        document.getElementById("swab").style.display = "none";

                        return false
                    }
                }

                document.getElementById("btn").onclick = function () {
                    if (rapid_testing.value == ""){
                        document.getElementById("SPrapid_testing").innerHTML = "Field is required *";
                        document.getElementById("SPrapid_testing").style.display = "block";
                        document.getElementById("SPrapid_testing").style.color = "red";
                        return false;
                    }
                }
                document.getElementById("rapid_testing").oninput = function () {
                    if (rapid_testing.value == "YES"){
                        document.getElementById("SPrapid_testing").style.display = "none";
                        document.getElementById("rapid").style.display = "block";

                    }else if (rapid_testing.value == "NO"){
                        document.getElementById("rapid").style.display = "none";
                        document.getElementById("SPrapid_testing").style.display = "none";

                    }else if (rapid_testing.value == ""){
                        document.getElementById("rapid").style.display = "none";
                        document.getElementById("SPrapid_testing").innerHTML = "Field is required *";
                        document.getElementById("SPrapid_testing").style.display = "block";
                        document.getElementById("SPrapid_testing").style.color = "red";
                        return false;
                    }
                }
                document.getElementById("place-visited").onclick = function () {
                    if (place_visited.value == ""){
                        document.getElementById("modalConfirmDeleteErr").style.display = "block"
                        document.getElementById("modalConfirmDeleteErr").innerHTML = "Field is required *";
                        document.getElementById("modalConfirmDeleteErr").style.color = "red";
                        return false;
                    }
                    true;
                }

                document.getElementById("place_visited").oninput = function () {
                    if (place_visited.value == ""){
                        document.getElementById("modalConfirmDeleteErr").style.display = "block"
                        document.getElementById("modalConfirmDeleteErr").innerHTML = "Field is required *";
                        document.getElementById("modalConfirmDeleteErr").style.color = "red";
                        //return false;
                    }
                    if (temperature.value == ""){
                        document.getElementById("modalConfirmDeleteErr").style.display = "block"
                        document.getElementById("modalConfirmDeleteErr").innerHTML = "Field is required *";
                        document.getElementById("modalConfirmDeleteErr").style.color = "red";
                        return false;
                    }
                    else{
                        document.getElementById("modalConfirmDeleteErr").style.display = "none";
                        true;
                    }
                }
                //Profile Script

                document.getElementById("profile").onclick = function () {
                    if (firstname.value == ""){
                        document.getElementById("SPname").innerHTML = "Field is required *";
                        document.getElementById("SPname").style.display = "block";
                        document.getElementById("SPname").style.color = "red";
                        //return false;
                    }
                    if(lastname.value == ""){
                        document.getElementById("SPlname").innerHTML = "Field is required *";
                        document.getElementById("SPlname").style.display = "block";
                        document.getElementById("SPlname").style.color = "red";
                        //return false;
                    }
                    if(middlename.value == ""){
                        document.getElementById("SPmiddlename").innerHTML = "Field is required *";
                        document.getElementById("SPmiddlename").style.display = "block";
                        document.getElementById("SPmiddlename").style.color = "red";
                        //return false;
                    }
                    if(contact_number.value == ""){
                        document.getElementById("SPlcontact_number").innerHTML = "Field is required *";
                        document.getElementById("SPlcontact_number").style.display = "block";
                        document.getElementById("SPlcontact_number").style.color = "red";
                       // return false;
                    }
                    if(address2.value == ""){
                        document.getElementById("address").innerHTML = "Field is required *";
                        document.getElementById("address").style.display = "block";
                        document.getElementById("address").style.color = "red";
                        //return false;
                    }
                    if(barangay.value == ""){
                        document.getElementById("brgy").innerHTML = "Field is required *";
                        document.getElementById("brgy").style.display = "block";
                        document.getElementById("brgy").style.color = "red";
                        //return false;
                    }
                    if(city_municipality.value == ""){
                        document.getElementById("MU").innerHTML = "Field is required *";
                        document.getElementById("MU").style.display = "block";
                        document.getElementById("MU").style.color = "red";
                        return false;
                    }
                    true;
                }
                //Profile KeyUp function
                document.getElementById("firstname").onkeyup = function () {
                    if (firstname.value == ""){
                        document.getElementById("SPname").innerHTML = "Field is required *";
                        document.getElementById("SPname").style.display = "block";
                        document.getElementById("SPname").style.color = "red";
                    }else{
                        document.getElementById("SPname").style.display = "none";
                        return true;
                    }
                }
                document.getElementById("lastname").onkeyup = function () {
                    if (lastname.value == ""){
                        document.getElementById("SPlname").innerHTML = "Field is required *";
                        document.getElementById("SPlname").style.display = "block";
                        document.getElementById("SPlname").style.color = "red";
                    }else{
                        document.getElementById("SPlname").style.display = "none";
                        return true;
                    }
                }
                document.getElementById("middlename").onkeyup = function () {
                    if (middlename.value == ""){
                        document.getElementById("SPmiddlename").innerHTML = "Field is required *";
                        document.getElementById("SPmiddlename").style.display = "block";
                        document.getElementById("SPmiddlename").style.color = "red";
                    }else{
                        document.getElementById("SPmiddlename").style.display = "none";
                        return true;
                    }
                }
                document.getElementById("contact_number").onkeyup = function () {
                    if (contact_number.value == ""){
                        document.getElementById("SPlcontact_number").innerHTML = "Field is required *";
                        document.getElementById("SPlcontact_number").style.display = "block";
                        document.getElementById("SPlcontact_number").style.color = "red";
                    }else{
                        document.getElementById("SPlcontact_number").style.display = "none";
                        return true;
                    }
                }
                document.getElementById("address2").onkeyup = function () {
                    if (address2.value == ""){
                        document.getElementById("address").innerHTML = "Field is required *";
                        document.getElementById("address").style.display = "block";
                        document.getElementById("address").style.color = "red";
                    }else{
                        document.getElementById("address").style.display = "none";
                        return true;
                    }
                }
                document.getElementById("barangay").onkeyup = function () {
                    if (barangay.value == ""){
                        document.getElementById("brgy").innerHTML = "Field is required *";
                        document.getElementById("brgy").style.display = "block";
                        document.getElementById("brgy").style.color = "red";
                    }else{
                        document.getElementById("brgy").style.display = "none";
                        return true;
                    }
                }
                document.getElementById("city_municipality").onkeyup = function () {
                    if (city_municipality.value == ""){
                        document.getElementById("MU").innerHTML = "Field is required *";
                        document.getElementById("MU").style.display = "block";
                        document.getElementById("MU").style.color = "red";
                    }else{
                        document.getElementById("MU").style.display = "none";
                        return true;
                    }
                }
            </script>
            <script>
                document.getElementById("QRclick").onclick = function (){
                    document.getElementById("messageshow").style.display = "none";
                    document.getElementById("showQR").style.display = "block";
                }
                document.getElementById("sendMSG").onclick = function (){
                    document.getElementById("showQR").style.display = "none";
                    document.getElementById("messageshow").style.display = "block";
                }
            </script>
</body>

    <script type="text/javascript" src="js\fontawesome.min.js"></script>
    <script type="text/javascript" src="js\search.js"></script>
    <script type="text/javascript" src="js\fontawesome.js"></script>
    <script type="text/javascript" src="js/symptoms.js"></script>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/js/mdb.min.js"></script>
</html>

