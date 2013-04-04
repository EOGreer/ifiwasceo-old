<?php
	/**
	 *	The base Robin model.
	 */
	abstract class Robin_Model
	{
		
		public function __construct($db_host, $db_user, $db_pass, $db_db)
		{
			$this->db = new Robin_Database($db_host, $db_user, $db_pass, $db_db);
		}
		
	}