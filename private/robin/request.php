<?php
	/**
	 *	Robin Request
	 *	Handles the incoming request.
	 *	
	 *	Chained as much as possible when setting stuff.
	 */
	class Robin_Request
	{
		
		/* Accept-type */
		protected $accept = null;
		
		/* Base URL */
		protected $baseurl = null;
		
		/* GET array */
		protected $get = array();
		
        /* HTTP Method */
        protected $method = null;
        
		/* PARAMS array */
		protected $params = array();
		
		/* Path */
		protected $path = null;
		
		/* POST array */
		protected $post = array();
		
		/* SERVER array */
		protected $server = array();
		
		public function __construct()
		{
			$this->baseurl($_SERVER['HTTP_HOST'])
                    ->method($_SERVER['REQUEST_METHOD'])
					->path($_SERVER['REQUEST_URI'])
					->post(null, $_POST)
					->query(null, $_GET)
					->server(null, $_SERVER);
			// Neutralise the globals. But not $_SERVER.
			$_GET = $_POST = array();
			
			if (true === strpos($_SERVER['HTTP_ACCEPT'], 'json')) $this->accept('json');
			else $this->accept('html');
		}
		
		/**
		 *	The accept-type.
		 */
		public function accept($a = null)
		{
			if (false === empty($a)) {
				$this->accept = $a;
				return $this;
			}
			
			return $this->accept;
		}
		
		/**
		 *	The base url.
		 */
		public function baseurl($b = null)
		{
			if (false === empty($b)) {
				$this->baseurl = $b;
				return $this;
			}
			
			return $this->baseurl;
		}
		
		/**
		 *	Returns the current url.
		 */
		public function currenturl() { return $this->baseurl().$this->path(); }
		
		/**
		 *	A filter function to filter out evil things.
		 *	@TODO Write this.
		 */
		public function filter($i)
		{
			if (true === is_array($i)) foreach($i as $k => $v) $i[$this->filter($k)] = $this->filter($v);
			
			return $i;
		}
		
        public function method($m = null)
        {
            if (false === empty($m)) {
                $this->method = strtolower($m);
                return $this;
            }
            
            return $this->method;
        }
        
		/**
		 *	Incredi-method.
		 *	Either gets all the params, one param, null, sets a param or sets ALL the params.
		 */
		public function param($k = null, $v = null)
		{
			if ((false === empty($v)) && (true === is_array($v))) {
				$this->params = array_merge($this->params, $v);
				return $this;
			}
			elseif ((false === empty($k)) && (false === empty($v))) {
				$this->params[$k] = $this->filter($v);
				return $this;
			}
			elseif (false === empty($k)) {
				if (false === empty($this->params[$k])) return $this->params[$k];
				else return null;
			}
			return $this->params;
		}
		
		/**
		 *	The path.
		 */
		public function path($p = null)
		{
			if (false === empty($p)) {
				$this->path = $p;
				return $this;
			}
			
			return $this->path;
		}
		
		/**
		 *	Incredi-method.
		 *	Either gets all the POSTs, one POST, null, sets a POST or sets ALL the POSTs.
		 */
		public function post($k = null, $v = null)
		{
			if ((false === empty($v)) && (true === is_array($v))) {
				$this->post = array_merge($this->post, $v);
				return $this;
			}
			elseif ((false === empty($k)) && (false === empty($v))) {
				$this->post[$k] = $this->filter($v);
				return $this;
			}
			elseif (false === empty($k)) {
				if (false === empty($this->post[$k])) return $this->post[$k];
				else return null;
			}
			return $this->post;
		}
		
		/**
		 *	Incredi-method.
		 *	Either gets all the GETs, one GET, null, sets a GET or sets ALL the GETs.
		 */
		public function query($k = null, $v = null)
		{
			if ((false === empty($v)) && (true === is_array($v))) {
				$this->get = array_merge($this->get, $v);
				return $this;
			}
			elseif ((false === empty($k)) && (false === empty($v))) {
				$this->get[$k] = $this->filter($v);
				return $this;
			}
			elseif (false === empty($k)) {
				if (false === empty($this->get[$k])) return $this->get[$k];
				else return null;
			}
			return $this->get;
		}
		
		/**
		 *	Incredi-method.
		 *	Either gets all the SERVERs, one SERVER, null, sets a SERVER or sets ALL the SERVERs.
		 */
		public function server($k = null, $v = null)
		{
			if ((false === empty($v)) && (true === is_array($v))) {
				$this->server = array_merge($this->server, $v);
				return $this;
			}
			elseif ((false === empty($k)) && (false === empty($v))) {
				$this->server[$k] = $this->filter($v);
				return $this;
			}
			elseif (false === empty($k)) {
				if (false === empty($this->server[$k])) return $this->server[$k];
				else return null;
			}
			return $this->server;
		}
		
	}