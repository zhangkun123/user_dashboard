<?php

class Message extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	public function delete_message($message_id)
	{
		return $this->db->delete('messages', array('id' => $message_id)); 
	}

	public function create_message($user_id, $message_data)
	{
		$message = array(
			'sender_user_id' => $user_id,
			'user_id' => $message_data['recipient_user_id'],
			'parent_message_id' => isset($message_data['parent_message_id']) ? $message_data['parent_message_id'] : NULL,
			'message' => $message_data['message_content'],
			'created_at' => date("Y-m-d H:i:s")
		);

		return $this->db->insert('messages', $message);
	}

	//get message by user id, by message id, or by user id and message id 
	public function get_message($user_id = NULL, $message_id = NULL)
	{
		$this->db->select('messages.message, messages.created_at, messages.id as message_id, messages.user_id, messages.parent_message_id, users.first_name, users.last_name, users.id as user_id');
		$this->db->join('users', 'users.id = messages.sender_user_id');
		
		if($user_id != NULL && $message_id == NULL)
		{
			$this->db->where('user_id', $user_id);
			$this->db->where('parent_message_id', NULL);
			$this->db->order_by('messages.id', "DESC");
		}
		elseif($message_id != NULL && $user_id == NULL)
		{
			$this->db->where('parent_message_id', $message_id);
			$this->db->order_by('messages.id', "ASC");
		}
		else
		{
			$this->db->where('sender_user_id', $user_id);
			$this->db->where('messages.id', $message_id);
		}

		return $this->db->get('messages')->result_array();
	}
}