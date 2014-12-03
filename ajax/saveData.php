<?php 
	session_start();
	if(isset($_SESSION['cardALT']) && isset($_SESSION['cardURL']) && isset($_SESSION['cardID']) && isset($_SESSION['persMess']) && isset($_SESSION['senderFirstname']) && isset($_SESSION['senderLastname']) && isset($_SESSION['senderEmail']) && isset($_SESSION['person']))
 	{
 		include_once('../class/card.class.php');

 		$cardID = $_SESSION['cardID'];

 		$senderFirstname = $_SESSION['senderFirstname'];
 		$senderLastname = $_SESSION['senderLastname'];
 		$senderEmail = $_SESSION['senderEmail'];
 		$perMess = $_SESSION['persMess'];

 
 		$card = new Card();
 		/*$personalMessageID = $card->SavePersonalMessage();*/

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
			$receiverID = $card->SaveReceivers();

			$sendmail = $card->SendCard($cardID, $senderID, $receiverID);
 		}
 	}
 ?>