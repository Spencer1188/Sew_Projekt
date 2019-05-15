<?php 
	include "../../api/dbconfig.php";
	session_start();
	$id = $_SESSION["id"];
	$listid = $_SESSION["last_list_id"];

	$sql = "SELECT id,item_id,count(*) as anz FROM list_items where usr_id=$id and list_id=$listid group by item_id";
	$result = $conn->query($sql);
?>

			<?php
				  if ($result->num_rows > 0) {
						// output data of each row
						while($row = $result->fetch_assoc()) { 
							$listid = $row["item_id"];
				  			$sql2 = "SELECT name,id as anz FROM items where id='$listid'";
							$items = $conn->query($sql2);
							$item = $items->fetch_assoc()
				  ?>
							<tr>
							  <th scope="row" id="name<?php echo $row["id"] ?>"><?php echo $item["name"] ?></th>
							  <td><?php echo $row["anz"] ?></td>
							  <td class="text-center">
								  <i class="fas fa-trash" onClick="deleteitem(<?php echo $row["id"] ?>)"></i>
							  </td>
							</tr>
				<?php
						} 
					  } ?>
