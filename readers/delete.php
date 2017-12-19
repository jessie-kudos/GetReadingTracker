<?php
	session_start();
	require (__DIR__.'/../connection.php');

	$readerId = $mysqli->real_escape_string($_POST['id']);
	$id = $_SESSION['userId'];

	$sql = "DELETE FROM readers WHERE id = '$readerId'";

	if ($mysqli->query($sql) == true) {
		$_SESSION['info'] = 'Reader successfully deleted!';
		header("location: /users/show.php?id=" . $id);
	}
	else {
		$_SESSION['error'] = "Reader could not be deleted.";
		header("location: /users/show.php?id=" . $id);
	}	
?>