<?php
	abstract class CEO_Abstract_Entity
	{
		
		/**
		 *	Creates a new entity to interact with! :)
		 *	
		 *	@return CEO_Abstract_Entity
		 */
		public static function create() { return new get_called_class(); }
		
		protected $data;
		protected $entity;
		
		/**
		 *	__call Magic Method
		 *	This catches any undefined methods.
		 *	Means you can interact and use methods like getId(), getName(), setName('James'), etc.
		 *		without having to physically define them!
		 */
		public function __call($name,$args)
		{
			$type = strtolower(substr($name,0,3));
			$var  = strtolower(substr($name,3));
			if (array_key_exists($var, $this->data)) {
				switch($type) {
					
					case 'get':
						return $this->$var;
					break;
					
					case 'has':
						$v = $this->$var;
						return (false === empty($v));
					break;
					
					case 'set':
						$this->$var = $args[0];
						return $this;
					break;
				}
			}
			return null;
		}
		
		/**
		 *	Set the entity's name.
		 */
		public function __construct()
		{
			$this->entity = strtolower(get_called_class());
		}
		
		/**
		 *	Getting "properties" which are really just elements in the $data array.
		 */
		public function __get($key)
		{
			if (false === empty($this->data[strtolower($key)])) return $this->data[strtolower($key)];
			else return null;
		}
		
		/**
		 *	Setting "properties" which are really just elements in the $data array.
		 */
		public function __set($key,$value)
		{
			if (true === array_key_exists(strtolower($key), $this->data)) {
				$this->data[strtolower($key)] = $value;
			}
		}
		
		public function getData() { return $this->data; }
		
	}