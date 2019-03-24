<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login-EinkaufManager</title>
	  	<link type="text/css" rel="stylesheet" href="asserts/css/bootstrap.css">
	  	<link type="text/css" rel="stylesheet" href="asserts/css/my.css">
  </head>

  <body class="abstract-bg">
	<div class="navbar transparent navbar-inverse">
            <div class="navbar-inner">
				<div class="container">
					<a>Sign Up</a>
				</div>
	</div>
	</div>  
<div class="wrapper fadeInDown">
		
  <div id="formContent">
    <!-- Tabs Titles -->

    <!-- Icon -->
    <div class="fadeIn first" style="padding: 20px">
		<h1 class="headermain">Ihr Einkaufsmanager</h1>
      <!--<img src="http://danielzawadzki.com/codepen/01/icon.svg" id="icon" alt="User Icon" /> -->
    </div>


      <input type="email" id="email" class="fadeIn second" name="login" placeholder="Email">
      <input type="password" id="password" class="fadeIn third" name="login" placeholder="Password">
      <input class="btn btn-primary" onClick="do_login()" type="submit"><br><br>
	
	  

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
