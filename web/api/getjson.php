<?php
//Login
require_once 'dbconfig.php';
$token = 'maxserver';


//Retrieve the data.
$prefix = $_POST['prefix'];
$ean = $_POST['token'];

//EAN Search
$xml = file_get_contents("https://api.ean-search.org/api?" . "op=barcode-lookup&token=$token&ean=$ean");
$response = new SimpleXMLElement($xml);
$productName = $response->product->name;
$date = date("dmY");

//Sql insert db
$sql = "INSERT INTO items (prefix,token,name,date) VALUES ('$prefix','$ean','$productName','$date')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

?>