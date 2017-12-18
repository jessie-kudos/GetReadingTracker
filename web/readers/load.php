<?php
	$id = htmlspecialchars($_GET["id"]);
	$sql13 = "SELECT id, sessiondate, title, author, minutes FROM readingsession WHERE readerid = '$id'";
	$result13 = $mysqli->query($sql13);

	while($row13 = $result13->fetch_assoc()) {
		echo "<tr><td>" . $row13['sessiondate'] . "</td><td><i class='fa fa-external-link' onclick='getBookInfo(\"" . $row13['title'] . "\",\"" . $row13['author'] . "\")' aria-hidden='true'></i>" . $row13['title'] . "</td><td>" . $row13['author'] . "</td><td>" . $row13['minutes'] . "<i class='fa fa-times-circle' id=" . $row13['id'] . " aria-hidden='true'></i></td></tr>";
	}
?>