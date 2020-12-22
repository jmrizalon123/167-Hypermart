<?php
require_once('controllers\authController.php');
if (!isset($_SESSION['id'])){
  header('location: login');
  exit ();
}

  $msg = "";
  $msg_class = "";
  $conn = mysqli_connect("localhost", "root", "", "divimart");
  if (isset($_POST['save_profile'])) {
    // for the database
    $email = stripslashes($_POST['email']);
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
        $sql = "INSERT INTO users_profile SET profile_image='$profileImageName', email='$email '";
        if(mysqli_query($conn, $sql)){
          $msg = "Image uploaded and saved in the Database";
          $msg_class = "alert-success";
          header("Location: User_Temperature");
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

<?php include_once('processForm.php') ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.min.css" />
    <link rel="icon" type="image/png" href="images\167 Hypermart Logo 2b.png"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/css/mdb.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/util.css">
    <link rel="stylesheet" type="text/css" href="css/loader.css">
    <link rel="stylesheet" type="text/css" href="css/main2.css">
    <link rel="stylesheet" type="text/css" href="css/fontawesome.css">
    <link rel="stylesheet" type="text/css" href="css/fontawesome.min.css">
</head>
<body onload="myFunction()">
  <div class="limiter" id="myDiv" style="display:none;">
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
                  <p class="h4 mb-4">Upload Your Profile</p>

                  <p>One last thing upload your profile picture.</p>

                  <p>
                  <a href="" target="_blank">This is the custom default avater you can change your profile once you activate your account!</a>
                  </p>
                  <form action="upload" method="post" enctype="multipart/form-data">
                      <h2 class="text-center mb-3 mt-3">Add profile</h2>
                      <?php if (!empty($msg)): ?>
                          <div class="alert <?php echo $msg_class ?>" role="alert">
                          <?php echo $msg; ?>
                          </div>
                      <?php endif; ?>
                      <div class="form-group text-center" style="position: relative;" >
                          <span class="img-div">
                          <div class="text-center img-placeholder"  onClick="triggerClick()">
                              <h4>Upload Profile</h4>
                          </div>
                          <img src="images\userimage.png" onClick="triggerClick()" id="profileDisplay">
                          </span>
                          <input type="file" name="profileImage" onChange="displayImage(this)" id="profileImage" class="form-control" style="display: none;">
                          <label>Profile Image</label><br>
                          <input type="text" name="email" value="<?php echo $_SESSION['email'] ?>" style="width:100%; text-align: center;">
                      </div>
                      <div class="form-group">
                          <button type="submit" name="save_profile" id="profile" class="btn btn-primary btn-block">UPLOAD</button>
                      </div>
                  </form>
              </div>
          </div>
          </section>
      </div>
    </div>
  </div>

  <div id="loader-wrapper">
			<div id="loader"></div>
		</div>
  <script>
    document.getElementById("profile").onclick = function() {
      if (profileImage.value == ""){
        alert("You have no chosen file!");
        return false;
      }
    }
  </script>
  <style>

  .form-div { margin-top: 100px; border: 1px solid #e0e0e0; }
  #profileDisplay { display: block; height: 210px; width: 210px; margin: 0px auto; border-radius: 50%; }
  .img-placeholder {
    width: 210px;
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
  </style>
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