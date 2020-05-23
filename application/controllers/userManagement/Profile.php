<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//session_start();

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
			$mainData['userDetails'] = $this->accessAccount_model->getUserData($username);
			$mainData['authorExperienced'] = $this->accessAccount_model->getAuthorExperience($username);
		}
		if(!isset($_SESSION['username']) && !empty($result)){			//if there is no session but valid username
			$mainData['username'] = $username;
			$data['title']="Profile | CSQueries";
			$this->load->view('templates/Header',$data);
			$this->load->view('userManagementViews/ProfilePage',$mainData);
			$this->load->view('templates/Footer');
		}else if(isset($_SESSION['username']) && isset($_SESSION['AuthId'])){ //if there is session
			if($this->uri->segment(1)==$_SESSION['username']){	//if the session username matches url username that means same user account
				if($this->isAccountVerified($username)){
					$data['title']="Profile | CSQueries";
					$mainData['username'] = $username;
					$this->load->view('templates/Header',$data);
					$this->load->view('userManagementViews/ProfilePage',$mainData);
					$this->load->view('templates/Footer');
				}else{
					redirect(base_url().$username.'/accountVerification');
				}
			}else{	//if the user clicks on different username
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
		}else{				//if there is session and also valid username but username is not same with session username
			show_404();
			// if(!empty($result)){
			// 	$mainData['username'] = $username;
			// 	$data['title']="Profile | CSQueries";
			// 	$this->load->view('templates/Header',$data);
			// 	$this->load->view('userManagementViews/ProfilePage',$mainData);
			// 	$this->load->view('templates/Footer');
			// }else{			//if there is no session as well as invalid username
			// 	show_404();
			// }
		}
	}
	public function dashboard(){
		try{
			if(!$this->isSessionAvailable()){	//checking if user is logged in or not
				$this->session->set_flashdata('error', "Oops!! It's looks like you are logged out.You must Login first to Upload your content.");
				redirect(base_url().'login');
			}
			$data['title']="Upload Content | CSQueries";
			$data['category']=$this->fetchContent_model->categories();
			$username=$this->uri->segment(1);	
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
		}
		catch (Exception $e)
		{
		    show_error($e->getMessage());
		}
	}
	public function userQuestionList(){
		try{
			if(!$this->isSessionAvailable()){	//checking if user is logged in or not
				$this->session->set_flashdata('error', "Oops!! It's looks like you are logged out.You must Login first to View your content.");
				redirect(base_url().'login');
			}
			$data['title']="My Contents | CSQueries";
			$data['category']=$this->fetchContent_model->categories();
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
		}
		catch (Exception $e)
		{
		    show_error($e->getMessage());
		}
	}
	public function editContent($category=NULL,$questionId =NULL ,$questionText=NULL){		//function for editing existing content
		try{
			if(!$this->isSessionAvailable()){	//checking if user is logged in or not
				$this->session->set_flashdata('error', "Oops!! It's looks like you are logged out.You must Login first to Edit your content.");
				redirect(base_url().'login');
			}
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
		}catch (Exception $e)
			{
			    show_error($e->getMessage());
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
		$mainData['question']=$this->fetchContent_model->questionDetails($questionId);
		$mainData['RelatedQuestionFromTopic']=$this->fetchContent_model->getCategoryQuestions($category);	
		return $mainData;
	}
	public function editUserDetails(){
		try{
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
				else throw new Exception("<b style='font-weight:bold;color:red;'>ERROR</b>: Some error encountered. Try again later.");
			}else show_404();
		}
		catch (Exception $e)
		{
		    show_error($e->getMessage());
		}
	}
	public function updatePicture(){
		try{
			if(!$this->isSessionAvailable()) redirect(base_url().'login');//Not logged in ,returning to login page
			if(isset($_POST['UpdatePicture'])){
				$file = $_FILES['profilePicture']['tmp_name'];
				$file_name = $_FILES['profilePicture']['name'];
				$file_size = $_FILES['profilePicture']['size'];
				if(!$file){
					throw new Exception("<b style='font-weight:bold;'>ERROR</b>: Select an Image first.");
				}
				if($file_size>600000){
					 throw new Exception("<b style='font-weight:bold;color:red;'>ERROR</b>: Image Size should be within 600 KB.");
					 
				}
				$file_type = getimagesize($file);
				function compress_image($source_url, $destination_url, $quality)
			    {
			        $info = getimagesize($source_url);
			        if ($info['mime'] == 'image/jpeg') $image = imagecreatefromjpeg($source_url);
			        elseif ($info['mime'] == 'image/gif') $image = imagecreatefromgif($source_url);
			        elseif ($info['mime'] == 'image/png') $image = imagecreatefrompng($source_url);
			        imagejpeg($image, $destination_url, $quality);
			        // echo "Image uploaded successfully.";
			    }
			    if($file_size<=200000) $imageQuality = 30;
			    else if($file_size<=400000) $imageQuality = 20;
			    else if($file_size<=600000) $imageQuality = 10;
			    else $imageQuality = 10;
				$file_name_array = explode(".",$file_name);
				$extension = end($file_name_array);
				$new_image_name = $_SESSION['username'].rand().'.'.$extension;
				$allowed_extension = array("image/jpeg","image/gif","image/png");
				if(in_array($file_type['mime'],$allowed_extension)){
					compress_image($file, './assets/images/UserProfilePictures/'.$new_image_name, $imageQuality);
					// move_uploaded_file($file, './assets/images/UserProfilePictures/'.$new_image_name);
					$status = $this->accessAccount_model->updateUserPicture($new_image_name,$_SESSION['AuthId']);
					if($status) {
						$_SESSION['authorPicture'] = $new_image_name;
						redirect(base_url().$_SESSION['username']);
					}else show_error("<b style='font-weight:bold;color:red;'>ERROR</b>: Some unknown error encountered. Try again later."); 
				}else show_error("<b style='font-weight:bold;color:red;'>ERROR</b>: Image Should be of .jpg,.png or .gif type.");
			}else show_error("<b style='font-weight:bold;color:red;'>ERROR</b>: Select an Image first.");
		}
		catch (Exception $e)
		{
		    show_error($e->getMessage());
		}
	}
	public function editUserKnownTopics(){ //Edit User Known Topics in Profile Page
		try{
			if(!$this->isSessionAvailable()) redirect(base_url().'login'); //Not logged in ,returning to login page
			if(isset($_POST['updateKnownTopics'])){
				$topics = '';
				foreach($_POST['knownTopics'] as $row){
					$topics = $topics . $row . ',';
				}
				$status = $this->accessAccount_model->updateUserKnownTopics($_SESSION['AuthId'],$topics);
				if($status) redirect(base_url().$_SESSION['username']);
				else show_404();
			}else throw new Exception("<b style='font-weight:bold;color:red;'>ERROR</b>: Direct Access not allowed.");
		}
		catch (Exception $e)
		{
		    show_error($e->getMessage());
		}
	}
	// public function ShowMessage($message=NULL){
	// 	$data['title']="Message | CSQueries";
	// 	$data['category']=$this->fetchContent_model->categories();
	// 	$mainData['message'] = $message;
	// 	$this->load->view('templates/Header',$data);
	// 	$this->load->view('templates/ShowMessage',$mainData);
	// 	$this->load->view('templates/Footer');
	// }
}
?>