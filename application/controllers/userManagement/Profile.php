<?php
defined('BASEPATH') OR exit('No direct script access allowed');
session_start();

class Profile extends CI_Controller{
	function __construct() {
        parent::__construct();
		$this->load->model("contentManagement/fetchContent_model");
    }
	public function index(){
		$username=$this->uri->segment(1);
		$this->load->model("userManagement/accessAccount_model");
		$result=$this->accessAccount_model->isUsernameValid($username);
		if(!empty($result)){		//Gets the user details
			$this->load->model("userManagement/accessAccount_model");
			$mainData['userDetails'] = $this->accessAccount_model->getUserData($username);
		}
		if(!isset($_SESSION['username']) && !empty($result)){			//if there is no session but valid username
			$mainData['username'] = $username;
			$data['title']="Profile | CSQueries";
			$this->load->view('templates/Header',$data);
			$this->load->view('userManagementViews/ProfilePage',$mainData);
			$this->load->view('templates/Footer');
		}else if($this->uri->segment(1)==$_SESSION['username'] && isset($_SESSION['AuthId'])){ //if there is session and user clicks on his username
			$data['title']="Profile | CSQueries";
			$mainData['username'] = $username;
			$this->load->view('templates/Header',$data);
			$this->load->view('userManagementViews/ProfilePage',$mainData);
			$this->load->view('templates/Footer');
		}else{				//if there is session and also valid username but username is not same with session username
			if(!empty($result)){
				$mainData['username'] = $username;
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
		if($this->isSessionAvailable()){
			if($this->isUrlUsernameSame()){
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
		$data['category']=$this->fetchContent_model->categories();
		if($this->isSessionAvailable()){			//checking if user is logged in or not
			if($this->isUrlUsernameSame()){			// if logged in the the url username is 
				$username=$this->uri->segment(1);				//getting the username from url							
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
	public function editContent($category=NULL,$questionId =NULL ,$questionText=NULL){		//function for editing existing content
		$data['title']="Edit Content | CSQueries";
		$data['category']=$this->fetchContent_model->categories();
		$mainData = $this->fetchQuestion($category,$questionId,$questionText);
		if($this->isSessionAvailable()){			//checking if user is logged in or not
			if($this->isUrlUsernameSame()){
				$this->load->view('templates/Header',$data);
				$this->load->view('userManagementViews/EditContent',$mainData);
				$this->load->view('templates/Footer');
			}else{
				show_404();
			}
		}else{
			redirect(base_url()."login");		//no session found redirecting to login page
		}
	}
	public function logout(){			//when the user clicks the logout button
		session_destroy();				//destroying session
		redirect(base_url()."login");		//redirecting to login page
	}
	public function isUrlUsernameSame(){
			$this->load->model("userManagement/accessAccount_model");
			$username=$this->uri->segment(1);				//getting the username from url
			$result=$this->accessAccount_model->isUsernameValid($username);
			if(!empty($result) && $username==$_SESSION['username']){
				return true;
			}else{
				return false;
			}
	}
	public function isSessionAvailable(){
		if(isset($_SESSION['username']) && isset($_SESSION['AuthId'])){
			return true;
		}else{
			return false;
		}
	}
	public function fetchQuestion($category=NULL,$questionId =NULL ,$questionText=NULL){
		$this->load->model("contentManagement/fetchContent_model");
		$mainData['question']=$this->fetchContent_model->questionDetails($questionId);
		$mainData['RelatedQuestionFromTopic']=$this->fetchContent_model->getCategoryQuestions($category);	
		return $mainData;
	}
}
?>