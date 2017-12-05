<?php 
	session_start();

	if(isset($_POST['personalMessage']))
	{
		$personalMessage = $_POST['personalMessage'];
		$begroetingMessage = $_POST['begroetingMessage'];
		$taal = $_POST['taal'];

		$_SESSION['begroetMess'] = $begroetingMessage;
		$_SESSION['persMess'] = $personalMessage;
		$_SESSION['taal'] = $taal;

		echo $_SESSION['begroetMess'];
		echo $_SESSION['persMess'];
		echo $_SESSION['taal'];
	}
 ?>