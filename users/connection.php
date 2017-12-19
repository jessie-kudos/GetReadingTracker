<?php 
	$servername = "us-cdbr-iron-east-05.cleardb.net";
	$username = "b7acce26205a72";
	$password = "05a4c8c1";

	// Create connection
	$mysqli = mysqli_connect($servername, $username, $password);

	// Check connection
	if (!$mysqli) {
	    die("Connection failed: " . mysqli_connect_error());
	}
	echo "Connected successfully";
?>