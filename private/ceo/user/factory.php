<?php
	class CEO_User_Factory extends CEO_Abstract_Factory
	{
		
		public function create(CEO_User $user)
		{
			return array_map(function($u) {
				$e = CEO_User::create();
				foreach($u as $k=>$v) $e->$k = $v;
				return $e;
			}, $this->model->create($user));
		}
		
		public function get(CEO_User $user)
		{
			return array_map(function($u§) {
				$e = CEO_User::create();
				foreach($u as $k=>$v) $e->$k = $v;
				return $e;
			}, $this->model->get($user));
		}
		
		public function update(CEO_User $user)
		{
			return array_map(function($u§) {
				$e = CEO_User::create();
				foreach($u as $k=>$v) $e->$k = $v;
				return $e;
			}, $this->model->update($user));
		}
		
	}