<?php

	include "../../api/dbconfig.php";

	$mail = $_POST["mail"];
	$pw1 = $_POST["pw1"];
	$pw2 = $_POST["pw2"];

	$sql = "SELECT * FROM `user` WHERE mail = '$mail'";

	function encrypt_password($password) {
        $password_hash = hash('sha256', $password);
		return $password_hash;
		}

	if($pw1 != $pw2){
		die("Passwörter übereinstimmen nicht!");
	}


$select = mysqli_query($conn, "SELECT `mail` FROM `user` WHERE `mail` = '".$_POST['mail']."'") or exit(mysqli_error($conn));
if(mysqli_num_rows($select)) {
    die('This email is already being used');
}


	$password_hash = encrypt_password($pw1);


		$insusr = mysqli_query($conn,"insert into user (password,mail) values('$password_hash','$mail')");

	echo "ok";

?>
