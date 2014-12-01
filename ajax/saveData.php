<?php 
	session_start();
	if(isset($_SESSION['cardALT']) && isset($_SESSION['cardURL']) && isset($_SESSION['cardID']) && isset($_SESSION['persMess']) && isset($_SESSION['person']))
 	{
 		include_once('../class/card.class.php');

 		$cardID = $_SESSION['cardID'];
 		$perMess = $_SESSION['persMess'];

 		$card = new Card();
 		$card->message = $perMess;
 		//$personalMessageID = $card->SavePersonalMessage();


 		$people = $_SESSION['person'];
 		foreach($people as $person)
 		{
 			$personReceiverFirstname = $person['voornaam'];
 			$personReceiverLastname = $person['achternaam'];
 			$personReceiverEmail = $person['emailadres'];

 			$card->receiverFirstname = $personReceiverFirstname;
			$card->receiverLastname = $personReceiverLastname;
			$card->receiverEmailadress = $personReceiverEmail;
			//$receiverID = $card->SaveReceivers();
 		}
 	}
 ?>