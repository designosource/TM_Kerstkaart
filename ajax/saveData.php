<?php 
	session_start();
	if(isset($_SESSION['cardALT']) && isset($_SESSION['cardURL']) && isset($_SESSION['cardID']) && isset($_SESSION['persMess']) && isset($_SESSION['senderFirstname']) && isset($_SESSION['senderLastname']) && isset($_SESSION['senderEmail']) && isset($_SESSION['person']))
 	{
 		include_once('../class/card.class.php');

 		$cardID = $_SESSION['cardID'];
 		$perMess = $_SESSION['persMess'];

 
 		$senderFirstname = $_SESSION['senderFirstname'];
 		$senderLastname = $_SESSION['senderLastname'];
 		$senderEmail = $_SESSION['senderEmail'];


 		$card = new Card();
 		$card->message = $perMess;
 		$personalMessageID = $card->SavePersonalMessage();

 		$card->senderFirstname = $senderFirstname;
		$card->senderLastname = $senderLastname;
		$card->senderEmailadress = $senderEmail;
		$senderID = $card->SaveSenders();

 		$receivers = $_SESSION['person'];
 		foreach($receivers as $receiver)
 		{
 			$personReceiverFirstname = $receiver['voornaam'];
 			$personReceiverLastname = $receiver['achternaam'];
 			$personReceiverEmail = $receiver['emailadres'];

 			$card->receiverFirstname = $personReceiverFirstname;
			$card->receiverLastname = $personReceiverLastname;
			$card->receiverEmailadress = $personReceiverEmail;
			$receiverID = $card->SaveReceivers();
 		}
 	}
 ?>