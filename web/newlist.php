<!doctype html>
<?php

if($_GET["type"]=="new"){
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
}else if($_GET["type"] == "edit"){
	include "api/dbconfig.php";
	session_start();
	$id = $_SESSION["id"];
	$listid = $_GET["id"];
	$_SESSION["last_list_id"] = $listid;
	echo $listid;
echo "
   <script type=\"text/javascript\"><!--
 	var usrid = \"".$id."\";
	var aktlist = \"".$listid."\";
   </script>
 ";
}
?>
<html>
<head>
<meta charset="utf-8">
<title>Neue Liste</title>
	<link type="text/css" rel="stylesheet" href="asserts/css/bootstrap.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
	<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
	 <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <!-- Brand/logo -->
  <a class="navbar-brand" href="mainface.php">Logo</a>

</nav>
	<br>
<div class="container">
<div class="row">
  <div class="form-group col-8">
    <label for="exampleInputEmail1">Title der Einkaufsliste</label>
    <input type="text" class="form-control" id="titlename" placeholder="Name der Einkaufsliste">
  </div>  
  <div class="form-group row align-content-end" style="margin-left: 30px;">
	<button class="btn btn-outline-dark" onClick="safetitle()">Speichern</button>
	<button class="btn btn-outline-primary " onClick="closeList()" style="margin-left: 10px;">Schließen</button>
  </div>
</div>
<div class="row">
	<div class="form-group col-8">
		<input type="checkbox" data-toggle="toggle" data-on="Aktiv" data-off="Inaktiv" data-onstyle="success" data-offstyle="danger" id="switch-active">
	</div>
</div>
	<div class="row">
		<div id="aktlist" class="col-sm-12 col-lg-6">
		</div>
		<div id="alllist" class="col-sm-12 col-lg-6">
		</div>
	</div>
</div>



	<?php include "listinfo_modal.php"; ?>
</body>
	<script src="asserts/js/my-main.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="asserts/js/bootstrap.js"></script>
	<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
	<script>
		
	window.onload = function () {
		$.ajax({
		  url: "asserts/php/get_title_item_list.php?id="+aktlist,
			 success: function(data){ 
				 var a = JSON.parse(data);
				$("#titlename").val(a["name"]);
				 if(a["anz"] == 1){
				 	$('#switch-active').bootstrapToggle('on');
				 }else{
					 $('#switch-active').bootstrapToggle('off');
				 }
			 },
		  type: "GET"
		});
		 $("#aktlist").load('asserts/php/aktlist.php');
		 $("#alllist").load('asserts/php/allitemslist.php');
		
		  $(function() {
			$('#switch-active').bootstrapToggle();
		  })
		  $(function() {
			$('#switch-active').change(function() {
				var val=0;
			 	if($(this).prop('checked')){
					val=1;
				}
				
					$.ajax({
					  url: "asserts/php/set_list_on_off.php?val="+val,
					  type: "GET"
					});
			})
		  })
	 
    }
	
	function safetitle(){
		var name = $("#titlename").val();
		
		$.ajax({
		  url: "asserts/php/safe_title_item_list.php?val="+name+"&listid="+aktlist,
		  type: "GET"
		});
	}
		
	function closeList(){
		window.location.href = "buylist.php";
	}
		

	
	function additem(itemid){
		
		$.ajax({
		  url: "asserts/php/add_item_list.php?usrid="+usrid+"&listid="+aktlist+"&itemid="+itemid,
		  success: function(data){ 
			  $("#aktlist").load('asserts/php/aktlist.php');
		  },
		  type: "GET"
		});
		
	}
		
	function deleteitem(itemid){
		$.ajax({
		  url: "asserts/php/delete_item_list.php?id="+itemid,
		  success: function(data){
			  $("#aktlist").load('asserts/php/aktlist.php');
		  },
		  type: "GET"
		});
		
	}

</script>
</html>
