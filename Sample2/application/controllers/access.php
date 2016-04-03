<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once("main.php");

class Access extends Main
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model("User");
		$this->load->view('partials/header',array('current_user' => $this->current_user));
	}

	public function index()
	{
		$this->load->view("access/index");
	}

	public function login()
	{ 
		if($this->current_user)
		{
			redirect(base_url('/dashboard'));
		}
		else
		{
			 $this->load->view("access/login");	
		}
	}

	public function register()
	{

		if($this->current_user)
		{
			redirect(base_url('/dashboard'));
		}
		else
		{
			 $this->load->view("access/register");
		}
		
	}

	public function user_login()
	{
		if($this->input->post("form_action")=="Register")
		{
			// returns all POST items with XSS filter 
			$user = $this->input->post(NULL, TRUE); 
		    $register_user = $this->User->create_user_record($user);
		    
		    if($register_user["user_created"])
		    {
		    	$this->session->set_flashdata("success_message",$register_user["success_message"]);
		    }
		    else
		    {
		    	$this->session->set_flashdata("error_message",$register_user["error_message"]); 
		    }

		    redirect(base_url('/register')); 
        }
		else if($this->input->post("form_action")=="Login")
		{
			$user = $this->input->post(NULL, TRUE);
			$login_user = $this->User->login_user($user);
			
			if($login_user["is_login"])
			{ 
				$this->session->set_flashdata("success_message",$login_user["success_message"]);
				redirect(base_url('/dashboard'));
			}
			else
			{
				$this->session->set_flashdata("error_message",$login_user["error_message"]);
				redirect(base_url('/login')); 
				 
			}
		}
		else
		{
			redirect(base_url('/'));
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		$this->session->set_flashdata("error_message","Logged Out successfully");
		redirect(base_url('/'));
	}

}


//end of main controller