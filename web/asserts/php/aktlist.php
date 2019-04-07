<?php 
	include "../../api/dbconfig.php";
	session_start();
	$id = $_SESSION["id"];
	$listid = $_SESSION["last_list_id"];
	$sql = "SELECT * FROM list_items where usr_id=$id and list_id=$listid";
	$result = $conn->query($sql);
?>
		<table class="table table-striped">
			<thead>
				<tr>
				  <th scope="col">Produktname</th>
				  <th scope="col"><i class="fas fa-tools"></i></th>
				</tr>
			  </thead>
			  <tbody>
			<?php
				  if ($result->num_rows > 0) {
						// output data of each row
						while($row = $result->fetch_assoc()) { 
							$listid = $row["item_id"];
				  			$sql2 = "SELECT * FROM items where id='$listid'";
							$result = $conn->query($sql2);
							$item = $result->fetch_assoc()
				  ?>
							<tr>
							  <th scope="row" id="name<?php echo $row["id"] ?>"><?php echo $item["name"] ?></th>
							  <td class="text-center">
								  <i class="fas fa-trash" onClick="deletelist(<?php echo $item["id"] ?>)"></i>
							  </td>
							</tr>
				<?php
						} 
					  } ?>
			</tbody>
		</table>