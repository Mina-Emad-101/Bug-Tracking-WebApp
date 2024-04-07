<?php

require_once __DIR__.'/../Controllers/dbController.php';
require_once __DIR__.'/../Models/user.php';

class AuthController
{
	public static function getRoleID($role)
	{
		if($role == 'Admin') return 1;
		if($role == 'Staff') return 2;
		if($role == 'Customer') return 3;
	}

	public static function getRoleFromID($id)
	{
		if($id == 1) return 'Admin';
		if($id == 2) return 'Staff';
		if($id == 3) return 'Customer';
	}

	public static function confirmLogin($email, $password)
	{
		$query = "SELECT * FROM auth WHERE email = '$email' AND password = '$password';";
		$result = DbController::query($query);

		if(mysqli_num_rows($result) == 0) return false;

		session_start();
		$row = $result->fetch_assoc();
		$_SESSION['loggedInUser'] = new User($row);

		return true;
	}

	public static function isUsernameTaken($username)
	{
		$query = "SELECT * FROM auth WHERE username = '$username';";
		$result = DbController::query($query);

		if(mysqli_num_rows($result) == 0){ return false; } else { return true; }
	}

	public static function isEmailTaken($email)
	{
		$query = "SELECT * FROM auth WHERE email = '$email';";
		$result = DbController::query($query);

		if(mysqli_num_rows($result) == 0){ return false; } else { return true; }
	}

	public static function register($username, $email, $password, $role)
	{
		$roleID = self::getRoleID($role);

		$query = "INSERT INTO auth (username, email, password, role_id) VALUES ('$username', '$email', '$password', '$roleID');";
		DbController::query($query);
	}

}

?>
