<?php
//Login
require_once 'dbconfig.php';
if($_SERVER['REQUEST_METHOD'] == 'GET') {

if(isset($_GET["func"])){

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
		$myOb = new \stdClass();
		$myOb->scan = $productName;
		$myJSON = json_encode($myOb);
		echo $myJSON;
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
	}else{
		echo "Use API!";
	}
	$conn->close();
}else if($_GET["func"] == "login"){
	
	$mail = $_GET["mail"];
	$password = $_GET["password"];
	$password_hash = hash('sha256', $password);
	$regusr = mysqli_query($conn,"SELECT * FROM `user` WHERE mail = '$mail'");
	$dbusr = mysqli_fetch_array($regusr);

	if($dbusr["password"] == $password_hash){
		
	$myObj->uid = $dbusr["usr_id"];

	$JSON = json_encode($myObj);

	echo $JSON;

	}
	else{
		echo json_encode("error");
	}
}else if($_GET["func"]== "changepname"){
	parse_str(file_get_contents("php://input"),$post_vars);
    echo $post_vars['Name'];
}
	
}else{
	echo "Use APi";
}
	
} elseif($_SERVER['REQUEST_METHOD'] == 'PUT') {
	
	echo "this is a put request\n";
    parse_str(file_get_contents("php://input"),$post_vars);
    echo $post_vars['Name'];
	
}

?>