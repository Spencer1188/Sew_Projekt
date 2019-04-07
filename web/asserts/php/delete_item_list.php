<?php
	include "../../api/dbconfig.php";
	$id = $_GET["id"];

	$sql = "DELETE FROM list_items WHERE id=$id";

	if ($conn->query($sql) === TRUE) {
		echo "Delete successfully";
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}


?>