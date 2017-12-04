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
        private $m_sreceiverViewed;

		private $m_sMessage;
		private $m_sTaal;

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

                case "receiverViewed":
                    $this->m_sreceiverViewed = $p_vValue;
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

                case "receiverViewed":
                    return $this->m_sreceiverViewed;
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

		public function GetCardSent($id)
		{
            $conn = Db::getInstance();

            $statement = $conn->prepare("SELECT * FROM card WHERE card_id=:id");
            $statement->bindParam(':id', $id);
            $statement->execute();
            $res = $statement->fetchAll();

            return $res;
		}

		public function GetSenderSent($id)
		{
            $conn = Db::getInstance();

            $statement = $conn->prepare("SELECT * FROM sender WHERE sender_id=:id");
            $statement->bindParam(':id', $id);
            $statement->execute();
            $res = $statement->fetchAll();

            return $res;
		}

		public function GetReceiverSent($id)
		{
            $conn = Db::getInstance();

            $statement = $conn->prepare("SELECT * FROM receiver WHERE receiver_id=:id");
            $statement->bindParam(':id', $id);
            $statement->execute();
            $res = $statement->fetchAll();

            return $res;
		}

		public function setViewed($id)
        {
            $conn = Db::getInstance();

            $statement = $conn->prepare("UPDATE receiver SET receiver_viewed=1 WHERE receiver_id=:id");
            $statement->bindParam(':id', $id);
            return $statement->execute();
        }
	}
 ?>