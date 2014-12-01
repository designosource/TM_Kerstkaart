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

		public function SavePersonalMessage()
		{
			$db = new Db();
			
			$sql = "INSERT INTO personaltext (personaltext_message)
				   values ('". $db->conn->real_escape_string($this->m_sMessage)."')";

			$result = $db->conn->query($sql);

			if($result)
			{
				$sql2 = "SELECT LAST_INSERT_ID() FROM personaltext order by personaltext_id desc limit 1";
				$result2 = $db->conn->query($sql2);

				if($result2)
				{
					$results = mysqli_fetch_array($result2, MYSQL_ASSOC);

					$lastEntryID = $results['LAST_INSERT_ID()'];

					return $lastEntryID;
				}
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
	}
 ?>