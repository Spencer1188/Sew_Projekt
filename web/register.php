<!doctype html>
<html>
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registrieren-EinkaufManager</title>
	  	<link type="text/css" rel="stylesheet" href="asserts/css/bootstrap.css">
	  	<link type="text/css" rel="stylesheet" href="asserts/css/my.css">
	<?php include("favicon.php"); ?>
</head>
<body class="register" id="regform">

</body>
		<script src="asserts/js/bootstrap.js"></script>
	<script src="asserts/js/jquery.js"></script>
	<script src="asserts/js/chart.js"></script>
	<script src="asserts/js/my-main.js"></script>
	<script>
	
		$(document).ready(function() { 

				$("#regform").load("register_form.php");
		
		});
	
		function do_regist(){
			 var email=$("#email").val();
			 var pass1=$("#password1").val();
			 var pass2=$("#password2").val();
			
			if(email != ""  && pass2 != "" && pass2 != "" ){
				$("#regist").load("preloader.php");
				send_regist();
			}else{
				alert("Please Fill All The Details");
			}
			
		}
		
		function send_regist(){
			 var email=$("#email").val();
			 var pass1=$("#password1").val();
			 var pass2=$("#password2").val();
			
			  $.ajax
			  ({
			  type:'post',
			  url:'asserts/php/do_regist.php',
			  data:{
			   mail:email,
			   pw1:pass1,
			   pw2:pass2
			  },
			  success:function(data) {
				  if(data == "ok"){
					 setTimeout(function(){ window.location.href = "index.php"; }, 3000);
				  }else{
					 alert(data);
					 $("#regform").load("register_form.php");
				  }
			  },			
			  error:function() {
				alert("error");
			  }
			  });
		}
		
	
	</script>

</html>