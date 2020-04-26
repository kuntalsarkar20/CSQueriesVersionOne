<?php
defined('BASEPATH') OR exit('No direct script access allowed');
session_start();

class accessAccount extends CI_Controller {

	public function check_session(){
		if(!isset($_SESSION['username'])){
			return false;
		}else{
			return true;
		}
	}
	public function signup()
	{
		$data['title']="SignUp | CSQueries";
		$this->load->view('templates/Header',$data);
		$this->load->view('userManagementViews/Signup');
		$this->load->view('templates/Footer');

	}
	public function login()
	{
		$data['title']="Login | CSQueries";
		$this->load->view('templates/Header',$data);
		$this->load->view('userManagementViews/Login');
		$this->load->view('templates/Footer');
	}
	public function isUsernameAvailable()
	{
		$username = $this->input->post('username');
		$this->load->model("userManagement/accessAccount_model");
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
			if($psw==$confrimPassword){
				$salt=bin2hex(random_bytes(10));   //It will generate a salt of 10*2=20 characters
				$encryptPass=md5($psw.$salt);		//Password encrypted using md5 encryption
				$userData = array('name' => $displayName,
				'Email' => $userEmail,
				'userName' => $username,
				'password' => $encryptPass,
				'salt' => $salt  );
				$this->load->model("userManagement/accessAccount_model");
				$status= $this->accessAccount_model->insertSignupData($userData);
				if($status){	//if all the data inserted properly into db
					$_SESSION['username']=$username;
					redirect(base_url().$username);
				}else{		//If there is an error in inserting data into db
					redirect(base_url()."Signup/failed");
				}
			}else{		//If Passwords are not matched
				redirect(base_url()."Signup/failed");
			}
		}
		// else{   //if anyone tries to run form_validate function directly.
		// 	redirect(base_url()."signup");
		// }
	}
	public function checkLoginDetails(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$this->load->model("userManagement/accessAccount_model");
		$status= $this->accessAccount_model->checkLoginData($username);
		if(!empty($status)){ //found the data on database
			if(sizeof($status)==1){	//if only 1 result found
				foreach ($status as $row) {
					$fetchedPass=$row['PassWord'];
					$passwordSalt=$row['PassWordSalt'];
				}
				$encryptpassword=md5($password.$passwordSalt);
				// $encryptpassword=$epassword.$passwordSalt;
				if($fetchedPass==$encryptpassword){
					$_SESSION['username']=$username;
					return print_r($username);
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
}