<?php

include "../../api/dbconfig.php";

$id = $_GET["usrid"];
$date = date("dmY");

$sql = "INSERT INTO `list`(`usrid`, `date`, `active`) VALUES ($id,'$date',0)";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
	session_start();
	$_SESSION["last_list_id"] = mysqli_insert_id($conn);
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

?>