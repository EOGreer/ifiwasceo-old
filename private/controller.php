<?php
	/**
	 *	Controller
	 *	All controllers extend from here.
	 */
	class Controller extends Robin_Controller
	{
		
		protected static $static = array(
			'Controller_Static'
		);
		
		protected $master;
		
		public function before()
		{
			$this->master = View::getMaster();
			
			if (false === in_array($this->request->param('controller'), self::$static)) {
				$write = View::get('write');
				$write->master = $this->master;
				$this->master->write = $write;
			}
		}
		
		public function after()
		{
			$this->master->render();
		}
		
	}