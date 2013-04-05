<?php
	class CEO_User_Model extends CEO_Abstract_Model
	{
		
		public function create(CEO_User $user)
		{
			$data = $user->getData();
		}
		
		public function get(CEO_User $user)
		{
			$data = $user->getData();
			
			if (false === empty($data['id'])) $users = $this->db->query('call usp_GetUserById(%d);', $data['id']);
			else return array();
		}
		
		public function update(CEO_User $user)
		{
			$data = $user->getData();
		}
		
	}