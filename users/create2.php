<?php
	session_start();
	$_SESSION['error'] = '';

	// $mysqli = new mysqli('us-cdbr-iron-east-05.cleardb.net', 'b7acce26205a72', '05a4c8c1');
	
	// if ($mysqli->connect_errno) {
 //    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
	// }
	// echo $mysqli->host_info . "\n";
	//require (__DIR__.'/../connection.php');

	$url = parse_url(getenv("mysql://b7acce26205a72:05a4c8c1@us-cdbr-iron-east-05.cleardb.net/heroku_58a0d489d10415d?reconnect=true"));

	$server = $url["host"];
	$username = $url["user"];
	$password = $url["pass"];
	$db = substr($url["path"], 1);

	$mysqli = new mysqli($server, $username, $password, $db);

	$username = $mysqli->real_escape_string($_POST['username']);
	$email = $mysqli->real_escape_string($_POST['email']);
	$password = $mysqli->real_escape_string($_POST['password']);
	$confirmPassword = $_POST['confirmPassword'];

	if($password == $confirmPassword) {

		$salted = "jhdf45fhuig8sdhzdhsuhaskjhs".$password."uyf83ona";
		$hashed = hash('sha512', $salted);

		$sql = "INSERT INTO users (username, email, password)" . "VALUES ('$username', '$email', '$hashed')";

		if ($mysqli->query($sql) == true) { 

			$sql = "SELECT id FROM users WHERE username = '$username' AND email = '$email' AND password = '$hashed'";
			$result = $mysqli->query($sql);
			$user = $result->fetch_assoc();
			$id = $user['id'];
			header("location: /users/show.php?id=" . $id);
		}
		else {
			$_SESSION['error'] = "Username already exists. Please use a different username or log in below.";
			header("location: /users/login.php");
		}	
	} else {
		$_SESSION['error'] = "Passwords do not match. Please try again.";
		header("location: /users/register.php");
	}
	
?>