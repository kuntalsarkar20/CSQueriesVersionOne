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
		$result=$this->db->query('SELECT AuthId,PassWord,PassWordSalt,AuthId from author where UserName="'.$uname.'"');
		return $result->result_array();
	}
}
?>