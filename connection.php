<?php 
	$url = parse_url(getenv("mysql://b7acce26205a72:05a4c8c1@us-cdbr-iron-east-05.cleardb.net/heroku_58a0d489d10415d?reconnect=true"));

	$server = $url["host"];
	$username = $url["user"];
	$password = $url["pass"];
	$db = substr($url["path"], 1);

	$mysqli = new mysqli($server, $username, $password, $db);
?>