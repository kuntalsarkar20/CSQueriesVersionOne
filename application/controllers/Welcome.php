<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//session_start();
class Welcome extends CI_Controller {

	function __construct() {
        parent::__construct();
		$this->load->model("contentManagement/fetchContent_model");
		$this->load->model("userManagement/accessAccount_model");
		$this->load->model("HomeModels/HomePage_model");
		//$this->load->library('session');
    }
	public function index()
	{	
		$mainData['category1'] = $this->fetchContent_model->homeCategory1Question();
		$mainData['category2'] = $this->fetchContent_model->homeCategory2Question();
		$mainData['category3'] = $this->fetchContent_model->homeCategory3Question();
		$mainData['top3Contributers'] = $this->accessAccount_model->top3Contributers();
		$data['category']=$this->fetchContent_model->categories();
		$data['title']="Home | CSQueries";
		$this->load->view('templates/Header',$data);
		$this->load->view('HomeViews/Home',$mainData);
		$this->load->view('templates/Footer');
	}
	public function ShowContactUsPage(){
		$data['category']=$this->fetchContent_model->categories();
		$data['title']="Contact Us | CSQueries";
		$this->load->view('templates/Header',$data);
		$this->load->view('HomeViews/ContactUs');
		$this->load->view('templates/Footer');	
	}
	public function MeetTheDevelopers(){
		$data['category']=$this->fetchContent_model->categories();
		$data['title']="Meet The Developer Team | CSQueries";
		$this->load->view('templates/Header',$data);
		$this->load->view('HomeViews/MeetTheDevelopers');
		$this->load->view('templates/Footer');	
	}
	public function ShowPrivacyPolicy(){
		$data['category']=$this->fetchContent_model->categories();
		$data['title']="Privacy Policy | CSQueries";
		$this->load->view('templates/Header',$data);
		$this->load->view('HomeViews/PrivacyPolicy');
		$this->load->view('templates/Footer');	
	}
	public function ShowTermsAndConditions(){
		$data['category']=$this->fetchContent_model->categories();
		$data['title']="Privacy Policy | CSQueries";
		$this->load->view('templates/Header',$data);
		$this->load->view('HomeViews/TermsAndConditions');
		$this->load->view('templates/Footer');	
	}
	public function SendContactUsData(){
		try{
			if(!isset($_POST['SendThought'])) throw new Exception("<b style='font-weight:bold;color:red;'>ERROR</b>: Direct Access is not allowed");	//Showing error if anyone tries to directly access it
			if(empty($_POST['PersonName']) || empty($_POST['PersonEmail']) || empty($_POST['Thoughts'])) throw new Exception("<b style='font-weight:bold;color:red;'>ERROR</b>: No fields can be Empty!");	//showing error if any of the fields is empty
			$PersonName = htmlspecialchars($this->security->xss_clean($_POST['PersonName']));
			$PersonEmail = htmlspecialchars($this->security->xss_clean($_POST['PersonEmail']));
			$Message = htmlspecialchars($this->security->xss_clean($_POST['Thoughts']));
			$status= $this->HomePage_model->SendContactMessages($PersonName,$PersonEmail,$Message);
			if($status){
				$this->session->set_flashdata('success', 'Success');
				redirect(base_url().'ContactUs');
			} 
			else $this->session->set_flashdata('error', 'Somthing worng. Error!!');
		}
		catch (Exception $e)
		{
		    show_error($e->getMessage());
		}
		
	}
}
