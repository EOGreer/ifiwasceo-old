<?php
	/**
	 *	Robin Route && Route
	 *	
	 *	Robin Route
	 *	Maps a URI to a controller.
	 */
	class Robin_Route
	{
		
		public static $error404 = 'error/404';
		protected $get = array();
		
		public static function get404()
		{
			return self::$error404;
		}
		
		protected function find($path)
		{
			foreach($this->get as $route) {
				if (true === $route->match($path)) {
					return $route;
				}
			}
			return null;
		}
		
		public function match($path)
		{
			$route = $this->find($path);
			if (true === empty($route)) {
				$route = $this->find('/error/404');
			}
			return $route;
		}
		
		public function set(Route $route)
		{
			$this->get[] = $route;
			return $this;
		}
		
		public static function set404($path)
		{
			self::$error404 = $path;
		}
		
	}
	
	/**
	 *	Route
	 *	Easy way to add a route to the Robin_Route class.
	 */
	class Route
	{
		
		protected static $defaultController = 'welcome';
		protected static $defaultMethod = 'index';
		
		public static function create($path)
		{
			return new Route($path);
		}
		
		public static function setDefaultController($controller)
		{
			self::$defaultController = $controller;
		}
		
		public static function setDefaultMethod($method)
		{
			self::$defaultMethod = $method;
		}
		
		protected $controller;
		protected $matches;
		protected $method;
		protected $path;
		
		public function __call($name,$args)
		{
			if (true === in_array($name,array('controller','method'))) {
				if (true === empty($args)) {
					return $this->$name;
				}
				if ($name === 'controller') $args[0] = ucfirst(strtolower($args[0]));
				$this->$name = $args[0];
				return $this;
			}
			$action = substr($name, 0, 3);
			$variable = strtolower(substr($name,3));
			switch($action) {
				
				case 'get':
					if (false === empty($this->$variable)) {
						return $this->$variable;
					}
				break;
				
				case 'set':
					$this->$variable = $args[0];
					return $this;
				break;
				
			}
			return null;
		}
		
		protected function __construct($path)
		{
			$this->controller = $this::$defaultController;
			$this->matches = array();
			$this->method = $this::$defaultMethod;
			$this->path = $this->formatPath($path);
		}
		
		protected function formatParams($params)
		{
			$matches = $this->matches;
			$urlparam = array();
//			prettyprint($this->matches,'$matches');
//			prettyprint($params,'$params');
			if (false === empty($params)) {
				foreach($params as $key=>$value) {
					if (false === empty($matches[$key])) {
						$name = $matches[$key];
						switch($name) {
							case 'controller':
								$this->controller('Controller_'.$params[$key]);
							break;
							case 'method':
								$this->method($params[$key]);
							break;
						}
					}
					else $name = $key;
					$urlparam[$name] = $params[$key];
				}
			}
			$this->matches = $urlparam;
		}
		
		//^/home(/)?([^/]+)?(/)?$
		protected function formatPath($path)
		{
			//prettyprint($path,'formatPath pre§ $path');
			$matches = array();
			$regex = '@\(\<([A-Za-z0-9\_]+)\>/)@i';
			@preg_match_all($regex,$path,$matches);
			if (false === empty($matches)) {
//				prettyprint($matches,'formatPath $matches');
				array_shift($matches);
				$this->matches = array_merge($this->matches,$matches[0]);
				$path = preg_replace($regex,'(/)?([^/]+)?(/)?',$path);
			}
			$matches = array();
			$regex = '@\<([A-Za-z0-9\_]+)\>@i';
			@preg_match_all($regex,$path,$matches);
			if (false === empty($matches)) {
//				prettyprint($matches,'formatPath $matches');
				array_shift($matches);
				$this->matches = array_merge($this->matches,$matches[0]);
				$path = preg_replace($regex,'([^/]+)',$path);
			}
			//prettyprint($path,'formatPath post $path');
			return $path;
		}
		
		public function getMatches() { return $this->matches; }
		
		public function match($path)
		{
			$matches = array();
			$regex = '@^'.$this->path.'$@i';
			preg_match($regex,$path,$matches);
			if (false === empty($matches)) {
				array_shift($matches);
				$this->formatParams($matches);
				return true;
			}
			else return false;
		}
		
	}