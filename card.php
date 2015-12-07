<?php 
	session_start();

	if(!empty($_GET)) 
	{
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

		if($senderInfo["sender_language"] == "en"){
			$mail_copy = '<span id="copy">&copy; <a target="_blank" href="http://www.thomasmore.be/">Thomas More</a> | Developed by <a target="_blank" href="http://designosource.be/">Designosource</a> - Students in <a target="_blank" href="http://weareimd.be/">Interactive Multimedia Design</a></span>';
			$mail_footer = '<h1><a id="clickHinter" href="#">Click here</a> or swipe the <span id="sideHinter">card</span> to read <span id="messageHinter">your personal message.</span></h1>';
		} else if ($senderInfo["sender_language"] == "fr"){
			$mail_copy = '<span id="copy">&copy; <a target="_blank" href="http://www.thomasmore.be/">Thomas More</a> | Réalisé par <a target="_blank" href="http://designosource.be/">Designosource</a> - Etudiants en <a target="_blank" href="http://weareimd.be/">Interactive Multimedia Design</a></span>';
			$mail_footer = '<h1><a id="clickHinter" href="#">Cliquez ici</a> ou balayez <span id="sideHinter">la carte</span> afin de découvrir <span id="messageHinter">votre message personnalisé.</span></h1>';
		} else {
			$mail_copy = '<span id="copy">&copy; <a target="_blank" href="http://www.thomasmore.be/">Thomas More</a> | Ontwikkeld door <a target="_blank" href="http://designosource.be/">Designosource</a> - Studenten van <a target="_blank" href="http://weareimd.be/">Interactive Multimedia Design</a></span>';
			$mail_footer = '<h1><a id="clickHinter" href="#">Klik hier</a> of veeg over de <span id="sideHinter">kaart</span> om je <span id="messageHinter">persoonlijke boodschap</span> te bekijken.</h1>';
		}

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
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0;">
		<link href="img/favicon.ico" rel="icon" type="image/x-icon" />

		<meta name="description" content="Bekijk hier je gepersonaliseerde kerstkaart die werd gemaakt via de Thomas More kerstkaart tool."/>
		<meta name="keywords" content="Thomas more, Mechelen, Geel, Antwerpen, kerstkaart, kerstmis, ">
		<meta name="author" content="Thomas More">

		<meta property="og:type"   content="website" /> 
	  	<meta property="og:url" content="http://ecard.thomasmore.be<?php echo $_SERVER['REQUEST_URI']; ?>" />
	 	<meta property="og:title" content="Thomas More - Kerstkaart" />
	  	<meta property="og:image" content="http://ecard.thomasmore.be/img/tm_kerstkaart_facebook.png"/>
	  	<meta property="og:description" content="Bekijk hier je gepersonaliseerde kerstkaart die werd gemaakt via de Thomas More kerstkaart tool."/>

		<meta name="twitter:card" content="summary_large_image" />
		<meta name="twitter:site" content="@ThomasMoreBE" />
		<meta name="twitter:site:id" content="957208351" />
		<meta name="twitter:creator" content="@ThomasMoreBE" />
		<meta name="twitter:creator:id" content="957208351" />
		<meta name="twitter:title" content="Thomas More - Kerstkaart" />
		<meta name="twitter:description" content="Bekijk hier je gepersonaliseerde kerstkaart die werd gemaakt via de Thomas More kerstkaart tool."/>
		<meta name="twitter:image" content="http://ecard.thomasmore.be/img/tm_kerstkaart_twitter.png" />
		<meta name="twitter:url" content="http://ecard.thomasmore.be" />
		<meta name="twitter:domain" content="ttp://ecard.thomasmore.be">

		<link href="css/normalize.css" rel="stylesheet" type="text/css" />
		<link href="css/style.css" rel="stylesheet" type="text/css" />

		<!--[if lt IE 9]>
			<script src="js/html5chiv.js"></script>
		<![endif]-->

		<title>Thomas More | Kerstkaart</title>
	</head>

	<body class="<?php if($cardInfo['card_type'])
					 { 
					 	if($cardInfo['card_type'] == "animated")
						{
							echo "music";
						}
					 } ?>">

		<div id="audioCon">
			<audio id="backgoundMusic">
		  		<source src="music/kerstmuziekje.ogg" type="audio/ogg">
 				<source src="music/kerstmuziekje.mp3" type="audio/mpeg">
		  		<source src="music/kerstmuziekje.wav" type="audio/wav">
			</audio>

			<a href="#go" id="go" class="demp_muziek"><img src="img/on.png" alt=""></a>
		</div>

		<div id="container">
			<div class="flipbox-container box100">
			    <div id="cardCon">
			    	<!-- Add poem here -->
			    	<?php 
			    		if($cardInfo['card_type'] == "animated")
						{
							echo "<figure id='cardConSec' alt='".$cardInfo['card_title']."' style='background-image: url(img/full_".$cardInfo['card_url'].".gif)'></figure>";
						}
						else
						{
							echo "<figure id='cardConSec' alt='".$cardInfo['card_title']."' style='background-image: url(img/ie_full_".$cardInfo['card_url'].".png)'></figure>";
						}
			    	 ?>
			    </div>
		   	</div>

			<div id="front" style="display:none;">
				<div id="cardCon">
			    	<!-- Add poem here -->
			    	<?php 
			    		if($cardInfo['card_type'] == "animated")
						{
							echo "<figure id='cardConSec' alt='".$cardInfo['card_title']."' style='background-image: url(img/full_".$cardInfo['card_url'].".gif)'></figure>";
						}
						else
						{
							echo "<figure id='cardConSec' alt='".$cardInfo['card_title']."' style='background-image: url(img/ie_full_".$cardInfo['card_url'].".png)'></figure>";
						}
					?>
			    </div>
			</div>

			<div id="back" style="display:none;">
				<div id="backCon">
					<div id="backSec">
					<!-- add personal text here -->
					
						<h1>Beste <span><?php echo $receiverInfo['receiver_firstname'];?></span></h1>
						<p><?php echo nl2br($senderInfo['sender_message']); ?></p>

					</div>

					<div id="copyCon">
						<?php echo $mail_copy ?>
						<!--<span id="copy">&copy; <a target="_blank" href="http://www.thomasmore.be/">Thomas More</a> | Ontwikkeld door <a target="_blank" href="http://designosource.be/">Designosource</a> - Studenten van <a target="_blank" href="http://weareimd.be/">Interactive Multimedia Design</a></span>-->
					</div>
				</div>
			</div>


		    <div id="nav">
				<?php echo $mail_footer ?>
				<!--<h1><a id="clickHinter" href="#">Klik hier</a> of veeg over de <span id="sideHinter">kaart</span> om je <span id="messageHinter">persoonlijke boodschap</span> te bekijken.</h1>-->
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