<?php
defined('BASEPATH') OR exit('No direct script access allowed');
session_start();

class Profile extends CI_Controller{
	public function uploadContent(){
		if(!isset($_SESSION['username'])){
			redirect(base_url()."login");
		}else{
			$this->load->view('templates/Header');
			$this->load->view('userManagementViews/UploadContent');
			$this->load->view('templates/Footer');
		}
	}
	public function logout(){
		session_destroy();
		redirect(base_url()."login");
	}
}
?>