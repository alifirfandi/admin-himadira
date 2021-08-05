<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AuthCheck extends CI_Controller {
	public function __construct()
    {
		parent::__construct();
		
		// Load Helper
        $this->session = new Session_helper();
	}

	// Login
	public function login()
	{
		if ($this->session->check_session(HIMADIRA_ADMIN_AUTH)) redirect(base_url("views/dashboard"));

		$this->load->view("login", array(
			'title' => 'Login Dashboard'
		));
	}
}