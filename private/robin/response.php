<?php
	/**
	 *	Robin Response
	 *	Handles the outgoing data.
	 *	
	 *	Chains the methods as much as possible when setting stuff.
	 */
	class Robin_Response
	{
		
		protected $body = null;
		protected $headers = array();
		
		/**
		 *	Takes in a request object to build an appropriate response.
		 *	If no request object is received, make a new one.
		 */
		public function __construct(Robin_Request &$r = null)
		{
			if (false === empty($r)) $this->request =& $r;
			else $this->request = new Robin_Request();
		}
		
		/**
		 *	Either gets the body or sets the body of the response.
		 */
		public function body($i = null)
		{
			if (false === empty($i)) {
				$this->body = $i;
				return $this;
			}
			return $this->body;
		}
		
		/**
		 *	Add a new header.
		 */
		public function header($h)
		{
			$this->headers[] = $h;
			return $this;
		}
		
		/**
		 *	Either gets or sets the headers.
		 */
		public function headers(array $h = null)
		{
			if (false === empty($h)) {
				$this->headers = array_merge($this->headers, $h);
				return $this;
			}
			return $this->headers;
		}
		
		public function sendHeaders()
		{
			foreach($this->headers() as $header) {
				header($header);
			}
		}
		
	}