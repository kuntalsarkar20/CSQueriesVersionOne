<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index()
	{
		$this->load->view('templates/Header');
		$this->load->view('HomeViews/Home');
		$this->load->view('templates/Footer');
	}
}
