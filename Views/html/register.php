<?php
    require_once __DIR__.'/../../Controllers/dbController.php';
    require_once __DIR__.'/../../Controllers/authController.php';

    session_start();

    header('location:./authentication-login.php');

    $db = new DbController();
    $auth = new AuthController($db);

    $_SESSION['register_errors'] = array();

    $username = mysqli_real_escape_string($db->conn, $_POST['username']);
    $email = strtolower(mysqli_real_escape_string($db->conn, $_POST['email']));
    $password = mysqli_real_escape_string($db->conn, $_POST['password']);
    $role = 'Customer';

    if(!$username){ array_push($_SESSION['register_errors'], 'Username is Required'); }
    if(!$email){ array_push($_SESSION['register_errors'], 'Email is Required'); }
    if(!$password){ array_push($_SESSION['register_errors'], 'Password is Required'); }

    if(count($_SESSION['register_errors']) > 0){ exit(); }

    if($auth->isUsernameTaken($username)){ array_push($_SESSION['register_errors'], 'Username Already Taken'); }

    if($auth->isEmailTaken($email)){ array_push($_SESSION['register_errors'], 'Email Already Taken'); }

    if(count($_SESSION['register_errors']) == 0){
        $auth->register($username, $email, $password, $role);
        $auth->confirmLogin($email, $password);
        $_SESSION['main'] = "location:http://".$_SERVER['SERVER_NAME'].'/BugTrackingApplication/Views/html/main.php';
        header($_SESSION['main']);
    }
?>
