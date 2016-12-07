<?php 
	session_start();
	if(empty($_SESSION['cardALT']) && empty($_SESSION['cardURL']) && empty($_SESSION['cardID']))
	{
		header("location: index.php");
	}
	else
	{
		if(empty($_SESSION['persMess']))
		{
			header("location: stap2.php");
		}
		else
		{
			if(empty($_SESSION['person']))
			{
				header("location: stap3.php");
			}
			else
			{
				$amountPersons = count($_SESSION['person']);
			}
		}
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

		<!--[if lt IE 9]>
			<script src="js/html5chiv.js"></script>
		<![endif]-->

		<link href="css/normalize.css" rel="stylesheet" type="text/css" />
		<link href="css/styleCard.css" rel="stylesheet" type="text/css" />
		<title>Thomas More | Kerstkaart</title>
	</head>

	<body class="stap4 <?php
								if(isset($_SESSION['cardType']))
							 {

							 	if($_SESSION['cardType'] == "animated")
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
				<source src="music/kerstmuziekje.mp3" type="audio/mpeg">
		  		<source src="music/kerstmuziekje.ogg" type="audio/ogg">
		  		<source src="music/kerstmuziekje.wav" type="audio/wav">
			</audio>
			<a href="#go" id="go" class="demp_muziek"><img src="img/on.png" alt=""></a>
		</div>';
		} */
		?>



		<div id='sendConfirmation'>
			<a id='closeOverlay' href='#'>Sluiten</a>
			<div id='confirmationCon'>
				<h1>Weet je zeker dat je klaar bent?</h1>
				<p>Je staat op het punt om deze kaart naar 
					<span>
							<?php if(!empty($amountPersons))
								  {
								  	if($amountPersons > 1)
								  	{
								  		echo $amountPersons . "</span> personen";
								  	}
								  	else
								  	{
								  		echo $amountPersons . "</span> persoon";
								  	}
								  } ?> te versturen.</p>

				<ul>
					<li id='send'><a href='#'>Versturen</a></li>
					<li id='cancel'><a href='#'>Annuleren</a></li>
				</ul>
			</div>
		</div>


		<div id="container">
			<div class="flipbox-container box100">
			    <div id="cardCon">
			    	<!-- Add poem here -->
			    	<?php
			    		if(isset($_SESSION['cardURL']) && isset($_SESSION['cardType']))
						{
							if($_SESSION['cardType'] == "animated")
							{
								if(preg_match('~MSIE|Internet Explorer~i', $_SERVER['HTTP_USER_AGENT']) || (strpos($_SERVER['HTTP_USER_AGENT'], 'Trident/7.0; rv:11.0') !== false)){
									echo "<div class='videoWrapper'><iframe src='https://www.youtube.com/watch?v=fUB7oLawfDc?&amp;wmode=transparent&amp;rel=0&amp;showinfo=0&amp;loop=1&amp;autoplay=1&amp;loop=1&amp;autoplay=1&amp;playlist=vAZT4TcoQ1I' frameborder='0' wmode='opaque' allowfullscreen></iframe>
											</div><img style='visibility: hidden;width: 0;height: 0;' src='img/full_kaart_1.png' data-id='1' alt='Geanimeerde kerstkaart' data-type='animated'/>";
								}else{
									echo "<video width='100%' class='videoCon' controls loop autoplay poster='img/".$_SESSION['cardURL'].".png' src='img/".$_SESSION['cardURL'].".mp4' data-id='".$_SESSION['cardID']."' alt='".$_SESSION['cardALT']."' data-type='".$_SESSION['cardType']."' title='".$_SESSION['cardALT']."'>
												<source src='img/full_".$_SESSION['cardURL'].".mp4' type='video/mp4'>
												<source src='img/full_".$_SESSION['cardURL']."a.mp4' type='video/mp4'>
												<source src='img/full_".$_SESSION['cardURL'].".webm' type='video/webm'>
												<source src='img/full_".$_SESSION['cardURL'].".ogv' type='video/ogg'>
												<source src='img/full_".$_SESSION['cardURL'].".m4v' type='video/x-m4v'>
												<img src='img/full_".$_SESSION['cardURL'].".png'></img>
												</video>";
								}

							}
							else
							{
								echo "<img title='".$_SESSION['cardALT']."' alt='".$_SESSION['cardALT']."' data-id=".$_SESSION['cardID']." data-type=".$_SESSION['cardType']." src='img/full_kaart_3.png'/>";
							}
						}
						else
						{
							echo "<figure id='cardConSec' alt='".$_SESSION['cardALT']."' style='background-image: url(img/full_".$_SESSION['cardURL'].".png)'></figure>";
						}
			    	 ?>
			    </div>
		   	</div>

			<div id="front" style="display:none;">
				<div id="cardCon">
			    	<!-- Add poem here -->
					<?php 
						if(isset($_SESSION['cardURL']) && isset($_SESSION['cardType']))
						{
							if($_SESSION['cardType'] == "animated")
							{
								if(preg_match('~MSIE|Internet Explorer~i', $_SERVER['HTTP_USER_AGENT']) || (strpos($_SERVER['HTTP_USER_AGENT'], 'Trident/7.0; rv:11.0') !== false)){
									echo "<div class='videoWrapper'><iframe src='https://www.youtube.com/watch?v=fUB7oLawfDc?&amp;wmode=transparent&amp;rel=0&amp;showinfo=0&amp;loop=1&amp;autoplay=0&amp;playlist=vAZT4TcoQ1I' frameborder='0' wmode='opaque' allowfullscreen></iframe>
											</div><img style='visibility: hidden;width: 0;height: 0;' src='img/full_kaart_1.png' data-id='1' alt='Geanimeerde kerstkaart' data-type='animated'></img>";
								}else{
									echo "<video width='100%' class='videoCon' controls loop  poster='img/".$_SESSION['cardURL'].".png' src='img/".$_SESSION['cardURL'].".mp4' data-id='".$_SESSION['cardID']."' alt='".$_SESSION['cardALT']."' data-type='".$_SESSION['cardType']."' title='".$_SESSION['cardALT']."'>
												<source src='img/full_".$_SESSION['cardURL'].".mp4' type='video/mp4'>
												<source src='img/full_".$_SESSION['cardURL']."a.mp4' type='video/mp4'>
												<source src='img/full_".$_SESSION['cardURL'].".webm' type='video/webm'>
												<source src='img/full_".$_SESSION['cardURL'].".ogv' type='video/ogg'>
												<source src='img/full_".$_SESSION['cardURL'].".m4v' type='video/x-m4v'>
												<img src='img/full_".$_SESSION['cardURL'].".png'></img>
												</video>";
								}
							}
							else
							{
								echo "<img title='".$_SESSION['cardALT']."' alt='".$_SESSION['cardALT']."' data-id=".$_SESSION['cardID']." data-type=".$_SESSION['cardType']." src='img/full_kaart_3.png'/>";
							}
						}
						else
						{
							echo "<figure id='cardConSec' alt='".$_SESSION['cardALT']."' style='background-image: url(img/full_".$_SESSION['cardURL'].".png)'></figure>";
						}
					 ?>
			    </div>
			</div>

			<div id="back" style="display:none;">
				<div id="backCon">
					<div id="backSec">
					<!-- add personal text here -->
						<h1><?php if(!empty($_SESSION['begroetMess'])){ echo nl2br($_SESSION['begroetMess']);} ?> <span>[hier zal automatisch de naam van je bestemmeling verschijnen]</span></h1>
						<p><?php if(!empty($_SESSION['persMess'])){ echo nl2br($_SESSION['persMess']);} ?></p>
						</div>

					<div id="copyCon">
					<span id="copy">&copy; <a href="http://www.thomasmore.be/">Thomas More</a> | Ontwikkeld door <a href="http://designosource.be/">Designosource</a> - Studenten van <a href="http://weareimd.be/">Interactive Multimedia Design</a></span>
					</div>
				</div>
			</div>


		    <div id="nav">
		    	<ul id="vorige-volgende">
					<li id="left"><a class="button-vorigevolgende" href="index.php">Kaart wijzigen</a></li>
					<li id="center"><h1><a id="clickHinter" href="#">Klik hier</a> of veeg over de <span id="sideHinter">kaart</span> om je <span id="messageHinter">persoonlijke boodschap</span> te bekijken.</h1></li>
					<li id="right"><a class="button-vorigevolgende" id="sendCard" href="#">Kaart versturen</a></li>
				</ul>
			</div>
		</div>

	<?php include("includes/scripts.inc.php"); ?>
	<script>
		$(document).ready(function(){
			var isIE11 = /*@cc_on!@*/false || !!document.documentMode;
			if(isIE11) {
				$("#audioCon").empty();
				$("body").removeClass("music");
				pauseBackgroundMusic();
				$.each($('audio'), function () {
				 this.pause();
				 });
			}
		});
	</script>
	</body>
</html>