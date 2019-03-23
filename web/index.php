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

  <body>
<div class="wrapper fadeInDown">
  <div id="formContent">
    <!-- Tabs Titles -->

    <!-- Icon -->
    <div class="fadeIn first">
      <img src="http://danielzawadzki.com/codepen/01/icon.svg" id="icon" alt="User Icon" />
    </div>

    <!-- Login Form -->
    <form>
      <input type="email" id="email" class="fadeIn second" name="login" placeholder="Email">
      <input type="text" id="password" class="fadeIn third" name="login" placeholder="Password">
      <input type="submit" class="fadeIn fourth" value="Log In">
    </form>

<div class="alert alert-danger" role="alert" style="display:inherit;">
  A simple danger alert—check it out!
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
			   username:usr,
			   pw:pass
			  },
			  success:function(data) {
				  if(data == "error"){
					 myFunction()
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
