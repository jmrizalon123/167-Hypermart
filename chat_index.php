<?php

include('database_connection.php');
include('controllers\authController.php');
if(!isset($_SESSION['user_id']))
{
 header("location:index.php");
} 
?>
<!DOCTYPE html>
<html lang="en">
    <head> 
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <title>167 Hypermart | Chatroom</title>  
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="https://cdn.rawgit.com/mervick/emojionearea/master/dist/emojionearea.min.css">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/css/mdb.min.css" rel="stylesheet">
    </head>  
    <body>  
    <div class="container py-2 z-depth-1">
        <section class="px-md-2 mx-md-2 text-center dark-grey-text">
            <div class="row">
                <div class="col-sm-2 text-left">
                    <img src="images\167 Hypermart Logo 2b.png" alt="" width="120px;">
                </div>
                <div class="col-sm-10 text-right">
                </div> 
            </div>
        </section>
</div>
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

                                <p class="text-left">FACEBOOK</p>
                                <input type="text" class="form-control" name="facebook_account" placeholder="https://www.facebook.com/your username" value="<?php echo $row['facebook_account'] ?>">

                                <p class="text-left">TWITTER</p>
                                <input type="text" class="form-control" name="twitter_account" placeholder="https://twitter.com/your username" value="<?php echo $row['twitter_account'] ?>">

                                <p class="text-left">INSTAGRAM</p>
                                <input type="text" class="form-control" name="instagram_account" placeholder="https://www.instagram.com/your username" value="<?php echo $row['instagram_account'] ?>">
                                    <small>NOTE: Just make sure you have ent
                                    ered a correct address, any misspelled characters will lead to incorrect IP address!</small>
                                <br>
                                <div class="text-left">
                                <input type="submit" name="link-accounts" value="SAVE CHANGE" class="btn btn-primary">
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
<div class="container my-3 py-3 z-depth-1">
    <section class="dark-grey-text text-center text-lg-left">
        <div class="row">
            <div class="col-sm-12 text-right" style="background-color:">
               <a href="<?php echo $row['facebook_account'] ?>" title="Settings" class="card-img-100 d-inline-flex justify-content-center align-items-center rounded-circle grey lighten-4 hoverable" style="width: 40px; height: 40px; margin-top: -5px; margin-right: 5px; color: #0d47a1" data-toggle="modal" data-target="#modalSubscriptionForm222"><i class="fas fa-cog"></i></i></a>
               <a href="<?php echo $row['facebook_account'] ?>" target="_blank" title="Search" class="card-img-100 d-inline-flex justify-content-center align-items-center rounded-circle grey lighten-4 hoverable" style="width: 40px; height: 40px; margin-top: -5px; margin-right: 5px; color: #0d47a1"><i class="fas fa-edit"></i></i></a>
               <a href="chat_logout.php" title="Sign out" class="card-img-100 d-inline-flex justify-content-center align-items-center rounded-circle grey lighten-4 hoverable" style="width: 40px; height: 40px; margin-top: -5px; margin-right: 5px; color: #0d47a1"><i class="fas fa-sign-out-alt"></i></i></a>
            </div>
            <div class="col-lg-4 mb-lg-0 text-center">
                <?php
                    $conn = mysqli_connect("localhost", "root", "", "divimart");
                    $results = mysqli_query($conn, "SELECT * FROM users_profile WHERE email = '$_SESSION[email]'");
                    $users = mysqli_fetch_all($results, MYSQLI_ASSOC);
                ?>
                <?php
                    $count=1;
                    $email="";
                    $email = $_SESSION['email'];
                    $sel_query="SELECT * FROM divimart.users_profile WHERE email = '$_SESSION[email]'";
                    $result = mysqli_query($con,$sel_query);
                        while($row = mysqli_fetch_assoc($result)) { ?>
                        <?php foreach ($users as $user):?>
                            <a href="profiles/<?php echo $row['profile_image'] ?>" target="_blank"><img  src="<?php echo 'profiles/' . $user['profile_image'] ?>" class="rounded-circle z-depth-0" height="80"></a>
                        <?php endforeach; ?>
                <?php $count++; } ?><br><br>
                <?php
                        $count=1;
                        $email="";
                        $email = $_SESSION['email'];
                        $sel_query="SELECT * FROM client_information WHERE email = '$_SESSION[email]'";
                        $result = mysqli_query($con,$sel_query);
                        while($row = mysqli_fetch_assoc($result)) { ?> 
                            <p class="text-muted" style="text-transform: uppercase; font-weight: bold; font-size: 80%"><?php echo $row['firstname']; echo ' '; echo $row['middlename']; echo ' '; echo $row['lastname']?></p>
                            <p class="text-muted" style="font-size: 80%; margin-top: -15px"><?php echo $row['email'];?></p>
                            <hr>
                            <a href="<?php echo $row['facebook_account'] ?>" target="_blank" title="FACEBOOK" class="card-img-100 d-inline-flex justify-content-center align-items-center rounded-circle grey lighten-3 hoverable" style="width: 40px; height: 40px; margin-top: -5px; margin-right: 5px; color: #0d47a1"><i class="fab fa-facebook-f"></i></i></a>
                            <a href="<?php echo $row['twitter_account'] ?>" target="_blank" title="TWITTER" class="card-img-100 d-inline-flex justify-content-center align-items-center rounded-circle grey lighten-3 hoverable" style="width: 40px; height: 40px; margin-top: -5px; margin-right: 5px; color: #0d47a1"><i class="fab fa-twitter"></i></a>
                            <a href="<?php echo $row['instagram_account'] ?>" target="_blank" title="INSTAGRAM" class="card-img-100 d-inline-flex justify-content-center align-items-center rounded-circle grey lighten-3 hoverable" style="width: 40px; height: 40px; margin-top: -5px; margin-right: 5px; color: #0d47a1"><i class="fab fa-instagram" style="font-weight:bold;"></i></a> 
                        <?php $count++; } ?><br><br>
                        <?php
                            $count=1;
                            $email="";
                            $email = $_SESSION['email'];
                            $sel_query="SELECT * FROM users_profile WHERE email = '$_SESSION[email]'";
                            $result = mysqli_query($con,$sel_query);
                            while($row = mysqli_fetch_assoc($result)) { ?> 
                            <p><?php echo $row['bio']?></p>
                        <?php $count++; } ?>
            </div>
            <div class="col-lg-8 mb-lg-5 d-flex align-items-center justify-content-center" style=" overflow-y: scroll;">
                <div id="user_details" style="width: 100%;"></div>
                <div id="user_model_details" class="card"></div>
            </div>
        </div>
    </section>
