<?php 
	session_start();

	/*unset($_SESSION['login']);
	session_write_close();
	header("location: index.php");*/
	header("location: ".$_SERVER["REDIRECT_Shib_logoutURL"]);
 ?>