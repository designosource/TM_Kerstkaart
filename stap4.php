<?php 
	session_start();
	if(empty($_SESSION['cardALT']) && empty($_SESSION['cardURL']) && empty($_SESSION['cardID']))
	{
		header("location: stap1.php");
	}
	else
	{
		if(empty($_SESSION['persMess']) && isset($_SESSION['senderFirstname']) && isset($_SESSION['senderLastname']) && isset($_SESSION['senderEmail']))
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

				var_dump($_SESSION);
			}
		}
	}

 ?><!DOCTYPE HTML>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<link href="css/normalize.css" rel="stylesheet" type="text/css" />
		<link href="css/styleCard.css" rel="stylesheet" type="text/css" />
		<title>Thomas More | Kerstkaart</title>
	</head>

	<body class="stap4">


		<div id='sendConfirmation'>
			<a id='closeOverlay' href='#'>Sluiten</a>
			<div id='confirmationCon'>
				<h1>Weet je zeker dat je klaar bent?</h1>
				<p>Je staat op het punt om deze kaart naar <span><?php if(!empty($amountPersons)){echo $amountPersons;} ?></span> personen te versturen.</p>

				<ul>
					<li id='send'><a href='#'>Versturen</a></li>
					<li id='cancel'><a href='#'>Annuleren</a></li>
				</ul>
			</div>
		</div>


		<div id="container">
			<div class="flipbox-container box100">
			    <div id="cardCon" style="background-image: url('<?php if(!empty($_SESSION['cardURL'])){echo $_SESSION['cardURL'];} ?>')">
			    	<!-- Add poem here -->
			    </div>
		   	</div>

			<div id="front" style="display:none;">
				<div id="cardCon" style="background-image: url('<?php if(!empty($_SESSION['cardURL'])){echo $_SESSION['cardURL'];} ?>')">
			    	<!-- Add poem here -->
			    </div>
			</div>

			<div id="back" style="display:none;">
				<div id="backCon">
					<div id="backSec">
					<!-- add personal text here -->
						<h1>Beste <span>[Voornaam ontvanger]</span></h1>
						<p><?php if(!empty($_SESSION['persMess'])){ echo $_SESSION['persMess'];} ?></p>
						<p id="senderSig">[Voornaam verzender]</p>
					</div>

					<div id="copyCon">
					<span id="copy">© 2014 <a title="Website van Designosource" href="http://designosource.be/">designosource</a> - <a title="Website van IMD" href="http://weareimd.be/">Interactieve Multimedia Design</a></span>
					</div>
				</div>
			</div>


		    <div id="nav">
		    	<ul id="vorige-volgende">
					<li id="left"><a class="button-vorigevolgende" href="stap3.php">Kaart wijzigen</a></li>
					<li id="center"><h1>Veeg over de kaart om de <span>achterkant</span> te zien</h1></li>
					<li id="right"><a class="button-vorigevolgende" id="sendCard" href="#">Kaart versturen</a></li>
				</ul>
			</div>
		</div>

	<?php include("includes/scripts.inc.php"); ?>
	</body>
</html>