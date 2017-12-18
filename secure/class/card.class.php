<?php
include_once('db.class.php');

Class Card
{
    private $m_ssenderFirstname;
    private $m_ssenderLastName;
    private $m_ssenderEmailadress;

    private $m_sreceiverFirstname;
    private $m_sreceiverLastName;
    private $m_sreceiverEmailadress;

    private $m_sMessage;
    private $m_sBegroeting;
    private $m_sTaal;

    private $m_sCard;

    public function __set($p_sProperty, $p_vValue)
    {
        switch ($p_sProperty) {
            case "senderFirstname":
                $this->m_ssenderFirstname = $p_vValue;
                break;

            case "senderLastname":
                $this->m_ssenderLastName = $p_vValue;
                break;

            case "senderEmailadress":
                $this->m_ssenderEmailadress = $p_vValue;
                break;

            case "receiverFirstname":
                $this->m_sreceiverFirstname = $p_vValue;
                break;

            case "receiverLastname":
                $this->m_sreceiverLastName = $p_vValue;
                break;

            case "receiverEmailadress":
                $this->m_sreceiverEmailadress = $p_vValue;
                break;

            case "message":
                $this->m_sMessage = $p_vValue;
                break;

            case "begroeting":
                $this->m_sBegroeting = $p_vValue;
                break;

            case "taal":
                $this->m_sTaal = $p_vValue;
                break;

            case "card":
                $this->m_sCard = $p_vValue;
                break;
        }
    }

    public function __get($p_sProperty)
    {
        switch ($p_sProperty) {
            case "senderFirstname":
                return $this->m_ssenderFirstname;
                break;

            case "senderLastname":
                return $this->m_ssenderLastName;
                break;

            case "senderEmailadress":
                return $this->m_ssenderEmailadress;
                break;

            case "receiverFirstname":
                return $this->m_sreceiverFirstname;
                break;

            case "receiverLastname":
                return $this->m_sreceiverLastName;
                break;

            case "receiverEmailadress":
                return $this->m_sreceiverEmailadress;
                break;

            case "message":
                return $this->m_sMessage;
                break;

            case "begroeting":
                return $this->m_sBegroeting;
                break;

            case "taal":
                return $this->m_sTaal;
                break;

            case "card":
                return $this->m_sCard;
                break;
        }
    }

    public function GetCardsAnimated()
    {
        $conn = Db::getInstance();

        $statement = $conn->prepare("SELECT * FROM card WHERE card_type='animated'");
        $statement->execute();
        $res = $statement->fetchAll();

        return $res;
    }

    public function GetCardsStatic()
    {
        $conn = Db::getInstance();

        $statement = $conn->prepare("SELECT * FROM card WHERE card_type='static'");
        $statement->execute();
        $res = $statement->fetchAll();

        return $res;
    }

    public function GetMatchingYoutubeCard()
    {
        $conn = Db::getInstance();

        $statement = $conn->prepare("SELECT card_youtube FROM card WHERE card_id=:cardid");
        $statement->bindValue(':cardid', $_SESSION['cardID']);
        $statement->execute();
        $res = $statement->fetchAll();

        return $res;
    }

    public function SaveSenders()
    {
        $conn = Db::getInstance();

        $statement = $conn->prepare("INSERT INTO sender (sender_firstname,sender_lastname,sender_email,sender_message,sender_begroeting,sender_language,sender_timestamp) VALUES (:senderfirstname,:senderlastname,:senderemailadress,:sendermessage,:senderbegroeting,:sendertaal,:sendertimestamp)");
        $statement->bindValue(':senderfirstname', $_SESSION["savesender"]["firstname"]);
        $statement->bindValue(':senderlastname', $_SESSION["savesender"]["lastname"]);
        $statement->bindValue(':senderemailadress', $_SESSION["savesender"]["email"]);
        $statement->bindValue(':sendermessage', $_SESSION["savesender"]["message"]);
        $statement->bindValue(':senderbegroeting', $_SESSION["savesender"]["begroeting"]);
        $statement->bindValue(':sendertaal', $_SESSION["savesender"]["taal"]);
        $statement->bindValue(':sendertimestamp', time());

        $statement->execute();

        //$_SESSION['blabla'] = $statement->fetch();

        $statement2 = $conn->prepare("SELECT sender_id FROM sender order by sender_id desc limit 1");
        $statement2->execute();
        $res2 = $statement2->fetch();
        $_SESSION['senderid'] = $res2['sender_id'];

        return $_SESSION['senderid'];
    }

    public function SaveReceivers()
    {
        $conn = Db::getInstance();

        $statement = $conn->prepare("INSERT INTO receiver (receiver_firstname, receiver_lastname, receiver_email, sender_id, receiver_viewed) VALUES (:receiverFirstname,:receiverLastname,:receiverEmailadress,:senderid,:receiverviewed)");
        $statement->bindValue(':receiverFirstname', $_SESSION["savereceiver"]["firstname"]);
        $statement->bindValue(':receiverLastname', $_SESSION["savereceiver"]["lastname"]);
        $statement->bindValue(':receiverEmailadress', $_SESSION["savereceiver"]["email"]);
        $statement->bindValue(':senderid', $_SESSION['savereceiver']['senderid']);
        $statement->bindValue(':receiverviewed', 0);
        $statement->execute();

        //$statement->fetch();

        $statement2 = $conn->prepare("SELECT receiver_id FROM receiver order by receiver_id desc limit 1");
        $statement2->execute();
        $res2 = $statement2->fetch();
        $lastEntryID = $res2['receiver_id'];

        return $lastEntryID;

    }


    public function SendCard($cardID, $senderID, $receiverID)
    {
        $paramUrl = "cid=" . $cardID . "&sid=" . $senderID . "&rid=" . $receiverID;
        $url = "http://ecard.thomasmore.be/card.php?" . urlencode($paramUrl);
        $_SESSION['url']['url'] = $url;

        $language = $_SESSION['taal'];

        require_once('class.phpmailer.php');
        $mail = new PHPMailer();
        $mail->IsSMTP();

        $mail->SMTPAuth = false;
        $mail->Host = "10.151.11.101";
        $mail->Port = 25;

        if ($language == "fr") { // Frans
            $opmaakLogo = "height: 50px; width: 126px;";
            $begroeting = "Bonjour";
            $tekst = '<h1 style="font-family: Arial, Helvetica, sans-serif; font-size: 16px; color: #383b3a; font-weight: normal;">Vous avez re&ccedil;u une carte de v&oelig;ux virtuelle de <span style="font-weight:normal;">' . $_SERVER['REDIRECT_Shib_Person_givenName'] . ' ' . $_SERVER['REDIRECT_Shib_Person_surname'] . '.</span></h1>
							  <h1 style="font-family: Arial, Helvetica, sans-serif; font-size: 16px; color: #383b3a; font-weight: normal;"><a style="font-family: Arial, Helvetica, sans-serif; font-size: 16px; color: white; font-weight: normal; padding:16px; display:inline-block; text-decoration:none; margin-top:8px; background-color:#f24f11;" target="_blank" href="' . $url . '">Veuillez cliquer ici pour découvrir la carte.</a> </h1>';
            $footer = '<span style="color: #999; font-size: 10px;">&copy; <a style="color:#999999; text-decoration:none; text-decoration:underline;" target="_blank" href="http://www.thomasmore.be/">Thomas More</a> | R&egrave;alis&egrave; par <a style="color:#999999; text-decoration:none; text-decoration:underline;" target="_blank" href="http://designosource.be/">Designosource</a> - Etudiants en <a style="color:#999999; text-decoration:none; text-decoration:underline;" target="_blank" href="http://weareimd.be/">Interactive Multimedia Design</a></span>';
            $logo = "http://ecard.thomasmore.be/img/TM_logo_mail_international.png";
        } else if ($language == "en") { // Engels
            $opmaakLogo = "height: 50px; width: 224px;";
            $begroeting = "Dear";
            $tekst = '<h1 style="font-family: Arial, Helvetica, sans-serif; font-size: 16px; color: #383b3a; font-weight: normal;"><span style="font-weight:normal;">' . $_SESSION["savesender"]["firstname"] . ' ' . $_SERVER['REDIRECT_Shib_Person_surname'] . '</span> has sent you a card  with Season\'s Greetings.</h1>
							  <h1 style="font-family: Arial, Helvetica, sans-serif; font-size: 16px; color: #383b3a; font-weight: normal;"><a style="font-family: Arial, Helvetica, sans-serif; font-size: 16px; color: white; font-weight: normal; padding:16px; display:inline-block; text-decoration:none; margin-top:8px; background-color:#f24f11;" target="_blank" href="' . $url . '">Click here to read the card!</a></h1>';
            $footer = '<span style="color: #999; font-size: 10px;">&copy; <a style="color:#999999; text-decoration:none; text-decoration:underline;" target="_blank" href="http://www.thomasmore.be/">Thomas More</a> | Developed by <a style="color:#999999; text-decoration:none; text-decoration:underline;" target="_blank" href="http://designosource.be/">Designosource</a> - Students in <a style="color:#999999; text-decoration:none; text-decoration:underline;" target="_blank" href="http://weareimd.be/">Interactive Multimedia Design</a></span>';
            $logo = "http://ecard.thomasmore.be/img/TM_logo_mail_international.png";
        } else { // Nederlands
            $opmaakLogo = "height: 50px; width: 224px;";
            $begroeting = "Beste";
            $tekst = '<h1 style="font-family: Arial, Helvetica, sans-serif; font-size: 16px; color: #383b3a; font-weight: normal;">Je kreeg een kerstkaart van <span style="font-weight:normal;">' . $_SERVER['REDIRECT_Shib_Person_givenName'] . ' ' . $_SERVER['REDIRECT_Shib_Person_surname'] . '.</span></h1>
							  <h1 style="font-family: Arial, Helvetica, sans-serif; font-size: 16px; color: #383b3a; font-weight: normal;"><a style="font-family: Arial, Helvetica, sans-serif; padding:16px; display:inline-block; text-decoration:none; margin-top:8px; font-size: 16px; color: white; font-weight: normal; background-color:#f24f11;" target="_blank" href="' . $url . '">Klik hier om de kaart te lezen!</a></h1>';
            $footer = '<span style="color: #999; font-size: 10px;">&copy; <a style="color:#999999; text-decoration:none; text-decoration:underline;" target="_blank" href="http://www.thomasmore.be/">Thomas More</a> | Ontwikkeld door <a style="color:#999999; text-decoration:none; text-decoration:underline;" target="_blank" href="http://designosource.be/">Designosource</a> - Studenten <a style="color:#999999; text-decoration:none; text-decoration:underline;" target="_blank" href="http://weareimd.be/">Interactive Multimedia Design</a></span>';
            $logo = "http://ecard.thomasmore.be/img/TM_logo_mail.png";
        }

        $emailbody = '<html><body>
						        <table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" id="bodyTable" style="border-collapse: collapse; background-color: #F3F3F3; font-family: font-family: Arial, Helvetica, sans-serif;">
						            <tr>
						                <td align="center" valign="top">
						                    <table border="0" cellpadding="20" cellspacing="0" width="553" id="emailContainer" style="position:relative; padding-bottom:25px;">
						                        <tr>
						                            <td align="center" valign="top">

												  		<table class="container" id="info" style="width: 100%; background-color: #FAFAFA; border-radius: 5px; height: 75px;">

												  			<tbody style="width:100%;">
												  				<tr>
												  					<td>
												  							<table style="padding-top: 30px; padding-right: 30px; padding-bottom: 25px; padding-left: 30px; width:100%;">
												  								<tbody>
												  									<tr>
												  										<td style="width:45%;">
												  											<img alt="" style="'. $opmaakLogo . '" src="'. $logo .'"/>
												  										</td>
												  									</tr>
												  								</tbody>
												  							</table>
												  					</td>
												  				</tr>
												  			</tbody>

												  			<tbody style="background-color:#fff; width:100%;">
												  				<tr>
												  					<td>
												  							<table style="padding-right: 30px; padding-left: 30px; width:100%;">
												  								<tbody>
												  									<tr>
												  										<td class="contentSec" style="text-align: left; padding-top: 50px; padding-bottom: 10px; width: 100%; position:relative;">
												  											<h1 style="font-family: Arial, Helvetica, sans-serif; font-size: 16px; color: #383b3a; font-weight: normal;">' . $begroeting . ' <span style="font-weight:normal;">' . $_SESSION["savereceiver"]["firstname"] . '</span></h1>
												  										</td>
												  									</tr>
												  								</tbody>
												  							</table>

												  							<table style="padding-right: 30px; padding-left: 30px; width:100%; padding-bottom:30px;">
												  								<tbody>
												  									<tr>
												  										<td class="contentSec" style="text-align: left; padding-top: 0px; padding-bottom: 0px; width: 100%; position:relative;">' . $tekst . '</td>
												  									</tr>
												  								</tbody>
												  							</table>
												  					</td>
												  				</tr>
												  			</tbody>

												  			<tbody style="margin-top:50px; background-color:#FAFAFA; width:100%;">
													  				<tr>
													  					<td>
													  							<table style="padding-right: 25px; padding-left: 25px; width:100%;">
													  								<tbody>
													  									<tr>
													  										<td class="contentSec" style="text-align: left; padding-top: 5px; padding-bottom: 5px; width: 100%;">' . $footer . '</td>
													  									</tr>
													  								</tbody>
													  							</table>
													  					</td>
													  				</tr>
													  		</tbody>

												  		</table>
						                            </td>
						                        </tr>
						                    </table>
						                </td>
						            </tr>
						        </table>
						</body></html>';


        $mail->SetFrom($_SESSION["savesender"]["email"], $_SESSION["savesender"]["firstname"] . " " . $_SESSION["savesender"]["lastname"]);
        $mail->Subject = "Expect more ... wishes!";
        $mail->MsgHTML($emailbody);
        $mail->AddAddress($_SESSION["savereceiver"]["email"], $_SESSION["savereceiver"]["firstname"] . " " . $_SESSION["savereceiver"]["lastname"]);

        $_SESSION['url']['first'] = "first";
        if ($mail->Send()) {
            echo "Message sent! ";
            //echo $destination . " " . $mail->Subject;
            $_SESSION['url']['second'] = "second";
        } else {
            echo "Mailer Error: " . $mail->ErrorInfo;
            $_SESSION['url']['thirth'] = "thirth";
        }
    }

    public function GetCardSent($id)
    {
        $conn = Db::getInstance();

        $statement = $conn->prepare("SELECT * FROM card WHERE card_id=:id");
        $statement->bindValue(':id', $id);
        $statement->execute();
        $res = $statement->fetchAll();

        return $res;
    }

    public function GetSenderSent($id)
    {
        $conn = Db::getInstance();

        $statement = $conn->prepare("SELECT * FROM sender WHERE sender_id=:id");
        $statement->bindValue(':id', $id);
        $statement->execute();
        $res = $statement->fetchAll();

        return $res;
    }

    public function GetReceiverSent($id)
    {
        $conn = Db::getInstance();

        $statement = $conn->prepare("SELECT * FROM receiver WHERE receiver_id=:id");
        $statement->bindValue(':id', $id);
        $statement->execute();
        $res = $statement->fetchAll();

        return $res;
    }
}

?>
