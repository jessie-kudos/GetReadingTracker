<?php 
	$url = parse_url(getenv("CLEARDB_DATABASE_URL"));

	$server = $url["host"];
	$username = $url["user"];
	$password = $url["pass"];
	$db = substr($url["path"], 1);

	$mysqli = new mysqli($server, $username, $password, $db);

	if ($mysqli->connect_error) {
		die("Connection failed: " . $mysqli->connect_error);
	}
?>