</div>
    </body>  
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="https://cdn.rawgit.com/mervick/emojionearea/master/dist/emojionearea.min.js"></script>
</html>

<script>  
$(document).ready(function(){
    $('.chat_history').animate({scrollTop: 1000000}, 800);
});

$(document).ready(function(){

 fetch_user();

 setInterval(function(){
  update_last_activity();
  fetch_user();
  update_chat_history_data();
 }, 5000);

 function fetch_user()
 {
  $.ajax({
   url:"fetch_user.php",
   method:"POST",
   success:function(data){
    $('#user_details').html(data);
   }
  })
 }

 function update_last_activity()
 {
  $.ajax({
   url:"update_last_activity.php",
   success:function()
   {

   }
  })
 }

 function make_chat_dialog_box(to_user_id, to_user_name)
 {
    
  var modal_content = '<div id="user_dialog_'+to_user_id+'" class="user_dialog animated bounceIn card" title="'+to_user_name+'">';
  modal_content += '<div style="height:350px; width: 100%; overflow-y: scroll; margin-bottom:20px;" class="container-fluid chat_history" data-touserid="'+to_user_id+'" id="chat_history_'+to_user_id+'">';
  modal_content += fetch_user_chat_history(to_user_id);
  modal_content += '</div>';
  modal_content += '<div class="form-group">';
  modal_content += '<textarea rows="5" name="chat_message_'+to_user_id+'" id="chat_message_'+to_user_id+'" class="form-control chat_message" placeholder="Type a message..."></textarea>';
  modal_content += '</div><div class="form-group" align="left">';
  modal_content+= '<button type="button" name="send_chat" id="'+to_user_id+'" class="btn btn-info send_chat" onclick="sendMSG()"><i class="fas fa-paper-plane"></i> Send</button></div></div>';
  $('#user_model_details').html(modal_content);
 }

 $(document).on('click', '.start_chat', function(){
  var to_user_id = $(this).data('touserid');
  var to_user_name = $(this).data('tousername');
  make_chat_dialog_box(to_user_id, to_user_name);
  $("#user_dialog_"+to_user_id).dialog({
   autoOpen:false,
   width:400
  });
  $('#user_dialog_'+to_user_id).dialog('open');
  $('#chat_message_'+to_user_id).emojioneArea({
   pickerPosition:"top",
   toneStyle: "bullet"
  });
 });

 $(document).on('click', '.send_chat', function(){
  var to_user_id = $(this).attr('id');
  var chat_message = $('#chat_message_'+to_user_id).val();
  $.ajax({
   url:"insert_chat.php",
   method:"POST",
   data:{to_user_id:to_user_id, chat_message:chat_message},
   success:function(data)
   {
    //$('#chat_message_'+to_user_id).val('');
    var element = $('#chat_message_'+to_user_id).emojioneArea();
    element[0].emojioneArea.setText('');
    $('#chat_history_'+to_user_id).html(data);
   }
  })
 });

 function fetch_user_chat_history(to_user_id)
 {
  $.ajax({
   url:"fetch_user_chat_history.php",
   method:"POST",
   data:{to_user_id:to_user_id},
   success:function(data){
    $('#chat_history_'+to_user_id).html(data);
   }
  })
 }

 function update_chat_history_data()
 {
  $('.chat_history').each(function(){
   var to_user_id = $(this).data('touserid');
   fetch_user_chat_history(to_user_id);
  });
 }

 $(document).on('click', '.ui-button-icon', function(){
  $('.user_dialog').dialog('destroy').remove();
 });

 $(document).on('focus', '.chat_message', function(){
  var is_type = 'yes';
  $.ajax({
   url:"update_is_type_status.php",
   method:"POST",
   data:{is_type:is_type},
   success:function()
   {

   }
  })
 });

 $(document).on('blur', '.chat_message', function(){
  var is_type = 'no';
  $.ajax({
   url:"update_is_type_status.php",
   method:"POST",
   data:{is_type:is_type},
   success:function()
   {
    
   }
  })
 });
 
}); 

$(document).on('click', '.remove_chat', function(){
  var chat_message_id = $(this).attr('id');
  if(confirm("Are you sure you want to remove this message?"))
  {
   $.ajax({
    url:"remove_chat.php",
    method:"POST",
    data:{chat_message_id:chat_message_id},
    success:function(data)
    {
     update_chat_history_data();
    }
   })
  }
 });

</script>