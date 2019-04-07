<!doctype html>
<?php
	include "api/dbconfig.php";
	session_start();
	$id = $_SESSION["id"];
	$listid = $_SESSION["last_list_id"];
echo "
   <script type=\"text/javascript\"><!--
 	var usrid = \"".$id."\";
	var aktlist = \"".$listid."\";
   </script>
 ";
?>
<html>
<head>
<meta charset="utf-8">
<title>Neue Liste</title>
	<link type="text/css" rel="stylesheet" href="asserts/css/bootstrap.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
	 <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <!-- Brand/logo -->
  <a class="navbar-brand" href="mainface.php">Logo</a>

</nav>
	<br>
<div class="container">
<form class="row">
  <div class="form-group col-8">
    <label for="exampleInputEmail1">Title der Einkaufsliste</label>
    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Name der Einkaufsliste">
  </div>
</form>
	<div class="row">
		<div id="aktlist" class="col-6">
		</div>
		<div id="alllist" class="col-6">
		</div>
	</div>
</div>



	<?php include "listinfo_modal.php"; ?>
</body>
	<script src="asserts/js/my-main.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="asserts/js/bootstrap.js"></script>
	<script>
		
	window.onload = function () {
		 $("#aktlist").load('asserts/php/aktlist.php');
		 $("#alllist").load('asserts/php/allitemslist.php');
    }
	
	function additem(itemid){
		
		$.ajax({
		  url: "asserts/php/create_new_list.php?usrid="+usrid+"&listid="+aktlist,
		  success: function(data){  
			  alert(data);
		  },
		  type: "GET"
		});
		
	}

</script>
</html>
