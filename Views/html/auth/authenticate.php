<?php
    require_once __DIR__.'/../../Controllers/dbController.php';
    require_once __DIR__.'/../../Controllers/authController.php';

    session_start();

    header('location:./authentication-login.php');

    $db = new DbController();
    $auth = new AuthController($db);

    $_SESSION['login_errors'] = array();

    $email = strtolower(mysqli_real_escape_string($db->conn, $_POST['email']));
    $password = mysqli_real_escape_string($db->conn, $_POST['password']);

    if(!$email){ array_push($_SESSION['login_errors'], 'Email is Required'); }

    if(!$password){ array_push($_SESSION['login_errors'], 'Password is Required'); }

    if(count($_SESSION['login_errors']) > 0){ exit(); }

    if(!$auth->confirmLogin($email, $password)){ array_push($_SESSION['login_errors'], 'Incorrect Email or Password'); }
    else{ $_SESSION['main'] = "location:http://".$_SERVER['SERVER_NAME'].'/BugTrackingApplication/Views/html/main.php'; }
?>
