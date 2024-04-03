<?php
    require_once __DIR__.'/../../Models/user.php';
    session_start();
    header('location:./main-'.strtolower($_SESSION['loggedInUser']->getRole()).'.php');
?>
