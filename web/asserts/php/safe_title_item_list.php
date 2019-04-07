<?php

	include "../../api/dbconfig.php";

	$name = $_GET["val"];
	$id = $_GET["listid"];

	$sql = "UPDATE list SET name='$name' WHERE id=$id";

	if ($conn->query($sql) === TRUE) {
		echo "Record updated successfully";
	} else {
		echo "Error updating record: " . $conn->error;
	}


?>