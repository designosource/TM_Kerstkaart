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
		$card->setViewed($ridID);

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
		<meta name="twitter:domain" content="ttp://ecard.thomasmore.be">

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



		<?php /*
		if(preg_match('~MSIE|Internet Explorer~i', $_SERVER['HTTP_USER_AGENT']) || (strpos($_SERVER['HTTP_USER_AGENT'], 'Trident/7.0; rv:11.0') === false)) {
			echo '<div id="audioCon">
			<audio id="backgoundMusic">
		  		<source src="music/kerstmuziekje.ogg" type="audio/ogg">
 				<source src="music/kerstmuziekje.mp3" type="audio/mpeg">
		  		<source src="music/kerstmuziekje.wav" type="audio/wav">
			</audio>
			<a href="#go" id="go" class="demp_muziek"><img src="img/on.png" alt=""></a>
		</div>';
		} */
		?>

		<div id="container">
			<div class="flipbox-container box100">
			    <div id="cardCon">
			    	<!-- Add poem here -->
			    	<?php 
			    		if($cardInfo['card_type'] == "animated")
						{
							/*$useragent=$_SERVER['HTTP_USER_AGENT'];
							if(preg_match('~MSIE|Internet Explorer~i', $_SERVER['HTTP_USER_AGENT']) || (strpos($_SERVER['HTTP_USER_AGENT'], 'Trident/7.0; rv:11.0') !== false)){
								echo "<div class='videoWrapper'><iframe src='https://www.youtube.com/watch?v=fUB7oLawfDc?&amp;wmode=transparent&amp;rel=0&amp;showinfo=0&amp;loop=1&amp;autoplay=1' frameborder='0' allowfullscreen></iframe>
											</div><img style='visibility: hidden;width: 0;height: 0;' src='img/full_kaart_1.png' data-id='1' alt='Geanimeerde kerstkaart' data-type='animated'></img>";*/
							/*}else if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)
									||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))
									||preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up.browser|up.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"])){
								echo "<div class='videoWrapper'><iframe src='https://www.youtube.com/watch?v=fUB7oLawfDc?&amp;wmode=transparent&amp;rel=0&amp;showinfo=0&amp;loop=1&amp;autoplay=0' frameborder='0' allowfullscreen></iframe>
											</div><img style='visibility: hidden;width: 0;height: 0;' src='img/full_kaart_1.png' data-id='1' alt='Geanimeerde kerstkaart' data-type='animated'></img>";*/
							/*} else {*/
								echo "<video width='100%' class='videoCon' controls loop autoplay poster='img/full_" . $cardInfo['card_url'] . ".png' src='img/full_" . $cardInfo['card_url'] . ".mp4' data-id='" . $cardInfo['card_title'] . "' data-type='" . $cardInfo['card_type'] . "'>
												<source src='img/full_" . $cardInfo['card_url'] . ".mp4' type='video/mp4'>
												<source src='img/full_" . $cardInfo['card_url'] . ".webm' type='video/webm'>
												<source src='img/full_" . $cardInfo['card_url'] . ".ogv' type='video/ogg'>
												<source src='img/full_" . $cardInfo['card_url'] . ".m4v' type='video/x-m4v'>
												<img src='img/full_" . $cardInfo['card_url'] . ".png'></img>
														</video>";
							/*}*/
							//echo "<figure id='cardConSec' alt='".$cardInfo['card_title']."' style='background-image: url(img/full_".$cardInfo['card_url'].".gif)'></figure>";
						}
						else
						{
							echo "<figure id='cardConSec' alt='".$cardInfo['card_title']."' style='background-image: url(img/full_".$cardInfo['card_url'].".png); margin:0 auto; display: block'></figure>";
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
						/*$useragent=$_SERVER['HTTP_USER_AGENT'];
						if(preg_match('~MSIE|Internet Explorer~i', $_SERVER['HTTP_USER_AGENT']) || (strpos($_SERVER['HTTP_USER_AGENT'], 'Trident/7.0; rv:11.0') !== false)){
							echo "<div class='videoWrapper'><iframe src='https://www.youtube.com/watch?v=fUB7oLawfDc?&amp;wmode=transparent&amp;rel=0&amp;showinfo=0&amp;loop=1&amp;autoplay=0' frameborder='0' allowfullscreen></iframe>
											</div><img style='visibility: hidden;width: 0;height: 0;' src='img/full_kaart_1.png' data-id='1' alt='Geanimeerde kerstkaart' data-type='animated'></img>";*/
						/*}else if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)
								||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))
								||preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up.browser|up.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"])){
							echo "<div class='videoWrapper'><iframe src='https://www.youtube.com/watch?v=fUB7oLawfDc?&amp;wmode=transparent&amp;rel=0&amp;showinfo=0&amp;loop=1&amp;autoplay=0' frameborder='0' allowfullscreen></iframe>
											</div><img style='visibility: hidden;width: 0;height: 0;' src='img/full_kaart_1.png' data-id='1' alt='Geanimeerde kerstkaart' data-type='animated'></img>";*/
						/*}else {*/
							echo "<video width='100%' class='videoCon' controls loop poster='img/full_" . $cardInfo['card_url'] . ".png' src='img/full_" . $cardInfo['card_url'] . ".mp4' data-id='" . $cardInfo['card_title'] . "' data-type='" . $cardInfo['card_type'] . "'>
												<source src='img/full_" . $cardInfo['card_url'] . ".mp4' type='video/mp4'>
												<source src='img/full_" . $cardInfo['card_url'] . "a.mp4' type='video/mp4'>
												<source src='img/full_" . $cardInfo['card_url'] . ".webm' type='video/webm'>
												<source src='img/full_" . $cardInfo['card_url'] . ".ogv' type='video/ogg'>
												<source src='img/full_" . $cardInfo['card_url'] . ".m4v' type='video/x-m4v'>
												<img src='img/full_" . $cardInfo['card_url'] . ".png'></img>
														</video>";
						/*}*/
						//echo "<figure id='cardConSec' alt='".$cardInfo['card_title']."' style='background-image: url(img/full_".$cardInfo['card_url'].".gif)'></figure>";
					}
					else
					{
						echo "<figure id='cardConSec' alt='".$cardInfo['card_title']."' style='background-image: url(img/full_".$cardInfo['card_url'].".png)'></figure>";
					}
					?>
			    </div>
			</div>

			<div id="back" style="display:none;">
				<div id="backCon">
					<div id="backSec">
					<!-- add personal text here -->
					
						<h1><?php echo nl2br($senderInfo['sender_begroeting']); ?> <span><?php echo $receiverInfo['receiver_firstname'];?></span></h1>
						<p><?php echo nl2br($senderInfo['sender_message']); ?></p>
						<input type="hidden" name="lang" id="lang" value="<?php echo $senderInfo["sender_language"]; ?>">
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