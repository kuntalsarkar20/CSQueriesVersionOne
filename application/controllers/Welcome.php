<?php
defined('BASEPATH') OR exit('No direct script access allowed');
session_start();
class Welcome extends CI_Controller {

	public function index()
	{	
		$data['title']="Home | CSQueries";
		$this->load->view('templates/Header',$data);
		$this->load->view('HomeViews/Home');
		$this->load->view('templates/Footer');
	}
}
