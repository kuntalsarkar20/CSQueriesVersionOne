<?php

class fetchContent_model extends CI_Model{
	public function categories(){		//for getting all the categories from the category table
		$queryResult=$this->db->query('SELECT * from category');
		return $queryResult->result_array();
	}
	public function questionDetails($questionId){	//gets Full quesion and that's author details for a particular question
		$queryResult = $this->db->query('SELECT * FROM contents,author WHERE ContentId="'.$questionId.'" AND contents.AuthId=author.AuthId');
		return $queryResult->result_array();
	}
	public function getCategoryQuestions($category){	//gets question for a particular category
		$queryResult = $this->db->query('SELECT * FROM contents,category,author WHERE category.CategoryName="'.$category.'" AND category.CategoryId=contents.CategoryId AND author.AuthId = contents.AuthId AND isPublished=1 order by contents.views DESC,contents.CreatedAt DESC');
		return $queryResult->result_array();
	}
	public function getUserQuestionList($username){		//gets question for a particular author
		$queryResult = $this->db->query('SELECT contents.*,category.CategoryName FROM contents,author,category WHERE author.UserName = "'.$username.'" AND author.AuthId = Contents.AuthId AND contents.CategoryId=category.CategoryId ORDER BY contents.CreatedAt DESC');
		return $queryResult->result_array();
	}
	public function homeCategory1Question(){	//gets 3 question to show in the home page of category DBMS
		$queryResult = $this->db->query('SELECT * FROM contents,category WHERE contents.CategoryId=1 AND category.CategoryId = contents.CategoryId AND contents.isPublished = 1 order by views DESC,CreatedAt DESC Limit 3');
		return $queryResult->result_array();
	}
	public function homeCategory2Question(){	//gets 3 question to show in the home page of category DataStructure
		$queryResult = $this->db->query('SELECT * FROM contents,category WHERE contents.CategoryId=2 AND category.CategoryId = contents.CategoryId AND contents.isPublished = 1 order by views DESC,CreatedAt DESC Limit 3');
		return $queryResult->result_array();
	}
	public function homeCategory3Question(){	//gets 3 question to show in the home page of category NetWorking
		$queryResult = $this->db->query('SELECT * FROM contents,category WHERE contents.CategoryId=3 AND category.CategoryId = contents.CategoryId AND contents.isPublished = 1 order by views DESC,CreatedAt DESC Limit 3');
		return $queryResult->result_array();
	}
	public function getCategoryQuestionsWithLimit($category,$startRange){//gets question for a particullar category with 																			limit of question for pagination
		$queryResult = $this->db->query('SELECT * FROM contents,category,author WHERE category.CategoryName="'.$category.'" AND category.CategoryId=contents.CategoryId AND author.AuthId = contents.AuthId AND isPublished=1 order by contents.views DESC,contents.CreatedAt DESC Limit '.$startRange.',10');
		return $queryResult->result_array();
	}
	public function countTotalQuestionCategory($category){
		$queryResult = $this->db->query('SELECT count(contents.ContentId) as totalCategoryQuestion from contents,category where category.CategoryName="'.$category.'" AND category.CategoryId=contents.CategoryId AND isPublished=1');
		return $queryResult->result_array();
	}
	public function SeacrhResults($searchString){
		$Result['queryResult'] = $this->db->query('SELECT MATCH(Contents.ContentTags,Contents.Question,Contents.Answer) AGAINST("'.$searchString.'") AS relevance,Contents.*,author.*,category.* FROM contents,author,category WHERE MATCH(Contents.ContentTags,Contents.Question,Contents.Answer) AGAINST("'.$searchString.'") AND Contents.AuthId = author.AuthId AND Contents.CategoryId=category.CategoryId AND contents.isPublished = 1 ORDER BY relevance DESC,Contents.Views DESC,Contents.CreatedAt DESC;');
		$Result['totalQuestion'] = $this->db->query('SELECT MATCH(Contents.ContentTags,Contents.Question,Contents.Answer) AGAINST("'.$searchString.'") AS relevance,Contents.*,author.*,category.*,count(contents.ContentId) as totalQuestionFound FROM contents,author,category WHERE MATCH(Contents.ContentTags,Contents.Question,Contents.Answer) AGAINST("'.$searchString.'") AND Contents.AuthId = author.AuthId AND Contents.CategoryId=category.CategoryId AND contents.isPublished = 1 ORDER BY relevance DESC,Contents.Views DESC,Contents.CreatedAt DESC;');
		return $Result;
	}
}
?>