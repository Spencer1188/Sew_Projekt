<!doctype html>
<?php 
	include "api/dbconfig.php";
	session_start();
	$id = $_SESSION["id"];

$sql = "SELECT* FROM list order by date ASC";
$result = $conn->query($sql);


echo "
   <script type=\"text/javascript\"><!--
 	var usrid = \"".$id."\";
   </script>
 ";
?>
<html>
<head>
<meta charset="utf-8">
<title>Einkaufsliste</title>
	<link type="text/css" rel="stylesheet" href="asserts/css/bootstrap.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
	 <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <!-- Brand/logo -->
  <a class="navbar-brand" href="mainface.php">Logo</a>
  
  <!-- Links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" href="asserts/php/logout.php">Logout</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="mainface.php">Übersicht</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="buylist.php">Einkaufsliste</a>
    </li>
  </ul>
</nav>
	
	<div class="jumbotron">
  <h1 class="display-4">Einkaufsliste</h1>
  <p class="lead">Alles was Sie benötigen</p>
  <hr class="my-4">
</div>
	
	<div class="container">
	
		<table class="table table-striped">
			<thead>
				<tr>
				  <th scope="col">Titel</th>
				  <th scope="col">Datum</th>
				  <th scope="col">Aktiv</th>
				  <th scope="col"><i class="fas fa-tools"></i></th>
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
				  <td>
					  <i class="fas fa-edit" onClick="edit(<?php echo $row["id"] ?>)"></i>
					  <i class="fas fa-trash" onClick="delete(<?php echo $row["id"] ?>)"></i>
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
					 	 <i class="fas fa-plus-square" style="font-size: 20px"></i>
					</td>
				 </tr>
			</tbody>
		</table>
		
	</div>
	<?php include "listinfo_modal.php"; ?>
</body>
	<script src="asserts/js/my-main.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="asserts/js/bootstrap.js"></script>
	<script>
	
	function edit(val){
		$("#myModal").modal();
		var title = $("#name"+val).text();
		$("#title").val(title);
		
	}
		
	function safe_changes(){
	}
	
	
	</script>
</html>