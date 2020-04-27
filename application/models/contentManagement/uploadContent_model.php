<?php

class uploadContent_model extends CI_Model{
	public function uploadContents($contentData){
		$queryResult = $this->db->query('INSERT INTO contents(AuthId,Question,Answer,CategoryId,isPublished) VALUES()');
	}
}
?>