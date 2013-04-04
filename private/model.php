<?php
	/**
	 *	Model
	 *	All models extend this.
	 */
	abstract class Model extends Robin_Model
	{
		
		public function __construct()
		{
			parent::__construct('localhost', 'username', 'password', 'database');
		}
		
		public abstract function get();
		
	}