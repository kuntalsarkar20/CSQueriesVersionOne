<?php

class fetchContent_model extends CI_Model{
	public function categories(){
		$queryResult=$this->db->query('SELECT * from category');
		return $queryResult->result_array();
	}
	public function questionDetails($questionId){
		$queryResult = $this->db->query('SELECT * FROM contents,author WHERE ContentId="'.$questionId.'" AND contents.AuthId=author.AuthId');
		return $queryResult->result_array();
	}
	public function getCategoryQuestions($category){
		$queryResult = $this->db->query('SELECT * FROM contents,category WHERE category.CategoryName="'.$category.'" AND category.CategoryId=contents.CategoryId AND isPublished=1');
		return $queryResult->result_array();
	}
}
?>