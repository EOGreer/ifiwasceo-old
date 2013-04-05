<?php
	/**
	 *	Example controller.
	 */
	class Controller_Home extends Controller
	{
		
		public function index()
		{
			$this->master->view = View::get('home');
		}
		
	}