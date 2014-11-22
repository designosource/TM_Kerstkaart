<!doctype html>
<html lang="en">
	<head>
		<?php include("includes/head.inc.php") ?>
	</head>

	<body class="stap1">
		<div id="preCon">
			<div id="container">

				<?php include("includes/header.inc.php") ?>

				<div id="content">
					<div id="stap1-col1">
						<h1>Titel van kaart</h1>
						<div class="stap1-choosen"></div>	<!--CSS VERWIJDEREN CLASS -->
					</div>

					<div id="stap1-col2">
						<h1>Andere ontwerpen</h1>
						<p>Andere ontwerpen zijn nog niet beschikbaar.</p>
					</div>



					<ul id="vorige-volgende" class="clearfix">
						<li id="right"><a class="button-vorigevolgende" href="stap2.php">Volgende stap</a></li>
					</ul>
				</div>

			</div>

			<?php include("includes/footer.inc.php"); ?>
			
		</div>
	
		<?php include("includes/scripts.inc.php"); ?>
	</body>
</html>