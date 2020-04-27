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
		try{
			if(isset($_POST['publish'])){
				$isPublish=true;
			}else if(isset($_POST['save'])){
				$isPublish=0;
			}
			$category = $_POST['category'];
			$contentHeading = $_POST['contentName'];
			$content = $_POST['contentDetails'];
			if(!empty($category) && !empty($contentHeading)){
				$dashedContent = str_replace(" ", "-", $contentHeading);
				$contentData = array( 'authId' => $_SESSION['AuthId'],
					'category' => $category,
					'contentHeading' => $contentHeading,
					'dashed' => $dashedContent,
					'content' => $content,
					'publishStatus' => $isPublish);
				$this->load->model("contentManagement/uploadContent_model");
				$result = $this->uploadContent_model->uploadContents($contentData);
				if($result){
					redirect(base_url().$_SESSION['username'].'/UploadSuccess');
				}else{
					redirect(base_url().$_SESSION['username'].'/UploadFailed');
				}
			}else{
				redirect(base_url().$_SESSION['username'].'/UploadFailed');
			}
		}
		catch(exception $e){
			redirect(base_url().$_SESSION['username']);
		}
	}

}
?>