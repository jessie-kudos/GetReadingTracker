<?php
	session_start();
	require (__DIR__.'/../connection.php');

	$sessiondate = $mysqli->real_escape_string($_POST['sessiondate']);
	$title = $mysqli->real_escape_string($_POST['title']);
	$author = $mysqli->real_escape_string($_POST['author']);
	$minutes = $mysqli->real_escape_string($_POST['minutes']);
	$finished = $mysqli->real_escape_string($_POST['finished']);
	$readerid = $mysqli->real_escape_string($_POST['readerid']);

	$titleF = formatInput($title);
	$authorF = formatInput($author);


	$sql = "INSERT INTO readingsessions (sessiondate, minutes, author, title, finished, readerid)" . "VALUES ('$sessiondate','$minutes','$authorF','$titleF','$finished','$readerid')";

	if ($mysqli->query($sql) == true) {
		$_SESSION['info'] = 'Reading session successfully added!';
		header("location: /readers/show.php?id=" . $readerid);
	}
	else {
		$_SESSION['error'] = "Reading session could not be added.";
		header("location: /readers/show.php?id=" . $readerid);
	}

	function upcase($word) {
		return ucfirst($word);
	}

	function formatInput($input) {
		$inputLower = strtolower($input);
		$inputArray = explode(" ", $inputLower);

		foreach ($inputArray as &$word) {
			$word = ucfirst($word);
		}

		return implode(" ",$inputArray);
	}	
?>