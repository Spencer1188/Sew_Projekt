<?php
	include "../../api/dbconfig.php";

	$id = $_GET["id"];

	$sql = "SELECT * from list where id=$id";
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
	$arr = array("name"=>$row["name"],"anz"=>$row["active"]);

	echo json_encode($arr);



?>