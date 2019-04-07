<!doctype html>
<?php
	include "api/dbconfig.php";
	session_start();
	$id = $_SESSION["id"];

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

	<div class="container" id="table-buylist">


	</div>

	<?php include "listinfo_modal.php"; ?>
</body>
	<script src="asserts/js/my-main.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="asserts/js/bootstrap.js"></script>
	<script>
		var editid;
	window.onload = function () {
  		$("#table-buylist").load('asserts/php/buylist_table.php');
    }
	function edit(val){
		$("#myModal").modal();
		var title = $("#name"+val).text();
		$("#update_in").val(title);
		editid = val;
	}

	function deletelist(val){
		var url = "asserts/php/delete_buylist.php?val="+val;

		$.ajax({
		  url: url,
		  success: function(data){
			  $("#table-buylist").load('asserts/php/buylist_table.php');
		  },
		  type: "GET"
		});
	}

	function safe_changes(){
		var inp = $("#update_in").val();
		var url = "asserts/php/update_buylist_title.php?val="+inp+"&id="+editid;

		$.ajax({
		  url: url,
		  success: function(data){
			  $("#table-buylist").load('asserts/php/buylist_table.php');
		  },
		  type: "GET"
		});
	}

	function open_list(id){
		window.location.href = "newlist.php?type=edit&id="+id;
	}
		
	function newList(){
		
		$.ajax({
		  url: "asserts/php/create_new_list.php?usrid="+usrid,
		  success: function(data){  
			window.location.href = "newlist.php?type=new";
		  },
		  type: "GET"
		});
		
	}




	</script>
</html>
