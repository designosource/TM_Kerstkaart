<?php 
	session_start();

	if(isset($_POST['personalMessage']))
	{
		$personalMessage = $_POST['personalMessage'];
		$_SESSION['persMess'] = $personalMessage;
	}
 ?>