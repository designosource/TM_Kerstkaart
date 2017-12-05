<?php 
	if(!empty($_POST['senderFirstname']) && !empty($_POST['senderLastname']) && !empty($_POST['senderemail']) && !empty($_POST['receiverfirstname']) && !empty($_POST['receiverlastname']) && !empty($_POST['receiveremail']) && !empty($_POST['inputText']))
	{
		$senderFirstname = $_POST['senderFirstname'];
		$senderLastname = $_POST['senderLastname'];
		$senderemail = $_POST['senderemail'];

		$receiverfirstname = $_POST['receiverfirstname'];
		$receiverlastname = $_POST['receiverlastname'];
		$receiveremail = $_POST['receiveremail'];

		$inputText = $_POST['inputText'];

		include_once('../class/card.class.php');
		$card = new Card();

		$card->senderFirstname = $senderFirstname;
		$card->senderLastname = $senderLastname;
		$card->senderEmailadress = $senderemail;
		
		$card->receiverFirstname = $receiverfirstname;
		$card->receiverLastname = $receiverlastname;
		$card->receiverEmailadress = $receiveremail;
 		
 		$card->message = $inputText;
 		$card->SendAppreciation();
	}
 ?>