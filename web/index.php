<!DOCTYPE html>
<html lang="en">
<head>
	<title>Anmelden</title>
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
				<div class="login100-form validate-form" style="padding-top: 200px;" method="post">
		
					<img class="login100-form-title p-b-43 small center" src="images/logo/logo_barcodescanner.png" width="20%">
					</img>
					<div class="text-center p-t-46 p-b-20">
							
					</div>
					
					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input100" type="email" name="email" id="email">
						<span class="focus-input100"></span>
						<span class="label-input100">Email</span>
					</div>
					
					
					<div class="wrap-input100 validate-input" data-validate="Password is required">
						<input class="input100" type="password" name="pass" id="password">
						<span class="focus-input100"></span>
						<span class="label-input100">Passwort</span>
					</div>
			

					<div class="container-login100-form-btn">
						<button class="login100-form-btn" onClick="do_login()">
							Einloggen
						</button>
					</div>
					
					<div class="text-center p-t-46 p-b-20">
							<a href="register.php">Oder Regestrieren Sie sich</a>
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
	<script>
		
	function do_login(){

		 var email=$("#email").val();
		 var pass=$("#password").val();

		 if(email!="" && pass!="" )
		 {
			  $.ajax
			  ({
			  type:'post',
			  url:'asserts/php/do_login.php',
			  data:{
			   mail:email,
			   pw:pass
			  },
			  success:function(data) {
				if(data == "error"){
						Swal.fire({
						  type: 'error',
						  title: 'Oops...',
						  text: 'Email oder Passwort falsch!'
						})

				  }else{
					 window.location.href = "mainface.php";
				  }
			  },
			  error:function() {
				  M.toast({html: 'Fehler beim Login'})
			  }
			  });
		 }else {
		  alert("Please Fill All The Details");
		 }

		}
	
	
	</script>

</body>
</html>