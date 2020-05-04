<?php

class accessAccount_model extends CI_Model{
	public function insertSignupData($data){
		$query['Status'] = $this->db->query('insert into author(UserName,PassWord,PassWordSalt,Email,Name) values("'.$data['userName'].'","'.$data['password'].'","'.$data['salt'].'","'.$data['Email'].'","'.$data['name'].'")');
		$query['authorId'] = $this->db->insert_id();

		return $query;
	}
	public function isUsernamevalid($uname){
		$queryResult=$this->db->query('SELECT AuthId from author where UserName="'.$uname.'"');
		return $queryResult->result_array();
	}
	public function checkLoginData($uname){
		$result=$this->db->query('SELECT AuthId,PassWord,PassWordSalt,AuthId,isVerified from author where UserName="'.$uname.'"');
		return $result->result_array();
	}
	public function getUserData($uname){
		$queryResult=$this->db->query('SELECT author.*,count(contents.ContentId) as userUploadedQuestionNo,sum(contents.Views) as totalView from author,contents where UserName="'.$uname.'" AND contents.AuthId = author.AuthId');
		return $queryResult->result_array();
	}
	public function insertVerificationLink($uname,$ucode){
		$queryResult = $this->db->query('INSERT INTO verificationlinks(UserName,UniqueCode) VALUES("'.$uname.'","'.$ucode.'")');
		return $queryResult;
	}
	public function getVerificationLink($uname){
		$queryResult = $this->db->query('select Id,UserName,UniqueCode from verificationlinks where UserName="'.$uname.'"ORDER BY Id DESC LIMIT 1');
		return $queryResult->result_array();
	}
	public function updateisVerifiedStatus($uname){
		$queryResult=$this->db->query('UPDATE author SET isVerified = 1 WHERE UserName = "'.$uname.'"');
		return $queryResult;
	}
	public function isAccountVerified($uname){
		$queryResult = $this->db->query('SELECT isVerified from author WHERE UserName = "'.$uname.'"');
		return $queryResult->result_array();
	}
}
?>