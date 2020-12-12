<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CHAT</title>
    <!-- Font Awesome -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
<!-- Google Fonts -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
<!-- Bootstrap core CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
<!-- Material Design Bootstrap -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/css/mdb.min.css" rel="stylesheet">

</head>
<body>
<?php

//fetch_user.php

include('database_connection.php');

session_start();
$query = "
SELECT * FROM chat_login  
WHERE user_id != '".$_SESSION['user_id']."' 
";

$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

$output = '
<table class="table table-hover" style="width: 100%;">
 <tr>
  <th><trong>Username</strong></td>
  <th><trong>Status</strong></td>
  <th><trong>Action</strong></td>
 </tr>
';

foreach($result as $row)
{
 $status = '';
 $current_timestamp = strtotime(date("Y-m-d H:i:s") . '- 10 second');
 $current_timestamp = date('Y-m-d H:i:s', $current_timestamp);
 $user_last_activity = fetch_user_last_activity($row['user_id'], $connect);
 if($user_last_activity > $current_timestamp)
 {
  $status = '<span class="label badge badge-pill badge-success">Online</span>';
 }
 else
 {
  $status = '<span class="label badge badge-pill badge-danger">Offline</span>';
 }
 $output .= '
  <td style="text-transform: uppercase">'.$row['firstname'].' '.$row['middlename'].' '.$row['lastname'].count_unseen_message($row['user_id'], $_SESSION['user_id'], $connect).' '.fetch_is_type_status($row['user_id'], $connect).'</td>
  <td>'.$status.'</td>
  <td style="text-transform: uppercase"><button type="button" class="btn btn-primary btn-sm start_chat" data-touserid="'.$row['user_id'].'" data-tousername="'.$row['firstname']. ' ' . $row['middlename'].' '. $row['lastname']. ' '. '('. $row['username'].')'.'">Start Chat</button></td>
 </tr>
 ';
}

$output .= '</table>';

echo $output;

?>

</body>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/js/mdb.min.js"></script>
</html>