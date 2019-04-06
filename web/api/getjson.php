<?php
//Login
require_once 'dbconfig.php';

if($_GET["func"] == "additem"){
	$token = 'maxserver';

	if( isset($_GET['eantoken']) and $_GET['prefix']){
	//Retrieve the data.
	$prefix = $_GET['prefix'];
	$ean = $_GET['eantoken'];
	$usrid = $_GET["usrid"];

	//EAN Search
	$xml = file_get_contents("https://api.ean-search.org/api?" . "op=barcode-lookup&token=$token&ean=$ean");
	$response = new SimpleXMLElement($xml);
	$productName = $response->product->name;
	$date = date("dmY");

	//Sql insert db

	$sql = "INSERT INTO items (usr_id,prefix,token,name,date) VALUES ('$usrid','$prefix','$ean','$productName','$date')";

	if ($conn->query($sql) === TRUE) {
		echo "New record created successfully";
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
	}else{
		echo "Use API!";
	}
	$conn->close();
}

?>