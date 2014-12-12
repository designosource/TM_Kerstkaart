<?php 
	session_start();
	
	if(!empty($_GET['cid']) && !empty($_GET['sid']) && !empty($_GET['ric'])) 
	{
		$cardID = $_GET['cid'];
		$senderID = $_GET['sid'];
		$receiverID = $_GET['ric'];

		include_once('class/card.class.php');
		$card = new Card();
		$cardInfo = $card->GetCardSent($cardID);
		$senderInfo = $card->GetSenderSent($senderID);
		$receiverInfo = $card->GetReceiverSent($receiverID);

		if(empty($cardInfo) || empty($senderInfo) || empty($receiverInfo))
		{
			header("location: index.php");
		}
	}
	else
	{
		header("location: index.php");
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

		<div id='overlay'></div>

		<div id="appreciateCon">
			<a id='closeOverlay' href='#'>Sluiten</a>

			<div id="appreciateSec">
				<h1>Bedank <span><?php echo $senderInfo['sender_firstname'] . " " . $senderInfo['sender_lastname'];?></span></h1>

				<form action="#" method="POST">
					<textarea placeholder="Uw persoonlijk bericht" name="persoonlijkbericht"></textarea>
				</form>

				<ul>
					<li id='send'><a href='#'>Versturen</a></li>
					<li id='cancel'><a href='#'>Annuleren</a></li>
				</ul>
			</div>
		</div>

		<div id="container">
			<div class="flipbox-container box100">
			    <div id="cardCon" style="background-image: url('img/<?php echo $cardInfo['card_url'];?>')">
			    	<!-- Add poem here -->
			    </div>
		   	</div>

			<div id="front" style="display:none;">
				<div id="cardCon" style="background-image: url('img/<?php echo $cardInfo['card_url'];?>')">
			    	<!-- Add poem here -->
			    </div>
			</div>

			<div id="back" style="display:none;">
				<div id="backCon">
					<div id="backSec">
					<!-- add personal text here -->
						<h1>Beste <span><?php echo $receiverInfo['receiver_firstname'];?></span></h1>
						<p><?php echo $senderInfo['sender_message']; ?></p>
						<p id="senderSig"><?php echo $senderInfo['sender_firstname'];?></p>
					</div>

					<div id="copyCon">
					<span id="copy">&copy; <a href="http://www.thomasmore.be/">Thomas More</a> | Ontwikkeld door <a href="http://designosource.be/">Designosource</a> - Studenten van het afstudeertraject <a href="http://weareimd.be/">Interactive Multimedia Design</a></span>
					</div>
				</div>
			</div>


		    <div id="nav">
		    	<ul id="vorige-volgende">
					<li id="center"><h1>Veeg over de kaart om de <span>achterkant</span> te zien</h1></li>
					<li id="right" class="appreciate"><a href="#">Bedank <?php echo $senderInfo['sender_firstname'];?></a></li>
				</ul>
			</div>
		</div>

	<?php include("includes/scripts.inc.php"); ?>
	</body>
</html>