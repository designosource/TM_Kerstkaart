<?php 
	session_start();

	if(isset($_POST['chosenCardURL']) && isset($_POST['chosenCardALT']) && isset($_POST['chosenCardID']) && isset($_POST['chosenCardType']))
	{
		$cardURL = $_POST['chosenCardURL'];
		$cardALT = $_POST['chosenCardALT'];
		$cardID = $_POST['chosenCardID'];
		$cardType = $_POST['chosenCardType'];

		$_SESSION['cardURL'] = $cardURL;
		$_SESSION['cardALT'] = $cardALT;
		$_SESSION['cardID'] = $cardID;
		$_SESSION['cardType'] = $cardType;
	}
 ?>