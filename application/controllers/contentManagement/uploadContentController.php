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
			$contentHeading = addslashes($_POST['contentName']);
			$content = addslashes($_POST['contentDetails']);
			if(!empty($category) && !empty($contentHeading)){
				$dashedContent = str_replace(" ", "-", $contentHeading);
				$dashedContent = preg_replace('/[^A-Za-z0-9\-]/', '', $dashedContent);
				$dashedContent = (strlen($dashedContent) > 80) ? substr($dashedContent,0,80) : $dashedContent;
				$contentData = array( 'authId' => $_SESSION['AuthId'],
					'category' => $category,
					'contentHeading' => $contentHeading,
					'dashed' => $dashedContent,
					'content' => $content,
					'publishStatus' => $isPublish);
				$this->load->model("contentManagement/uploadContent_model");
				$result = $this->uploadContent_model->uploadContents($contentData);
				if($result){
					redirect(base_url().$_SESSION['username'].'/myContents/UploadSuccess');
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
	public function uploadContentImages(){
		if(isset($_FILES['upload']['name'])){
			$file = $_FILES['upload']['tmp_name'];
			$file_name = $_FILES['upload']['name'];
			$file_name_array = explode(".",$file_name);
			$extension = end($file_name_array);
			$new_image_name = rand().'.'.$extension;
			$this->load->library('upload'); // do the job
			chmod(base_url() .'assets/images/contentImagesByUser',0777);
			$allowed_extension = array("jpg","png","gif");
			if(in_array($extension,$allowed_extension)){
				move_uploaded_file($file, './assets/images/contentImagesByUser/'.$new_image_name);
				$function_number = $_GET['CKEditorFuncNum'];
				$url = base_url().'assets/images/contentImagesByUser/'.$new_image_name;
				$message = 'Uploaded';
				echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction($function_number,'$url','$message');</script>";
			}
		}
	}

}
?>