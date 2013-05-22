<?php
	
	include_once("classes/User.php");

	class klassement
	{
		private $m_sName;
		private $m_iPunt;
		private $m_sEmail;

		public function __get($p_sProperty)
		{
			switch($p_sProperty)
			{
				case "Name":
				return $this->m_sName;
				break;

				case "Punt":
				return $this->m_sPassword;
				break;

				case "Email":
				return $this->m_sEmail;
				break;

				default:
				throw new Exception("CANNOT GET " . $p_sProperty);
			}
		}
		public function GetAll()
		{
			$db = Db::getInstance();
			$cols = array("*");
			$result = $db->select($cols, "login", null, "name","punt", "DESC");
			return($result);
		}

		/*public function __set($p_sProperty, $p_vValue)
		{	
			switch($p_sProperty)
			{
				case "Name":
				$this->m_sName = mysql_real_escape_string($p_vValue);
				break;

				case "Password":

					$salt = "verzint iets ! 3023032KF. . D";
					$this->m_sPassword = md5($p_vValue.$salt);

				break;

				case "Email":
				$this->m_sEmail = mysql_real_escape_string($p_vValue);
				break;

				default:
				throw new Exception("CANNOT SET " . $p_sProperty);
			}
		}

		public function Register()
		{
			try
			{
				$db = new db('localhost', 'root', 'root', 'project');
				$db->insert("login (name, email, password)", "'$this->Name','$this->Email', '$this->Password'");
				
			}
			catch(Exception $e)
			{
				echo $e->Message;
			}
		}

		public function CanLogin()
		{
			try
			{
				$db = new db('localhost', 'root', 'root', 'project');

				$res = $db->Select("name", "login","email = '$this->Email' and password = '$this->Password'");

				if($res->num_rows == 1)
				{
					$obj = $res->fetch_object();
					$this->Name = $obj->name;
					return true;
					
				}else
				{
					return false;
				}
			}
			catch(Exception $e)
			{
				echo $e->Message;
			}
		}*/

	}	

?>