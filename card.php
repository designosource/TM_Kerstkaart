<?php 
	session_start();

	if(!empty($_GET)) 
	{
		$url = urldecode(http_build_query($_GET));


		$urlExploded = explode('&', $url);
		$cidParam = $urlExploded[0]; // card ID
		$sidParam = $urlExploded[1]; // sender ID
		$ricParam = $urlExploded[2]; // receiver ID

		$cidParamExploded = explode('cid=', $cidParam);
		$sidParamExploded = explode('sid=', $sidParam);
		$ridParamExploded = explode('rid=', $ricParam);

		$cidID =  $cidParamExploded[1];
		$sidID =  $sidParamExploded[1];
		$ridPad = $ridParamExploded[1];

		$ridPadExploded = explode('=', $ridPad);
		$ridID = $ridPadExploded[0];

		include_once('class/cardemail.class.php');
		$card = new CardEmail();
		$cardFetch = $card->GetCardSent($cidID);
		$cardInfo = $cardFetch[0];
		$senderFetch = $card->GetSenderSent($sidID);
		$senderInfo = $senderFetch[0];
		$receiverFetch = $card->GetReceiverSent($ridID);
		$receiverInfo = $receiverFetch[0];

        if(empty($cardInfo) || empty($senderInfo) || empty($receiverInfo))
        {
            //header("location: 404.php");
        }

        $language = $senderInfo['sender_language'];

		$card->setViewed($ridID);

		if($language == "en"){
			$mail_copy = '<span id="copy">&copy; <a target="_blank" href="http://www.thomasmore.be/">Thomas More</a> | Developed by <a target="_blank" href="http://designosource.be/">Designosource</a> - Students in <a target="_blank" href="http://weareimd.be/">Interactive Multimedia Design</a></span>';
			$mail_footer = '<h1><a id="clickHinter" href="#">Click here</a> or swipe the <span id="sideHinter">card</span> to read <span id="messageHinter">your personal message.</span></h1>';
		} else if ($language == "fr"){
			$mail_copy = '<span id="copy">&copy; <a target="_blank" href="http://www.thomasmore.be/">Thomas More</a> | Réalisé par <a target="_blank" href="http://designosource.be/">Designosource</a> - Etudiants en <a target="_blank" href="http://weareimd.be/">Interactive Multimedia Design</a></span>';
			$mail_footer = '<h1><a id="clickHinter" href="#">Cliquez ici</a> ou balayez <span id="sideHinter">la carte</span> afin de découvrir <span id="messageHinter">votre message personnalisé.</span></h1>';
		} else {
			$mail_copy = '<span id="copy">&copy; <a target="_blank" href="http://www.thomasmore.be/">Thomas More</a> | Ontwikkeld door <a target="_blank" href="http://designosource.be/">Designosource</a> - Studenten van <a target="_blank" href="http://weareimd.be/">Interactive Multimedia Design</a></span>';
			$mail_footer = '<h1><a id="clickHinter" href="#">Klik hier</a> of veeg over de <span id="sideHinter">kaart</span> om je <span id="messageHinter">persoonlijke boodschap</span> te bekijken.</h1>';
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
	 	<meta property="og:title" content="Thomas More | Expect more ... wishes!" />
	  	<meta property="og:image" content="http://ecard.thomasmore.be/img/full_kaart_1.png"/>
	  	<meta property="og:description" content="Bekijk hier je gepersonaliseerde kerstkaart die werd gemaakt via de Thomas More kerstkaart tool."/>

		<meta name="twitter:card" content="summary_large_image" />
		<meta name="twitter:site" content="@ThomasMoreBE" />
		<meta name="twitter:site:id" content="957208351" />
		<meta name="twitter:creator" content="@ThomasMoreBE" />
		<meta name="twitter:creator:id" content="957208351" />
		<meta name="twitter:title" content="Thomas More | Expect more ... wishes!" />
		<meta name="twitter:description" content="Bekijk hier je gepersonaliseerde kerstkaart die werd gemaakt via de Thomas More kerstkaart tool."/>
		<meta name="twitter:image" content="http://ecard.thomasmore.be/img/full_kaart_1.png" />
		<meta name="twitter:url" content="http://ecard.thomasmore.be" />
		<meta name="twitter:domain" content="http://ecard.thomasmore.be">

		<link href="css/normalize.css" rel="stylesheet" type="text/css" />
		<link href="css/style.css" rel="stylesheet">

		<!--[if lt IE 9]>
			<script src="js/html5chiv.js"></script>
		<![endif]-->

		<title>Thomas More | Expect more ... wishes!</title>
	</head>

	<body class="<?php if($cardInfo['card_type'])
					 { 
					 	if($cardInfo['card_type'] == "animated")
						{
							if(preg_match('~MSIE|Internet Explorer~i', $_SERVER['HTTP_USER_AGENT']) || (strpos($_SERVER['HTTP_USER_AGENT'], 'Trident/7.0; rv:11.0') === false)) {
								echo "music";
							}
						}
					 } ?>">

		<div id="container">
            <div class="flipbox-container box100">
                <div id="cardCon">
                    <!-- Add poem here -->
                    <?php
                    if(isset($cardInfo['card_url']) && isset($cardInfo['card_type']))
                    {
                        if($cardInfo['card_type'] == "animated")
                        {
                            if(preg_match('~MSIE|Internet Explorer~i', $_SERVER['HTTP_USER_AGENT']) || (strpos($_SERVER['HTTP_USER_AGENT'], 'Trident/7.0; rv:11.0') !== false)){
                                echo "<div class='videoWrapper'><iframe src='" . $cardInfo['card_youtube'] . "?&amp;wmode=transparent&amp;rel=0&amp;showinfo=0&amp;loop=1&amp;autoplay=1&amp;loop=1&amp;autoplay=1&amp;playlist=vAZT4TcoQ1I' frameborder='0' wmode='opaque' allowfullscreen></iframe>
											</div><img style='visibility: hidden;width: 0;height: 0;' src='img/full_" . $cardInfo['card_url'] . ".png' data-id='1' alt='Geanimeerde kerstkaart' data-type='animated'/>";
                            }else{
                                echo "<video width='100%' class='videoCon' controls loop autoplay poster='img/full_" . $cardInfo['card_url'] . ".png' src='img/full_" . $cardInfo['card_url'] . ".mp4' data-id='" . $cardInfo['card_id'] . "' alt='" . $cardInfo['card_title'] . "' data-type='" . $cardInfo['card_type'] . "' title='" . $cardInfo['card_title'] . "'>
												<source src='img/full_" . $cardInfo['card_url'] . ".mp4' type='video/mp4'>
												<source src='img/full_" . $cardInfo['card_url'] . "a.mp4' type='video/mp4'>
												<source src='img/full_" . $cardInfo['card_url'] . ".webm' type='video/webm'>
												<source src='img/full_" . $cardInfo['card_url'] . ".ogv' type='video/ogg'>
												<source src='img/full_" . $cardInfo['card_url'] . ".m4v' type='video/x-m4v'>
												<img src='img/full_" . $cardInfo['card_url'] . ".png'></img>
										  </video>";
                            }

                        }
                        else
                        {
                            echo "<img title='" . $cardInfo['card_title'] . "' alt='" . $cardInfo['card_title'] . "' data-id=" . $cardInfo['card_id'] . " data-type=" . $cardInfo['card_type'] . " src='img/full_" . $cardInfo['card_url'] . ".png'/>";
                        }
                    }
                    else
                    {
                        echo "<figure id='cardConSec' alt='" . $cardInfo['card_title'] . "' style='background-image: url(img/full_" .  $cardInfo['card_url'] . ".png)'></figure>";
                    }
                    ?>
                </div>
            </div>

            <div id="front" style="display:none;">
                <div id="cardCon">
                    <!-- Add poem here -->
                    <?php
                    if(isset($cardInfo['card_url']) && isset($cardInfo['card_type']))
                    {
                        if($cardInfo['card_type'] == "animated")
                        {
                            if(preg_match('~MSIE|Internet Explorer~i', $_SERVER['HTTP_USER_AGENT']) || (strpos($_SERVER['HTTP_USER_AGENT'], 'Trident/7.0; rv:11.0') !== false)){
                                echo "<div class='videoWrapper'><iframe src='" . $cardInfo['card_youtube'] . "?&amp;wmode=transparent&amp;rel=0&amp;showinfo=0&amp;loop=1&amp;autoplay=1&amp;loop=1&amp;autoplay=1&amp;playlist=vAZT4TcoQ1I' frameborder='0' wmode='opaque' allowfullscreen></iframe>
											</div><img style='visibility: hidden;width: 0;height: 0;' src='img/full_" . $cardInfo['card_url'] . ".png' data-id='1' alt='Geanimeerde kerstkaart' data-type='animated'/>";
                            }else{
                                echo "<video width='100%' class='videoCon' controls loop poster='img/full_" . $cardInfo['card_url'] . ".png' src='img/full_" . $cardInfo['card_url'] . ".mp4' data-id='" . $cardInfo['card_id'] . "' alt='" . $cardInfo['card_title'] . "' data-type='" . $cardInfo['card_type'] . "' title='" . $cardInfo['card_title'] . "'>
												<source src='img/full_" . $cardInfo['card_url'] . ".mp4' type='video/mp4'>
												<source src='img/full_" . $cardInfo['card_url'] . "a.mp4' type='video/mp4'>
												<source src='img/full_" . $cardInfo['card_url'] . ".webm' type='video/webm'>
												<source src='img/full_" . $cardInfo['card_url'] . ".ogv' type='video/ogg'>
												<source src='img/full_" . $cardInfo['card_url'] . ".m4v' type='video/x-m4v'>
												<img src='img/full_" . $cardInfo['card_url'] . ".png'></img>
										  </video>";
                            }

                        }
                        else
                        {
                            echo "<img title='" . $cardInfo['card_title'] . "' alt='" . $cardInfo['card_title'] . "' data-id=" . $cardInfo['card_id'] . " data-type=" . $cardInfo['card_type'] . " src='img/full_" . $cardInfo['card_url'] . ".png'/>";
                        }
                    }
                    else
                    {
                        echo "<figure id='cardConSec' alt='" . $cardInfo['card_title'] . "' style='background-image: url(img/full_" .  $cardInfo['card_url'] . ".png)'></figure>";
                    }
                    ?>
                </div>
            </div>

            <div id="back" style="display:none;">
                <div id="backCon">
                    <div id="backSec">
                        <!-- add personal text here -->
                        <h1><?php if(!empty($senderInfo['sender_begroeting'])){ echo nl2br($senderInfo['sender_begroeting']);} ?> <span><?php if(isset($receiverInfo['receiver_firstname'])){ echo $receiverInfo['receiver_firstname']; }?></span></h1>
                        <p><?php if(!empty($senderInfo['sender_message'])){ echo nl2br($senderInfo['sender_message']);} ?></p>
                    </div>

                    <div id="copyCon">
                        <?php echo $mail_copy; ?>
                    </div>
                </div>
            </div>


		    <div id="nav">
				<?php echo $mail_footer; ?>
				<!--<h1><a id="clickHinter" href="#">Klik hier</a> of veeg over de <span id="sideHinter">kaart</span> om je <span id="messageHinter">persoonlijke boodschap</span> te bekijken.</h1>-->
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