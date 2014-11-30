<?php 
	session_start();

	if(isset($_POST['voornaam']) && isset($_POST['achternaam']) && isset($_POST['emailadres']))
	{
		$voornaam = $_POST['voornaam'];
		$achternaam = $_POST['achternaam'];
		$emailadres = $_POST['emailadres'];

		$_SESSION['person'][] = array($voornaam, $achternaam, $emailadres);
	}
?>