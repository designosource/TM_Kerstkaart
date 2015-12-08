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

    public function GetCards()
    {
        $db = new Db();

        $sql = "SELECT * FROM card";

        $result = $db->conn->query($sql);

        if ($result) {
            $rows = array();
            while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
                $rows[] = $row;
            }
            return $rows;

        }
    }

    public function SaveSenders()
    {
        $db = new Db();

        $sql = "INSERT INTO sender (sender_firstname, sender_lastname, sender_email, sender_message, sender_begroeting, sender_language)
				   values (
				   			'" . $db->conn->real_escape_string($this->m_ssenderFirstname) . "',
				   			'" . $db->conn->real_escape_string($this->m_ssenderLastName) . "',
				   			'" . $db->conn->real_escape_string($this->m_ssenderEmailadress) . "',
				   			'" . $db->conn->real_escape_string($this->m_sMessage) . "',
				   			'" . $db->conn->real_escape_string($this->m_sBegroeting) . "',
				   			'" . $db->conn->real_escape_string($this->m_sTaal) . "'
				   		  )";

        $result = $db->conn->query($sql);

        if ($result) {
            $sql2 = "SELECT LAST_INSERT_ID() FROM sender order by sender_id desc limit 1";
            $result2 = $db->conn->query($sql2);

            if ($result2) {
                $results = mysqli_fetch_array($result2, MYSQL_ASSOC);

                $lastEntryID = $results['LAST_INSERT_ID()'];

                return $lastEntryID;
            }
        }
    }

    public function SaveReceivers($senderID)
    {
        $db = new Db();

        $sql = "INSERT INTO receiver (receiver_firstname, receiver_lastname, receiver_email, sender_id)
				   values (
				   			'" . $db->conn->real_escape_string($this->m_sreceiverFirstname) . "',
				   			'" . $db->conn->real_escape_string($this->m_sreceiverLastName) . "',
				   			'" . $db->conn->real_escape_string($this->m_sreceiverEmailadress) . "',
				   			'" . $db->conn->real_escape_string($senderID) . "'
				   		  )";

        $result = $db->conn->query($sql);

        if ($result) {
            $sql2 = "SELECT LAST_INSERT_ID() FROM receiver order by receiver_id desc limit 1";
            $result2 = $db->conn->query($sql2);

            if ($result2) {
                $results = mysqli_fetch_array($result2, MYSQL_ASSOC);

                $lastEntryID = $results['LAST_INSERT_ID()'];

                return $lastEntryID;
            }
        }
    }


    public function SendCard($cardID, $senderID, $receiverID)
    {
        //$cardLink = "http://ecard.thomasmore.be/card.php?cid=".$cardID."&sid=".$senderID."&ric=".$receiverID;
        $paramUrl = "cid=" . $cardID . "&sid=" . $senderID . "&rid=" . $receiverID;
        $url = "http://ecard.thomasmore.be/card.php?" . urlencode($paramUrl);

        require_once('class.phpmailer.php');
        $mail = new PHPMailer();
        $mail->IsSMTP();

        $mail->SMTPAuth = false;
        $mail->Host = "10.151.11.101";
        $mail->Port = 25;

        $taal_begroeting = "";
        $taal_tekst = '';
        $mail_footer = '';


        if ($_SESSION["taal"] == "fr") {
            $taal_begroeting = "Bonjour";
            $taal_tekst = '<h1 style="font-family: Arial, Helvetica, sans-serif; font-size: 16px; color: #383b3a; font-weight: normal;">Vous avez re&ccedil;u une carte de v&oelig;ux virtuelle de <span style="font-weight:normal;">' . $this->m_ssenderFirstname . ' ' . $this->m_ssenderLastName . '.</span></h1>
							  <h1 style="font-family: Arial, Helvetica, sans-serif; font-size: 16px; color: #383b3a; font-weight: normal;">Veuillez cliquer <a style="font-family: Arial, Helvetica, sans-serif; font-size: 16px; color: #383b3a; font-weight: normal; color:#f24f11;" href="' . $url . '">ici</a> pour d&egrave;couvrir la carte.</h1>';
            $mail_footer = '<span style="color: #999; font-size: 10px;">&copy; <a style="color:#999999; text-decoration:none; text-decoration:underline;" href="http://www.thomasmore.be/">Thomas More</a> | R&egrave;alis&egrave; par <a style="color:#999999; text-decoration:none; text-decoration:underline;" href="http://designosource.be/">Designosource</a> - Etudiants en <a style="color:#999999; text-decoration:none; text-decoration:underline;" href="http://weareimd.be/">Interactive Multimedia Design</a></span>';
        } else if ($_SESSION["taal"] == "en") {
            $taal_begroeting = "Dear";
            $taal_tekst = '<h1 style="font-family: Arial, Helvetica, sans-serif; font-size: 16px; color: #383b3a; font-weight: normal;"><span style="font-weight:normal;">' . $this->m_ssenderFirstname . ' ' . $this->m_ssenderLastName . '</span> has sent you a card  with Season\'s Greetings.</h1>
							  <h1 style="font-family: Arial, Helvetica, sans-serif; font-size: 16px; color: #383b3a; font-weight: normal;">Click <a style="font-family: Arial, Helvetica, sans-serif; font-size: 16px; color: #383b3a; font-weight: normal; color:#f24f11;" href="' . $url . '">here</a> to read the card!</h1>';
            $mail_footer = '<span style="color: #999; font-size: 10px;">&copy; <a style="color:#999999; text-decoration:none; text-decoration:underline;" href="http://www.thomasmore.be/">Thomas More</a> | Developed by <a style="color:#999999; text-decoration:none; text-decoration:underline;" href="http://designosource.be/">Designosource</a> - Students in <a style="color:#999999; text-decoration:none; text-decoration:underline;" href="http://weareimd.be/">Interactive Multimedia Design</a></span>';
        } else {
            $taal_begroeting = "Beste";
            $taal_tekst = '<h1 style="font-family: Arial, Helvetica, sans-serif; font-size: 16px; color: #383b3a; font-weight: normal;">Je kreeg een kerstkaart van <span style="font-weight:normal;">' . $this->m_ssenderFirstname . ' ' . $this->m_ssenderLastName . '.</span></h1>
							  <h1 style="font-family: Arial, Helvetica, sans-serif; font-size: 16px; color: #383b3a; font-weight: normal;">Klik <a style="font-family: Arial, Helvetica, sans-serif; font-size: 16px; color: #383b3a; font-weight: normal; color:#f24f11;" href="' . $url . '">hier</a> om de kaart te lezen!</h1>';
            $mail_footer = '<span style="color: #999; font-size: 10px;">&copy; <a style="color:#999999; text-decoration:none; text-decoration:underline;" href="http://www.thomasmore.be/">Thomas More</a> | Developed by <a style="color:#999999; text-decoration:none; text-decoration:underline;" href="http://designosource.be/">Designosource</a> - Students in <a style="color:#999999; text-decoration:none; text-decoration:underline;" href="http://weareimd.be/">Interactive Multimedia Design</a></span>';
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
												  											<img alt="" style="width:125px; height:50px;" src="http://ecard.thomasmore.be/img/TM_logo_mail.png"></img>
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
												  											<h1 style="font-family: Arial, Helvetica, sans-serif; font-size: 16px; color: #383b3a; font-weight: normal;">' . $taal_begroeting . '
												  											<span style="font-weight:normal;">' . $this->m_sreceiverFirstname . '</span></h1>
												  										</td>
												  									</tr>
												  								</tbody>
												  							</table>

												  							<table style="padding-right: 30px; padding-left: 30px; width:100%; padding-bottom:30px;">
												  								<tbody>
												  									<tr>
												  										<td class="contentSec" style="text-align: left; padding-top: 0px; padding-bottom: 0px; width: 100%; position:relative;">
												  											' . $taal_tekst . '
												  											<!--<h1 style="font-family: Arial, Helvetica, sans-serif; font-size: 16px; color: #383b3a; font-weight: normal;">Je kreeg een kerstkaart van <span style="font-weight:normal;">. $this->m_ssenderFirstname .. $this->m_ssenderLastName .</span></h1>
												  											<h1 style="font-family: Arial, Helvetica, sans-serif; font-size: 16px; color: #383b3a; font-weight: normal;">Klik <a style="font-family: Arial, Helvetica, sans-serif; font-size: 16px; color: #383b3a; font-weight: normal; color:#f24f11;" href="./*$url*/.">hier</a> om de kaart te lezen!</h1>-->
												  										</td>
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
													  										<td class="contentSec" style="text-align: left; padding-top: 5px; padding-bottom: 5px; width: 100%;">
													  											' . $mail_footer . '
													  											<!--<span style="color: #999; font-size: 10px;">&copy; <a style="color:#999999; text-decoration:none; text-decoration:underline;" href="http://www.thomasmore.be/">Thomas More</a> | Ontwikkeld door <a style="color:#999999; text-decoration:none; text-decoration:underline;" href="http://designosource.be/">Designosource</a> - Studenten van <a style="color:#999999; text-decoration:none; text-decoration:underline;" href="http://weareimd.be/">Interactive Multimedia Design</a></span>-->
													  										</td>
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


        $mail->SetFrom($this->m_ssenderEmailadress, $this->m_ssenderFirstname . " " . $this->m_ssenderLastName);
        $mail->Subject = "Expect more ... wishes!";
        $mail->MsgHTML($emailbody);
        $mail->AddAddress($this->m_sreceiverEmailadress, $this->m_sreceiverFirstname . " " . $this->m_sreceiverLastName);


        if ($mail->Send()) {
            echo "Message sent! ";
            echo $destination . " " . $mail->Subject;
        } else {
            echo "Mailer Error: " . $mail->ErrorInfo;
        }
    }

    public function GetCardSent($id)
    {
        $db = new Db();

        $sql = "SELECT * FROM card WHERE card_id=$id";

        $result = $db->conn->query($sql);

        if ($result) {
            $results = mysqli_fetch_array($result, MYSQL_ASSOC);

            return $results;
        }
    }

    public function GetSenderSent($id)
    {
        $db = new Db();

        $sql = "SELECT * FROM sender WHERE sender_id=$id";

        $result = $db->conn->query($sql);

        if ($result) {
            $results = mysqli_fetch_array($result, MYSQL_ASSOC);

            return $results;
        }
    }

    public function GetReceiverSent($id)
    {
        $db = new Db();

        $sql = "SELECT * FROM receiver WHERE receiver_id=$id";

        $result = $db->conn->query($sql);

        if ($result) {
            $results = mysqli_fetch_array($result, MYSQL_ASSOC);

            return $results;
        }
    }
}

?>
