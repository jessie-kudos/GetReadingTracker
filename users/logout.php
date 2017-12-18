<?php 
	session_start();
	session_destroy();
	$_SESSION['error'] = "";
	header("location: /~jessiekl/GetReadingTracker/users/login.php");
?>