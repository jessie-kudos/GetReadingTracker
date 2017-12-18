<?php
	session_start();
	$_SESSION['error'] = '';
	$mysqli = new mysqli('localhost', 'jessiekl', 'jessieklabyz', 'jessiekl');
	
	if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
	}
	echo $mysqli->host_info . "\n";
	
	if(isset($_POST) & !empty($_POST)) {
		$username = $mysqli->real_escape_string($_POST['username']);
		$password = $mysqli->real_escape_string($_POST['password']);
	}

	$sql = "SELECT * FROM user WHERE username = '$username'";
	$result = $mysqli->query($sql);

	if ($result->num_rows == 1) {

		$salted = "jhdf45fhuig8sdhzdhsuhaskjhs".$password."uyf83ona";
		$hashed = hash('sha512', $salted);

		$user = $result->fetch_assoc();
		$savedPassword = $user['password'];

		if ($hashed == $savedPassword) {
			$id = $user['id'];
			$_SESSION['username'] = $username;
			$_SESSION['userId'] = $id;
			header("location: /users/show.php?id=" . $id);
		} else {
			$_SESSION['error'] = "Incorrect password. Please try again.";
			header("location: /users/login.php");
		}

	} else {
		$_SESSION['error'] = "User is not yet registered. Please register here.";
		header("location: /users/register.php");
	}	
?>