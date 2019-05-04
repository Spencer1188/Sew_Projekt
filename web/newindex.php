<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	  <?php include("favicon.php"); ?>
    <title>Login-EinkaufManager</title>
	  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
	  <link href="asserts/css/my.css" rel="stylesheet" type="text/css">
	  <style>
	  
.abstract-bg{
	background-image: url("images/bg/main.jpg");
	background-size: cover;
	background-repeat: no-repeat;
	overflow: hidden !important;
}

	  
	  </style>
  </head>
<body>

<div class="navbar-fixed">
  <nav class="transparent z-depth-0">
    <div class="nav-wrapper">
      <ul class="right" id="nav-mobile">
        <li><a href="https://github.com/dogfalo/materialize/" target="_blank">Regestrieren</a></li></li>
      </ul>
    </div>
  </nav>
</div>
<div class="container">
	  <div class="row login-box">
		<form class="col s12 l6 offset-l1">
		  <div class="row center-align">
			<div class="input-field col s12">
			  <i class="material-icons prefix">account_circle</i>
			  <input id="icon_prefix" type="text" class="validate" style="padding: 2px">
			  <label for="icon_prefix">First Name</label>
			</div>
			<div class="input-field col s12">
			 <i class="material-icons prefix">lock</i>
			  <input id="icon_telephone" type="password" class="validate" style="padding: 2px">
			  <label for="icon_telephone">Telephone</label>
			</div>
			  <a class="waves-effect waves-light btn">Einloggen</a>
		  </div>
		</form>
	  </div>

</div>
	
	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
	<script src="asserts/js/jquery.js"></script>
	<script src="asserts/js/chart.js"></script>
	<script src="asserts/js/my-main.js"></script>
	<script src="asserts/js/bootstrap.bundle.js"></script>

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
