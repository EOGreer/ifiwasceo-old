<?php
	/**
	 *	Robin Controller
	 */
	abstract class Robin_Controller
	{
		
		protected $request;
		protected $response;
		
		public function __construct(Robin_Request &$req, Robin_Response $res)
		{
			$this->request =& $req;
			$this->response = $res;
		}
		
		public abstract function before();
        
        public function getResponse() { return $this->response; }
		
		public abstract function after();
		
	}