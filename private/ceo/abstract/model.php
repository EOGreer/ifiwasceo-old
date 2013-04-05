<?php
	abstract class CEO_Abstract_Model extends Robin_Model
	{
		
		public function __construct()
		{
			parent::__construct(Database::$hostname, Database::$username, Database::$password, Database::$database);
		}
		
	}