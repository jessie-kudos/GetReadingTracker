<?php
	session_start();
	$_SESSION['error'] = '';
	$mysqli = new mysqli('localhost', 'jessiekl', 'jessieklabyz', 'jessiekl');
	
	// if ($mysqli->connect_errno) {
 //    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
	// }
	// echo $mysqli->host_info . "\n";

	$username = $mysqli->real_escape_string($_POST['username']);

	$sql = "INSERT INTO users (username)" . "VALUES ('$username')";

	if ($mysqli->query($sql) == true) {
		$_SESSION['info'] = 'Registration successful!';
		header("location: /~jessiekl/GetReadingTracker/users/show.php?username=" . $username);
	}
	else {
		$_SESSION['error'] = "Username already taken. Please enter a new username.";
		header("location: /~jessiekl/GetReadingTracker/users/signup.php");
	}	
?>