<?php
session_start ();
$account_type = "";
$username = "";
$email = "";
$errors2 = [];

$conn = new mysqli('localhost', 'root', '', 'divimart');


    if (isset($_POST['signup-btn'])) {
        if (empty($_POST['account_type'])) {
            $errors2['account_type'] = 'Account Type is required';
        }
        if (empty($_POST['username'])) {
            $errors2['username'] = 'Username required';
        }
        if (empty($_POST['email'])) {
            $errors2['email'] = 'Email required';
        }
        if (empty($_POST['password'])) {
            $errors2['password'] = 'Password required';
        }
        if (isset($_POST['password']) && $_POST['password'] !== $_POST['passwordConf']) {
            $errors2['passwordConf'] = 'Password not match';
        }

        $username = $_POST['username'];
        $email = $_POST['email'];
        $token = bin2hex(random_bytes(50));
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT); 

        
        $sql = "SELECT * FROM admin_users WHERE email='$email' LIMIT 1";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $errors2['email'] = "Email address is already exist!";
        }

        $connection = mysqli_connect("localhost", "root", "");
            $db = mysqli_select_db($connection, 'divimart');
            
            if(isset($_POST['signup-btn'])) {
            $account_type = $_POST['account_type'];

            
            $query = "INSERT into `admin_users` (account_type)VALUES($account_type)";
            $query_run = mysqli_query($connection, $query);
            if($query_run){
                echo '<script type = "text/javascript">alert("Account type added")</script>';
            }
            }



        if (count($errors2) === 0) {
            $query = "INSERT INTO admin_users SET account_type=?, username=?, email=?, token=?, password=?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param('sssss', $account_type, $username, $email, $token, $password);
           // $result = $stmt->execute();
            if ($stmt->execute()) {
                $user_id = $stmt->insert_id;
                $_SESSION['id'] = $user_id;
                $_SESSION['username'] = $username;
                $_SESSION['email'] = $email;
                $_SESSION['verified'] = false;
                $_SESSION['message'] = 'You are logged in!';
                $_SESSION['type'] = 'alert-success';
                header('location: admin_login.php'); 
                exit ();
            } else {
                $_SESSION['error_msg'] = "Server is offline: Could not register user";
            }
        }
    }

    if (isset($_POST['login-btn'])) {
        if (empty($_POST['email'])) {
            $errors2['email'] = 'Email is required';
        }
        if (empty($_POST['password'])) {
            $errors2['password'] = 'Password is required';
        }
        $email = $_POST['email'];
        $password = $_POST['password'];

        if (count($errors2) === 0) {
            $query = "SELECT * FROM admin_users WHERE email=? OR username=? LIMIT 1";
            $stmt = $conn->prepare($query);
            $stmt->bind_param('ss', $email, $email);

            if ($stmt->execute()) {
                $result = $stmt->get_result();
                $user = $result->fetch_assoc();
                if (password_verify($password, $user['password'])) { 
                    $_SESSION['id'] = $user ['id'];
                    $_SESSION['username'] = $user['username'];
                    $_SESSION['email'] = $user['email'];
                    $_SESSION['verified'] = $user['verified'];
                    $_SESSION['message'] = "Welcome user manage your acount here!";
                    $_SESSION['alert-class'] = "alert-success";
                    header('location: admin.php');
                    exit();
                } else {
                    
                    $errors2['login_fail'] = '<strong>Notice!</strong> Invalid credentials incorrect email or password';
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
        header("location: admin_login.php");
    }
?>