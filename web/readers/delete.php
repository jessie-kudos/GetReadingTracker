<?php
	session_start();
	$mysqli = new mysqli('localhost', 'jessiekl', 'jessieklabyz', 'jessiekl');

	$id = $mysqli->real_escape_string($_POST['id']);
	$username = $mysqli->real_escape_string($_POST['username']);

	$sql = "DELETE FROM reader WHERE id = '$id'";

	if ($mysqli->query($sql) == true) {
		$_SESSION['info'] = 'Reader successfully deleted!';
		header("location: /~jessiekl/GetReadingTracker/users/show.php?username=" . $username);
	}
	else {
		$_SESSION['error'] = "Reader could not be deleted.";
		header("location: /~jessiekl/GetReadingTracker/users/show.php?username=" . $username);
	}	
?>