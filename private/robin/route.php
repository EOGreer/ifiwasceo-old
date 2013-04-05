<?php
	/**
	 *	Robin Route
	 *	
	 *	Robin Route
	 *	Maps a URI to a controller.
	 */
	class Robin_Route
	{
		
		public static $defaultController = 'welcome';
		public static $defaultMethod = 'index';
		
		/* @var The routes. */
		protected $routes = array();
		
		/**
		 *	Builds the Routes object.
		 *	Uses the $json file supplied.
		 */
		public function __construct($json = '/routes.json')
		{
			$this->routes = array_map(function($r) {
				return array_merge(array(
					'name' => 'unknown',
					'path' => '(.*)',
					'params' => null,
					'controller' => Robin_Route::$defaultController,
					'method' => Robin_Route::$defaultMethod,
					'test' => null
				), $r);
			}, json_decode(file_get_contents(sprintf('../private%s', $json)), true));
			//die(prettyprint($this->routes, '$this->routes'));
		}
		
		/**
		 *	Find the route you want!
		 *	
		 *	@param $path The path requested.
		 *	@return StdClass or null
		 */
		public function find($path)
		{
			foreach($this->routes as $r) {
				$m = array();
				if (@preg_match(sprintf("$%s$", $r['path']), $path, $m) == true) {
					array_shift($m);
					foreach($m as $k=>$v) {
						$l = $r['params'][$k];
						unset($r['params'][$k]);
						$r['params'][$l] = $m[$k];
					}
					return (object)$r;
				}
			}
			// At this point, no routes found, so find an error route.
			foreach($this->routes as $route) if ((false === empty($route->error)) && (true == $route->error)) return (object)$route;
			return null;
		}
		
		/**
		 *	Only run tests when you need too! :P
		 */
		public function test()
		{
			foreach($this->routes as $r) {
				if (false === empty($r['test'])) {
					$route = $this->find($r['test']['path']);
					if (false === empty($route)) {;
						$diff = array_diff($route['params'], $r['test']['results']);
						//prettyprint($r['test']['results'],'$r["test"]["results"]'); prettyprint($route->params, '$route["params"]'); prettyprint($diff,'$diff');
						if (false === empty($diff)) {
							exit('Routes: Test failed on '.$r['name'].'. <br/><pre>$route '.print_r($route,true).'</pre>');
						}
					}
				}
			}
			exit('Routes: All tests successful.');
		}
		
	}