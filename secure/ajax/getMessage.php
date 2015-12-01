<?php 
	session_start();

	if(isset($_POST['personalMessage']))
	{
		$aanspreekMessage = $_POST['aanspreekMessage'];
		$personalMessage = $_POST['personalMessage'];
		$_SESSION['persMess'] = $personalMessage;
		$_SESSION['aansMess'] = $aanspreekMessage;
		echo $_SESSION['persMess'];
		echo $_SESSION['aansMess'];
	}
 ?>