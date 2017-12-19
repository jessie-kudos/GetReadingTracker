<?php
	session_start();
	require (__DIR__.'/../connection.php');

	$readerid = $mysqli->real_escape_string($_POST['readerid']);

	$sql = "SELECT COUNT(*) AS RecordCount FROM readingsessions WHERE readerid = '$readerid'"; 
	$result = $mysqli->query($sql);
	$row = $result->fetch_assoc();
	$recordCount = $row['RecordCount'];

	$sql = "SELECT * FROM readingsessions WHERE readerid = '$readerid' ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";";
	$result = $mysqli->query($sql);

	$rows = array();

	while ($row = $result->fetch_assoc()) {
		$rows[] = $row;
	}

	$jTableResult = array();
	$jTableResult['Result'] = "OK";
	$jTableResult['TotalRecordCount'] = $recordCount;
	$jTableResult['Records'] = $rows;
	print json_encode($jTableResult);
?>



										