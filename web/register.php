<!DOCTYPE html>
<html lang="en">
<head>
	<title>Registrieren</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php include "favicon.php"; ?>
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<style>
		.small{
			width: 20% !important;
		}
		
		.center {
  display: block;
  margin-left: auto;
  margin-right: auto;
  width: 50%;
}
	</style>
</head>
<body style="background-color: #666666;">
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-form validate-form" style="padding-top: 200px;">
		
					<img class="login100-form-title p-b-43 small center" src="images/logo/logo_barcodescanner.png" width="20%">
					</img>
					<div class="text-center p-t-46 p-b-20">
							
					</div>
					
					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input100" type="email" name="email" id="email">
						<span class="focus-input100"></span>
						<span class="label-input100">Email</span>
					</div>
					
					
					<div class="wrap-input100 validate-input" data-validate="Passwort ist erforderlich">
						<input class="input100" type="password" name="pass" id="password1">
						<span class="focus-input100"></span>
						<span class="label-input100">Passwort</span>
					</div>
					<div class="wrap-input100 validate-input" data-validate="Passwort ist erforderlich">
						<input class="input100" type="password" name="pass" id="password2">
						<span class="focus-input100"></span>
						<span class="label-input100">Passwort wiederholen</span>
					</div>
			

					<div class="container-login100-form-btn" id="loader">

					</div>
					
					<div class="text-center p-t-46 p-b-20">
							<a href="index.php">Jetzt Einloggen</a>
					</div>
				</div>

				<div class="login100-more" style="background-image: url('images/bg/wallhaven-61437.jpg');">
				</div>
			</div>
		</div>
	</div>
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
	<script src="vendor/animsition/js/animsition.min.js"></script>
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="vendor/select2/select2.min.js"></script>
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
	<script src="vendor/countdowntime/countdowntime.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
	<script src="js/main.js"></script>
	<script src="asserts/js/jquery.js"></script>
	<script src="asserts/js/my-main.js"></script>
	<script>
		
		window.onload = function(){
			$("#loader").load("register_form.php");
		}
		
		function do_regist(){
			 var email=$("#email").val();
			 var pass1=$("#password1").val();
			 var pass2=$("#password2").val();
			
			if(email != ""  && pass2 != "" && pass2 != "" ){
				$("#loader").load("preloader.php");
				send_regist();
			}else{
						Swal.fire({
						  type: 'warning',
						  title: 'Haben Sie Etwas Vergessen?'
						})
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
						Swal.fire({
						  type: 'error',
						  text: data
						})
					 $("#loader").load("register_form.php");
				  }
			  },			
			  error:function() {
						Swal.fire({
						  type: 'Error',
						  title: 'Regestrieren funktioniert derzeit nicht!'
						})
			  }
			  });
		}
		
	
	</script>

</html>