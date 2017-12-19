<?php
	session_start();
	require (__DIR__.'/../connection.php');

	$readername = $mysqli->real_escape_string($_POST['readername']);
	$username = $mysqli->real_escape_string($_POST['username']);
	$id = $_SESSION['userId'];


	$sql = "INSERT INTO readers (name, username)" . "VALUES ('$readername','$username')";

	if ($mysqli->query($sql) == true) {
		$_SESSION['info'] = 'Reader successfully added!';
		header("location: /users/show.php?id=" . $id);
	}
	else {
		$_SESSION['error'] = "Reader could not be added.";
		header("location: /users/show.php?id=" . $id);
	}	
?>