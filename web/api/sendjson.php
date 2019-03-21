<?php
//these are the server details
//the username is root by default in case of xampp
//password is nothing by default
//and lastly we have the database named android. if your database name is different you have to change it 
require_once 'dbconfig.php';
 
//Get Operation

$todo = $_GET["op"];
	
if($todo == "all"){
		$items = array(); 
		$sql = "SELECT id,prefix,token,name,price FROM items;";

		$stmt = $conn->prepare($sql);
		$stmt->execute();
		$stmt->bind_result($id,$prefix,$token,$name,$preis);

		while($stmt->fetch()){

		$temp = [ 
			'id'=>$id,
			'prefix'=>$prefix,
			'token'=>$token,
			'name'=>$name,
			'preis'=>$preis
		];
		array_push($items, $temp);
		}
		echo json_encode($items);			
}else if($todo== "daybyday"){
	
		$day = $_GET["day"];
		$items = array(); 
		$sql = "SELECT count(*) FROM items where date=$day;";

		$stmt = $conn->prepare($sql);
		$stmt->execute();
		$stmt->bind_result($anz);

		while($stmt->fetch()){

		$temp = [ 
			'anz'=>$anz,
			'date'=>$day
		];
		array_push($items, $temp);
		}
		echo json_encode($items);	
}



?>