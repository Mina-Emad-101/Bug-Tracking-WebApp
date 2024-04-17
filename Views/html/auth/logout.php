<?php
session_start();
session_unset();
header('location:http://'.$_SERVER['SERVER_NAME'].'/BugTrackingApplication/Views/html/auth/authentication-login.php');
?>
