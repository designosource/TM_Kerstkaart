<?php 
session_start();

if(isset($_POST['persons']))
{
	$persons = $_POST['persons'];

	unset($_SESSION['person']);
	
	foreach($persons as $person)
	{

		$voornaam = $person['voornaam'];
		$achternaam = $person['achternaam'];
		$emailadres = $person['emailadres'];


		$_SESSION['person'][] = array(
								    "voornaam" => $voornaam,
								    "achternaam" => $achternaam,
								    "emailadres" => $emailadres
								);
	}
}
 ?>