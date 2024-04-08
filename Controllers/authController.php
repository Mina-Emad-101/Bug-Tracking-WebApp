<?php

require_once __DIR__ . '/../Controllers/dbController.php';
require_once __DIR__ . '/../Models/user.php';

class AuthController
{
	public static function getRoleID($roleName)
	{
		$query = "SELECT * FROM roles WHERE role = '$roleName';";
		$result = DbController::query($query);
		$row = $result->fetch_assoc();
		return $row['id'];
	}

	public static function getRoleFromID($id)
	{
		$query = "SELECT * FROM roles WHERE id = '$id';";
		$result = DbController::query($query);
		$row = $result->fetch_assoc();
		return $row['role'];
	}

	public static function confirmLogin($email, $password)
	{
		$query = "SELECT * FROM auth WHERE email = '$email' AND password = '$password';";
		$result = DbController::query($query);

		if (mysqli_num_rows($result) == 0) return false;

		session_start();
		$row = $result->fetch_assoc();
		$_SESSION['loggedInUser'] = new User($row);

		return true;
	}

	public static function isUsernameTaken($username)
	{
		$query = "SELECT * FROM auth WHERE username = '$username';";
		$result = DbController::query($query);

		if (mysqli_num_rows($result) == 0) {
			return false;
		} else {
			return true;
		}
	}

	public static function isEmailTaken($email)
	{
		$query = "SELECT * FROM auth WHERE email = '$email';";
		$result = DbController::query($query);

		if (mysqli_num_rows($result) == 0) {
			return false;
		} else {
			return true;
		}
	}

	public static function register($username, $email, $password, $role)
	{
		$roleID = self::getRoleID($role);

		$query = "INSERT INTO auth (username, email, password, role_id) VALUES ('$username', '$email', '$password', '$roleID');";
		DbController::query($query);
	}

	public static function deleteAccount($id)
	{
		$query = "DELETE FROM auth WHERE id = '$id';";
		DbController::query($query);
	}

	public static function getUsersArray($roleID = 0)
	{
		$users = array();

		if ($roleID > 0) {
			$query = "SELECT * FROM auth WHERE role_id = $roleID;";
			$result = DbController::query($query);
		} else {
			$query = 'SELECT * FROM auth;';
			$result = DbController::query($query);
		}

		while ($row = $result->fetch_assoc()) {
			$user = new User($row);
			array_push($users, $user);
		}

		return $users;
	}
}
