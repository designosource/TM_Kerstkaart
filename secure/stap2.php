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

    include('includes/variables.inc.php'); // Word hier pas geinclude doordat je anders de taal nog niet hebt opgehaald

    // If empty --> nl
	
	/*if($_SESSION['taal'] == "en") {
		$begroeting = "Dear";
		$tekst =  "[Vul hier de tekst voor de e-card in.]\n".$_SERVER['REDIRECT_Shib_Person_givenName'];
		$taal = "en";
	} else if($_SESSION['taal'] == "fr") {
		$begroeting = "Bonjour";
		$tekst =  "[Vul hier de tekst voor de e-card in.]\n".$_SERVER['REDIRECT_Shib_Person_givenName'];
		$taal = "fr";
	} else {
		$begroeting = "Beste";
		$tekst =  "Meer\nStilte op aarde.\nEn vrede overal.\nZalig kerstfeest en\nEen gelukkig Nieuwjaar!\n\nGroeten\n".$_SERVER['REDIRECT_Shib_Person_givenName'];
		$taal = "nl";
	}

    if(isset($_GET["lang"])){
        $_SESSION["begroetMess"] = $begroeting;
        $_SESSION["persMess"] = $tekst;
    }*/



	/*if(isset($_SESSION["taal"])) {
		$taalValue = $_SESSION["taal"];
	}
	else{
		$taalValue = $taal;
	}*/

	if(isset($_SESSION['persMess'])) {
		$persVal = trim($_SESSION["persMess"]); // als er al een tekst geschreven is --> toon die tekst
	}
	else{
		$persVal = $step2["message"]; // toon default adhv SESSION TAAL
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


						<h1 id="perMessage"><b><?php if(isset($step2)){ echo $step2["title"]; }else{echo "Persoonlijk bericht";} ?></b></h1>
						<p class="perMessage-info"><?php if(isset($step2)){ echo $step2["subtitle"]; }else{echo "Onderstaande tekst kun je wijzigen";} ?>.</p>
						
						<div class="taal_select_container">
							<a id="lang-en" class="<?php if($_SESSION["taal"] == "en"){echo 'active';}
							?>" href="?lang=en">EN</a>
							<a id="lang-fr" class="<?php if($_SESSION["taal"] == "fr"){echo 'active';}
							?>" href="?lang=fr">FR</a>
							<a id="lang-nl" class="<?php if(!isset($_SESSION["taal"]) || $_SESSION["taal"] == "nl"){echo 'active';}
							?>" href="?lang=nl">NL</a>

						</div>
						<label for="begroeting" id="label_begroeting"><input type="text" id="begroeting" name="begroeting" value="<?php if(isset($step2["greeting"])){ echo $step2["greeting"];}else{ echo "Beste"; } ?>"> <span>[<?php if(isset($step2["receiverinformation"])){ echo $step2["receiverinformation"]; }else{ echo "De voornaam van de ontvanger wordt automatisch ingevuld"; } ?>.]</span></label>
						<input type="hidden" id="taal_input_hidden" value="<?php if(isset($_SESSION["taal"])){ echo $_SESSION["taal"];}else{ echo "nl";}; ?>" name="taal">
							<textarea  class="stap2-persoonlijkbericht" placeholder="<?php if(isset($step2["placeholder"])){ echo $step2["placeholder"]; }else{ echo "Uw persoonlijk bericht"; } ?>" name="persoonlijkbericht" onclick="this.select()"><?php if(isset($_SESSION["persMess"])){ echo $_SESSION["persMess"];}elseif(isset($step2["message"])){ echo $step2["message"] . $_SERVER['REDIRECT_Shib_Person_givenName'];}else{ echo "Meer\nStilte op aarde.\nEn vrede overal.\nZalig kerstfeest en\nEen gelukkig Nieuwjaar!\n\nGroeten\n" . $_SERVER['REDIRECT_Shib_Person_givenName']; }?></textarea>
					</form>
					
					<p class="stap2-characters"><span>500</span> <?php if(isset($step2["characters"])){ echo $step2["characters"]; }else{ echo "karakters over"; } ?></p>

					<?php include("includes/previousnext.inc.php"); ?>
				</div>

			</div>

			<?php include("includes/footer.inc.php"); ?>
		</div>
		<?php include("includes/scripts.inc.php"); ?>
	</body>
</html>