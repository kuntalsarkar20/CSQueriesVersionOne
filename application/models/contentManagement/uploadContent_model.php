<?php

class uploadContent_model extends CI_Model{
	public function uploadContents($contentData){
		$queryResult = $this->db->query('INSERT INTO contents(AuthId,Question,DashedQuestion,Answer,ContentTags, CategoryId,isPublished) VALUES("'.$contentData['authId'].'","'.$contentData['contentHeading'].'","'.$contentData['dashed'].'","'.$contentData['content'].'","'.$contentData['ContentTags'].'","'.$contentData['category'].'","'.$contentData['publishStatus'].'")');
		return $queryResult;
	}
	public function updateContent($contentData){
		$queryResult = $this->db->query('UPDATE contents SET Question = "'.$contentData['contentHeading'].'",DashedQuestion = "'.$contentData['dashed'].'" ,Answer = "'.$contentData['content'].'",ContentTags = "'.$contentData['contentTag'].'",CategoryId = "'.$contentData['category'].'" WHERE ContentId = "'.$contentData['ContentId'].'"');
		return $queryResult;
	}
	public function updateContentAndToggle($contentData){	//isPublished status will toggle in this
		$queryResult = $this->db->query('UPDATE contents SET Question = "'.$contentData['contentHeading'].'",DashedQuestion = "'.$contentData['dashed'].'" ,Answer = "'.$contentData['content'].'" ,ContentTags = "'.$contentData['contentTag'].'",CategoryId = "'.$contentData['category'].'", isPublished = case when isPublished=1 then 0 else 1 end WHERE ContentId = "'.$contentData['ContentId'].'"');
		return $queryResult;
	}
	public function updateQuestionView($contentId){		//for updating the question views
		$queryResult = $this->db->query('UPDATE contents SET Views = Views+1 WHERE ContentId = "'.$contentId.'"');
	}
	public function addRequestedCategory($categoryName,$Desc,$authId){
		$queryResult = "INSERT INTO requestedcategory(CategoryName,Description,ReqAuthId) VALUES(?,?,?)";
		$status= $this->db->query($queryResult, [$categoryName,''.$Desc.'',''.$authId.'']);
		return $status;
	}
}
?>