<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once("main.php");

class Dashboard extends Main {

	public function __construct()
	{
		parent::__construct();
		$this->load->model("User");
		$this->load->model("Post");
		$this->load->model("Comment");

		if(!$this->is_login())
		{
			$this->session->set_flashdata("error_message","Please Login");
			redirect(base_url('/'));
		}
		$this->load->view('partials/header',array('current_user'   => $this->current_user) );
		// $this->output->enable_profiler();
	}

	public function index()
	{  
		$this->list_users();	 
	}

	public function list_users()
	{
		$users = $this->User->get_all_users();
		$this->load->view('dashboard/list_users',array('users'    => $users ,
			                                           'is_admin' => $this->is_admin()
			                                           ));
		$this->load->view('partials/footer');
	}

	public function profile()
	{
		$this->load->view('/dashboard/profile',array('current_user'   => $this->current_user));
	}

	public function view_user($user_id)
	{
		$user_details        = $this->User->get_user_with_id($user_id);
		$get_all_users       = $this->User->get_all_users();
		$post_details        = $this->Post->get_post_details_by_id($user_id);
		$all_comments        = $this->Comment->get_all_comments();
		$this->load->view("dashboard/view_user",array( 'user'         => $user_details,
		                                               'current_user' => $this->current_user,
													   'posts'        => $post_details,
													   'all_users'    => $get_all_users,
													   'comments'     => $all_comments 
													  )
						 );
	}

	public function create_post()
	{
		if($this->input->post("form_action")=="Post")
		{
			$post = $this->Post->create_post($this->input->post()) ;

			if($post['post_created'])
			{
				$this->session->set_flashdata("success_message",$post['success_message']);
			}
			else
			{
				$this->session->set_flashdata("error_message",$post['error_message']);
			}
		}
		redirect(base_url("/dashboard/view_user/".$this->input->post('post_created_for')));
	}

	public function create_comment()
	{
		if($this->input->post("form_action")=="Reply")
		{
		 	$comment_created = $this->Comment->create_comment($this->input->post());
		 	$user = $this->Post->get_user_id_with_post_id($this->input->post('post_id') ) ;
            $user_id = $user['user_id'];

			if($comment_created['comment_created'])
			{
				$this->session->set_flashdata("success_message",$comment_created['success_message']);
			}
			else
			{
				$this->session->set_flashdata("error_message",$comment_created['error_message']);
			}
		}
		redirect(base_url("/dashboard/view_user/").$user_id);
	}

	public function edit_user($user_id)
	{	
		if($this->is_admin() )
		{
			$user = $this->User->get_user_with_id($user_id);
			$this->load->view("dashboard/edit_user",array('user' => $user));
		}
		else
		{
			redirect(base_url('/'));
		}
	}

	public function update_user()
	{
		if($this->is_admin() && $this->input->post("form_action")=="Update User")
		{	
			$user = $this->input->post(NULL,TRUE);
			if($this->User->update_user($user) )
			{
				$this->session->set_flashdata("success_message","User record updated successfully");
				redirect(base_url('/dashboard/list_users'));
			} 
			else
			{
				$this->session->set_flashdata("error_message","User record cant be updated");
				$this->load->view("dashboard/edit_user",array('user' => $user  )) ; 
			}
		}
		else if($this->is_admin() && $this->input->post("form_action")=="Cancel")
		{
			redirect(base_url('/dashboard/list_users'));
		}
	}

	public function delete_user($user_id)
	{
		if($this->is_admin() )
		{
			$id = $user_id;
			if($this->is_login() && $this->is_admin() )
			{
				if($this->User->delete_user($id))
				{
					$this->session->set_flashdata("success_message","User record deleted successfully");
				}
				else
				{
					$this->session->set_flashdata("error_message","User record can't be deleted");
				}
				redirect(base_url('/dashboard/list_users'));
			}
		}
		else
		{
			redirect(base_url('/'));
		}
	}
}

//end of main controller