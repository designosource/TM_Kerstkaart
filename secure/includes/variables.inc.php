<?php

// Tekstvariabelen per taal
if( $_SESSION['taal'] == "nl" ) // Nederlands
{
    $logout = "Afmelden";

    $step1 = "Kies een ontwerp";
    $step2 = array("title" => "Persoonlijk bericht", "subtitle" => "Onderstaande tekst kun je wijzigen", "greeting" => "Beste", "message" => "[Vul hier de tekst voor de e-card in.]\n", "placeholder" => "Uw persoonlijk bericht", "characters" => "karakters over");
    $step3 = array("amountmails" => "Het bulk importeren van emails is beperkt tot", "error" => "Er is iets misgelopen, gelieve nog eens te proberen", "wrongtype" => "Verkeerde type file. Alleen .xls en .xlsx zijn momenteel ondersteund", "nofileselected" => "Gelieve een bestand up te loaden",
        "addemail" => "Emailadres toevoegen", "importexcel" => "Excel-bestand importeren", "modify" => "Wijzig", "delete" => "Verwijder", "firstname" => "Voornaam", "lastname" => "Achternaam", "email" => "E-mailadres", "noreceivers" => "Nog geen ontvangers");
    $step4 = array("previousstep" => "Kaart wijzigen", "nextstep" => "Kaart versturen", "clickhere" => "Klik hier", "message" => "of veeg over de <b>kaart</b> om je <b>persoonlijke boodschap</b> te bekijken");


    $nav1 = "Kies een kaart";
    $nav2 = "Voeg tekst toe";
    $nav3 = "Ontvangers";
    $nav4 = "Preview";
    $previousstep = "Vorige stap";
    $nextstep = "Volgende stap";
    $footer = array("developed" => "Ontwikkeld door", "student" => "Studenten van");
}
elseif($_SESSION['taal'] == "fr") // Frans
{
    $logout = "Déconnecte";

    $step1 = "Choisis un design";
    $step2 = array("title" => "Message personelle", "subtitle" => "Vous pouvez changer le texte ci-dessous", "greeting" => "Bonjour", "receiverinformation" => "Le prénom de le destinataire est remplit automatiquement", "message" => "[Entre le texte pour l'e-card ici.]\n", "placeholder" => "Votre message personnelle", "characters" => "caractères restant");
    $step3 = array("amountmails" => "L'importation des courriels est limité à", "error" => "Il y a quelque chose a mal tourné, s’il vous plaît avoir une autre chance", "wrongtype" => "Type de fichier incorrect. Seuls les fichiers .xls et .xlsx sont supporté au moment", "nofileselected" => "Télécharge un fichier s’il vous plaît",
        "addemail" => "Ajoute des adresses de courriels", "importexcel" => "Importe fichier excel", "modify" => "Modifié", "delete" => "Supprimé", "firstname" => "Prénom", "lastname" => "Nom de famille", "email" => "Adresse de courriel", "noreceivers" => "Aucun récepteurs selecté");
    $step4 = array("previousstep" => "Modifié design", "nextstep" => "Envoie carte", "clickhere" => "Cliquez ici", "message" => "ou essuyer sur <b>la carte</b> pour afficher votre <b>message personnel</b>");

    $nav1 = "Choisis une carte";
    $nav2 = "Ajoute du texte";
    $nav3 = "Destinataires";
    $nav4 = "Aperçu";
    $previousstep = "Etape précédent";
    $nextstep = "Etape suivant";
    $footer = array("developed" => "Développé par", "student" => "Etudiants de");
}
elseif($_SESSION['taal'] == "en") // Engels
{
    $logout = "Sign out";
    $step1 = "Choose a design";
    $step2 = array("title" => "Personal message", "subtitle" => "You can change the text below", "greeting" => "Dear", "receiverinformation" => "The program automatically fills in the name of the recipient", "message" => "[Fill in the text for the e-card.]\n", "placeholder" => "Your personal message", "characters" => "characters left");
    $step3 = array("amountmails" => "The bulk import of emails is limited to", "error" => "Something went wrong. Please try again", "wrongtype" => "Wrong file type. Only .xls and .xlsx are currently supported", "nofileselected" => "Please upload a file",
        "addemail" => "Add e-mail address", "importexcel" => "Import excel file", "modify" => "Modify", "delete" => "Delete", "firstname" => "First name", "lastname" => "Last name", "email" => "E-mailaddress", "noreceivers" => "No receivers yet");
    $step4 = array("previousstep" => "Change card", "nextstep" => "Send card", "clickhere" => "Click here", "message" => "or swipe <b>the card</b> to show your <b>personal message</b>");


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

// Link volgende - vorige
$currentfile = basename($_SERVER['PHP_SELF']);
if( $currentfile == "index.php" )
{
    $linkprevious = null;
    $linknext = "stap2.php";
} elseif( $currentfile == "stap2.php" )
{
    $linkprevious = "index.php";
    $linknext = "stap3.php";
} elseif( $currentfile == "stap3.php" )
{
    $linkprevious = "stap2.php";
    $linknext = "stap4.php";
} else {
    $linkprevious = "index.php";
    $linknext = null;
}

?>