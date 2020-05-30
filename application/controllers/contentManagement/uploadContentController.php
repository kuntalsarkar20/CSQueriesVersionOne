<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//session_start();

class uploadContentController extends CI_Controller {
	function __construct() {
        parent::__construct();
		$this->load->model("contentManagement/uploadContent_model");
		date_default_timezone_set('Asia/Kolkata');
    }
	public function contentUploadUser(){
		try{
			if(isset($_POST['publish'])){
				$isPublish=true;
			}else if(isset($_POST['save'])){ 
				$isPublish=0;
			}else throw new Exception("<b style='font-weight:bold;color:red;'>ERROR</b>: Direct access is not allowed.");

			$category = $_POST['category'];
			$contentHeading = addslashes($_POST['contentName']);
			$content = addslashes($_POST['contentDetails']);
			$ContentTag = htmlentities($_POST['contentTags']);
			if(!empty($category) && !empty($contentHeading) && !empty($ContentTag)){   //checking if the category or content heading is empty
				$dashedContent = str_replace(" ", "-", $contentHeading);
				$dashedContent = preg_replace('/[^A-Za-z0-9\-]/', '', $dashedContent);
				$dashedContent = (strlen($dashedContent) > 100) ? substr($dashedContent,0,100) : $dashedContent;
				$contentData = array( 'authId' => $_SESSION['AuthId'],
					'category' => $category,
					'contentHeading' => $contentHeading,
					'dashed' => $dashedContent,
					'content' => $content,
					'ContentTags' => $ContentTag,
					'publishStatus' => $isPublish);
				$result = $this->uploadContent_model->uploadContents($contentData);
				if($result){
					$this->session->set_flashdata('success', 'Your Content is Uploaded Successfully.');
					redirect(base_url().$_SESSION['username'].'/myContents/');
				}else throw new Exception("<b style='font-weight:bold;color:red;'>ERROR</b>: Some unknown error encountered. Try again later.");
			}else throw new Exception("<b style='font-weight:bold;color:red;'>ERROR</b>: Category Name or Content Heading or Content Tag Con not be empty.");
		}
		catch(exception $e){
			show_error($e->getMessage());
		}
	}
	public function uploadContentImages(){
		try{
			if(isset($_FILES['upload']['name'])){
				$file = $_FILES['upload']['tmp_name'];
				$file_name = $_FILES['upload']['name'];
				$file_size = $_FILES['upload']['size'];
				$function_number = $_GET['CKEditorFuncNum'];
				$url = '';
				if($file_size>600000){
					 throw new Exception("<b style='font-weight:bold;color:red;'>ERROR</b>: Image Size should be within 600 KB.");
					 
				}
				$file_type = getimagesize($file);
				function compress_image($source_url, $destination_url, $quality)
			    {
			        $info = getimagesize($source_url);
			        if ($info['mime'] == 'image/jpeg') $image = imagecreatefromjpeg($source_url);
			        elseif ($info['mime'] == 'image/gif') $image = imagecreatefromgif($source_url);
			        elseif ($info['mime'] == 'image/png') $image = imagecreatefrompng($source_url);
			        imagejpeg($image, $destination_url, $quality);
			        // echo "Image uploaded successfully.";
			    }
				if($file_size<=200000) $imageQuality = 30;
			    else if($file_size<=400000) $imageQuality = 20;
			    else if($file_size<=600000) $imageQuality = 10;
			    else $imageQuality = 10;

				$file_name_array = explode(".",$file_name);
				$extension = end($file_name_array);
				$new_image_name = date("d-m-Y-H-i-s").$_SESSION['username'].rand().'.'.$extension;
				$allowed_extension = array("image/jpeg","image/gif","image/png");
				if(in_array($file_type['mime'],$allowed_extension)){
					compress_image($file, './assets/images/contentImagesByUser/'.$new_image_name, $imageQuality);
					// $function_number = $_GET['CKEditorFuncNum'];
					$url = base_url().'assets/images/contentImagesByUser/'.$new_image_name;
					$message = 'Uploaded';
					echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction($function_number,'$url','$message');</script>";
				}else throw new Exception("<b style='font-weight:bold;color:red;'>ERROR</b>: Image Should be of .jpg,.png or .gif type.");
			}else show_error("<b style='font-weight:bold;color:red;'>ERROR</b>: Direct access is not allowed.");
		}
		catch (Exception $e)
		{
			$message = $e->getMessage();
			echo $message;
		}
	}
	public function editContent(){
		try{
			if(isset($_POST['update'])){
				$userClick = 'update';
			}elseif(isset($_POST['updateAndToggle'])){
				$userClick = 'updateAndToggle';
			}else throw new Exception("<b style='font-weight:bold;color:red;'>ERROR</b>: Direct access is not allowed.");
			$cId = $_POST['ContentId'];
			$category = $_POST['category'];
			$contentHeading = htmlentities(addslashes($_POST['contentName']));
			$content = addslashes($_POST['contentDetails']);
			$ContentTag = htmlentities($_POST['Ctag']);
			if(!empty($category) && !empty($contentHeading) && !empty($ContentTag)){   //checking if the category or content heading is empty
				$dashedContent = str_replace(" ", "-", $contentHeading);
				$dashedContent = preg_replace('/[^A-Za-z0-9\-]/', '', $dashedContent);
				$dashedContent = (strlen($dashedContent) > 80) ? substr($dashedContent,0,80) : $dashedContent;
				$contentData = array( 'ContentId' => $cId,
					'category' => $category,
					'contentHeading' => $contentHeading,
					'dashed' => $dashedContent,
					'content' => $content,
					'contentTag' => $ContentTag);
				if($userClick=='update'){
					$result = $this->uploadContent_model->updateContent($contentData);
					// echo "ok";
				}elseif($userClick=='updateAndToggle'){
					$result = $this->uploadContent_model->updateContentAndToggle($contentData);
				}else{
					$result='';
				}
				if($result){
					$this->session->set_flashdata('success', 'Your Content is Uploaded Successfully.');
					redirect(base_url().$_SESSION['username'].'/myContents/');
				}else{
					redirect($_SERVER['HTTP_REFERER'].'/UpdateFailed');
				}
			}else throw new Exception("<b style='font-weight:bold;color:red;'>ERROR</b>: Category Name or Content Heading or Content Tag Con not be empty.");
		}
		catch(exception $e){
			show_error($e->getMessage());
		}
	}
	public function ReqCategory(){
		try{
			if(!isset($_POST['ReqCategory']) || !$this->isSessionAvailable()) throw new Exception("<b style='font-weight:bold;color:red;'>ERROR</b>: Direct access is not allowed.");
			$ReqCategoryName = $_POST['categoryName'];
			$ReqCategoryDesc = $_POST['categoryDesc'];
			if(empty($ReqCategoryName)) throw new Exception("<b style='font-weight:bold;color:red;'>ERROR</b>: Category Name can't be empty.");
			$returnedStatus = $this->uploadContent_model->addRequestedCategory($ReqCategoryName,$ReqCategoryDesc,$_SESSION['AuthId']);
			if($returnedStatus){
				$this->session->set_flashdata('success', 'Thank you for your Request. We received the request Successfully.');
				redirect(base_url().$_SESSION['username'].'/dashboard/');
			}else{
				$this->session->set_flashdata('error', 'Some error occured. Try again later.');
				redirect(base_url().$_SESSION['username'].'/dashboard/');
			}
		}
		catch(exception $e){
			show_error($e->getMessage());
		}
	}
	private function isSessionAvailable(){
		if(isset($_SESSION['username']) && isset($_SESSION['AuthId'])){
			return true;
		}else{
			return false;
		}
	}
}
?>