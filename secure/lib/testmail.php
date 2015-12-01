<?php
// Init phpMailer
require_once('class.phpmailer.php');
$mail = new PHPMailer();
$mail->IsSMTP();

$mail->SMTPAuth = false;
//$mail->Host = "10.64.4.15";
$mail->Host = "10.151.11.101";
$mail->Port = 25;

//compose message
$emailbody = "	<p><strong>Naam: </strong> Hallo, Wereld! </p>";

//Send Message
$mail->SetFrom("jille.floridor@thomasmore.be");
$mail->Subject = "Dit is een testbericht";
$mail->MsgHTML($emailbody);
//$mail->AddAddress($destination);
$mail->AddAddress("jille.floridor+servicedesk@gmail.com","Jille Floridor");

if($mail->Send()) {
  echo "Message sent! ";
  echo $destination . " " . $mail->Subject;
} else {
  echo "Mailer Error: " . $mail->ErrorInfo;
}

?>
