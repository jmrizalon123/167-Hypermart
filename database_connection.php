<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="images\167 Hypermart Logo 2b.png"/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/css/mdb.min.css" rel="stylesheet">

</head>
<body>
<?php

//database_connection.php
$connect = new PDO("mysql:host=localhost;dbname=chat;charset=utf8mb4", "root", "");
date_default_timezone_set('Asia/Kolkata');
function fetch_user_last_activity($user_id, $connect)
{
 $query = " SELECT * FROM login_details WHERE user_id = '$user_id' ORDER BY last_activity DESC LIMIT 1";
 $statement = $connect->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();
 foreach($result as $row)
 {
  return $row['last_activity'];
 }
}

function fetch_user_chat_history($from_user_id, $to_user_id, $connect)
{
 $query = "SELECT * FROM chat_message WHERE (from_user_id = '".$from_user_id."' AND to_user_id = '".$to_user_id."') OR (from_user_id = '".$to_user_id."' AND to_user_id = '".$from_user_id."') ORDER BY timestamp ASC";
 $statement = $connect->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();
 $output = '<ul class="list-unstyled">';
 foreach($result as $row)
 {
  $user_name = '';
  $dynamic_background = '';
  $chat_message = '';
  if($row["from_user_id"] == $from_user_id)
  {
   if($row["status"] == '2')
   {
    $chat_message = '<small>This message has been removed</small>';
    $user_name = '<b class="text-primary"></b>';
   }
   else
   {
    $user_name = '<a class="remove_chat" id="'.$row['chat_message_id'].'"><i class="fas fa-minus-square" style="color: rgba(202, 198, 198, 0.9); float: right; margin-left:"> <i>remove message</i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b class="text-success text-right" margin-left: -50px;> </b></i></a>';
    $chat_message =$row['chat_message'];
   
   }

   $dynamic_background = 'background-color:#fff; float: right; border-radius: 3px; margin-bottom: 10px; margin-right: 5px; border-style: none;';
  }
  else
  {
   if($row["status"] == '2')
   {
    $chat_message = '<em>This message has been removed</em>';
   }
   else
   {
    $chat_message = $row["chat_message"];
   }
   $user_name = '<b class="text-danger">'.get_user_name($row['from_user_id'], $connect).'</b>';
   $dynamic_background = 'background-color:#fff; float: left; border-radius: 3px; margin-bottom: 10px; margin-left: -20px; margin-right: 50px; border-style: none;';
  }

  $output .= '
  <li style="border-bottom:1px dotted #ccc;padding-top:8px; padding-left:8px; padding-right:8px;'.$dynamic_background.'">
  <table>
    <tr>
      <th>'.$user_name.'</th>
      <td style = "box-shadow: 0px 0px 3px; padding-left: 20px; padding-right: 20px; padding-top: 2px; padding-bottom: 2px; border-radius: 20px;">'.$chat_message.'<br><small style="font-size: 8px;">'.$row['timestamp'].'</small></td>
    </tr>

  </table>
  </li>
  ';
 }
 $output .= '</ul>';
 $query = "UPDATE chat_message SET status = '0' WHERE from_user_id = '".$to_user_id."' AND to_user_id = '".$from_user_id."' AND status = '1'";
 $statement = $connect->prepare($query);
 $statement->execute();
 return $output;
}

function get_user_name($user_id, $connect)
{
$output = '';
 $query = "SELECT profile_image FROM chat_login WHERE user_id = '$user_id'";
 $statement = $connect->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();
 foreach($result as $row)
 {
     $output .='
     <a href=""data-toggle="modal" data-target="#modalSubscriptionForm22"><img src = "profiles/'.$row['profile_image']. '" class="rounded-circle z-depth-1" height="40" style="margin-right: 15px;"></a>
     ';
     return $output;
 }
}

function count_unseen_message($from_user_id, $to_user_id, $connect)
{
 $query = "SELECT * FROM chat_message WHERE from_user_id = '$from_user_id' AND to_user_id = '$to_user_id' AND status = '1'";
 $statement = $connect->prepare($query);
 $statement->execute();
 $count = $statement->rowCount();
 $output = '';
 if($count > 0)
 {
  $output = '<span class="label label-pill label-danger count badge red z-depth-1 mr-0" style="margin-left:10px;">'.$count.'</span>';
 }
 return $output;
}

function fetch_is_type_status($user_id, $connect)
{
 $query = "SELECT is_type FROM login_details WHERE user_id = '".$user_id."' ORDER BY last_activity DESC LIMIT 1"; 
 $statement = $connect->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();
 $output = '';
 foreach($result as $row)
 {
  if($row["is_type"] == 'yes')
  {
   $output = ' <small><em><span class="text-muted">Typing...</span></em></small>';
  }
 }
 return $output;
}

?>
</body>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/js/mdb.min.js"></script>
</html>