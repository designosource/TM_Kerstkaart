<?php 
	session_start();

	if(isset($_POST['chosenCardURL']) && isset($_POST['chosenCardALT']) && isset($_POST['chosenCardID']))
	{
		$cardURL = $_POST['chosenCardURL'];
		$cardALT = $_POST['chosenCardALT'];
		$cardID = $_POST['chosenCardID'];

		$_SESSION['cardURL'] = $cardURL;
		$_SESSION['cardALT'] = $cardALT;
		$_SESSION['cardID'] = $cardID;
	}
 ?>