<?php
	session_start();
	
	if(isset($_SESSION['main']))
	{
		$main = $_SESSION['main'];
	}
	else
	{
		$main = 'location:./Views/html/auth/authentication-login.php';
	}
	
	header($main);
?>
