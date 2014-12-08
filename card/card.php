<?php 
	session_start();
	
	/*$url = urldecode(http_build_query($_GET));*/
	if(!empty($_GET)) 
	{
		/*$cardID = $_GET['cid'];
		$senderID = $_GET['sid'];
		$receiverID = $_GET['ric'];*/

		$url = urldecode(http_build_query($_GET));

		$urlExploded = explode('&', $url);
		$cidParam = $urlExploded[0];
		$sidParam = $urlExploded[1];
		$ricParam = $urlExploded[2];

		$cidParamExploded = explode('cid=', $cidParam);
		$sidParamExploded = explode('sid=', $sidParam);
		$ridParamExploded = explode('rid=', $ricParam);

		$cidID =  $cidParamExploded[1];
		$sidID =  $sidParamExploded[1];
		$ridPad = $ridParamExploded[1];

		$ridPadExploded = explode('=', $ridPad);
		$ridID = $ridPadExploded[0];

		include_once('class/card.class.php');
		$card = new Card();
		$cardInfo = $card->GetCardSent($cidID);
		$senderInfo = $card->GetSenderSent($sidID);
		$receiverInfo = $card->GetReceiverSent($ridID);

		if(empty($cardInfo) || empty($senderInfo) || empty($receiverInfo))
		{
			header("location: 404.php");
		}
	}
	else
	{
		header("location: 404.php");
	}
	
 ?><!DOCTYPE HTML>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<link href="css/normalize.css" rel="stylesheet" type="text/css" />
		<link href="css/style.css" rel="stylesheet" type="text/css" />
		<title>Thomas More | Kerstkaart</title>
	</head>

	<body>

		<div id="audioCon">
			<audio id="backgoundMusic">
		  		<source src="" type="audio/ogg">
		  		<source src="music/kerstmuziekje.wav" type="audio/wav">
				Your browser does not support the audio element.
			</audio>

			<input type="button" id="go" value="Muziek pauzeren">
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
						<p><?php echo nl2br($senderInfo['sender_message']); ?></p>
						<p id="senderSig"><?php echo $senderInfo['sender_firstname'];?></p>
					</div>

					<div id="copyCon">
						<span id="copy">&copy; <a href="http://www.thomasmore.be/">Thomas More</a> | Ontwikkeld door <a href="http://designosource.be/">Designosource</a> - Studenten van <a href="http://weareimd.be/">Interactieve Multimedia Design</a></span>
					</div>
				</div>
			</div>


		    <div id="nav">
				<h1>Veeg over de kaart om de <span>achterkant</span> te zien</h1>
			</div>
		</div>

		<script src="js/jquery-1.11.1.min.js" type="text/javascript"></script>
		<script src="js/jquery-ui.min.js" type="text/javascript"></script>
		<script src="js/modernizr2.8.3.js" type="text/javascript"></script>
		<!--[if lt IE 9]>
			<script src="js/excanvas.min.js" type="text/javascript"></script>
		<![endif]-->
		<!--[if (gte IE 6)&(lte IE 8)]>
		 	<script type="text/javascript" src="js/selectivizr-min.js"></script>
		<![endif]-->
		<script type="text/javascript" src="js/jquery.flippy.min.js"></script>
		<script src="js/hammer.min.js" type="text/javascript"></script>
		<script src="js/jquery.hammer.js" type="text/javascript"></script>
		<script src="js/script.js" type="text/javascript"></script>
	</body>
</html>