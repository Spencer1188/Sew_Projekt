<?php
	include "../../api/dbconfig.php";
	$usrid = $_GET["usrid"];
	$listid = $_GET["listid"];
	$itemid = $_GET["itemid"];

	$sql = "INSERT INTO list_items (list_id,item_id,usr_id)VALUES ('$listid','$itemid','$usrid')";

	if ($conn->query($sql) === TRUE) {
		echo "New record created successfully";
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}


?>