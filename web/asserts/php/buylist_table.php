<?php 
	include "../../api/dbconfig.php";
	session_start();
	$id = $_SESSION["id"];

	$sql = "SELECT* FROM list where usrid=$id order by date ASC";
	$result = $conn->query($sql);
?>
<table class="table table-striped">
			<thead>
				<tr>
				  <th scope="col">Titel</th>
				  <th scope="col">Datum</th>
				  <th scope="col">Aktiv</th>
				  <th scope="col" class="text-center"><i class="fas fa-tools"></i></th>
				</tr>
			  </thead>
			  <tbody>
			<?php
				  if ($result->num_rows > 0) {
						// output data of each row
						while($row = $result->fetch_assoc()) {  ?>
				<tr onClick="open_list(<?php echo $row["id"] ?>)">
				  <th scope="row" id="name<?php echo $row["id"] ?>"><?php echo $row["name"] ?></th>
				  <td><?php echo $row["date"] ?></td>
				  <td><?php if($row["active"] == 1){ ?>
						<i class="fas fa-check-square" style="color: #689f38"></i>
					<?php }else{ ?>
					 	<i class="fas fa-window-close" style="color: #e64a19"></i>
					 <?php } ?>
				  </td>
				  <td class="text-center">
					  <i class="fas fa-edit" onClick="edit(<?php echo $row["id"] ?>)"></i>
					  <i class="fas fa-trash" onClick="deletelist(<?php echo $row["id"] ?>)"></i>
				  </td>
				</tr>
			<?php
					} 
				  } else { ?>
 				<tr>
				   <td colspan="4">
					 	Keine Listen erstellt!
					</td>
				 </tr>
					<?php } ?>
				 <tr>
				   <td colspan="4">
					 	 <i class="fas fa-plus-square" style="font-size: 20px" onClick="newList()"></i>
					</td>
				 </tr>
			</tbody>
		</table>