<?php

class User extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	public function update_user($user_id, $user_data)
	{
		return $this->db->where('id', $user_id)
				    ->update('users', $user_data); 
	}

	public function delete_user($user_id)
	{
		return $this->db->delete('users', array('id' => $user_id)); 
	}

	//flexible function for getting user/users information
	public function get_user($user = NULL)
	{
		if($user != NULL)
		{
			//for user login
			if(is_array($user))
			{
				return $this->db->where('email', $user['email'])
							->where('password', $user['password'])
							->get('users')
							->row();
			}
			else
				return $this->db->where('id', $user)->get('users')->row();
		}
		else
			return $this->db->get('users')->result();
	}
	
	public function add_user($user_data)
	{
		//HAST_START and HASH_END are contants making our password more secure, check app/config/constants.php
		$user = array(
			'email'	=> $user_data["email"],
			'password' => md5(HASH_START . $user_data["password"] . HASH_END),
			'first_name' => $user_data["first_name"],
			'last_name'	=> $user_data["last_name"],
			'user_level' => NORMAL_USER,
			'created_at' => date("Y-m-d H:i:s")
		);
		
		return $this->db->insert('users', $user);
	}
}