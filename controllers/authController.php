<?php
session_start ();
require_once 'sendEmails.php';
require_once 'config.php';
$account_type = "";
$username = "";
$email = "";
$errors = [];

$conn = new mysqli('localhost', 'root', '', 'divimart');


    if (isset($_POST['signup-btn'])) {
        if (empty($_POST['account_type'])) {
            $errors['account_type'] = 'Account Type is required';
        }
        if (empty($_POST['username'])) {
            $errors['username'] = 'Username required';
        }
        if (empty($_POST['email'])) {
            $errors['email'] = 'Email required';
        }
        if (empty($_POST['password'])) {
            $errors['password'] = 'Password required';
        }
        if (isset($_POST['password']) && $_POST['password'] !== $_POST['passwordConf']) {
            $errors['passwordConf'] = 'Password not match';
        }

        $username = $_POST['username'];
        $email = $_POST['email'];
        
        $token = bin2hex(random_bytes(50));
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT); 

        
        $sql = "SELECT * FROM users WHERE email='$email' LIMIT 1";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $errors['email'] = "Your email is already register! Login your account!";
        }
        $sql = "SELECT * FROM users WHERE username='$username' LIMIT 1";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $errors['username'] = "Oops! Someting went wrong. Username is already taken.";
        }

        $connection = mysqli_connect("localhost", "root", "");
            $db = mysqli_select_db($connection, 'divimart');
            
            if(isset($_POST['signup-btn'])) {
            $account_type = $_POST['account_type'];
            
            $query = "INSERT into `users` (account_type)VALUES($account_type)";
            $query_run = mysqli_query($connection, $query);
            if($query_run){
                echo '<script type = "text/javascript">alert("Account type added")</script>';
            }
            }

        if (count($errors) === 0) {
            $query = "INSERT INTO users SET account_type=?, username=?, email=?, token=?, password=?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param('sssss', $account_type, $username, $email, $token, $password);
           // $result = $stmt->execute();
            if ($stmt->execute()) {
                $user_id = $stmt->insert_id;
                $_SESSION['id'] = $user_id;
                $_SESSION['username'] = $username;
                $_SESSION['email'] = $email;
                $_SESSION['verified'] = false;
                $_SESSION['administrator'] = false;
                $_SESSION['chat_activation'] = false;
                $_SESSION['message'] = 'You are logged in!';
                $_SESSION['type'] = 'alert-success';
               // header('location: home.php'); 
               // exit ();
            } else {
               // $_SESSION['error_msg'] = "Server is offline: Could not register user";
            }
        }

        if (count($errors) === 0) {
            $query = "INSERT INTO chat.chat_login SET username=?, email=?, password=?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param('sss', $username, $email, $password);
           // $result = $stmt->execute();
            if ($stmt->execute()) {
                $user_id = $stmt->insert_id;
                $_SESSION['id'] = $user_id;
                $_SESSION['username'] = $username;
                $_SESSION['email'] = $email;
                $_SESSION['type'] = 'alert-success';
                header('location: home'); 
                exit ();
            } else {
                $_SESSION['error_msg'] = "Server is offline: Could not register user";
            }
        }


    }

    if (isset($_POST['login-btn'])) {
        if (empty($_POST['email'])) {
            $errors['email'] = 'Email is required *';
        }
        if (empty($_POST['password'])) {
            $errors['password'] = 'Password is required *';
        }
        $email = $_POST['email'];
        $password = $_POST['password'];
        if (count($errors) === 0) {
            $query = "SELECT * FROM users WHERE email=? OR username=? LIMIT 1";
            $stmt = $conn->prepare($query);
            $stmt->bind_param('ss', $email, $email);

            if ($stmt->execute()) {
                $result = $stmt->get_result();
                $user = $result->fetch_assoc();
                if (password_verify($password, $user['password'])) { 
                    $_SESSION['id'] = $user ['id'];
                    $_SESSION['user_id'] = $user ['user_id'];
                    $_SESSION['username'] = $user['username'];
                    $_SESSION['email'] = $user['email'];
                    $_SESSION['verified'] = $user['verified'];
                    $_SESSION['administrator'] = $user['administrator'];
                    $_SESSION['chat_activation'] = $user['chat_activation'];

                    $_SESSION['message'] = "WELCOME BACK, ";
                    $_SESSION['alert-class'] = "alert-success";
                    header('location: index?user'.'-'. $_SESSION['username']);
                    exit();
                } else {
                    
                    $errors['login_failed'] = '<strong>Notice!</strong> Invalid credentials <br> incorrect email or password';
                }
            } else {
                $_SESSION['message'] = "Database error. Login failed!";
                $_SESSION['type'] = "alert-danger";
            }
        }
    }
    if (isset($_GET['logout'])){
        session_destroy();
        unset($_SESSION['id']);
        unset($_SESSION['username']);
        unset($_SESSION['email']);
        unset($_SESSION['verify']);
        header("location: login");
    }

