<?php
	/*
	* class db
	* @param Host
	* @param User 
	* @param Password
	* @param Name*/
	
	class db
	{
		
		var $host;       //MySQL Host
		var $user;       //MySQL User
		var $pass;       //MySQL Password
		var $name;       //MySQL Name
		
		var $mysqli;     //MySQLi Object

	        var $last_query; //Last Query Run
		
		/*
		 * Class Constructor
		 * Creates a new MySQLi Object*/
		 
		function __construct($host, $user, $pass, $name)
		{
			
			$this->host = $host;
			$this->user = $user;
			$this->pass = $pass;
			$this->name = $name;
		
			$this->mysqli = new mysqli($this->host, $this->user, $this->pass, $this->name);
		
		}
		
	

	/* Function Select
	 * @param fields
	 * @param from
	 * @param where
	 * @returns Query Result Set*/
	 
	function select($fields, $from, $where)
	{
		
		$query = "SELECT " . $fields . " FROM `" . $from . "` WHERE " . $where;
		$result = $this->mysqli->query($query);

                $this->last_query = $query;
		
		return $result;
		
	}

	/*
	 * Function Insert
	 * @param into
	 * @param values
	 * @returns boolean*/
	 
	function insert($into, $values)
	{
		
		$query = "INSERT INTO " . $into . " VALUES(" . $values . ")";
	        $this->last_query = $query;

		if($this->mysqli->query($query))
		{
			return true;
		} else {
			return false;
		}
		
	}

	/*
	 * Function Delete
	 * @param from
	 * @param where
	 * @returns boolean*/
	 
	function delete($from, $where)
	{
		
		$query = "DELETE FROM " . $from . " WHERE " . $where;

	        $this->last_query = $query;

		if($this->mysqli->query($query))
		{
			return true;
		} else {
			return false;
		}
		
		
	}
}
?>