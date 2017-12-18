<?php
	session_start();
	$mysqli = new mysqli('localhost', 'jessiekl', 'jessieklabyz', 'jessiekl');

	// $id = $mysqli->real_escape_string($_POST['del_id']);

	$sql = "DELETE FROM readingsession WHERE id ='".$_POST["id"]."'";
	$result = $mysqli->query($sql);

	// if ($mysqli->query($sql) == true) {
	// 	$_SESSION['info'] = 'Reading session successfully deleted!';
	// 	echo "YES";
	// }
	// else {
	// 	$_SESSION['error'] = "Reading session could not be deleted.";
	// 	echo "NO";
	// }	
	$jTableResult = array();
	$jTableResult['Result'] = "OK";
	print json_encode($jTableResult);
?>