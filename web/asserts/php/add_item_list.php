<?php
	include "../../dbconfig.php";
	$usrid = $_GET["usrid"];
	$listid = $_GET["listid"];

	$sql = "INSERT INTO list_items (list_id,item_id,usr_id)VALUES ($listid,,$usrid)";

	if ($conn->query($sql) === TRUE) {
		echo "New record created successfully";
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}


?>