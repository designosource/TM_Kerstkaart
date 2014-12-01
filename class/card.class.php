<?php 
	include_once('db.class.php');

	Class Card
	{
		private $m_sFirstname;
		private $m_sLastName;
		private $m_sEmailadress;

		private $m_sMessage;

		private $m_sCard;
		
		public function __set($p_sProperty, $p_vValue)
		{
			switch($p_sProperty)
			{
				case "firstname":
				$this->m_sFirstname = $p_vValue;
				break;

				case "lastname":
				$this->m_sLastName = $p_vValue;
				break;

				case "emailadress":
				$this->m_sEmailadress = $p_vValue;
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
				case "firstname":
				return $this->m_sFirstname;
				break;

				case "lastname":
				return $this->m_sLastName;
				break;

				case "emailadress":
				return $this->m_sEmailadress;
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
	}
 ?>