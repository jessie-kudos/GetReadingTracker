<?php 
	session_start();
	session_destroy();
	$_SESSION['error'] = "";
	header("location: /users/login.php");
?>