<?php
	/**
	 *	Model
	 *	All models extend this.
	 */
	abstract class Model extends Robin_Model
	{
		
		public function __construct()
		{
			parent::__construct(Database::$hostname, Database::$username, Database::$password, Database::$database);
		}
		
		public abstract function get();
		
	}