<?php 
	session_start();

	if(isset($_POST['personalMessage']))
	{
		$begroetingMessage = $_POST['begroetingMessage'];
		$personalMessage = $_POST['personalMessage'];
		$taal = $_POST['taal'];

		$_SESSION['persMess'] = $personalMessage;
		$_SESSION['begroetMess'] = $begroetingMessage;
		$_SESSION['taal'] = $taal;

		echo $_SESSION['persMess'];
		echo $_SESSION['begroetingMess'];
		echo $_SESSION['taal'];
	}
 ?>