<?php
defined('BASEPATH') OR exit('No direct script access allowed');
session_start();

class getQuestions extends CI_Controller {
	public function fetchQuestion($category=NULL,$questionId =NULL ,$questionText=NULL){
		$this->load->model("contentManagement/fetchContent_model");
		$mainData['question']=$this->fetchContent_model->questionDetails($questionId);
		$mainData['RelatedQuestionFromTopic']=$this->fetchContent_model->getCategoryQuestions($category);
		$this->load->model("contentManagement/fetchContent_model");
		$data['category']=$this->fetchContent_model->categories();
		if(!empty($mainData['question'])){
			$data['title']="Questions | CSQueries";
			$this->load->view('templates/Header',$data);
			$this->load->view('HomeViews/ShowContents',$mainData);
			$this->load->view('templates/Footer');
		}else{				//No questions found on database
			show_404();
		}
	}
	public function questionForTopic($category=NULL){
		$this->load->model("contentManagement/fetchContent_model");
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