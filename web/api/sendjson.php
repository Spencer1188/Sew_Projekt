<?php
//these are the server details
//the username is root by default in case of xampp
//password is nothing by default
//and lastly we have the database named android. if your database name is different you have to change it 
require_once 'dbconfig.php';
 
//Get Operation
header('Content-Type: text/plain');

if(isset($_GET["op"])){
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
		$restdate = $_GET["date"];
		$items = array();
		$date = $day . "" . $restdate;

	for($i=0;$i<6;$i++){
		$sql = "SELECT count(*),date FROM items where date=$date group by date;";
		
		$stmt = $conn->prepare($sql);
		$stmt->execute();
		$stmt->bind_result($anz,$date);
		$stmt->fetch();
		if($stmt->fetch()){
			$temp = [ 
				0
			];
			array_push($items, $temp);
		}else{
			$temp = [ 
				$anz
				];
				array_push($items, $temp);
		}
			$day = $day+1;
			$date = $day . "" . $restdate;
		
		}	

		echo json_encode($items);	
}else if($todo== "itemsday"){
		$date = $_GET["day"];
		$background_colors = array('#e53935', '#90caf9', '#a5d6a7', '##cddc39', '#ff9800');
	
		$items = array();
		$labels = array();
		$color = array();
		$itemsanz = array();
		$sql = "SELECT count(*),name FROM items where date=$date group by token;";
		
		$stmt = $conn->prepare($sql);
		$stmt->execute();
		$stmt->bind_result($anz,$name);
		$i = 0;
		while($stmt->fetch()){
				$temp1 = [ 
					$anz
				];
			
				$temp2 = [ 
					$name
				];
				$temp3 = [ 
					$background_colors[$i]
				];
				$i++;
				array_push($itemsanz, $temp1);
				array_push($labels, $temp2);
				array_push($color, $temp3);
		}
	
		array_push($items,$itemsanz);
		array_push($items,$labels);
		array_push($items,$color);
		echo json_encode($items);
}
	
}else{
	echo "Use Api";
}



?>