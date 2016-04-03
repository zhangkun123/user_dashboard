<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller 
{
	public $current_user;
	
	public function __construct()
	{
		parent::__construct();
		$this->current_user = $this->session->userdata("current_user");
	}

	public function is_login()
	{
		if($this->current_user)
		{
			  return true;
		}
		else
		{
			 return false;
		}
	}

	public function is_admin()
	{
		$current_user = $this->session->userdata["current_user"];
		if( $current_user['user_level']=="admin"  )
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	public function index()
	{
		$this->load->view("main/index",array('current_user' => $this->current_user));
	}
}


//end of main controller