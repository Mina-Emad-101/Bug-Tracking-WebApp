<?php
if(!isset($_SESSION)){
	session_start();
}
session_unset();
header('location:http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'].'/Views/html/auth/authentication-login.php');
?>
