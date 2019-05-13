<?php
	include "../../api/dbconfig.php";
	
	$usrid=$_GET["usrid"];

	$sql = "SELECT * FROM `list` WHERE `usrid`=$usrid and `active`=1";
	$result = $conn->query($sql);

	if ($result->num_rows > 1) {
		// output data of each row
		while($row = $result->fetch_assoc()) {
			echo "1";
		}
	} else {
		echo "0";
	}
	$conn->close();


?>