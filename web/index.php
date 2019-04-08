<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	  <?php include("favicon.php"); ?>
    <title>Login-EinkaufManager</title>
	  	<link type="text/css" rel="stylesheet" href="asserts/css/bootstrap.css">
	  	<link type="text/css" rel="stylesheet" href="asserts/css/my.css">
  </head>

  <body class="abstract-bg">
<nav class="navbar navbar-light navbar-expand-md bg-faded justify-content-center">
  
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsingNavbar3">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="navbar-collapse collapse w-100" id="collapsingNavbar3">
        <ul class="nav navbar-nav ml-auto w-100 justify-content-end">
            <li class="nav-item">
                <a class="nav-link" href="register.php">Registrieren</a>
            </li>
        </ul>
    </div>
</nav>
<div class="wrapper fadeInDown">

  <div id="formContent">
    <!-- Tabs Titles -->

    <!-- Icon -->
    <div class="fadeIn first row" style="padding: 20px; text-align: center">
		<h1 class="headermain col-sm-12 col-lg-9 align-content-center">Ihr Einkaufsmanager</h1>
		<div class="col-sm-12 col-lg-3">
			<img class="navbar-brand w-50 d-flex mr-auto" 		src="images/logo/logo_barcodescanner.png" width="100%" 
				 style="display: block; margin-left: auto; margin-right: auto;">
		</div>
      <!--<img src="http://danielzawadzki.com/codepen/01/icon.svg" id="icon" alt="User Icon" /> -->
    </div>


      <input type="email" id="email" class="fadeIn second" name="login" placeholder="Email">
      <input type="password" id="password" class="fadeIn third" name="login" placeholder="Password">
	  <button onClick="do_login()" type="submit">Login</button><br><br>



	<div class="alert alert-danger no-visible-error" role="alert" id="error-alert">
		<p id="error"></p>
	</div>

  </div>
</div>
	<script src="asserts/js/bootstrap.js"></script>
	<script src="asserts/js/jquery.js"></script>
	<script src="asserts/js/chart.js"></script>
	<script src="asserts/js/my-main.js"></script>

  </body>
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
					 $("#error-alert").removeClass("no-visible-error");
					 $("#error-alert").addClass("visible-error");
					  $("#error").text("Email oder Passwort falsch!");

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
</html>
