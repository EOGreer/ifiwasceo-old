<?php
	/**
	 *	Sets the autoloader and starts routing!
	 */
	
	spl_autoload_register(function($class) {
		$filename = '../private/' . str_replace('_', '/', strtolower($class)) . '.php';
		if (true === file_exists($filename)) {
			require_once($filename);
			return true;
		}
		return false;
	});
    
    require_once('robin/extras.php');
	
	$req    = new Robin_Request();
	$res    = new Robin_Response($req);
	$routes = new Robin_Route();
	
	// Site configuration in site.php!
	require_once('../private/site.php');
	
	$route = $routes->match($req->path());
	if (false === empty($route)) {
		$v = 0;
		$w = false;
		while (false === $w) {
			$v++;
			$w = true;
//			prettyprint($route,'$route');
			$controllerName = $route->controller();
			$methodName = $route->method();
//			prettyprint($controllerName,'$controllerName'); prettyprint($methodName,'$methodName');
			if (false === class_exists($controllerName)) {
				$route = $routes->match($routes::get404());
				if ($v > 1) $route = null;
				else $w = false;
			}
			if (false === method_exists($controllerName,$methodName)) {
				$route = $routes->match($routes::get404());
				if ($v > 1) $route = null;
				else $w = false;
			}
			prettyprint($route,'$route');
		}
	}

	if (true === empty($route)) {
		exit('Route not found. And no 404 route found.');
	}
	
    $ctl = new $route->controller($req, $res);
    $ctl->before();
    $ctl->{$route->method()}();
    $ctl->after();
?>