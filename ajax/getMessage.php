<?php 
	session_start();

	if(isset($_POST['personalMessage']) && isset($_POST['senderFirstname']) && isset($_POST['senderLastname']) && isset($_POST['senderEmail']))
	{
		$senderFirstname = $_POST['senderFirstname'];
		$senderLastname = $_POST['senderLastname'];
		$senderEmail = $_POST['senderEmail'];

		$personalMessage = $_POST['personalMessage'];

		$_SESSION['senderFirstname'] = $senderFirstname;
		$_SESSION['senderLastname'] = $senderLastname;
		$_SESSION['senderEmail'] = $senderEmail;

		$_SESSION['persMess'] = $personalMessage;
	}
 ?>