<p>-1</p>
<?php

              if(!filter_var($_SERVER['REDIRECT_Shib_Person_mail'], FILTER_VALIDATE_EMAIL)){
                  $emails = explode(";", $_SERVER['REDIRECT_Shib_Person_mail']);
                  foreach ($emails as $entry) {
                    if(strpos($entry, "thomasmore.be") && filter_var($entry, FILTER_VALIDATE_EMAIL))
                    {
                      $senderEmail = $entry;
                    }
                  }
                } else {
                  $senderEmail = $_SERVER['REDIRECT_Shib_Person_mail'];
                }

echo $senderEmail;
?>
<hr/>



<p>0
<?php
$email = $_SERVER["REDIRECT_Shib_Person_mail"];

if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
  $emails = explode(";", $email);
  foreach ($emails as $entry) {
    echo "<p>" . $entry ;
    if(strpos($entry, "thomasmore.be") && filter_var($entry, FILTER_VALIDATE_EMAIL))
    {
      echo "<p>Match: " . $entry;
    }
  }
}


?>

<p>1
<?php
 echo $_SERVER["REDIRECT_Shib_Person_surname"];
 echo $_SERVER["REDIRECT_Shib_Person_givenName"];
 echo $_SERVER["REDIRECT_Shib_Person_mail"];
?>

<p>Email syntax check</p>
<?php
if(filter_var($_SERVER["REDIRECT_Shib_Person_mail"], FILTER_VALIDATE_EMAIL)) {
	echo " valid";
}
?>


<p>2
<?php
 echo $_SERVER["REDIRECT_Shib_logoutURL"];
?>


<p>3
<?php
print"<table border=0>";
foreach ($_SERVER as $key=>$val )
{
    echo "<tr><td>".$key."</td><td>" .$val."</tr>";
}
print"</table>";
?>

