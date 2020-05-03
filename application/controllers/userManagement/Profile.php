<?php
defined('BASEPATH') OR exit('No direct script access allowed');
session_start();

class Profile extends CI_Controller{
	public function index(){
		$this->load->model("contentManagement/fetchContent_model");
		$data['category']=$this->fetchContent_model->categories();
		$username=$this->uri->segment(1);
		$this->load->model("userManagement/accessAccount_model");
		$result=$this->accessAccount_model->isUsernameValid($username);
		if(!empty($result)){		//Gets the user details
			$this->load->model("userManagement/accessAccount_model");
			$mainData['userDetails'] = $this->accessAccount_model->getUserData($username);
		}
		if(!isset($_SESSION['username']) && !empty($result)){			//if there is no session but valid username
			$mainData['username'] = $username;
			$this->load->model("contentManagement/fetchContent_model");
			$data['title']="Profile | CSQueries";
			$this->load->view('templates/Header',$data);
			$this->load->view('userManagementViews/ProfilePage',$mainData);
			$this->load->view('templates/Footer');
		}else if($this->uri->segment(1)==$_SESSION['username'] && isset($_SESSION['AuthId'])){ //if there is session and user clicks on his username
			$this->load->model("contentManagement/fetchContent_model");
			$data['title']="Profile | CSQueries";
			$mainData['username'] = $username;
			$this->load->view('templates/Header',$data);
			$this->load->view('userManagementViews/ProfilePage',$mainData);
			$this->load->view('templates/Footer');
		}else{				//if there is session and also valid username but username is not same with session username
			if(!empty($result)){
				$mainData['username'] = $username;
				$this->load->model("contentManagement/fetchContent_model");
				$data['title']="Profile | CSQueries";
				$this->load->view('templates/Header',$data);
				$this->load->view('userManagementViews/ProfilePage',$mainData);
				$this->load->view('templates/Footer');
			}else{			//if there is no session as well as invalid username
				show_404();
			}
		}
	}
	public function dashboard(){
		$data['title']="Upload Content | CSQueries";
		if(isset($_SESSION['username']) && isset($_SESSION['AuthId'])){
			$this->load->model("userManagement/accessAccount_model");
			$username=$this->uri->segment(1);
			$result=$this->accessAccount_model->isUsernameValid($username);
			if(!empty($result) && $username==$_SESSION['username']){
				$this->load->model("contentManagement/fetchContent_model");
				$mainData['category']=$this->fetchContent_model->categories();
				$data['category']=$mainData['category'];
				$this->load->view('templates/Header',$data);
				$this->load->view('userManagementViews/UploadContent',$mainData);
				$this->load->view('templates/Footer');
			}else{
				show_404();
			}
		}else{
			redirect(base_url()."login");
		}

	}
	public function userQuestionList(){
		$data['title']="My Contents | CSQueries";
		if(isset($_SESSION['username']) && isset($_SESSION['AuthId'])){			//checking if user is logged in or not
			$this->load->model("userManagement/accessAccount_model");
			$username=$this->uri->segment(1);				//getting the username from url
			$result=$this->accessAccount_model->isUsernameValid($username);
			if(!empty($result) && $username==$_SESSION['username']){			// if logged in the the url username is 
																				//valid and if the username is same as 
																				//session username
				$this->load->model('contentManagement/fetchContent_model');
				$mainData['questionList'] = $this->fetchContent_model->getUserQuestionList($username);
				$this->load->view('templates/Header',$data);
				$this->load->view('userManagementViews/userQuesList',$mainData);
				$this->load->view('templates/Footer');
			}else{				
				show_404();		//username not valid showing error page
			}
		}else{
			redirect(base_url()."login");		//no session found redirecting to login page
		}
	}
	public function logout(){			//when the user clicks the logout button
		session_destroy();				//destroying session
		redirect(base_url()."login");		//redirecting to login page
	}
	// public function isSessionAvailable(){
	// 	if(isset($_SESSION['username']) && isset($_SESSION['AuthId'])){
	// 		return true;
	// 	}else{
	// 		return false;
	// 	}
	// }
}
?>