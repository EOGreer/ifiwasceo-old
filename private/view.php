<?php
	class View
	{
		
		protected static $master = 'master';
		
		public static function get($view)
		{
			return new View($view);
		}
		
		public static function getMaster()
		{
			return new View(self::$master);
		}
		
		public static function setMaster($master)
		{
			self::$master = $master;
		}
		
		protected $file;
		protected $params;
		
		protected function __construct($file)
		{
			$this->file = "../private/view/$file.php";
			$this->params = array();
		}
		
		public function __get($key)
		{
			if (false === empty($this->params[$key])) {
				return $this->params[$key];
			}
			return null;
		}
		
		public function __set($key,$value)
		{
			$this->params[$key] = $value;
		}
		
		public function render()
		{
			extract($this->params);
			require($this->file);
		}
		
	}