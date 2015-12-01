<?php 
	session_start();

	if(empty($_SESSION['cardALT']) && empty($_SESSION['cardURL']) && empty($_SESSION['cardID']))
	{
		header("location: index.php");
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


						<h1 id="perMessage">Persoonlijk bericht</h1>
						<p class="perMessage-info">Onderstaande tekst kun je zelf wijzigen. Let wel: de aanspreking wordt verderop automatisch toegevoegd, die hoef je niet mee op te nemen in dit tekstvak.</p>
						<div class="taal_select_container">
							<a id="lang-nl" href="#nl">NL</a>
							<a id="lang-fr" href="#fr">FR</a>
							<a id="lang-en" href="#en">EN</a>

						</div>
						<label for="aanspreek"><input type="text" id="aanspreek" name="aanspreek" value="<?php if(isset($_SESSION['aansMess'])){ echo $_SESSION['aansMess'];}else{ echo "Beste";}?>">[Hier komt automatisch de naam van de ontvanger]</label>
						<input type="hidden" id="taal_input_hidden" value="nl" name="taal">
							<textarea class="stap2-persoonlijkbericht" placeholder="Uw persoonlijk bericht" name="persoonlijkbericht" onclick="this.select()"><?php if(isset($_SESSION['persMess'])){ echo $_SESSION['persMess'];}else{ echo "Alles wat je kunt wensen.
En een klein beetje meer.
Zalig kerstfeest en
een gelukkig Nieuwjaar!

Groeten
" . $_SERVER['REDIRECT_Shib_Person_givenName'];} ?></textarea>
					</form>
					
					<p class="stap2-characters"><span>500</span> karakters over</p>

					<ul id="vorige-volgende" class="clearfix">
						<li id="left"><a id="gbStap1" class="button-vorigevolgende" href="index.php">Vorige stap</a></li>
						<li id="right"><a id="gtStap3" class="button-vorigevolgende" href="stap3.php">Volgende stap</a></li>
					</ul>
				</div>

			</div>

			<?php include("includes/footer.inc.php"); ?>
		</div>
		<?php include("includes/scripts.inc.php"); ?>
	</body>
</html>