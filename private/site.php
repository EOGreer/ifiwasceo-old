<?php
	/**
	 *	Defines site-specific stuff.
	 */
	
	Database::$hostname = 'localhost';
	Database::$database = 'mydatabase';
	
	if ('environment' == 'development') {
		Database::$username = 'myuser';
		Database::$password = 'p4ssw0rd';
	}
	
	if ('environment' == 'live') {
		Database::$username = 'myuser123';
		Database::$password = 'p4ssw0rd123';
	}
	
	$routes->set(Route::create('/error/<code>')
					->controller('welcome')
					->method('index') )
					->set404('/error/404');

	$routes->set(Route::create('/')
					->controller('welcome')
					->method('index') );