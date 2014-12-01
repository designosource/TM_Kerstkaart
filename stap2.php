<?php 
	session_start();

	if(empty($_SESSION['cardALT']) && empty($_SESSION['cardURL']) && empty($_SESSION['cardID']))
	{
		header("location: stap1.php");
	}
 ?><!doctype html>
<html lang="en">
	<head>
		<?php include("includes/head.inc.php") ?>
	</head>

	<body class="stap2">
		<div id="preCon">
			<div id="container">

				<?php include("includes/header.inc.php") ?>

				<div id="content">

					<form action="#" method="POST">

						<div id="senderCon">
							<h1 id="senderInfo">De verzender</h1>

							<input id="sendFirstname" type="text" placeholder="Uw voornaam" value="<?php if(isset($_SESSION['senderFirstname'])){echo $_SESSION['senderFirstname'];}?>"></input>
							<input id="sendLastname" type="text" placeholder="Uw achternaam" value="<?php if(isset($_SESSION['senderLastname'])){echo $_SESSION['senderLastname'];}?>"></input>
							<input id="sendEmail" type="text" placeholder="Uw emailadres" value="<?php if(isset($_SESSION['senderEmail'])){echo $_SESSION['senderEmail'];}?>"></input>
						</div>

						<h1 id="perMessage">Persoonlijk bericht</h1>

							<textarea class="stap2-persoonlijkbericht" placeholder="Uw persoonlijk bericht" name="persoonlijkbericht" onclick="this.select()"><?php if(isset($_SESSION['persMess'])){ echo $_SESSION['persMess'];}else{ echo "Alles wat je kunt wensen.
En een klein beetje meer.
Zalig kerstfeest en
een gelukkig Nieuwjaar!";} ?></textarea>
					</form>
					
					<p class="stap2-characters"><span>500</span> karakters over</p>

					<ul id="vorige-volgende" class="clearfix">
						<li id="left"><a id="gbStap1" class="button-vorigevolgende" href="stap1.php">Vorige stap</a></li>
						<li id="right"><a id="gtStap3" class="button-vorigevolgende" href="stap3.php">Volgende stap</a></li>
					</ul>
				</div>

			</div>

			<?php include("includes/footer.inc.php"); ?>
		</div>
		<?php include("includes/scripts.inc.php"); ?>
	</body>
</html>