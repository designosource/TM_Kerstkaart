<?php 
	session_start();
	
	if(!empty($_GET)) 
	{
		$cardID = $_GET['cid'];
		$senderID = $_GET['sid'];
		$receiverID = $_GET['ric'];

		include_once('class/card.class.php');
		$card = new Card();
		$cardInfo = $card->GetCardSent($cardID);
		$senderInfo = $card->GetSenderSent($senderID);
		$receiverInfo = $card->GetReceiverSent($receiverID);

		var_dump($receiverInfo);
	}
	
 ?><!DOCTYPE HTML>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<link href="css/normalize.css" rel="stylesheet" type="text/css" />
		<link href="css/styleCard.css" rel="stylesheet" type="text/css" />
		<title>Thomas More | Kerstkaart</title>
	</head>

	<body>

		<div id="container">
			<div class="flipbox-container box100">
			    <div id="cardCon" style="background-image: url('')">
			    	<!-- Add poem here -->
			    </div>
		   	</div>

			<div id="front" style="display:none;">
				<div id="cardCon" style="background-image: url('')">
			    	<!-- Add poem here -->
			    </div>
			</div>

			<div id="back" style="display:none;">
				<div id="backCon">
					<div id="backSec">
					<!-- add personal text here -->
						<h1>Beste <span>[Voornaam ontvanger]</span></h1>
						<p>message</p>
						<p id="senderSig">[Voornaam verzender]</p>
					</div>

					<div id="copyCon">
					<span id="copy">&copy; <a href="http://www.thomasmore.be/">Thomas More</a> | Ontwikkeld door <a href="http://designosource.be/">Designosource</a> - Studenten van <a href="http://weareimd.be/">Interactieve Multimedia Design</a></span>
					</div>
				</div>
			</div>


		    <div id="nav">
		    	<ul id="vorige-volgende">
					<li id="center"><h1>Veeg over de kaart om de <span>achterkant</span> te zien</h1></li>
					<li id="right"><a id="appreciate" href="#">Bedank</a></li>
				</ul>
			</div>
		</div>

	<?php include("includes/scripts.inc.php"); ?>
	</body>
</html>