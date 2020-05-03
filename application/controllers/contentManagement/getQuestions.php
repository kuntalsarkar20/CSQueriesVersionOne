<?php
defined('BASEPATH') OR exit('No direct script access allowed');
session_start();

class getQuestions extends CI_Controller {
	function __construct() {
        parent::__construct();
		$this->load->model("contentManagement/fetchContent_model");
		$this->load->model("contentManagement/uploadContent_model");
    }
	public function ShowContents($category=NULL,$questionId =NULL ,$questionText=NULL){
		$data['category']=$this->fetchContent_model->categories();
		$mainData = $this->fetchQuestion($category,$questionId,$questionText);
		if(!empty($mainData['question'])){
			$data['title']="Questions | CSQueries";
			$this->load->view('templates/Header',$data);
			$this->load->view('HomeViews/ShowContents',$mainData);
			$this->load->view('templates/Footer');
			$this->uploadContent_model->updateQuestionView($questionId);
		}else{				//No questions found on database
			show_404();
		}
	}
	public function fetchQuestion($category=NULL,$questionId =NULL ,$questionText=NULL){
		$mainData['question']=$this->fetchContent_model->questionDetails($questionId);
		$mainData['RelatedQuestionFromTopic']=$this->fetchContent_model->getCategoryQuestions($category);	
		return $mainData;
	}
	public function questionForTopic($category=NULL){
		$mainData['categoryQuestions']=$this->fetchContent_model->getCategoryQuestions($category);
		if(!empty($mainData['categoryQuestions'])){
			foreach ($mainData['categoryQuestions'] as $row) {
			echo '<div style="padding:10px 20px;"><b><a href="'.base_url().'questions/'.$row['CategoryName'].'/'.$row['ContentId'].'/'.$row['DashedQuestion'].'">'.$row['Question'].'</a></b></div>';
			}
		}else{				//No questions found on database
			show_404();
		}
	}
}