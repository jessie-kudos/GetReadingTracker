<?php 
	$servername = "us-cdbr-iron-east-05.cleardb.net";
	$username = "b7acce26205a72";
	$password = "05a4c8c1";

	// Create connection
	$mysqli = new mysqli($servername, $username, $password);

	// Check connection
	if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
	}
	echo $mysqli->host_info . "\n";
?>