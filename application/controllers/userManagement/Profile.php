<?php
defined('BASEPATH') OR exit('No direct script access allowed');
session_start();

class Profile extends CI_Controller{
	function __construct() {
        parent::__construct();
		$this->load->model("contentManagement/fetchContent_model");
		$this->load->model("userManagement/accessAccount_model");
    }
    public function isAccountVerified($username){
    	$status = $this->accessAccount_model->isAccountVerified($username);
    	foreach($status as $row){
    		$isVerified = $row['isVerified'];
    	}
    	if($isVerified == 1){
    		return true;
    	}else{
    		return false;
    	}
    }
	public function index(){
		$data['category']=$this->fetchContent_model->categories();
		$username=$this->uri->segment(1);
		$this->load->model("userManagement/accessAccount_model");
		$result=$this->accessAccount_model->isUsernameValid($username);
		if(!empty($result)){		//Gets the user details
			$this->load->model("userManagement/accessAccount_model");
			$mainData['userDetails'] = $this->accessAccount_model->getUserData($username);
			$mainData['authorExperienced'] = $this->accessAccount_model->getAuthorExperience($username);
		}
		if(!isset($_SESSION['username']) && !empty($result)){			//if there is no session but valid username
			$mainData['username'] = $username;
			$data['title']="Profile | CSQueries";
			$this->load->view('templates/Header',$data);
			$this->load->view('userManagementViews/ProfilePage',$mainData);
			$this->load->view('templates/Footer');
		}else if($this->uri->segment(1)==$_SESSION['username'] && isset($_SESSION['AuthId'])){ //if there is session and user clicks on his username
			if($this->isAccountVerified($username)){
				$data['title']="Profile | CSQueries";
				$mainData['username'] = $username;
				$this->load->view('templates/Header',$data);
				$this->load->view('userManagementViews/ProfilePage',$mainData);
				$this->load->view('templates/Footer');
			}else{
				redirect(base_url().$username.'/accountVerification');
			}
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
		$data['category']=$this->fetchContent_model->categories();
		$username=$this->uri->segment(1);	
		if($this->isSessionAvailable()){
			if($this->isUrlUsernameSame()){
				if($this->isAccountVerified($username)){
					$mainData['category']=$this->fetchContent_model->categories();
					$data['category']=$mainData['category'];
					$this->load->view('templates/Header',$data);
					$this->load->view('userManagementViews/UploadContent',$mainData);
					$this->load->view('templates/Footer');
				}else{
					redirect(base_url().$username.'/accountVerification');
				}
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
				$mainData['questionList'] = $this->fetchContent_model->getUserQuestionList($username);
				if($this->isAccountVerified($username)){
					$this->load->view('templates/Header',$data);
					$this->load->view('userManagementViews/userQuesList',$mainData);
					$this->load->view('templates/Footer');
				}else{
					redirect(base_url().$username.'/accountVerification');
				}
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
	public function editUserDetails(){
		if(!$this->isSessionAvailable()) redirect(base_url().'login'); //Not logged in ,returning to login page
		if(isset($_POST['editDetails'])){
			$college = addslashes(htmlspecialchars($this->security->xss_clean($_POST['clgName'])));
			$degree = addslashes(htmlspecialchars($this->security->xss_clean($_POST['degree'])));
			$graduationYear = addslashes(htmlspecialchars($this->security->xss_clean($_POST['graduationYear'])));
			$aboutAuthor = addslashes(htmlspecialchars($this->security->xss_clean($_POST['aboutAuthor'])));
			$userData = array('college' => $college,
			'degree' => $degree,
			'graduationYear' => $graduationYear,
			'about'=> $aboutAuthor,
			'authorId' => $_SESSION['AuthId']);
			$status = $this->accessAccount_model->updateUserDetails($userData);
			if($status) redirect(base_url().$_SESSION['username']);
			else show_404();
		}else show_404();
	}
	public function updatePicture(){
		if(!$this->isSessionAvailable()) redirect(base_url().'login');//Not logged in ,returning to login page
		if(isset($_FILES['profilePicture']['name'])){
			$file = $_FILES['profilePicture']['tmp_name'];
			$file_name = $_FILES['profilePicture']['name'];
			$file_name_array = explode(".",$file_name);
			$extension = end($file_name_array);
			$new_image_name = $_SESSION['username'].rand().'.'.$extension;
			$allowed_extension = array("jpg","png","gif");
			if(in_array($extension,$allowed_extension)){
				move_uploaded_file($file, './assets/images/UserProfilePictures/'.$new_image_name);
				$status = $this->accessAccount_model->updateUserPicture($new_image_name,$_SESSION['AuthId']);
				if($status) {
					$_SESSION['authorPicture'] = $new_image_name;
					redirect(base_url().$_SESSION['username']);
				}
				else show_404(); 
				// echo $new_image_name;
			}else show_404();
		}else show_404();
	}
	public function editUserKnownTopics(){
		if(!$this->isSessionAvailable()) redirect(base_url().'login'); //Not logged in ,returning to login page
		if(isset($_POST['updateKnownTopics'])){
			$topics = '';
			foreach($_POST['knownTopics'] as $row){
				$topics = $topics . $row . ',';
			}
			$status = $this->accessAccount_model->updateUserKnownTopics($_SESSION['AuthId'],$topics);
			if($status) redirect(base_url().$_SESSION['username']);
			else show_404();
		}else show_404();
	}
}
?>