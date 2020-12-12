<?php
//insert.php
if(isset($_POST["subject"]))
{
 include("connect.php");
 $email = mysqli_real_escape_string($con, $_POST["email"]);
 $subject = mysqli_real_escape_string($con, $_POST["subject"]);
 $comment = mysqli_real_escape_string($con, $_POST["comment"]);
 $query = "
 INSERT INTO comments(email, comment_subject, comment_text)
 VALUES ('$email', '$subject', '$comment')
 ";
 mysqli_query($con, $query);
}
?>