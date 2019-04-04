<?php
	include "../../api/dbconfig.php";
	session_start();
	$title = $_GET["val"];
	$id = $_GET["id"];
	$usrid = $_SESSION["id"];
	$sql = "UPDATE list SET name='$title' WHERE usrid='$usrid' and id='$id'";

	if ($conn->query($sql) === TRUE) {
		echo "Record updated successfully";
	} else {
		echo "Error updating record: " . $conn->error;
	}

	$conn->close();


?>