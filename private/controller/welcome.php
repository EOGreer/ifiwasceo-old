<?php
	/**
	 *	Example controller.
	 */
	class Controller_Welcome
	{
		
		public function index()
		{
			$this->master->view = View::get('welcome');
		}
		
	}