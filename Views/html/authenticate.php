<?php
    require __DIR__.'/../../dbAccess.php';
    header('location:./authentication-login.php');

    session_start();
    $_SESSION['login_errors'] = array();

    $email = strtolower(mysqli_real_escape_string($conn, $_POST['email']));
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    if(!$email){ array_push($_SESSION['login_errors'], 'Email is Required'); }

    if(!$password){ array_push($_SESSION['login_errors'], 'Password is Required'); }

    if(count($_SESSION['login_errors']) > 0){ exit(); }

    $query = "SELECT * FROM auth WHERE email = '$email' AND password = '$password';";
    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) == 0){ array_push($_SESSION['login_errors'], 'Incorrect Email or Password'); }

    if(count($_SESSION['login_errors']) == 0){
        $_SESSION['logged_in'] = true;

        $row = mysqli_fetch_assoc($result);
        $_SESSION['username'] = $row['username'];
        $_SESSION['email'] = $row['email'];

        $role_id = $row['role'];
        $query = "SELECT * FROM roles WHERE id = '$role_id';";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);

        $_SESSION['role'] = $row['role'];
    }
?>
