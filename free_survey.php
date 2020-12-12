
<?php
session_start();

$are_you_currently_on_strict_quarantine = "";
$errors = [];

if (empty($_SESSION['id'])) {
    header('location: home.php');
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.min.css" />
    <link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
    <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
    <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
    <link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
    <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
    <link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" type="text/css" href="css/util.css">
    <link rel="stylesheet" type="text/css" href="css/fontawesome.css">
    <link rel="stylesheet" type="text/css" href="css/fontawesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/loader.css">
    <title>Q1</title>
</head>  
<body onload="myFunction()">
    
    <style>
        .limiter{
            background-image:url(images/DiviMart%20Logo.png);
            background-repeat: no-repeat;
            background-size: cover;
            width: 100%;
            height: 100%;
            
        }
        .wrap-login100 input{
            border-style: solid;
        }
    </style>
    <div class="limiter" style="display:none;" id="myDiv">
        <div class="container-login100">
            <div class="wrap-login100">
        <p class="text-right" style="color:darkgray; margin-top:-8%;"><?php echo $_SESSION['email'];?></p><br><br>

            <form method="POST" action="">
                <div class="login100-form-title p-b-5 p-t-5" style="margin-top: -20px; margin-bottom: 20px; font-size:25px;">
                    Quarantine status
                </div>
                

                <?php
                    if (isset($_POST['submit'])) {
                        if (empty($_POST['are_you_currently_on_strict_quarantine'])){
                            echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                            <strong>System Notice!</strong> Select item below to proceed!
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                              <span aria-hidden='true'>&times;</span>
                            </button>
                          </div>";
                        }else{
                            $are_you_currently_on_strict_quarantine = $_POST['are_you_currently_on_strict_quarantine'];
                        
                        $connection = mysqli_connect("localhost", "root", "");
                        $db = mysqli_select_db($connection, 'divimart');
                        
                        $query = "UPDATE `client_data` SET are_you_currently_on_strict_quarantine='$are_you_currently_on_strict_quarantine' WHERE id='$id'";
                        $query_run = mysqli_query($connection, $query);
                    
                        if($query_run){
                            echo '<script type = "text/javascript">alert("Data update successfully")</script>';
                           // header('Location: form.php');
                         }
                         else{
                           echo '<script type = "text/javascript">alert("Data not submited")</script>';
                    
                         }                 
                        }
                    }
                ?>

                <?php if (count($errors) > 0): ?>
                <div class="alert alert-danger">
                    <?php foreach ($errors as $error): ?>
                    <li>
                    <?php echo $error; ?>
                    </li>
                    <?php endforeach;?>
                </div>
                <?php endif;?>

                <div class="form-group">
                        <label for="are_you_currently_on_strict_quarantine">1. Are you currently on Strict Quarantine?</label><br>
                        <select id="are_you_currently_on_strict_quarantine" name="are_you_currently_on_strict_quarantine" class="form-control"style="text-transform: uppercase">
                            <option selected></option>
                            <option>YES</option>
                            <option>NO</option>
                        </select>
                </div>
                <button type="submit" name="submit" id="submit" class="login100-form-btn" style="width: 90px; height: 45px">Next</button>
           
            </form>

            </div>
        </div>
    </div>
        <div id="loader"></div>
        <style>
        

                @font-face {
                font-family: Poppins-Regular;
                src: url('../fonts/poppins/Poppins-Regular.ttf'); 
                }

                @font-face {
                font-family: Poppins-Medium;
                src: url('../fonts/poppins/Poppins-Medium.ttf'); 
                }

                @font-face {
                font-family: Poppins-Bold;
                src: url('../fonts/poppins/Poppins-Bold.ttf'); 
                }

                @font-face {
                font-family: Poppins-SemiBold;
                src: url('../fonts/poppins/Poppins-SemiBold.ttf'); 
                }


                * {
                    margin: 0px; 
                    padding: 0px; 
                    box-sizing: border-box;
                }

                body, html {
                    height: 100%;
                font-family: Poppins-Regular, sans-serif;
                background-color: rgba(245, 240, 240, 0.9);
                }

                a {
                    font-family: Poppins-Regular;
                    font-size: 14px;
                    line-height: 1.7;
                    color: #000000;
                    margin: 0px;
                    transition: all 0.4s;
                    -webkit-transition: all 0.4s;
                -o-transition: all 0.4s;
                -moz-transition: all 0.4s;
                font-weight: bold;
                }

                a:focus {
                    outline: none !important;
                }

                a:hover {
                    text-decoration: none;
                color: rgb(15, 67, 180);
                text-decoration: underline;
                }

                h1,h2,h3,h4,h5,h6 {
                    margin: 0px;
                }

                p {
                    font-family: Poppins-Regular;
                    font-size: 14px;
                    line-height: 1.7;
                    color: #0f0e0e;
                    margin: 0px;
                }

                ul, li {
                    margin: 0px;
                    list-style-type: none;
                }


                input {
                    outline: none;
                    border: none;
                }

                textarea {
                outline: none;
                border: none;
                }

                textarea:focus, input:focus {
                border-color: transparent !important;
                }

                input:focus::-webkit-input-placeholder { color:transparent; }
                input:focus:-moz-placeholder { color:transparent; }
                input:focus::-moz-placeholder { color:transparent; }
                input:focus:-ms-input-placeholder { color:transparent; }

                textarea:focus::-webkit-input-placeholder { color:transparent; }
                textarea:focus:-moz-placeholder { color:transparent; }
                textarea:focus::-moz-placeholder { color:transparent; }
                textarea:focus:-ms-input-placeholder { color:transparent; }

                input::-webkit-input-placeholder { color: rgb(7, 6, 6);}
                input:-moz-placeholder { color: rgb(0, 0, 0);}
                input::-moz-placeholder { color: rgb(0, 0, 0);}
                input:-ms-input-placeholder { color: rgb(0, 0, 0);}

                textarea::-webkit-input-placeholder { color: rgb(0, 0, 0);}
                textarea:-moz-placeholder { color: rgb(0, 0, 0);}
                textarea::-moz-placeholder { color: rgb(0, 0, 0);}
                textarea:-ms-input-placeholder { color: rgb(0, 0, 0);}

                label {
                margin: 0;
                display: block;
                }

                button {
                    outline: none !important;
                    border: none;
                    background: transparent;
                }

                button:hover {
                    cursor: pointer;
                }

                iframe {
                    border: none !important;
                }


                .txt1 {
                font-family: Poppins-Regular;
                font-size: 13px;
                color: #181515;
                line-height: 1.5;
                }


                .limiter {
                width: 100%;
                margin: 0 auto;
                }
                form{
                    width: 100%;
                }
                .container-login100 {
                width: 100%;  
                min-height: 100%;
                display: -webkit-box;
                display: -webkit-flex;
                display: -moz-box;
                display: -ms-flexbox;
                display: flex;
                flex-wrap: wrap;
                justify-content: center;
                align-items: center;
                padding: 15px;

                background-repeat: no-repeat;
                background-position: center;
                background-size: cover;
                position: relative;
                z-index: 1;  
                }

                .container-login100::before {
                content: "";
                display: block;
                position: absolute;
                z-index: -1;
                width: 100%;
                height: 100%;
                top: 0;
                left: 0;
                background-color: rgba(143, 142, 142, 0.801);
                }   

                .wrap-login100 {
                width: 700px;
                border-radius: 5px;
                overflow: hidden;
                padding: 55px 55px 37px 55px;
                    border-style: none;
                color: black;
                background-color: #ffffff;
                }



                .login100-form {
                width: 100%;
                }

                .login100-form-logo {
                font-size: 60px; 
                color: #1b1919;

                display: -webkit-box;
                display: -webkit-flex;
                display: -moz-box;
                display: -ms-flexbox;
                display: flex;
                justify-content: center;
                align-items: center;
                width: 120px;
                height: 90px;
                border-radius: 50%;
                background-color: #fff;
                margin: 0 auto;
                }

                .login100-form-title {
                font-family: Poppins-Medium;
                font-size: 30px;
                color: rgb(8, 58, 99);
                line-height: 1.2;
                text-align: center;
                text-transform: uppercase;

                display: block;
                }



                .wrap-input100 {
                width: 80%;
                position: relative;
                border-bottom: 2px solid rgba(4, 83, 156, 0.795);
                margin-bottom: 30px;
                }

                .input100 {
                font-family: Poppins-Regular;
                font-size: 16px;
                color: rgb(0, 0, 0);
                line-height: 1.2;

                display: block;
                width: 100%;
                height: 45px;
                background: transparent;
                padding: 0 5px 0 38px;
                }


                .focus-input100 {
                position: absolute;
                display: block;
                width: 100%;
                height: 100%;
                top: 0;
                left: 0;
                pointer-events: none;
                }

                .focus-input100::before {
                content: "";
                display: block;
                position: absolute;
                bottom: -2px;
                left: 0;
                width: 0;
                height: 2px;

                -webkit-transition: all 0.4s;
                -o-transition: all 0.4s;
                -moz-transition: all 0.4s;
                transition: all 0.4s;

                background: rgba(133, 10, 10, 0.603);
                }

                .focus-input100::after {
                font-family: Material-Design-Iconic-Font;
                font-size: 22px;
                color: rgb(0, 0, 0);

                content: attr(data-placeholder);
                display: block;
                width: 100%;
                position: absolute;
                top: 6px;
                left: 0px;
                padding-left: 5px;

                -webkit-transition: all 0.4s;
                -o-transition: all 0.4s;
                -moz-transition: all 0.4s;
                transition: all 0.4s;
                }

                .input100:focus {
                padding-left: 5px;
                }

                .input100:focus + .focus-input100::after {
                top: -22px;
                font-size: 18px;
                }

                .input100:focus + .focus-input100::before {
                width: 100%;
                }

                .has-val.input100 + .focus-input100::after {
                top: -22px;
                font-size: 18px;
                }

                .has-val.input100 + .focus-input100::before {
                width: 100%;
                }

                .has-val.input100 {
                padding-left: 5px;
                }

                .contact100-form-checkbox {
                padding-left: 5px;
                padding-top: 5px;
                padding-bottom: 35px;
                }

                .input-checkbox100 {
                display: none;
                }

                .label-checkbox100 {
                font-family: Poppins-Regular;
                font-size: 13px;
                color: rgb(0, 0, 0);
                line-height: 1.2;

                display: block;
                position: relative;
                padding-left: 26px;
                cursor: pointer;
                font-weight: bold;
                }

                .label-checkbox100::before {
                content: "\f26b";
                font-family: Material-Design-Iconic-Font;
                font-size: 13px;
                color: transparent;
                font-weight: bold;
                display: -webkit-box;
                display: -webkit-flex;
                display: -moz-box;
                display: -ms-flexbox;
                display: flex;
                justify-content: center;
                align-items: center;
                position: absolute;
                width: 16px;
                height: 16px;
                border-radius: 2px;
                background: rgb(150, 146, 146);
                left: 0;
                top: 50%;
                -webkit-transform: translateY(-50%);
                -moz-transform: translateY(-50%);
                -ms-transform: translateY(-50%);
                -o-transform: translateY(-50%);
                transform: translateY(-50%);
                }

                .input-checkbox100:checked + .label-checkbox100::before {
                color: #0c2c41;
                }

                .container-login100-form-btn {
                width: 100%;
                display: -webkit-box;
                display: -webkit-flex;
                display: -moz-box;
                display: -ms-flexbox;
                display: flex;
                flex-wrap: wrap;
                justify-content: center;
                }

                .login100-form-btn {
                font-family: Poppins-Medium;
                font-size: 16px;
                color: white;
                line-height: 1.2;

                display: -webkit-box;
                display: -webkit-flex;
                display: -moz-box;
                display: -ms-flexbox;
                display: flex;
                justify-content: center;
                align-items: center;
                padding: 0 20px;
                width: 100%;
                height: 50px;
                border-radius: 5px;

                background: #043657;
                position: relative;
                z-index: 1;

                -webkit-transition: all 0.4s;
                -o-transition: all 0.4s;
                -moz-transition: all 0.4s;
                transition: all 0.4s;
                }

                .login100-form-btn::before {
                content: "";
                display: block;
                position: absolute;
                z-index: -1;
                width: 100%;
                height: 100%;
                border-radius:5px;
                background-color: rgb(9, 88, 153);
                top: 0;
                left: 0;
                opacity: 1;


                -webkit-transition: all 0.4s;
                -o-transition: all 0.4s;
                -moz-transition: all 0.4s;
                transition: all 0.4s;
                }

                .login100-form-btn:hover {
                color: #fff;
                }

                .login100-form-btn:hover:before {
                opacity: 0;
                }



                @media (max-width: 576px) {
                .wrap-login100 {
                    padding: 55px 15px 37px 15px;
                }
                }



                .validate-input {
                position: relative;
                }

                .alert-validate::before {
                content: attr(data-validate);
                position: absolute;
                max-width: 70%;
                background-color: #fff;
                border: 1px solid #c80000;
                border-radius: 2px;
                padding: 4px 25px 4px 10px;
                top: 50%;
                -webkit-transform: translateY(-50%);
                -moz-transform: translateY(-50%);
                -ms-transform: translateY(-50%);
                -o-transform: translateY(-50%);
                transform: translateY(-50%);
                right: 0px;
                pointer-events: none;

                font-family: Poppins-Regular;
                color: #c80000;
                font-size: 13px;
                line-height: 1.4;
                text-align: left;

                visibility: hidden;
                opacity: 0;

                -webkit-transition: opacity 0.4s;
                -o-transition: opacity 0.4s;
                -moz-transition: opacity 0.4s;
                transition: opacity 0.4s;
                }

                .alert-validate::after {
                content: "\f12a";
                font-family: FontAwesome;
                font-size: 16px;
                color: #c80000;

                display: block;
                position: absolute;
                top: 50%;
                -webkit-transform: translateY(-50%);
                -moz-transform: translateY(-50%);
                -ms-transform: translateY(-50%);
                -o-transform: translateY(-50%);
                transform: translateY(-50%);
                right: 5px;
                }

                .alert-validate:hover:before {
                visibility: visible;
                opacity: 1;
                }

                @media (max-width: 992px) {
                .alert-validate::before {
                    visibility: visible;
                    opacity: 1;
                }
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

</body>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="vendor/animsition/js/animsition.min.js"></script>
    <script src="vendor/select2/select2.min.js"></script>
    <script src="vendor/daterangepicker/moment.min.js"></script>
    <script src="vendor/daterangepicker/daterangepicker.js"></script>
    <script src="vendor/countdowntime/countdowntime.js"></script>
    <script src="js/main.js"></script>
    <script src="js/fontawesome.js"></script>
    <script src="js/fontawesome.min.js"></script>

</html>