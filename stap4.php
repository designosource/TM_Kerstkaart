<!DOCTYPE HTML>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<link href="css/normalize.css" rel="stylesheet" type="text/css" />
		<link href="css/styleCard.css" rel="stylesheet" type="text/css" />
		<title>Thomas More | Kerstkaart</title>
	</head>

	<body class="stap4">

		<div id="container">
			<div class="flipbox-container box100">
			    <div id="cardCon" style="background-image: url('img/placeholderImg_1.png')">
			    	<!-- Add poem here -->
			    </div>
		   	</div>

			<div id="front" style="display:none;">
				<div id="cardCon" style="background-image: url('img/placeholderImg_1.png')">
			    	<!-- Add poem here -->
			    </div>
			</div>

			<div id="back" style="display:none;">
				<div id="backCon">
					<div id="backSec">
					<!-- add personal text here -->
						<h1>Dag <span>John</span></h1>
						<p>A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart. I am alone, and feel the charm of existence in this spot, which was created for the bliss of souls like mine. I am so happy, my dear friend, so absorbed in the exquisite sense of mere tranquil existence, that I neglect my talents. I should be incapable of drawing a single stroke at the present moment; and yet I feel that I never was a greater artist than now. When,.</p>
						
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