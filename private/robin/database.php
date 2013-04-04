<?php
	/**
	 *	Robin Database.
	 *	Simple database class to run queries.
	 */
	class Robin_Database
	{
		
		protected $mysqli;
		
		public function __construct($host, $user, $pass, $db)
		{
			$this->$mysqli = new mysqli($host, $user, $pass, $db);
		}
		
		public function escape($input)
		{
			if (true === is_array($input)) {
				foreach($input as $name => $value) {
					$input[$this->mysqli->escape_string($name)] = $this->escape($value);
				}
			}
			else {
				$input = $this->mysqli->escape_string($input);
			}
			return $input;
		}
		
		/**
		 *	Awesome query function, that also automatically runs "sprintf" on the SQL statement
		 *	if you provide more arguments than this function wants.
		 */
		public function query($type, $sql)
		{
			if (func_num_args() > 2) {
				$clean = function($a) {
					for($i=1; $i<func_num_args(); $i++) $a[$i] = $this->escape($a[$i]);
				};
				$vars = $clean(func_get_args());
				$sql = call_user_func_array('sprintf', $vars);
			}
			//echo '<pre>$sql '.print_r($sql, true).'</pre>';
			switch($type) {
				
				case Database::SELECT:
					$result = $this->mysqli->query($sql);
					if (false === $result) return array();
					elseif ($result->num_rows == 0) return array();
					$results = array();
					while ($row = $result->fetch_assoc()) $results[] = $row;
					return $results;
				break;
				
				case Database::INSERT:
					$result = $this->mysqli->query($sql);
					if (false === $result) {
						return false;
					}
					return $this->mysqli->insert_id;
				break;
				
				case Database::DELETE:
				case Database::UPDATE:
					$this->mysqli->query($sql) or die("Could not successfully run query ($sql) from DB: " . mysql_error());
				break;
				
			}
			return true;
		}
		
	}