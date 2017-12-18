<?php
	session_start();
	$mysqli = new mysqli('localhost', 'jessiekl', 'jessieklabyz', 'jessiekl');

	$readername = $mysqli->real_escape_string($_POST['readername']);
	$username = $mysqli->real_escape_string($_POST['username']);

	$sql = "INSERT INTO reader (name, username)" . "VALUES ('$readername','$username')";

	if ($mysqli->query($sql) == true) {
		$_SESSION['info'] = 'Reader successfully added!';
		header("location: /~jessiekl/GetReadingTracker/users/show.php?username=" . $username);
	}
	else {
		$_SESSION['error'] = "Reader could not be added.";
		header("location: /~jessiekl/GetReadingTracker/users/show.php?username=" . $username);
	}	
?>