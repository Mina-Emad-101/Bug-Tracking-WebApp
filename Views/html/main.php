<?php
    require_once __DIR__.'/../../Models/user.php';
    session_start();
    $role = $_SESSION['loggedInUser']->getRole();
    header('location:./'.$role.'/main.php');
?>
