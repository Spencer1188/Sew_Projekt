<?php

//Login
require_once 'dbconfig.php';
if($_SERVER['REQUEST_METHOD'] == 'GET') {

    if(isset($_GET["func"])){

        if($_GET["func"] == "additem"){
            $token = 'cisco123';

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
                    $last_id = $conn->insert_id;
					$myOb = new \stdClass();
					error_reporting(E_ERROR | E_PARSE);
					if($productName != ""){
                    	$myOb->scan->n = $response->product->name;
					}else{
						$id = "0";
						$arr = array("0"=>"Noname");
						$myOb->scan->n->$id = "Noname";
					}
                    $myOb->scan->id = (string) $last_id;
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
        }else if($_GET["func"]== "getlist"){
            $id = $_GET["usrid"];
            $sql = "SELECT items.name,count(*) as anz FROM `list` join list_items on list.id = list_items.list_id join items on items.id = list_items.item_id WHERE usrid='$id' and active=1 group by name";

            $result = $conn->query($sql);
            $list = array();

            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    $arr->name = $row["name"];
                    $arr->anzahl = (string) $row["anz"];
                    array_push($list,$arr);
                }
            } else {
                $arr->error = "0 Result";
                array_push($list,$arr);
            }

            echo json_encode($list);
        }

    }else{
        echo "Use APi";
    }

} elseif($_SERVER['REQUEST_METHOD'] == 'PUT') {

    parse_str(file_get_contents("php://input"),$post_vars);
    $Name = $post_vars['Name'];
    $id = $post_vars['Id'];


    $sql = "UPDATE `items` SET `name`='$Name' WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        $myOb = new \stdClass();
        $myOb->scan = $id;
        $myJSON = json_encode($myOb);
        echo $myJSON;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;

        $myOb->scan = $conn->error;
        $myJSON = json_encode($myOb);
        echo $myJSON;
    }

}

?>
