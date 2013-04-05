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
	
	// Site configuration in site.php!
	require_once('../private/site.php');
	
	$routes = new Robin_Route();
	/* Only test when needed. */
	//$routes->test();
	
	$route = $routes->find($req->path());
	if (true === empty($route)) {
		exit('Route not found. And no 404 route found.');
	}
	
	$req->param(array_merge(array(
		'controller' => $route->controller,
		'method' => $route->method
	), (array)$route->params));
	
	$controller = $req->param('controller');
	$method = $req->param('method');
	
    $ctl = new $controller($req, $res);
    $ctl->before();
    $ctl->{$method}();
    $ctl->after();
?>