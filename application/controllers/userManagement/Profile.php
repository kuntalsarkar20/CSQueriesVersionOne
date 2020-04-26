<?php
defined('BASEPATH') OR exit('No direct script access allowed');
session_start();

class Profile extends CI_Controller{
	public function index(){
		$data['title']="Upload Content | CSQueries";
		$username=$this->uri->segment(1);
		$this->load->model("userManagement/accessAccount_model");
		$result=$this->accessAccount_model->isUsernameValid($username);
		if(!isset($_SESSION['username']) && !empty($result)){			//if there is no session but valid username
			print_r("hello no session");
		}else if(!isset($_SESSION['username'])){		//if there is no session
			redirect(base_url()."login");
		}else if($this->uri->segment(1)==$_SESSION['username']){
			$this->load->model("contentManagement/fetchContent_model");
			$categoryDetails['category']=$this->fetchContent_model->categories();
			$this->load->view('templates/Header',$data);
			$this->load->view('userManagementViews/UploadContent',$categoryDetails);
			$this->load->view('templates/Footer');
		}else{				//if there is session and also valid username
			if(!empty($result)){
				print_r("hello");
			}else{			//if there is no session as well as invalid username
				show_404();
			}
		}
	}
	public function logout(){
		session_destroy();
		redirect(base_url()."login");
	}
}
?>