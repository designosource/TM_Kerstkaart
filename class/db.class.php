<?php 
	class Db
	{
		private $m_sHost = "localhost";
		private $m_sUser = "root";
		private $m_sPassword = "";
		private $m_sDatabase = "tmecards";

			public function __construct()
			{
				$this->conn = new mysqli($this->m_sHost, $this->m_sUser, $this->m_sPassword, $this->m_sDatabase);
			}

		/* local
			private $m_sHost = "localhost";
			private $m_sUser = "root";
			private $m_sPassword = "";
			private $m_sDatabase = "tmecards";

				public function __construct()
				{
					$this->conn = new mysqli($this->m_sHost, $this->m_sUser, $this->m_sPassword, $this->m_sDatabase);
				}
		*/

		/* online
			private $m_sHost = "localhost";
			private $m_sUser = " tmecards";
			private $m_sPassword = "bFQ7fnQzCz8VdK2K";
			private $m_sDatabase = " tmecards";

				public function __construct()
				{
					$this->conn = new mysqli($this->m_sHost, $this->m_sUser, $this->m_sPassword, $this->m_sDatabase);
				}
		*/
	}
 ?>