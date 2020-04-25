<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class accessAccount extends CI_Controller {

	public function signup()
	{
		$this->load->view('templates/Header');
		$this->load->view('userManagementViews/Signup');
		$this->load->view('templates/Footer');
	}
	public function login()
	{
		$this->load->view('templates/Header');
		$this->load->view('userManagementViews/Login');
		$this->load->view('templates/Footer');
	}
	public function isUsernameAvailable()
	{
		$username = $this->input->post('username');
		if($username=='kuntal_sarkar'){
			return print_r ("true");
		}else{
			return print_r ("false");
		}
	}
}