<?php 
	include_once('db.class.php');
	require_once('class.phpmailer.php');

	Class Card
	{
		private $m_ssenderFirstname;
		private $m_ssenderLastName;
		private $m_ssenderEmailadress;

		private $m_sreceiverFirstname;
		private $m_sreceiverLastName;
		private $m_sreceiverEmailadress;

		private $m_sMessage;

		private $m_sCard;
		
		public function __set($p_sProperty, $p_vValue)
		{
			switch($p_sProperty)
			{
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

				case "card":
				$this->m_sCard = $p_vValue;
				break;
			}
		}

		public function __get($p_sProperty)
		{
			switch($p_sProperty)
			{
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

			if($result)
			{
				$rows = array();
				while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) 
				{
				    $rows[] = $row;
				}
				return $rows;
				
			}
		}

		public function SaveReceivers()
		{
			$db = new Db();
			
			$sql = "INSERT INTO receiver (receiver_firstname, receiver_lastname, receiver_email)
				   values (
				   			'". $db->conn->real_escape_string($this->m_sreceiverFirstname)."',
				   			'". $db->conn->real_escape_string($this->m_sreceiverLastName)."',
				   			'". $db->conn->real_escape_string($this->m_sreceiverEmailadress)."'
				   		  )";

			$result = $db->conn->query($sql);

			if($result)
			{
				$sql2 = "SELECT LAST_INSERT_ID() FROM receiver order by receiver_id desc limit 1";
				$result2 = $db->conn->query($sql2);

				if($result2)
				{
					$results = mysqli_fetch_array($result2, MYSQL_ASSOC);

					$lastEntryID = $results['LAST_INSERT_ID()'];

					return $lastEntryID;
				}
			}
		}

		public function SaveSenders()
		{
			$db = new Db();
			
			$sql = "INSERT INTO sender (sender_firstname, sender_lastname, sender_email, sender_message)
				   values (
				   			'". $db->conn->real_escape_string($this->m_ssenderFirstname)."',
				   			'". $db->conn->real_escape_string($this->m_ssenderLastName)."',
				   			'". $db->conn->real_escape_string($this->m_ssenderEmailadress)."',
				   			'". $db->conn->real_escape_string($this->m_sMessage)."'
				   		  )";

			$result = $db->conn->query($sql);

			if($result)
			{
				$sql2 = "SELECT LAST_INSERT_ID() FROM sender order by sender_id desc limit 1";
				$result2 = $db->conn->query($sql2);

				if($result2)
				{
					$results = mysqli_fetch_array($result2, MYSQL_ASSOC);

					$lastEntryID = $results['LAST_INSERT_ID()'];

					return $lastEntryID;
				}
			}
		}

		public function SendCard($cardID, $senderID, $receiverID)
		{
			/*$cardLink = "http://ecard.thomasmore.be/card.php?cid=".$cardID."&sid=".$senderID."&ric=".$receiverID;
			echo $this->m_sreceiverEmailadress;
			echo $cardLink;*/

			//localhost/card.php?cid=2&sid=7&ric=36
			//http://localhost/TM_Kerstkaarten/TM_Kerstkaart/card.php?cid=2&sid=7&ric=36
			//http://ecard.thomasmore.be/card.php?cid=2&sid=6&ric=40


			/*$to = $this->m_sreceiverEmailadress;
			$subject = "Je hebt een kerstkaart ontvangen van ".$this->m_ssenderFirstname." ".$this->m_ssenderLastName;
			$header = "From: Thomas More <info@thomasmore.be>\r\n";
			$header .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
			$header .= "MIME-Version: 1.0\r\n";
			$header .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

			$message = '<html><body>';
			$message .= '<table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" id="bodyTable" style="background-repeat: no-repeat; background-size: cover; border-collapse: collapse; background-color: #ef403e; background-attachment: fixed; background-position: top center; width: 100%;">
					            <tr>
					                <td align="center" valign="top">
					                    <table>
					                    	<a href="'.$cardLink.'">Bekijk je kerstkaart</a>
					                    </table>
					                </td>
					            </tr>
					        </table>';
			$message .= '</body></html>';
					
			$confirmMail = mail($to, $subject, $message, $header);*/




			$mail = new PHPMailer();

			//$mail->IsSMTP();                                      // set mailer to use SMTP
			$mail->IsSendmail();

			$mail->SMTPAuth = false;
			$mail->Host = "10.151.11.101";

			$mail->From = "r0364401@student.thomasmore.be";
			$mail->FromName = "Kristof";
			$mail->AddAddress("r0364401@student.thomasmore.be", "Kristof Van Espen");

			$mail->WordWrap = 50;                                 // set word wrap to 50 characters
			$mail->IsHTML(true);                                  // set email format to HTML

			$mail->Subject = "Here is the subject";
			$mail->Body    = "This is the HTML message body <b>in bold!</b>";
			$mail->AltBody = "This is the body in plain text for non-HTML mail clients";

			if($mail->Send())
			{
			    echo json_encode(array(
			        "error" => false,
			        "message"=> "You have successfully sent"
			    ));
			} 
			else 
			{
			    echo json_encode(array(
			        "error" => true,
			        "message"=> $mail->ErrorInfo
			    ));

			};
		}

		public function GetCardSent($id)
		{
			$db = new Db();

			$sql = "SELECT * FROM card WHERE card_id=$id";

			$result = $db->conn->query($sql);

			if($result)
			{
				$results = mysqli_fetch_array($result, MYSQL_ASSOC);

				return $results;
			}
		}

		public function GetSenderSent($id)
		{
			$db = new Db();

			$sql = "SELECT * FROM sender WHERE sender_id=$id";

			$result = $db->conn->query($sql);

			if($result)
			{
				$results = mysqli_fetch_array($result, MYSQL_ASSOC);

				return $results;
			}
		}

		public function GetReceiverSent($id)
		{
			$db = new Db();

			$sql = "SELECT * FROM receiver WHERE receiver_id=$id";

			$result = $db->conn->query($sql);

			if($result)
			{
				$results = mysqli_fetch_array($result, MYSQL_ASSOC);

				return $results;
			}
		}

	}
 ?>