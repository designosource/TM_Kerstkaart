<?php
	session_start();
	if(isset($_SESSION['cardALT']) && isset($_SESSION['cardType']) && isset($_SESSION['cardURL']) && isset($_SESSION['cardID']) && isset($_SESSION['persMess']) && isset($_SESSION['person']))
	{
		include_once('../class/card.class.php');

		$cardID = $_SESSION['cardID'];

		if(!filter_var($_SERVER['REDIRECT_Shib_Person_mail'], FILTER_VALIDATE_EMAIL)){
			$emails = explode(";", $_SERVER['REDIRECT_Shib_Person_mail'] );
			foreach ($emails as $entry) {
				if(strpos($entry, "thomasmore.be") && filter_var($entry, FILTER_VALIDATE_EMAIL))
				{
                    $_SESSION["savesender"]["email"] = $entry;
				}
			}
		} else {
            $_SESSION["savesender"]["email"] = $_SERVER['REDIRECT_Shib_Person_mail'];
		}

		if(!isset($senderEmail) || trim($senderEmail)==false) {
			header("Location: /i-dont-think-therefore-i-am-not");
		}
		$card = new Card();

        $_SESSION["savesender"]["firstname"] = $_SERVER['REDIRECT_Shib_Person_givenName'];
        $_SESSION["savesender"]["lastname"] = $_SERVER['REDIRECT_Shib_Person_surname'];
        $_SESSION["savesender"]["message"] = $_SESSION['persMess'];
        $_SESSION["savesender"]["begroeting"] = htmlentities($_SESSION['begroetMess']);
        $_SESSION["savesender"]["taal"] = $_SESSION["taal"];

        $_SESSION['senderid'] = $card->SaveSenders();

		$receivers = $_SESSION['person'];
		foreach($receivers as $receiver)
		{
			$personReceiverFirstname = $receiver['voornaam'];
			$personReceiverLastname = $receiver['achternaam'];
			$personReceiverEmail = $receiver['emailadres'];

            $_SESSION["savereceiver"]["firstname"] = $personReceiverFirstname;
            $_SESSION["savereceiver"]["lastname"] = $personReceiverLastname;
            $_SESSION["savereceiver"]["email"] = $personReceiverEmail;
            $_SESSION["savereceiver"]["senderid"] = $_SESSION["senderid"];
			$receiverID = $card->SaveReceivers();

			$_SESSION['carddata']['cid'] = $cardID;
            $_SESSION['carddata']['sid'] = $_SESSION['senderid'];
            $_SESSION['carddata']['rid'] = $receiverID;

			$card->SendCard($cardID, $_SESSION['senderid'], $receiverID);
		}
	}
?>
