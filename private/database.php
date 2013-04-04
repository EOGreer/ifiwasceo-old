<?php
	/**
	 *	Nice simple access to database stuff! :)
	 */
	abstract class Database extends Robin_Database
	{
		
		const SELECT = 1;
		const INSERT = 2;
		const UPDATE = 3;
		const DELETE = 4;
		
		public static $hostname = 'localhost';
		public static $username = 'username';
		public static $password = 'password';
		public static $database = 'database';
		
	}