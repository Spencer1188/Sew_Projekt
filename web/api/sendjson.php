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
	
		$id = $_GET["usrid"];
		$date = $_GET["date"];
		$rdate = new DateTime($date);
		
		$labels = array();
		$items = array();
		$arr = array();
	
	for($i=0;$i<5;$i++){
		$d = $rdate->format('dmY');
		$sql = "SELECT count(*) as anz,date FROM items where date='$d' and usr_id='$id' group by date;";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			// output data of each row
			while($row = $result->fetch_assoc()) {
					$temp1 = [ 
						$row["anz"]
					];
					$temp2 = [ 
						$row["date"]
					];
						array_push($labels, $temp2);
						array_push($items, $temp1);
				}
		} else {
					$temp1 = [ 
						0
					];
					$temp2 = [ 
						$d
					];
						array_push($labels, $temp2);
						array_push($items, $temp1);
		}
		
	
			$rdate->modify('-1 day'); 
		}	
	
		array_push($arr, $labels);
		array_push($arr, $items);
		echo json_encode($arr);
	
}else if($todo== "itemsday"){
		$date = $_GET["day"];
		$id = $_GET["usrid"];
		$background_colors = array('#e53935', '#90caf9', '#a5d6a7', '##cddc39', '#ff9800');
	
		$items = array();
		$labels = array();
		$color = array();
		$itemsanz = array();
		$sql = "SELECT count(*),name FROM items where date=$date and usr_id=$id group by token;";
		
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