<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {
	
	protected $view_data = array();
	protected $user_session = array();
	
	public function __construct()
	{
		parent::__construct();
		$this->view_data = $this->user_session = $this->session->userdata('user_session');
	}

	//display dashboard if user is login
	public function index()
	{	
		if($this->is_login())
			redirect(base_url('/dashboard'));
		else
			$this->load->view('main_page');	
	}

	//function to check if user is login
	protected function is_login()
	{
		if($this->user_session['is_logged_in'] && is_numeric($this->user_session['user_id']))
			return TRUE;
		else
			return FALSE;
	}

	//function to check if user is admin
	public function is_admin()
	{
		if($this->is_login())
			return ($this->user_session['user_level'] == ADMIN_USER) ? TRUE : FALSE;
		else
			return FALSE;
	}
	
	public function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url());
	}
}

/* end of file */