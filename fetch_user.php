<?php include('database_connection.php'); ?>
<?php include('controllers\authController.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>167 Hypermart | Chatroom</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/css/mdb.min.css" rel="stylesheet">

</head>
<body>
<?php
    $conn = mysqli_connect("localhost", "root", "", "chat");
    $results = mysqli_query($conn, "SELECT * FROM chat_login WHERE email = '$_SESSION[email]'");
    $users = mysqli_fetch_all($results, MYSQLI_ASSOC);
?>
<?php
$query = " SELECT * FROM chat_login WHERE user_id != '".$_SESSION['user_id']."'";
$statement = $connect->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$output = '<table class="table table-hover" style="width: 100%;">
<thead>
    <tr class="text-center">
    <th>
        <strong>CHATS</strong>
    </th>
    </tr>
  </thead>
';

foreach($result as $row)
{
 $status = '';
 $current_timestamp = strtotime(date("Y-m-d H:i:s") . '- 10 second');
 $current_timestamp = date('Y-m-d H:i:s', $current_timestamp);
 $user_last_activity = fetch_user_last_activity($row['user_id'], $connect);
 if($user_last_activity > $current_timestamp)
 {
  $status = '<span class="label"><i class="fas fa-circle" style="color: #00C851"></i></span>';
 }
 else
 {
  $status = '<span class="label"><i class="fas fa-circle" style="color: #ff4444"></i></span>';
 }
foreach ($users as $user):
 $output .= '
    <tr>
        <th style="width: 5px;><a href="#"><img src = "profiles/'.$row['profile_image']. '" class="rounded-circle z-depth-1" height="45" width="45px"> </a></th>
        <td class="start_chat text-left" style="text-transform: uppercase; font-weight: 400;" data-touserid= "'.$row['user_id'].'" data-tousername="'.$row['firstname']. ' ' . $row['middlename'].' '. $row['lastname']. ' '. '('. $row['username'].')'.'">'.$row['firstname'].' '.$row['middlename'].' '.$row['lastname'].count_unseen_message($row['user_id'], $_SESSION['user_id'], $connect).' '.fetch_is_type_status($row['user_id'], $connect).' '. '<a style="float: right;">'.$status.'</a><br><i class="text-center" style="margin-left: 20px; font-size: 10px; color: darkblue;">'.$row['email'].'</i></td>
    </tr>
 ';
endforeach;
}

$output .= '</table>';

echo $output;

?>
</body>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/js/mdb.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/js/mdb.min.js"></script>
</html>