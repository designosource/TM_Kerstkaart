<?php 
	session_start();

	/*unset($_SESSION['login']);
	session_write_close();
	header("location: index.php");*/
	session_destroy();
	session_unset();
	header("location: index.php");
 ?>