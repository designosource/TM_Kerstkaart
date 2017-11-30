<?php
    if( $_SESSION['taal'] == "nl" )
    {
        $logout = "Afmelden";

        $step1 = "Kies een ontwerp";
        $step2 = array("title" => "Persoonlijk bericht", "subtitle" => "Onderstaande tekst kun je wijzigen", "greeting" => "Beste", "message" => "[Vul hier de tekst voor de e-card in.]\n", "placeholder" => "Uw persoonlijk bericht", "characters" => "karakters over");

        $nav1 = "Kies een kaart";
        $nav2 = "Voeg tekst toe";
        $nav3 = "Ontvangers";
        $nav4 = "Preview";
        $previousstep = "Vorige stap";
        $nextstep = "Volgende stap";
        $footer = array("developed" => "Ontwikkeld door", "student" => "Studenten van");
    }
    elseif($_SESSION['taal'] == "fr")
    {
        $logout = "Déconnecte";

        $step1 = "Choisis un design";
        $step2 = array("title" => "Message personelle", "subtitle" => "Vous pouvez changer le texte ci-dessous", "greeting" => "Bonjour", "receiverinformation" => "Le prénom de le destinataire est remplit automatiquement", "message" => "[Entre le texte pour l'e-card ici.]\n", "placeholder" => "Votre message personnelle", "characters" => "caractères restant");

        $nav1 = "Choisis une carte";
        $nav2 = "Ajoute du texte";
        $nav3 = "Destinataires";
        $nav4 = "Aperçu";
        $previousstep = "Etape précédent";
        $nextstep = "Etape suivant";
        $footer = array("developed" => "Développé par", "student" => "Etudiants de");
    }
    elseif($_SESSION['taal'] == "en")
    {
        $logout = "Sign out";
        $step1 = "Choose a design";
        $step2 = array("title" => "Personal message", "subtitle" => "You can change the text below", "greeting" => "Dear", "receiverinformation" => "The program automatically fills in the name of the recipient", "message" => "[Fill in the text for the e-card.]\n", "placeholder" => "Your personal message", "characters" => "characters left");

        $nav1 = "Choose a card";
        $nav2 = "Add text";
        $nav3 = "Receivers";
        $nav4 = "Preview";
        $previousstep = "Previous step";
        $nextstep = "Next step";
        $footer = array("developed" => "Developed by", "student" => "Students of");
    }
    else
    {

    }
?>
<header>
	<a id="afmelden" href="logout.php"><?php if(isset($_SESSION['taal'])){ echo $logout; }else{echo "Afmelden";} ?></a>
	<div id="logo">
		<a target="_blank" href="http://www.thomasmore.be/" id="login-logo">Thomas More Hogeschool</a>
	</div>

	<nav>
		<ul>
			<li id="liStap1">
			    <h1 style='color:<?php if(!empty($_SESSION['cardALT']) && !empty($_SESSION['cardURL']) && !empty($_SESSION['cardID'])){ echo "#656565";} ?>'><span class="cijfer" style='border-color:<?php if(!empty($_SESSION['cardALT']) && !empty($_SESSION['cardURL']) && !empty($_SESSION['cardID'])){ echo "#656565";} ?>'> <?php if(!empty($_SESSION['cardALT']) && !empty($_SESSION['cardURL']) && !empty($_SESSION['cardID'])){ echo "&#10004;";}else{ echo "1";} ?> </span><?php if(isset($_SESSION['taal'])){ echo $nav1; }else{echo "Kies een kaart";} ?></h1>
            </li>
			<li id="liStap2">
			    <h1 style='color:<?php if(!empty($_SESSION['persMess'])){ echo "#656565";} ?>'>
			        <span class="cijfer" style='border-color:<?php if(!empty($_SESSION['persMess'])){ echo "#656565";} ?>'> <?php if(!empty($_SESSION['persMess'])){ echo "&#10004;";}else{ echo "2";} ?> </span><?php if(isset($_SESSION['taal'])){ echo $nav2; }else{echo "Voeg tekst toe";} ?></h1>
            </li>
			<li id="liStap3">
			    <h1 style='color:<?php if(!empty($_SESSION['person'])){ echo "#656565";} ?>'>
			    <span class="cijfer" style='border-color:<?php if(!empty($_SESSION['person'])){ echo "#656565";} ?>'> <?php if(!empty($_SESSION['person'])){ echo "&#10004;";}else{ echo "3";} ?> </span><?php if(isset($_SESSION['taal'])){ echo $nav3; }else{echo "Ontvangers";} ?></h1>
            </li>
			<li id="liStap4">
                <h1><span class="cijfer">4</span><?php if(isset($_SESSION['taal'])){ echo $nav4; }else{echo "Preview";} ?></h1>
			</li>
		</ul>
	</nav>
</header>
