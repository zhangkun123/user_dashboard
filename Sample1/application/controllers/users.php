<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once('main.php');

class Users extends Main {
	
	public function __construct()
	{
		parent::__construct();
	}

	//display user profile page
	public function show($user_id = NULL)
	{
		if(! $this->is_login())
			redirect(base_url('/'));
		else
		{
			//if user is null redirect user to his own profile
			$user_id = ($user_id != NULL) ? $user_id : $this->user_session["user_id"];

			//get user information
			$this->load->model('User');
			$this->view_data["user"] = $user = $this->User->get_user($user_id);

			if($user)
			{
				//get all messages for the user
				$this->load->model('Message');
				$this->view_data["messages"] = $user_messages = $this->Message->get_message($user_id, NULL);

				//get all sub messages or comments for each message of the user
				foreach($user_messages as $message)
				{
					$this->view_data["replies"][$message['message_id']] = $this->Message->get_message(NULL, $message['message_id']);
				}

				//load date helper so that we can use time span function e.g. (2 seconds ago)
				$this->load->helper('date');
				$this->load->view('user_show', $this->view_data);
			}
			else
				show_404();	
		}
	}

	//function to update user information, forms in edit page has only one destination
	public function update_user($user_id)
	{
		$user_data = $this->input->post();
		$this->load->library('form_validation');

		//array key exist allows you to check if certain index exist on an array
		if(array_key_exists("email", $user_data))
		{
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
			$this->form_validation->set_rules('first_name', 'First name', 'trim|required');
			$this->form_validation->set_rules('last_name', 'Last name', 'trim|required');
			$this->form_validation->set_rules('user_level', 'User Level', 'trim|required');
		}
		elseif(array_key_exists("password", $user_data))
		{
			$this->form_validation->set_rules('password', 'Password', 'trim|required|matches[re_password]');
			unset($user_data['re_password']);
			$user_data['password'] = md5(HASH_START . $user_data["password"] . HASH_END);
		}
		elseif(array_key_exists("description", $user_data))
			$this->form_validation->set_rules('description', 'Description', 'trim|required');

		if($this->form_validation->run() === FALSE)
		{
			$data['status'] = FALSE;
			$data['error_message'] = validation_errors();
		}
		else
		{	
			$this->load->model('User');
			$update_user = $this->User->update_user($user_id, $user_data);

			if($update_user)
			{
				$data["status"] = TRUE;
				$data["success_message"] = "User information was updated successfully!";
			}
			else
			{
				$data["status"] = FALSE;
				$data["error_message"] = "Update failed! Please Try Again!";
			}	
		}

		echo json_encode($data);
	}

	//load edit page for a specific user
	public function edit($user_id)
	{
		if(is_numeric($user_id) && $this->is_admin() || $this->user_session['user_id'] == $user_id)
		{
			$this->load->model('User');
			$this->view_data['user'] =  $this->User->get_user($user_id);
			$this->view_data['other_users'] =  $this->User->get_user();

			$this->load->view('user_edit', $this->view_data);
		}
		else
			redirect(base_url('dashboard'));
	}

	//only admin can delete a user
	public function delete_user($user_id = NULL)
	{
		if(is_numeric($user_id) && $this->is_admin())
		{
			$this->load->model('User');
			$delete = $this->User->delete_user($user_id);

			if($delete)
				redirect(base_url('dashboard'));
			else
				show_404();
		}
		else
			show_404();
	}

	public function new_user()
	{
		$this->load->view('user_add');
	}

	public function signin()
	{
		$this->load->view('user_login');
	}

	public function register()
	{
		$this->load->view('user_register');
	}

	//ajax handle user login
	public function user_login()
	{	
		$post_data = $this->input->post();

		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		
		if($this->form_validation->run() === FALSE)
		{
			$data['status'] = FALSE;
			$data['error_message'] = validation_errors();
		}
		else
		{	
			$user = array(
				'email' => $post_data["email"], 
				'password' => md5(HASH_START . $post_data["password"] . HASH_END)
			);

			$this->load->model('User');
			$user = $this->User->get_user($user);

			if(count($user) > 0)
			{	
				$user_data = array(
					'user_id' => $user->id,
					'email' => $user->email,
					'user_level' => $user->user_level,
					'first_name' => $user->first_name,
					'last_name' => $user->last_name,
					'is_logged_in' => TRUE
				);

				//session is being set in here with index user session, remember session is in a form of array
				$this->session->set_userdata('user_session', $user_data);
						
				$data['status'] = TRUE;
				$data['redirect_url'] = base_url('/dashboard');
			}
			else
			{
				$data['status'] = FALSE;
				$data["error_message"] = "Invalid email and Password! Please Try Again!";
			}
		}
		
		echo json_encode($data);
	}

	//ajax handled user registration
	public function user_registration()
	{	
		$this->load->library('form_validation');

		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		$this->form_validation->set_rules('re_password', 'Confirm Password', 'trim|required|matches[password]');
		
		if($this->form_validation->run() === FALSE)
		{
			$data['status'] = FALSE;
			$data['error_message'] = validation_errors();
		}
		else
		{
			$this->load->model('User');
			$register_user = $this->User->add_user($this->input->post());
			
			if($register_user)
			{
				$data["status"] = TRUE; 

				//since this function is use by add user and user login, http referer will let us know where post data came from
				if($_SERVER['HTTP_REFERER'] == base_url("/register"))
					$data["success_message"] = "Registration successful! You can now <a href='signin'>login</a>!";
				else
					$data["success_message"] = "User is sucessfully added!";
			}
			else
			{
				$data["status"] = FALSE;
				$data["error_message"] = "Registration failed! Please Try Again!";
			}	
		}

		echo json_encode($data);
	}
}

/* end of file */