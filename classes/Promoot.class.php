<?php
require_once("DbPost.class.php");
class Tweet
{
	// PRIVATE MEMBER VARIABLES
	private $m_sText;
	private $m_iUserId;

	public function __set($p_sProperty, $p_vValue)
	{
		switch($p_sProperty)
		{
			case "Text":
				if(strlen($p_vValue) > 250)
				{
					throw new Exception("A tweet can be no longer than 250 characters.");
				}
				else
				{
					$this->m_sText = $p_vValue;
				}
			break;

			case "UserId":
				$this->m_iUserId = $p_vValue;
			break;

			default: echo "can't find property named " . $p_sProperty;
		}
	}

	public function Save()
	{
		$db = Db::getInstance();
		$table = "promoot";
		$cols = array("text", "fk_user_id", "date_posted");
		$values = array($this->m_sText, $this->m_iUserId, "NOW()");
		$db->insert($table, $cols, $values);
	}

	public function GetAll()
	{
		$db = Db::getInstance();
		$cols = array("*");
		$result = $db->select($cols, "promoot", null, "id", "DESC");
		return($result);
	}
/*  public function Save()
		{
			$db = new Db();
			$email = $_SESSION['user']['email'];
			$idGebruiker = "select * from imdtalks_users where email = '$email';";
			$resultaatId = $db->conn->query($idGebruiker);
			
			$rijId = $resultaatId->fetch_array();
			$id2 = $rijId['imdtalks_usersID'];
			
			$date = date('Y-m-j H:i:s');
			$sql = "insert into imdtalks_tweets (imdtalks_usersID, tweet, date) values('$id2', '".$db->conn->real_escape_string($this->Tweet)."', '$date');";
			$result = $db->conn->query($sql);
		}
		
		public function GetAll()
		{
			$db = new Db();
			$sql = "select imdtalks_users.imdtalks_usersID as userID, imdtalks_tweetsID, name, tweet, date, color from imdtalks_users inner join imdtalks_tweets 
				ON imdtalks_users.imdtalks_usersID = imdtalks_tweets.imdtalks_usersID
				order by imdtalks_tweets.imdtalks_tweetsID desc
				limit 100;";
			$result = $db->conn->query($sql);
			
			$sessie = $_SESSION['user'];
			$email = $sessie['email'];
			$sqlEmail = "select imdtalks_usersID from imdtalks_users where email = '$email';";
			$resultEmail = $db->conn->query($sqlEmail);
			$resultEmail = $resultEmail->fetch_array();
			$resultEmail = $resultEmail[0];
			
			$tweets = "";
									
			if($result->num_rows > 0)
			{
				//echo "Meer dan 1 rij!";
				while($row = $result->fetch_array())
				{
					//echo $row['userID'];
					$tweets .= "<hr /><b style='color: #" . $row['color'] . "'><a href='user.php?id=" . $row['userID'] . "' style='color: #" . $row['color'] . "'>" . htmlspecialchars($row['name']) . "</a></b>";
					$tweets .= " <i class='datum'>- " . $row['date'];
					if($row['userID'] == $resultEmail)
					{
						//echo 'test';
						$tweets .= " <a href='delete.php?id=" . $row['imdtalks_tweetsID'] . "' title='Delete'>Delete tweet</a>";
					}
					$tweets .= "</i><br />";
					$tweets .= htmlspecialchars($row['tweet']) . "<br /><br />";
					//$tweets .= "<a href='delete.php?id=" . $row['imdtalks_tweetsID'] . "' title='Delete'>Delete tweet</a>";
				}

			} else {
				$tweets = "You haven't placed a tweet!";
			}
			
			return $tweets;
			
		} 
	}*/
}
?>