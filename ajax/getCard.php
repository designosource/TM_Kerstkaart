<?php 
	session_start();

	if(isset($_POST['chosenCardURL']) && isset($_POST['chosenCardALT']))
	{
		$cardURL = $_POST['chosenCardURL'];
		$cardALT = $_POST['chosenCardALT'];

		$_SESSION['cardURL'] = $cardURL;
		$_SESSION['cardALT'] = $cardALT;
	}
 ?>