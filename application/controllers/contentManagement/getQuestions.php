<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//session_start();

class getQuestions extends CI_Controller {
	function __construct() {
        parent::__construct();
		$this->load->model("contentManagement/fetchContent_model");
		$this->load->model("contentManagement/uploadContent_model");
    }
	public function ShowContents($category=NULL,$questionId =NULL ,$questionText=NULL){	//showing detail of a particular 																						question
		try{
			$data['category']=$this->fetchContent_model->categories();
			$mainData['question']=$this->fetchContent_model->questionDetails($questionId);
			$mainData['RelatedQuestionFromTopic'] = $this->fetchContent_model->getCategoryQuestionsWithLimit($category,0);	//getting question through 																								category,questionid
			if(!empty($mainData['question'])){	//if the url is valid
				foreach ($mainData['question'] as $row) {
					$mainData['contentId']= $row['ContentId'];
					$mainData['contentName']= $row['Question'];
					$mainData['contentDesc']= $row['Answer'];
					$mainData['creationTime']= $row['CreatedAt'];
					$mainData['Author']= $row['UserName'];
					$mainData['DashedQuestion'] = $row['DashedQuestion'];

					//for meta tags
					$data['title']= substr(str_replace('-', ' ', $row['DashedQuestion']),0,20)." | CSQueries";
					$data['ContentKeyWords'] = $row['ContentTags']; 
					$data['MetaDescription'] = substr(str_replace('-', ' ', $row['DashedQuestion']),0,100);

					if($mainData['creationTime'] == $row['UpdatedAt']){
						$mainData['updateTime'] = 'Never';
					}else{
						$mainData['updateTime'] = $row['UpdatedAt'];
					}

					if($row['isPublished']==0 && !isset($_SESSION['username'])){		//if the question is private and there 										is session then check for if the author and the session username same.
						$mainData['contentDesc'] = "This Question is <b>Private</b> by the Uploader. You can't view Until the user makes it <b>Public</b>.";
					}elseif($row['isPublished']==0 && isset($_SESSION['username'])){
						if($mainData['Author'] != $_SESSION['username']){	//if the author & session username not same then content can't be shown
							$mainData['contentDesc'] = "This Question is <b>Private</b> by the Uploader. You can't view Until the user makes it <b>Public</b>.";
						}
					}
				}
				$this->load->view('templates/Header',$data);
				$this->load->view('HomeViews/ShowContents',$mainData);
				$this->load->view('templates/Footer');
				$this->uploadContent_model->updateQuestionView($questionId);
			}else{				//No questions found on database
				show_404();
			}
		}catch (Exception $e)
		{
		    show_error($e->getMessage());
		}
	}
	// public function fetchQuestion($category=NULL,$questionId =NULL ,$questionText=NULL){	//returning details about a 																							particular question
	// 	$mainData['question']=$this->fetchContent_model->questionDetails($questionId);
	// 	$mainData['RelatedQuestionFromTopic']=$this->fetchContent_model->getCategoryQuestions($category);	
	// 	return $mainData;
	// }
	public function questionForTopic($category=NULL,$startingRange=0){//Showing question for a particular topic in category question view in content Management section 
		$startTime = $this->microtime_float();	//getting current time
		$data['title'] = 'Question List | CSQueries';
		$data['category']=$this->fetchContent_model->categories();
		$mainData['categoryQuestions']=$this->fetchContent_model->getCategoryQuestionsWithLimit($category,$startingRange);
		$mainData['countQuestionNumber'] = $this->fetchContent_model->countTotalQuestionCategory($category);
		foreach ($mainData['countQuestionNumber'] as $row ) { 	//getting the total number of question for a category which 															status is PUBLISHED
			$mainData['countQuestionNumber'] = $row['totalCategoryQuestion'];
		}
		$endTime = $this->microtime_float();	//getting current time
		$mainData['TimeTaken'] = $endTime - $startTime;	//determining the total time taken for searching
		$mainData['startLimit'] = $startingRange+1; 	//starting range to show in pagination
		$mainData['PageNo'] = ($startingRange>9 ? ($startingRange / 10) + 1 : 1); // for pagination active page
		if(!empty($mainData['categoryQuestions'])){
			$this->load->view('templates/Header',$data);
			$this->load->view('HomeViews/CategoryQuestions',$mainData);
			$this->load->view('templates/Footer');
		}else{				//No questions found on database
			show_404();
		}
	}
	public function relatedQuestionFromTopicDashboard($categoryId){//getting questions to show in the dashboard related 																			question section
		$mainData['categoryQuestions']=$this->fetchContent_model->getCategoryQuestions($categoryId);
		if(!empty($mainData['categoryQuestions'])){
			foreach ($mainData['categoryQuestions'] as $row) {
			echo '<div style="padding:10px 20px;"><b><a href="'.base_url().'questions/'.$row['CategoryName'].'/'.$row['ContentId'].'/'.$row['DashedQuestion'].'">'.$row['Question'].'</a></b></div>';
			}
		}else{
			echo "NO Questions Found";
		}

	}
	public function microtime_float(){		//for converting microtime
    	list($usec, $sec) = explode(" ", microtime());
    	return ((float)$usec + (float)$sec);
	}
	public function SearchResultView($searchString=NULL,$startingRange=0){
		$startTime = $this->microtime_float();
		$searchString = $this->security->xss_clean($searchString);
		$searchString = preg_replace('/[^A-Za-z0-9\-+]/', '+', $searchString);
		$searchString = str_replace('+', ' ', $searchString);
		$FullSearchResults = $this->fetchContent_model->SeacrhResults($searchString); 
		$mainData['SearchResults'] = $FullSearchResults['queryResult']->result_array();
		$NoOfResult = $FullSearchResults['totalQuestion']->result_array();
		foreach ($NoOfResult as $row ) { 
			$mainData['countQuestionNumber'] = $row['totalQuestionFound'];
		}

		$data['title'] = 'Search Result | CSQueries';
		$data['category']=$this->fetchContent_model->categories();

		$mainData['SearchString'] = $searchString;
		$endTime = $this->microtime_float();
		$mainData['TimeTaken'] = $endTime - $startTime;
		$this->load->view('templates/Header',$data);
		$this->load->view('HomeViews/SearchResults',$mainData);
		$this->load->view('templates/Footer');
	}
}