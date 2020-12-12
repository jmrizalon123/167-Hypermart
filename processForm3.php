<?php
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
?>