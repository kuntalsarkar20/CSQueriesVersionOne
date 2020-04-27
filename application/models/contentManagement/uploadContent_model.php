<?php

class uploadContent_model extends CI_Model{
	public function uploadContents($contentData){
		$queryResult = $this->db->query('INSERT INTO contents(AuthId,Question,DashedQuestion,Answer,CategoryId,isPublished) VALUES("'.$contentData['authId'].'","'.$contentData['contentHeading'].'","'.$contentData['dashed'].'","'.$contentData['content'].'","'.$contentData['category'].'","'.$contentData['publishStatus'].'")');
		return $queryResult;
	}
}
?>