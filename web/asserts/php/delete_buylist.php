<?php
	include "../../api/dbconfig.php";
	session_start();
	$val = $_GET["val"];
	$usrid = $_SESSION["id"];

	$sql = "DELETE FROM list WHERE id=$val and usrid=$usrid";

	if ($conn->query($sql) === TRUE) {
		echo "Record deleted successfully";
	} else {
		echo "Error deleting record: " . $conn->error;
	}

	$conn->close();


?>