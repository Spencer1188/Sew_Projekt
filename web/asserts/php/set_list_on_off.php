<?php
	include "../../api/dbconfig.php";
	session_start();
	$val = $_GET["val"];
	$id = $_SESSION["last_list_id"];

	$sql = "UPDATE list SET active='$val' WHERE id=$id";

	if ($conn->query($sql) === TRUE) {
		echo "Record updated successfully";
	} else {
		echo "Error updating record: " . $conn->error;
	}


?>