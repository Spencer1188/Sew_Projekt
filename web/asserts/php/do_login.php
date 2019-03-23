<?php

	include "../../api/dbconfig.php";

	$mail = $_POST["mail"];
	$pw = $_POST["pw"];


	function encrypt_password($password) {
        $password_hash = hash('sha256', $password);
		return $password_hash;
		}
	
		$password_hash = encrypt_password($pw);


		$regusr = mysqli_query($conn,"SELECT * FROM `user` WHERE mail = '$mail'");
		$dbusr = mysqli_fetch_array($regusr);

	

		if($dbusr["password"] == $password_hash){
			
			session_start();
			$_SESSION['vali'] = 1;
			$_SESSION['mail'] = $mail;
			$_SESSION['id'] = $dbusr["usr_id"];
			echo "ok";
					
	}
	else{ 
		session_start();
		$_SESSION['vali'] = 0;
		echo "error";
	}

?>
