<?php 
	session_start();
	if(isset($_SESSION['cardALT']) && isset($_SESSION['cardType']) && isset($_SESSION['cardURL']) && isset($_SESSION['cardID']) && isset($_SESSION['persMess']) && isset($_SESSION['person']))
 	{
 		include_once('../class/card.class.php');

 		$cardID = $_SESSION['cardID'];

		$senderFirstname = $_SERVER['REDIRECT_Shib_Person_givenName'];
		
 		$senderLastname = $_SERVER['REDIRECT_Shib_Person_surname'];
		
		if(!filter_var($_SERVER['REDIRECT_Shib_Person_mail'], FILTER_VALIDATE_EMAIL)){
		  $emails = explode(";", $_SERVER['REDIRECT_Shib_Person_mail'] );
		  foreach ($emails as $entry) {
		    if(strpos($entry, "thomasmore.be") && filter_var($entry, FILTER_VALIDATE_EMAIL))
		    {
		      $senderEmail = $entry;
		    }
		  }
		} else {
		  $senderEmail = $_SERVER['REDIRECT_Shib_Person_mail'];
		}
		
		if(!isset($senderEmail) || trim($senderEmail)==false) {
		  header("Location: /i-dont-think-therefore-i-am-not");
		}

 		$perMess = $_SESSION['persMess'];
		$begroetingMess = $_SESSION['begroetingMess'];
		$taal = $_SESSION["taal"];

 
 		$card = new Card();

 		$card->senderFirstname = $senderFirstname;
		$card->senderLastname = $senderLastname;
		$card->senderEmailadress = $senderEmail;
		//$card->begroetingMess = $begroetingMess;
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
