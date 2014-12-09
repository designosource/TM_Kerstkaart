<?php 
	session_start();
	if(isset($_SESSION['cardALT']) && $_SESSION['cardType']) && isset($_SESSION['cardURL']) && isset($_SESSION['cardID']) && isset($_SESSION['persMess']) && isset($_SESSION['person']))
 	{
 		include_once('../class/card.class.php');

 		$cardID = $_SESSION['cardID'];

 		$senderFirstname = $_SERVER['REDIRECT_Shib_Person_givenName'];
 		$senderLastname = $_SERVER['REDIRECT_Shib_Person_surname'];
 		$senderEmail = $_SERVER['REDIRECT_Shib_Person_mail'];

 		$perMess = $_SESSION['persMess'];

 
 		$card = new Card();

 		$card->senderFirstname = $senderFirstname;
		$card->senderLastname = $senderLastname;
		$card->senderEmailadress = $senderEmail;
 		$card->message = $perMess;
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
			$receiverID = $card->SaveReceivers($senderID);

			$sendmail = $card->SendCard($cardID, $senderID, $receiverID);
 		}
 	}
 ?>