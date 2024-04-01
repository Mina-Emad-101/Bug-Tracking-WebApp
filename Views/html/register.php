<?php
require __DIR__.'/../../dbAccess.php';
header('location:./authentication-register.php');

session_start();
$_SESSION['register_errors'] = array();

$username = mysqli_real_escape_string($conn, $_POST['username']);
$email = strtolower(mysqli_real_escape_string($conn, $_POST['email']));
$password = mysqli_real_escape_string($conn, $_POST['password']);
$role = $_POST['role'];

if(!$username){ array_push($_SESSION['register_errors'], 'Username is Required'); }
if(!$email){ array_push($_SESSION['register_errors'], 'Email is Required'); }
if(!$password){ array_push($_SESSION['register_errors'], 'Password is Required'); }

if(count($_SESSION['register_errors']) > 0){ exit(); }

$query = "SELECT * FROM auth WHERE username = '$username';";
$result = mysqli_query($conn, $query);
if(mysqli_num_rows($result) > 0){ array_push($_SESSION['register_errors'], 'Username Already Taken'); }

$query = "SELECT * FROM auth WHERE email = '$email';";
$result = mysqli_query($conn, $query);
if(mysqli_num_rows($result) > 0){ array_push($_SESSION['register_errors'], 'Email Already Taken'); }

if(count($_SESSION['register_errors']) == 0){
    $_SESSION['logged_in'] = true;
    $query = "INSERT INTO auth (username, email, password, role_id) VALUES ('$username', '$email', '$password', 3);";
    mysqli_query($conn, $query);
    header('location:./main.php');
}
?>
