<?php
	/**
	 *	Robin Request
	 *	Handles the incoming request.
	 *	
	 *	Chained as much as possible when setting stuff.
	 */
	class Robin_Request
	{
		
		/* @var Accept-type */
		protected $accept = null;
		
		/* @var Base URL */
		protected $baseurl = null;
		
        /* @var HTTP Method */
        protected $method = null;
        
		/* @var PARAM array */
		protected $param = array();
		
		/* @var Path */
		protected $path = null;
		
		/* @var POST array */
		protected $post = array();
		
		/* @var GET array */
		protected $query = array();
		
		/* @var SERVER array */
		protected $server = array();
		
		/**
		 *	Get or set data!
		 *	
		 *	@param $name The name of the method being called.
		 *	@param $args The arguments of the method being called.
		 *	@return {$this->$name}, {$this}, mixed or null.
		 */
		public function __call($name, $args)
		{
			// method($var, $var2)
			if ((false === empty($args[0])) && (false === empty($args[1])) && (true === is_array($this->{$name}))) {
				$this->{$name}[$args[0]] = $args[1];
				return $this;
			}
			// method(array $var)
			elseif ((false === empty($args[0])) && (true === is_array($args[0]))) {
				$this->{$name} = array_merge($this->{$name}, $args[0]);
				return $this;
			}
			// method($var) where method is array
			elseif ((false === empty($args)) && (false === empty($args[0])) && (true === is_array($this->{$name}))) {
				if (false === empty($this->{$name}[$args[0]])) return $this->{$name}[$args[0]];
				else return null;
			}
			// method($var) where method is non-array.
			elseif (false === empty($args)) {
				$this->{$name} = $args[0];
				return $this;
			}
			// method()
			return $this->{$name};
		}
		
		/**
		 *	Builds the request object.
		 */
		public function __construct()
		{
			$this->baseurl($_SERVER['HTTP_HOST'])
                    ->method($_SERVER['REQUEST_METHOD'])
					->path($_SERVER['REQUEST_URI'])
					->post($_POST)
					->query($_GET)
					->server($_SERVER);
			// Neutralise the globals. But not $_SERVER.
			$_GET = $_POST = array();
			
			if (true === strpos($_SERVER['HTTP_ACCEPT'], 'json')) $this->accept('json');
			else $this->accept('html');
		}
		
		/**
		 *	Returns the current URL the visitor is on.
		 *	
		 *	@return string
		 */
		public function currenturl() { return $this->baseurl().$this->path(); }
		
	}