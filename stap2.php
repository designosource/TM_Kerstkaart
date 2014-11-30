<!doctype html>
<html lang="en">
	<head>
		<?php include("includes/head.inc.php") ?>
	</head>

	<body class="stap2">
		<div id="preCon">
			<div id="container">

				<?php include("includes/header.inc.php") ?>

				<div id="content">
					<h1>Persoonlijk bericht</h1>

					<form action="#" method="POST">
						<textarea class="stap2-persoonlijkbericht" placeholder="Uw persoonlijk bericht" name="persoonlijkbericht" onclick="this.select()">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ut mollis ipsum. Proin pharetra nibh sed lacus vestibulum, id consequat tortor euismod. Praesent mattis eleifend leo, ut auctor ligula aliquet eu. Aenean eu lacinia neque, nec aliquam purus. 

Aliquam id neque eu nunc ornare imperdiet id vel justo. Fusce maximus, ante ac ultricies luctus, urna ligula ullamcorper nisl, in molestie justo metus ac lacus. Fusce tincidunt sagittis turpis, nec placerat lorem interdum quis.</textarea>
					</form>
					
					<p class="stap2-characters"><span>500</span> karakters over</p>

					<ul id="vorige-volgende" class="clearfix">
						<li id="left"><a class="button-vorigevolgende" href="stap1.php">Vorige stap</a></li>
						<li id="right"><a id="gtStap3" class="button-vorigevolgende" href="stap3.php">Volgende stap</a></li>
					</ul>
				</div>

			</div>

			<?php include("includes/footer.inc.php"); ?>
		</div>
		<?php include("includes/scripts.inc.php"); ?>
	</body>
</html>