<?php
	class Controller_Static extends Controller
	{
		
		public function about()
		{
			$view = View::get('about');
			$this->master->view = $view;
		}
		
	}