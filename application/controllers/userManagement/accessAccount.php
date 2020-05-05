<?php
defined('BASEPATH') OR exit('No direct script access allowed');
session_start();

class accessAccount extends CI_Controller {

	function __construct() {
        parent::__construct();
		$this->load->model("contentManagement/fetchContent_model");
		$this->load->model("userManagement/accessAccount_model");
    }
	public function check_session(){
		if(isset($_SESSION['username']) && isset($_SESSION['AuthId'])){
			return true;
		}else{
			return false;
		}
	}
	public function signup()
	{
		$data['title']="SignUp | CSQueries";
		$data['category']=$this->fetchContent_model->categories();
		$this->load->view('templates/Header',$data);
		$this->load->view('userManagementViews/Signup');
		$this->load->view('templates/Footer');

	}
	public function login()
	{
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
		if(isset($_POST['submit'])){      //if user clicks the submit button on signup page
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
					if($this->createLinkForVerification($username)){
						redirect(base_url().$username.'/accountVerification');
					}else{
						redirect(base_url()."Signup/failed");
					}
				}else{		//If there is an error in inserting data into db
					redirect(base_url()."Signup/failed");
				}
			}else{		//If Passwords are not matched
				redirect(base_url()."Signup/failed");
			}
		}else{
			redirect(base_url()."signup/failed");
		}
	}else{   //if anyone tries to run form_validate function directly.
			redirect(base_url()."signup");
		}
	}
	public function checkLoginDetails(){
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
				}
				$encryptpassword=md5($password.$passwordSalt);
				// $encryptpassword=$epassword.$passwordSalt;
				if($fetchedPass==$encryptpassword){
					$_SESSION['AuthId']=$authorId;
					$_SESSION['username']=$username;
					if($isverified == 1){
						return print_r($username);
					}else{
						return print_r($username.'/accountVerification');
					}
				}else{
					return print_r("InValid");
				}
			}else{
				return print_r("InValid");
			}
		}else{
			return print_r("InValid");
		}
	}
	public function accountVerficationMessageShow(){
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
	public function verifyAccount($username,$verificationCode){
		$link= $this->accessAccount_model->getVerificationLink($username);
		if(!empty($link)){
			if($this->isAccountVerified($username)){		//checking is account already verified
				redirect(base_url().$username);
			}else{
				foreach($link as $row){
					$code = $row['UniqueCode'];
					$authId = $row['AuthId'];
				}
				if($code == $verificationCode){
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
	public function isVerifiedStatusUpdate($username){
		$this->accessAccount_model->updateisVerifiedStatus($username);
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
    public function passwordResetLinkGenerate(){
    	date_default_timezone_set('Asia/Kolkata');
    	$useremail = filter_var($this->input->post('useremail'), FILTER_SANITIZE_EMAIL);
    	$status = $this->accessAccount_model->isEmailExists($useremail);
    	if(!empty($status)){
    		foreach($status as $row){
    			$username = $row['UserName'];
    		}
    		$reqTime = date("Y-m-d H:i:s");
    		$endTime = date("Y-m-d H:i:s", strtotime($reqTime . "+30 minutes"));
    		$randomNumbers = bin2hex(random_bytes(20));
    		$insertStatus= $this->accessAccount_model->insertforgotPassWordLink($username,$randomNumbers,$endTime);
    		$forgotPassLink = base_url().'ResetPassword/'.$username.'/'.$randomNumbers.'/'.strtotime($reqTime);
    		if($insertStatus){
    			return print_r($forgotPassLink);
    		}else{
    			return print_r("Error in Sending mail. Please try again with proper details.");
    		}
    	}else{
    		return print_r("Account Not found.");
    	}
    	
    }
    public function ResetPassword($username,$randomNumber,$endTime){
		$data['title']="Reset Password | CSQueries";
		$data['category']=$this->fetchContent_model->categories();
		$this->load->view('templates/Header',$data);
		$this->load->view('userManagementViews/ResetPassword');
		$this->load->view('templates/Footer');
	}
	public function uploadNewPassword(){
		$username = $this->input->post('username');
		$psw = $this->input->post('password');
		$ConfirmPsw = $this->input->post('confirmPassword');
		if(!empty($username) && !empty($psw) && !empty($ConfirmPsw)){		//If one of the input field is empty
			if($psw == $ConfirmPsw){
				$salt=bin2hex(random_bytes(10));   //It will generate a salt of 10*2=20 characters
				$encryptPass=md5($psw.$salt);		//Password encrypted using md5 encryption
				$upadtedPassData = array('username' => $username,
				'salt' => $salt,
				'psw' => $encryptPass);
				$status = $this->accessAccount_model->updatePassword($upadtedPassData);
				if($status){
					return print_r("Passwords Updated SuccessFully.");
				}else{
					return print_r("Something Went Wrong. Try Again later.");
				}
			}else{
				return print_r("Password and Confirm Passwords are not identical.");
			}
		}else{
			return print_r("Enter all details Properly");
		}
		return print_r($psw." / ".$ConfirmPsw);
	}
}
//"E-Mail Sent SuccessFully. Check Your inbox for further Instructions."