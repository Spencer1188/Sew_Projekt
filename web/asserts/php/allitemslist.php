<?php 
	include "../../api/dbconfig.php";
	session_start();
	$id = $_SESSION["id"];
	$sql = "SELECT token,name,id FROM `items` group by token";
	$result = $conn->query($sql);
?>
		<table class="table table-striped">
			<thead>
				<tr>
				  <th scope="col">Produktname</th>
				  <th scope="col"><input type="text" class="form-control"></th>
				</tr>
			  </thead>
			  <tbody>
			<?php
				  if ($result->num_rows > 0) {
						// output data of each row
						while($row = $result->fetch_assoc()) {
				  ?>
							<tr>
							  <th scope="row" id="name<?php echo $row["name"] ?>"><?php echo $row["name"] ?></th>
							  <td class="text-center">
								  <i class="fas fa-plus" onClick="additem(<?php echo $row["id"] ?>)"></i>
							  </td>
							</tr>
				<?php
						} 
					  } ?>
			</tbody>
		</table>

