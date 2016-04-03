<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once('main.php');

class Dashboard extends Main {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->load->model('User');
		$this->view_data['users'] = $this->User->get_user();

		$this->load->view('dashboard', $this->view_data);
	}
}