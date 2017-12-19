<?php
	session_start();
	require (__DIR__.'/../connection.php');

	$sql = "DELETE FROM readingsessions WHERE id ='".$_POST["id"]."'";
	$result = $mysqli->query($sql);
	
	$jTableResult = array();
	$jTableResult['Result'] = "OK";
	print json_encode($jTableResult);
?>