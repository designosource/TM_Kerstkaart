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

		<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0;">
		<link href="img/favicon.ico" rel="icon" type="image/x-icon" />

		<meta name="description" content="Stuur een online kerstkaart naar je vrienden, familie, (mede)docenten en (mede)studenten als je werkgever, werknemer of student aan het Thomas More bent."/>
		<meta name="keywords" content="Thomas more, Mechelen, Geel, Antwerpen, kerstkaart, kerstmis, ">
		<meta name="author" content="Thomas More">

		<meta property="og:title" content="Thomas More - Kerstkaart" />
		<meta property="og:site_name" content="Thomas More - Kerstkaart" />
		<meta property="og:url" content="http://ecard.thomasmore.be" />
		<meta property="og:description" content="Stuur een online kerstkaart naar je vrienden, familie, (mede)docenten en (mede)studenten als je werkgever, werknemer of student aan het Thomas More bent."/>
		<meta property="og:image" content="http://ecard.thomasmore.be/img/tm_kerstkaart_facebook.png"/>
		<meta property="og:type" content="profile" /> 
		<meta property="og:locale" content="en_US" />
		<meta property="og:image:type" content="image/png" />
		<meta property="og:image:width" content="1200" />
		<meta property="og:image:height" content="630" />

		<meta name="twitter:card" content="summary_large_image" />
		<meta name="twitter:site" content="@ThomasMoreBE" />
		<meta name="twitter:site:id" content="957208351" />
		<meta name="twitter:creator" content="@ThomasMoreBE" />
		<meta name="twitter:creator:id" content="957208351" />
		<meta name="twitter:title" content="Thomas More - Kerstkaart" />
		<meta name="twitter:description" content="Stuur een online kerstkaart naar je vrienden, familie, (mede)docenten en (mede)studenten als je werkgever, werknemer of student aan het Thomas More bent."/>
		<meta name="twitter:image" content="http://ecard.thomasmore.be/img/tm_kerstkaart_twitter.png" />
		<meta name="twitter:url" content="http://ecard.thomasmore.be" />
		<meta name="twitter:domain" content="ttp://ecard.thomasmore.be">

		<link href="css/normalize.css" rel="stylesheet" type="text/css" />
		<link href="css/style.css" rel="stylesheet" type="text/css" />

		<title>Thomas More | Kerstkaart</title>
	</head>

	<body>

		<div id="audioCon">
			<audio id="backgoundMusic">
		  		<source src="music/kerstmuziekje.ogg" type="audio/ogg">
 				<source src="music/kerstmuziekje.mp3" type="audio/mpeg">
		  		<source src="music/kerstmuziekje.wav" type="audio/wav">
			</audio>

			<input type="button" id="go" value="Muziek pauzeren">
		</div>

		<div id="container">
			<div class="flipbox-container box100">
			    <div id="cardCon">
			    	<!-- Add poem here -->
			    	<?php 
			    		if($cardInfo['card_type'] == "animated")
						{
							echo "<video width='100%' loop autoplay poster='img/full_".$cardInfo['card_url'].".png' src='img/full_".$cardInfo['card_url'].".mp4' data-id='".$cardInfo['card_id']."' alt='".$cardInfo['card_title']."' data-type='".$cardInfo['card_type']."'>
									<source src='img/full_".$cardInfo['card_url'].".mp4' type='video/mp4'>
									<source src='img/full_".$cardInfo['card_url'].".webm' type='video/webm'>
									<source src='img/full_".$cardInfo['card_url'].".ogv' type='video/ogg'>
								</video>";
						}
						else
						{
							echo "<figure id='cardConSec' alt='".$cardInfo['card_title']."' style='background-image: url(img/".$cardInfo['card_url'].".png)'></figure>";
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
							echo "<video width='100%' loop autoplay poster='img/full_".$cardInfo['card_url'].".png' src='img/full_".$cardInfo['card_url'].".mp4' data-id='".$cardInfo['card_id']."' alt='".$cardInfo['card_title']."' data-type='".$cardInfo['card_type']."'>
									<source src='img/full_".$cardInfo['card_url'].".mp4' type='video/mp4'>
									<source src='img/full_".$cardInfo['card_url'].".webm' type='video/webm'>
									<source src='img/full_".$cardInfo['card_url'].".ogv' type='video/ogg'>
								</video>";
						}
						else
						{
							echo "<figure id='cardConSec' alt='".$cardInfo['card_title']."' style='background-image: url(img/".$cardInfo['card_url'].".png)'></figure>";
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
						<p id="senderSig"><?php echo $senderInfo['sender_firstname'];?></p>
					</div>

					<div id="copyCon">
						<span id="copy">&copy; <a href="http://www.thomasmore.be/">Thomas More</a> | Ontwikkeld door <a href="http://designosource.be/">Designosource</a> - Studenten van <a href="http://weareimd.be/">Interactieve Multimedia Design</a></span>
					</div>
				</div>
			</div>


		    <div id="nav">
				<h1>Veeg over de kaart om de <span>kerstboodschap</span> te zien</h1>
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