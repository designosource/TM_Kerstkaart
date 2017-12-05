<?php 
	session_start();

	if(empty($_SESSION['cardALT']) && empty($_SESSION['cardURL']) && empty($_SESSION['cardID']))
	{
		header("location: index.php");
	}
		
	if($_GET["lang"] === "en"){
		$_SESSION["taal"] = "en";
	} else if($_GET["lang"] === "fr") {
		$_SESSION["taal"] = "fr";
	} else if($_GET["lang"] === "nl") {
		$_SESSION["taal"] = "nl";
	}
	
	if($_SESSION['taal'] == "en") {
		$begroeting = "Dear";
		$tekst =  "[Vul hier de Engelstalige tekst voor de e-card in.]\n".$_SERVER['REDIRECT_Shib_Person_givenName'];
		$taal = "en";
	} else if($_SESSION['taal'] == "fr") {
		$begroeting = "Bonjour";
		$tekst =  "[Vul hier de Franstalige tekst voor de e-card in.]\n".$_SERVER['REDIRECT_Shib_Person_givenName'];
		$taal = "fr";
	} else {
		$begroeting = "Beste";
		$tekst =  "Meer\nStilte op aarde.\nEn vrede overal.\nZalig kerstfeest en\nEen gelukkig Nieuwjaar!\n\nGroeten\n".$_SERVER['REDIRECT_Shib_Person_givenName'];
		$taal = "nl";
	}

		if(isset($_GET["lang"])){
			$_SESSION["begroetMess"] = $begroeting;
			$_SESSION["persMess"] = $tekst;
		}

	if(isset($_SESSION["begroetMess"])) {
		$begroetingValue = $_SESSION["begroetMess"];
	}
	else{
		$begroetingValue = $begroeting;
	}

	if(isset($_SESSION["taal"])) {
		$taalValue = $_SESSION["taal"];
	}
	else{
		$taalValue = $taal;
	}

	if(isset($_SESSION['persMess'])) {
		$persVal = trim($_SESSION["persMess"]); // als er al een tekst geschreven is --> toon die tekst
	}
	else{
		$persVal = $tekst; // toon default adhv SESSION TAAL
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


						<h1 id="perMessage"><b>Persoonlijk bericht</b></h1>
						<p class="perMessage-info">Onderstaande tekst kun je wijzigen.</p>
						
						<div class="taal_select_container">
							<a id="lang-en" class="<?php if($taal == "en"){
								echo 'active';
							}
							?>" href="?lang=en">EN</a>
							<a id="lang-fr" class="<?php if($taal == "fr"){
								echo 'active';
							}
							?>" href="?lang=fr">FR</a>
							<a id="lang-nl" class="<?php if($taal == "nl"){
								echo 'active';
							}
							?>" href="?lang=nl">NL</a>

						</div>
						<label for="begroeting" id="label_begroeting"><input type="text" id="begroeting" name="begroeting" value="<?php echo $begroetingValue; ?>"> <span>[De voornaam van de ontvanger wordt automatisch ingevuld.]</span></label>
						<input type="hidden" id="taal_input_hidden" value="<?php echo $taalValue; ?>" name="taal">
							<textarea  class="stap2-persoonlijkbericht" placeholder="Uw persoonlijk bericht" name="persoonlijkbericht" onclick="this.select()"><?php echo $persVal ;?></textarea>
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