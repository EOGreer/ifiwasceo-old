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
		public static $username = 'iamceo';
		public static $password = 'jcQs2jUqtBCV6z9Y';
		public static $database = 'ifiwasceo';
		
	}