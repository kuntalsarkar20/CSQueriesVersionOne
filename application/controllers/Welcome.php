<?php
defined('BASEPATH') OR exit('No direct script access allowed');
session_start();
class Welcome extends CI_Controller {

	function __construct() {
        parent::__construct();
		$this->load->model("contentManagement/fetchContent_model");
    }
	public function index()
	{	
		$mainData['category1'] = $this->fetchContent_model->homeCategory1Question();
		$mainData['category2'] = $this->fetchContent_model->homeCategory2Question();
		$mainData['category3'] = $this->fetchContent_model->homeCategory3Question();
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
}