//home Authentication
$firstname = "";
$lastname ="";
$middlename ="";
$age ="";
$gender ="";
$contact_number ="";
$email ="";
$address2 ="";
$city_municipality ="";
$barangay ="";
$zip ="";
$chk="";
//$errors = [];


if (isset($_POST['submitdata'])) {
    if (empty($_POST['firstname'])){
        $errors['firstname'] = 'Firstname is required';
    }
    if (empty($_POST['lastname'])){
        $errors['lastname'] = 'Lastname is required';
    }
    if (empty($_POST['middlename'])){
        $errors['middlename'] = 'Middlename is required';
    }
    if (empty($_POST['age'])){
        $errors['age'] = 'Age is required';
    }
    if (empty($_POST['gender'])){
        $errors['gender'] = 'Gender is requir   ed';
    }
    if (empty($_POST['contact_number'])){
        $errors['contact_number'] = 'Contact Number is required';
    }
    if (empty($_POST['email'])){
        $errors['email'] = 'Email is required';
    }
    if (empty($_POST['address2'])){
        $errors['address2'] = 'Address2 is required';
    }
    if (empty($_POST['city_municipality'])){
        $errors['city_municipality'] = "City/Municipality 
        is required";
    }
    if (empty($_POST['barangay'])){
        $errors['barangay'] = 'Barangay is required';
    }
    if (empty($_POST['zip'])){
        $errors['zip'] = "Zip is required";
    }
    else{

        $store_code = $_POST['store_code'];
        $store_name = $_POST['store_name'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $middlename = $_POST['middlename'];
        $age = $_POST['age'];
        $gender = $_POST['gender'];
        $contact_number = $_POST['contact_number'];
        $email = $_POST['email'];
        $address2 = $_POST['address2'];
        $city_municipality = $_POST['city_municipality'];
        $barangay = $_POST['barangay'];
        $zip = $_POST['zip'];
        $are_you_currently_on_strict_quarantine = $_POST['are_you_currently_on_strict_quarantine'];

        $start_date = $_POST["start_date"];
        $end_date = $_POST["end_date"];
        $close_contact = $_POST["close_contact"];
        $positive_contact = $_POST["positive_contact"];
        $quarantine_facility = $_POST["quarantine_facility"];
        $quarantine_address = $_POST["quarantine_address"];

        $rapid_testing = $_POST['rapid_testing'];
        $test_result = $_POST['test_result'];
        $test_date = $_POST['test_date'];
        $test_location = $_POST['test_location'];

        $swab_testing = $_POST["swab_testing"];
        $swab_result = $_POST["swab_result"];
        $swab_date = $_POST["swab_date"];
        $swab_place = $_POST["swab_place"];
        $Store_Visited = $_POST["Store_Visited"];

        $temperature = $_POST["temperature"];
        $symptoms=$_POST['check_list'];
        $other_symptoms = $_POST["other_symptoms"];
    
            $connection = mysqli_connect("localhost", "root", "");
            $db = mysqli_select_db($connection, 'divimart');
            $query = "INSERT INTO `client_information` (store_code, store_name, firstname, lastname, middlename, age, gender, contact_number, email, address2, city_municipality, barangay, zip)VALUES('$store_code', '$store_name', '$firstname', '$lastname', '$middlename', '$age', '$gender', '$contact_number', '$email', '$address2', '$city_municipality', '$barangay', '$zip')";
            $query_run = mysqli_query($connection, $query);

            $conn = mysqli_connect("localhost", "root", "");
            $db = mysqli_select_db($conn, 'divimart');
            foreach($symptoms as $chk1){
                $chk.=$chk1.",";
            }
            $query = "INSERT INTO `client_data` (fname, lname, middlename, contact_number, email, are_you_currently_on_strict_quarantine, start_date, end_date, close_contact, positive_contact, quarantine_facility, quarantine_address, rapid_testing, test_result, test_date, test_location, swab_testing, swab_result, swab_date, swab_place, temperature, symptoms, other_symptoms, Store_Visited)VALUES
            ('$firstname', '$lastname', '$middlename', '$contact_number', '$email', '$are_you_currently_on_strict_quarantine', '$start_date', '$end_date', '$close_contact', '$positive_contact', '$quarantine_facility', '$quarantine_address', '$rapid_testing', '$test_result', '$test_date', '$test_location', '$swab_testing', '$swab_result', '$swab_date', '$swab_place', '$temperature', '$chk', '$other_symptoms', '$Store_Visited')";
            $query_run = mysqli_query($conn, $query);

            if($query_run){
                $_SESSION['firstname'] = $firstname;
                $_SESSION['lastname'] = $lastname;
                $_SESSION['middlename'] = $middlename;
                
                echo '<script type = "text/javascript">alert("Data save successfully")</script>';
                header('location: generate_user_qr');

            }
            else{
            echo '<script type = "text/javascript">alert("Data not submited")</script>';
        }
    }
}

if (isset($_POST['submitdata'])){
    $email = $_POST['email'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $middlename = $_POST['middlename'];

    $connChat = mysqli_connect("localhost", "root", "");
    $db = mysqli_select_db($connChat, 'chat');
    $query = "UPDATE `chat_login` SET firstname = '$_POST[firstname]', lastname = '$_POST[lastname]', middlename = '$_POST[middlename]' WHERE email = '$_POST[email]'";
    $query_run = mysqli_query($connChat, $query);

    if ($query_run){
        echo '<script type = "text/javascript">alert("Query chat added")</script>';

    }else{
        echo '<script type = "text/javascript">alert("Oops, Someting went wrong!")</script>';

    }
}

    if (isset($_POST['contact'])) {
        if (empty($_POST['email'])){
            $errors['email'] = 'Subject is required *';
        }
        if (empty($_POST['subject'])){
            $errors['subject'] = 'Subject is required *';
        }
        if (empty($_POST['message'])){
            $errors['message'] = 'Message is required *';
        }
        else{ 
            $email=$_POST['email'];
            $subject = $_POST['subject'];
            $message = $_POST['message'];
                        
            $query = "INSERT INTO `report_log` (email, subject, message)VALUES
            ('$email', '$subject', '$message')";
            $query_run = mysqli_query($conn, $query);
           
            if($query_run){
                echo'<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>NOTICE!</strong> Your message has been sent! Thanks for your patience, Stay healthy. <i class="far fa-grin-hearts fa-2x" style="color: blue;"></i>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                    </div>';
            }
            else{
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>NOTICE!</strong> Oops! Something went wrong while submitting your message! Please try again.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                    </div>';
            }
                            
        }
    }

    $username = "";
    $email ="";
    $other_symptoms ="";
    $symptoms = "";
    $chk="";
    //$errors = [];

    $conn = mysqli_connect("localhost", "root", "");
    $db = mysqli_select_db($conn, 'divimart');
    //Symptomms

    if (isset($_POST['submit'])) {
        if (empty($_POST['temperature'])){
            $errors['temperature'] = 'Temperature is required';
        }
        if (empty($_POST['username'])){
            $errors['username'] = 'Oops! samething went wrong! Please try again.';
        }
        else{
            $temperature = $_POST["temperature"];
            $other_symptoms = $_POST["other_symptoms"];
            $symptoms=$_POST['check_list'];
            $username=$_POST['username'];
            $email=$_POST['email'];

            foreach($symptoms as $chk1){
                $chk.=$chk1.", ";
            }
        $query = "INSERT INTO `updated_symptoms` (username, email, temperature, symptoms, other_symptoms)VALUES
        ('$username', '$email', '$temperature', '$chk', '$other_symptoms')";
        $query_run = mysqli_query($conn, $query);

        if($query_run){

           // echo '<script type = "text/javascript">alert("Thank you! Stay healthy")</script>';
        }
        else{
        //echo '<script type = "text/javascript">alert("Oops someting went wrong! ")</script>';
        }
    
        }
    }

    //update symptoms

    if (isset($_POST['submit'])){
        if (empty($_POST['temperature'])){
            echo '<script type="text/javascript">alert("Temperature cant be empty!")';
        }else{
            $symptoms=$_POST['check_list'];

            foreach($symptoms as $chk1){
                $chk.=$chk1.", ";
            }
            $query = "UPDATE `client_data` SET temperature = '$_POST[temperature]', symptoms = '$_POST[chk]', other_symptoms = '$_POST[other_symptoms]' WHERE email = '$_POST[email]'";
            $query_run = mysqli_query($conn, $query);

            if ($query_run){
                echo '<script type = "text/javascript">alert("Symptoms successfully updated!")</script>';

            }else{
                echo '<script type = "text/javascript">alert("Oops, Someting went wrong!")</script>';

            }
        }
    }


    //Update Quarantine

    if (isset($_POST['submitQ'])){
        $email = $_POST['email'];
        $query = "UPDATE `client_data` SET are_you_currently_on_strict_quarantine = '$_POST[are_you_currently_on_strict_quarantine]', start_date = '$_POST[start_date]', end_date = '$_POST[end_date]', close_contact = '$_POST[close_contact]', positive_contact = '$_POST[positive_contact]', quarantine_facility = '$_POST[quarantine_facility]', quarantine_address = '$_POST[quarantine_address]' WHERE email = '$_POST[email]'";
        $query_run = mysqli_query($conn, $query);

        if ($query_run){

            echo '<script type = "text/javascript">alert("Quarantine Status Added! Stay safe.")</script>';

        }else{
            echo '<script type = "text/javascript">alert("Oops, Someting went wrong!")</script>';

        }
    }

    //Rapid Testing
    if (isset($_POST['next3'])){
        $email = $_POST['email'];
        $rapid_testing = $_POST['rapid_testing'];
        $test_result = $_POST['test_result'];
        $test_date = $_POST['test_date'];
        $test_location = $_POST['test_location'];

        $query = "UPDATE `client_data` SET rapid_testing = '$_POST[rapid_testing]', test_result = '$_POST[test_result]', test_date = '$_POST[test_date]', test_location = '$_POST[test_location]' WHERE email = '$_POST[email]'";
        $query_run = mysqli_query($conn, $query);

        if ($query_run){
            echo '<script type = "text/javascript">alert("Rapid Test Added! Stay safe.")</script>';

        }else{
            echo '<script type = "text/javascript">alert("Oops, Someting went wrong!")</script>';

        }
    }


    //Place Visited
    if (isset($_POST['place-visited'])) {
        if (empty($_POST['place_visited'])){
            $errors['place_visited'] = 'Field is required';
        }
        if (empty($_POST['date_visited'])){
            $errors['date_visited'] = 'Oops! samething went wrong! Please try again.';
        }
        else{
            $username=$_POST['username'];
            $email=$_POST['email'];
            $place_visited = $_POST['place_visited'];
            $temperature = $_POST['temperature'];
            $date_visited = $_POST['date_visited'];

        $query = "INSERT INTO `place_visited` (temperature, username, email, place_visited, date_visited)VALUES
        ('$temperature', '$username', '$email', '$place_visited', '$date_visited')";
        $query_run = mysqli_query($conn, $query);

        if($query_run){ 
            echo '<script type = "text/javascript">alert("Thank you! Stay healthy")</script>';
        }
        else{
        echo '<script type = "text/javascript">alert("Oops someting went wrong! ")</script>';
        }
    
        }
    }

    //Swab Testing
    if (isset($_POST['submit2'])){
        $email = $_POST['email'];
        $query = "UPDATE `client_data` SET swab_testing = '$_POST[swab_testing]', swab_result = '$_POST[swab_result]', swab_date = '$_POST[swab_date]', swab_place = '$_POST[swab_place]' WHERE email = '$_POST[email]'";
        $query_run = mysqli_query($conn, $query);

        if ($query_run){
            echo '<script type = "text/javascript">alert("Swab Test Added! Stay safe.")</script>';

        }else{
            echo '<script type = "text/javascript">alert("Oops, Someting went wrong!")</script>';

        }
    }
//Profile Update

if (isset($_POST['profile']))
    {
        $firstname = "";
        $id = $_POST['id'];
        $firstname = $_POST['firstname'];

        $query = "UPDATE `client_information` SET firstname = '$_POST[firstname]', lastname = '$_POST[lastname]', middlename = '$_POST[middlename]', contact_number = '$_POST[contact_number]', address2 = '$_POST[address2]', barangay = '$_POST[barangay]', city_municipality = '$_POST[city_municipality]' WHERE id = '$_POST[id]'";
        $query_run = mysqli_query($conn, $query);
        
        if ($query_run){
            $_SESSION['firstname'] = $firstname;
            $query = "UPDATE `client_data` SET fname = '$_POST[firstname]', lname = '$_POST[lastname]', middlename = '$_POST[middlename]', contact_number = '$_POST[contact_number]' WHERE id = '$_POST[id]'";
            echo '<script type = "text/javascript">alert("Profile updated successfully")</script>';

        }else{
            echo '<script type = "text/javascript">alert("Oops, Someting went wrong!")</script>';

        }
        $firstname = "";
        $id = $_POST['id'];
        $query = "UPDATE `client_data` SET fname = '$_POST[firstname]', lname = '$_POST[lastname]', middlename = '$_POST[middlename]', contact_number = '$_POST[contact_number]' WHERE id = '$_POST[id]'";
        $query_run = mysqli_query($conn, $query);
        
        if ($query_run){
            //header("Location: index.php");
        }else{
        }
    }

       //Link social media accounts

       if (isset($_POST['link-accounts'])){
        $facebook_account = $_POST['facebook_account'];
        $twitter_account = $_POST['twitter_account'];
        $instagram_account = $_POST['instagram_account'];

        $query = "UPDATE `client_information` SET facebook_account = '$_POST[facebook_account]', twitter_account = '$_POST[twitter_account]', instagram_account = '$_POST[instagram_account]' WHERE email = '$_POST[email]'";
        $query_run = mysqli_query($conn, $query);

        if ($query_run){
            echo '<script type = "text/javascript">alert("You have successfully add your social media account!")</script>';

        }else{
            echo '<script type = "text/javascript">alert("Oops, Someting went wrong! Try again later")</script>';

        }
    }

?>
