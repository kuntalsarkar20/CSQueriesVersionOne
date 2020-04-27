<?php
defined('BASEPATH') OR exit('No direct script access allowed');
session_start();

class uploadContentController extends CI_Controller {
	public function getData(){
		if(isset($_POST['publish'])){
			echo "hello";
		}
	}
	public function contentUploadUser(){
		if(isset($_POST['publish'])){
			$isPublish=true;
		}else if(isset($_POST['save'])){
			$isPublish=0;
		}
		$category = $_POST['category'];
		$contentHeading = $_POST['contentName'];
		$content = $_POST['contentDetails'];
		$contentData = array( 'authId' => $_SESSION['authId'],
			'category' => $category,
			'contentHeading' => $contentHeading,
			'content' => $content,
			'publishStatus' => $isPublish);
		$this->load->model("contentManagement/uploadContent_model");
		$result = $this->uploadContent_model->uploadContents($contentData);
	}

}
?>