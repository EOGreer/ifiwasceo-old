<?php
	abstract class CEO_Abstract_Factory
	{
		
		protected $model;
		
		public function __construct(CEO_Abstract_Model $model)
		{
			$this->model = $model;
		}
		
	}