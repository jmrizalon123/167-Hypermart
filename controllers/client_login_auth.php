<?php 
session_start ();
require_once 'config.php';
$username = "";
$email = "";
$errors = [];

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
        $stmt = $con->prepare($query);
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
                header('location: temperature?user'.'-'. $_SESSION['username']);
                exit();
            } else {
                
                $errors['login_fail'] = '<strong>Notice!</strong> Invalid credentials <br> incorrect email or password';
            }
        } else {
            $_SESSION['message'] = "Database error. Login failed!";
            $_SESSION['type'] = "alert-danger";
        }
    }
}

 ?>