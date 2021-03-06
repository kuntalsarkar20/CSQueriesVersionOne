<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//session_start();

class accessAccount extends CI_Controller {

	function __construct() {
        parent::__construct();
		$this->load->model("contentManagement/fetchContent_model");
		$this->load->model("userManagement/accessAccount_model");
		date_default_timezone_set('Asia/Kolkata');
    }
	private function check_session(){
		if(isset($_SESSION['username']) && isset($_SESSION['AuthId'])){
			return true;
		}else{
			return false;
		}
	}
	public function signup()
	{
		if($this->check_session()) redirect(base_url().$_SESSION['username']);
		$data['title']="SignUp | CSQueries";
		$data['category']=$this->fetchContent_model->categories();
		$this->load->view('templates/Header',$data);
		$this->load->view('userManagementViews/Signup');
		$this->load->view('templates/Footer');

	}
	public function login()
	{
		if($this->check_session()) redirect(base_url().$_SESSION['username']);
		$data['title']="Login | CSQueries";
		$data['category']=$this->fetchContent_model->categories();
		$this->load->view('templates/Header',$data);
		$this->load->view('userManagementViews/Login');
		$this->load->view('templates/Footer');
	}
	public function isUsernameAvailable()
	{
		$username = $this->input->post('username');
		$result=$this->accessAccount_model->isUsernameValid($username);
		if(!empty($result)){
			return print_r ("Not Available");
		}else{
			return print_r ("Available");
		}
	}
	public function insertUserData(){     //Sending User registration data into database
		try{
			//if user does not clicks the submit button on signup page
			if(!isset($_POST['submit'])) throw new Exception("<b style='font-weight:bold;color:red;'>ERROR</b>: Direct Access not allowed.");	
			$displayName=strip_tags($_POST['displayName']);
			$userEmail = strip_tags($_POST['userEmail']);
			$username = strip_tags($_POST['usrname']);
			$psw = $_POST['psw'];
			$confrimPassword = $_POST['confirm-psw'];
			if(!empty($displayName)&& !empty($userEmail)&& !empty($username)&& !empty($psw)&& !empty($confrimPassword)){
				if($psw==$confrimPassword){
					$salt=bin2hex(random_bytes(10));   //It will generate a salt of 10*2=20 characters
					$encryptPass=md5($psw.$salt);		//Password encrypted using md5 encryption
					$userData = array('name' => $displayName,
					'Email' => $userEmail,
					'userName' => $username,
					'password' => $encryptPass,
					'salt' => $salt  );
					$status= $this->accessAccount_model->insertSignupData($userData);
					if($status){	//if all the data inserted properly into db
						$_SESSION['username']=$username;
						$_SESSION['AuthId']=$status['authorId'];
						$_SESSION['authorPicture']='having_doubts.png';
						if($this->createLinkForVerification($username)){
							redirect(base_url().$username.'/accountVerification');
						}else{
							$this->session->set_flashdata('error', 'Some Error occured During SignUp. Try again.');
							redirect(base_url()."Signup");
						}
					}else{		//If there is an error in inserting data into db
						$this->session->set_flashdata('error', 'Some Error occured During SignUp. Try again.');
						redirect(base_url()."Signup");
					}
				}else{		//If Passwords are not matched
					$this->session->set_flashdata('error', 'Passwords Did not matched.');
					redirect(base_url()."Signup");
				}
			}else{
				$this->session->set_flashdata('error', 'No fields can be <b>empty</b>.');
				redirect(base_url()."signup");
			}
		}
		catch (Exception $e)
		{
		    show_error($e->getMessage());
		}
	}
	public function checkLoginDetails(){	// checking if the login details given by the user is correct
		try{
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$status= $this->accessAccount_model->checkLoginData($username);
			if(!empty($status)){ //found the data on database
				if(sizeof($status)==1){	//if only 1 result found
					foreach ($status as $row) {
						$authorId=$row['AuthId'];
						$fetchedPass=$row['PassWord'];
						$passwordSalt=$row['PassWordSalt'];
						$isverified = $row['isVerified'];
						$picturePath = $row['Image'];
					}
					$encryptpassword=md5($password.$passwordSalt);
					// $encryptpassword=$epassword.$passwordSalt;
					if($fetchedPass==$encryptpassword){
						$_SESSION['AuthId']=$authorId;
						$_SESSION['username']=$username;
						$_SESSION['authorPicture']=$picturePath;
						if($isverified == 1){
							return print_r($username);
						}else{
							return print_r($username.'/accountVerification');
						}
					}else{
						$this->session->set_flashdata('error', "Passwords didn't matched.");
						return print_r("InValid");
					}
				}else{
					$this->session->set_flashdata('error', "Not Valid UserName or Password.");
					return print_r("InValid");
				}
			}else{
				$this->session->set_flashdata('error', "No UserName found.<a href='".base_url()."signup'> Create New Account</a>");
				return print_r("InValid");
			}
		}
		catch (Exception $e)
		{
		    show_error($e->getMessage());
		}
	}
	public function accountVerficationMessageShow(){	// showing user that they need to verify their ac to continue.
		if(!$this->check_session()) {
			$this->session->set_flashdata('error', "Oops!! It's looks like you are logged out.You must Login continue.");
				redirect(base_url().'login');
		}
		$data['title']="Account Verification | CSQueries";
		$data['category']=$this->fetchContent_model->categories();
		$this->load->view('templates/Header',$data);
		$this->load->view('userManagementViews/AccountVerificationMessage');
		$this->load->view('templates/Footer');
	}
	public function createLinkForVerification($uname){
		$randomNumbers = bin2hex(random_bytes(20));
		$url = base_url().$uname.'/verifyAccount/'.$randomNumbers;
		$status= $this->accessAccount_model->insertVerificationLink($uname,$randomNumbers);
		return $status;
	}
	public function resendVerificationLink(){
		$username = $_SESSION['username'];
		$this->createLinkForVerification($username);
		redirect(base_url().$username.'/accountVerification');
	}
	public function verifyAccount($username,$verificationCode){	//opening link and matching it with db. if valid then 																		account is verified.
		$link= $this->accessAccount_model->getVerificationLink($username);
		if(!empty($link)){
			if($this->isAccountVerified($username)){		//checking is account already verified
				redirect(base_url().$username);
			}else{
				foreach($link as $row){
					$code = $row['UniqueCode'];
					$authId = $row['AuthId'];
				}
				if($code == $verificationCode){	//if the link code and db latest code matches
					$mainData['status'] = true;
					$_SESSION['username'] = $username;
					$_SESSION['AuthId'] = $authId;
					$this->isVerifiedStatusUpdate($username);
				}else{
					$mainData['status'] = false;
				}
				$data['title']="Verify Account | CSQueries";
				$this->load->model("contentManagement/fetchContent_model");
				$data['category']=$this->fetchContent_model->categories();
				$this->load->view('templates/Header',$data);
				$this->load->view('userManagementViews/AccountVerifyStatus',$mainData);
				$this->load->view('templates/Footer');
			}
		}else{
			show_404();
		}
	}
	public function isVerifiedStatusUpdate($username){	//updating the status of isVerified column to verified
		$this->accessAccount_model->updateisVerifiedStatus($username);
	}
	public function isAccountVerified($username){	// checking the account verification status. verified or not?
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
    public function passwordResetLinkGenerate(){		//generating link for resetting password & sending in user's email
    	$useremail = filter_var($this->input->post('useremail'), FILTER_SANITIZE_EMAIL);//sanitizing email
    	$status = $this->accessAccount_model->isEmailExists($useremail);
    	if(!empty($status)){	//if only the email is valid and registered with us.
    		foreach($status as $row){
    			$username = $row['UserName'];
    		}
    		$reqTime = date("Y-m-d H:i:s");	//current date & time
    		$endTime = date("Y-m-d H:i:s", strtotime($reqTime . "+30 minutes"));	//link valid till endTime
    		$randomNumbers = bin2hex(random_bytes(20));
    		$insertStatus= $this->accessAccount_model->insertforgotPassWordLink($username,$randomNumbers,$endTime);
    		$forgotPassLink = base_url().'ResetPassword/'.$username.'/'.$randomNumbers.'/'.strtotime($reqTime);//generated 																									link
    		if($insertStatus) return print_r($forgotPassLink);
			else return print_r("Error in Sending mail. Please try again with proper details.");//  if the data is not 																inserted properly show error msg.
    	}else return print_r("Account Not found.");
    	
    }
    public function ResetPassword($username,$randomNumber,$endTime){//if the link is valid opening the reset password page
    	$isLinkDataValid = $this->accessAccount_model->getResetPassData($username);	//getting the reset password data for 																				particular username
    	if(!empty($isLinkDataValid)){	//checking if any data exits
    		foreach($isLinkDataValid as $row){
    			$getUsername = $row['UserName'];
    			$randomCode = $row['Randomcodes'];
    			$EndTime = $row['EndTime'];
    		}
    		$now = date("Y-m-d H:i:s");	//current date & time
    		if($randomNumber == $randomCode && $now <= $EndTime){	//checking if the link data is matching with our db 															data & link validity time is less.
	    		$data['title']="Reset Password | CSQueries";
				$data['category']=$this->fetchContent_model->categories();
				$this->load->view('templates/Header',$data);
				$this->load->view('userManagementViews/ResetPassword');
				$this->load->view('templates/Footer');
			}else show_404();	// if the code or time is not matched as required
    	}else show_404();	//if there is no data for that username
	}
	public function forgotPassLinkPasswordUpdate(){
		$username = $this->input->post('username');
		$psw = $this->input->post('password');
		$ConfirmPsw = $this->input->post('confirmPassword');
		$hiddenUsername = $this->input->post('hiddenUname');
		$result = $this->updatePassword($username,$psw,$ConfirmPsw,$hiddenUsername);
		return $result;
	}
	private function updatePassword($username,$psw,$ConfirmPsw,$hiddenUsername){	//updating the old password.
		if(!empty($username) && !empty($psw) && !empty($ConfirmPsw)){		//If one of the input field is empty
			if($psw == $ConfirmPsw && $username == $hiddenUsername){
				$salt=bin2hex(random_bytes(10));   //It will generate a salt of 10*2=20 characters
				$encryptPass=md5($psw.$salt);		//Password encrypted using md5 encryption
				$upadtedPassData = array('username' => $username,
				'salt' => $salt,
				'psw' => $encryptPass);
				$status = $this->accessAccount_model->updatePassword($upadtedPassData);
				if($status) return print_r("Passwords Updated SuccessFully.");
				else return print_r("Something Went Wrong. Try Again later.");
			}else return print_r("Password and Confirm Passwords are not identical.Check your username too.");
		}else return print_r("Enter all details Properly");
	}
	public function matchPasswords(){	//matching inputted password with db password before changing in profile
		$username = $this->input->post('username');
		$currentPsw = $this->input->post('currentPassword');
		$newPsw = $this->input->post('newPassword');
		$ConfirmPsw = $this->input->post('confirmPassword');
		$status= $this->accessAccount_model->checkLoginData($username);
		if(!empty($status)){ //found the data on database
			if(sizeof($status)==1){	//if only 1 result found
				foreach ($status as $row) {
					$authorId=$row['AuthId'];
					$fetchedPass=$row['PassWord'];
					$passwordSalt=$row['PassWordSalt'];
					$isverified = $row['isVerified'];
				}
				$encryptpassword=md5($currentPsw.$passwordSalt);
				if($encryptpassword == $fetchedPass){
					$result = $this->updatePassword($username,$newPsw,$ConfirmPsw,$username);
					return $result;
				}else return print_r("Previous passwords didn't match");
			}else return print_r("Something Went Wrong. Try Again later.");
		}else return print_r("Something Went Wrong. Try Again later.");
	}
}
//"E-Mail Sent SuccessFully. Check Your inbox for further Instructions."