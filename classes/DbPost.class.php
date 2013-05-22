

<?php
	
	class Db
	{

		private $m_rConn;
		private static $instance = NULL;

		// SINGLETON PATTERN EXAMPLE: http://phpadvocate.com/blog/2011/04/php-using-a-singleton-pattern-with-oop/
		private function __construct()
		{
			$this->m_rConn = new mysqli("localhost", "root", "root", "project");
		}

		// SINGLETON PATTERN EXAMPLE: http://phpadvocate.com/blog/2011/04/php-using-a-singleton-pattern-with-oop/
		public static function getInstance() {
		    if(!isset(self::$instance)) {
		      self::$instance = new Db();
		    }
		    return self::$instance;
  		}

		public function sanitize($val)
		{
			return $this->m_rConn->real_escape_string($val);
		}

		public function insert($table, $cols, $values)
		{
			$sql = "INSERT INTO $table (";
			$sql_cols = "";

			foreach($cols as $key=>$val)
			{
				if($sql_cols == "")
				{
					$sql_cols .= $val;
				}
				else
				{
					$sql_cols .= ", " . $val;
				}
			}
			$sql.= $sql_cols. ") VALUES (";

			// HANDLE VALUES
			$sql_values = "";
			foreach($values as $key=>$val)
			{
				$val = $this->sanitize($val);

				if($sql_values == "")
				{
					if(!is_int($val) && $val != "NOW()")
						$sql_values .= "'";

					$sql_values .= $val;
				}
				else
				{
					$sql_values .= ", ";

					if(!is_int($val)  && $val != "NOW()")
						$sql_values .= "'";

					$sql_values .= $val;
				}


				if(!is_int($val) && $val != "NOW()")
						$sql_values .= "'";

			}

			$sql.="$sql_values);";
			// echo $sql;
			$this->m_rConn->query($sql);
		}

		public function select($cols, $table, $limit, $orderby, $orderHow)
	    {  
	    	$sql = "SELECT ";
	    	$sql_from = "";

	    	/* HANDLE COLUMNS */
	    	foreach($cols as $key=>$val)
	    	{
	    		if($val == "*")
	    		{
	    			$sql_from = "*";
	    		}
	    		else
	    		{
		    		if($sql_from == "")
		    		{
		    			$sql_from .= "(";
		    			$sql_from .= $val;	
		    		}
		    		else
		    		{
		    			$sql_from .= ", " . $key;
		    		}	    
	    		}		 
	    	}	 

	    	if($sql_from != "*")
	    	{
	    		$sql_from .= ")"; 
			}

			/* HANDLE FROM */
			$sql .= $sql_from;		
			$sql .= " FROM $table";

			/* HANDLE ORDERBY */
			if(!empty($orderby))
			{
				$sql.= " ORDER BY $orderby";
			}

			/* HANDLE ORDERHOW */
			if(!empty($orderHow))
			{
				$sql.= " $orderHow";
			}

			/* HANDLE LIMIT */
			if(!empty($limit))
			{
				$sql.=" LIMIT $limit";
			}
		
			// RETURN THE RESULT AS AN ARRAY FOR EASY LOOPING IN TEMPLATES
	    	$result = $this->m_rConn->query($sql);
	    	$arrRecords = array();
	    	if($result)
	    	{
	    		while($row = $result->fetch_array())
	    		{
	    			// Note: If you use array_push() to add one element to the array it's better to use $array[] = because in that way there is no overhead of calling a function.
	    			// http://php.net/manual/en/function.array-push.php
	    			$arrRecords[] = $row;
	    		}
	    	}

	    	return($arrRecords);

	    }  
	}

?>



