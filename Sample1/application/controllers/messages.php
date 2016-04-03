<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once('main.php');

class Messages extends Main {

	public function __construct()
	{
		parent::__construct();
	}

	//admin or owner of message can delete a message/comment
	public function delete_message($message_id)
	{
		$this->load->model("Message");
		$get_message = $this->Message->get_message($this->user_session['user_id'], $message_id);

		if(count($get_message) > 0 || $this->is_admin())	
		{
			$delete = $this->Message->delete_message($message_id);

			if($delete)
				$data["status"] = TRUE;
			else
				$data["status"] = FALSE;
		}
		else
			$data["status"] = FALSE;

		echo json_encode($data);
	}

	//ajax handled sending of message
	public function send_message()
	{
		$message_data = $this->input->post();

		$this->load->model('Message');
		$send_message = $this->Message->create_message($this->user_session['user_id'], $message_data);

		if($send_message)
		{
			$data["status"] = TRUE;
			$data["message_type"] = "message";
			$data["message"] = "<div class='well'>
									<div class='pull-left'>
										<h5><a href=''>". $this->user_session['first_name'] .' '. $this->user_session['last_name'] ."</a> wrote:</h5>
									</div>
									<form action='/messages/delete_message/". $this->db->insert_id() .">' class='pull-right form-horizontal delete_message'>
										<input type='submit' value='Delete'>
									</form>
									<div class='clearfix'></div>
									<p>". $message_data['message_content'] ."</p>
									<h6 class='muted'>1 second ago</h6>
									<div class='replies'></div>	
									<form action='/messages/reply' class='form-horizontal send_reply' method='post'>
										<div class='control-group'>
											<input type='hidden' name='recipient_user_id' value='". $message_data['recipient_user_id'] ."'>
											<textarea name='message_content' placeholder='Write a reply...'></textarea>
										</div>
										<input type='hidden' name='parent_message_id' value='". $this->db->insert_id() ."'>
										<input type='submit' value='Post' class='btn btn-success'>
										<div class='clearfix'></div>
									</form>
								</div>";
		}
		else
		{
			$data["status"] = FALSE;
			$data["error_message"] = "Failed, please try again";
		}

		echo json_encode($data);
	}

	//ajax handled reply to a message
	public function reply()
	{
		$message_data = $this->input->post();

		$this->load->model('Message');
		$reply = $this->Message->create_message($this->user_session['user_id'], $message_data);

		if($reply)
		{
			$data["status"] = TRUE;
			$data["message_type"] = "reply";
			$data["message"] = "<div class='message_reply'>
									<div class='pull-left'>
										<h5><a href=''>". $this->user_session['first_name'] .' '. $this->user_session['last_name'] ."</a> replied:</h5>
										<p>". $message_data['message_content'] ."</p>
										<h6 class='muted'>1 second ago</h6>
									</div>	
									<form action='/messages/delete_message/". $this->db->insert_id() .">' class='pull-right form-horizontal delete_message'>
										<input type='submit' value='Delete' class='btn'>
									</form>
									<div class='clearfix'></div>
								 </div>";
		}
		else
		{
			$data["status"] = FALSE;
			$data["error_message"] = "Failed, please try again";
		}

		echo json_encode($data);
	}
}