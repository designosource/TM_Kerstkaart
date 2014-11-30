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
			    <div id="cardCon" style="background-image: url('http://vaipui.files.wordpress.com/2011/12/christmas-atmosphere.jpg')">
			    	<!-- Add poem here -->
			    </div>
		   	</div>

			<div id="front" style="display:none;">
				<div id="cardCon" style="background-image: url('http://vaipui.files.wordpress.com/2011/12/christmas-atmosphere.jpg')">
			    	<!-- Add poem here -->
			    </div>
			</div>

			<div id="back" style="display:none;">
				<div id="backCon">
					<!-- add personal text here -->
					<h1>Merry shitmas</h1>
				</div>
			</div>


		    <div id="nav">
		    	<ul id="vorige-volgende">
					<li id="left"><a class="button-vorigevolgende" href="stap3.php">Kaart wijzigen</a></li>
					<li id="center"><h1>Veeg over de kaart om de <span>voorkant<span> te zien</h1></li>
					<li id="right"><a class="button-vorigevolgende" id="sendCard" href="#">Kaart versturen</a></li>
				</ul>
			</div>
		</div>

	<?php include("includes/scripts.inc.php"); ?>
	</body>
</html>