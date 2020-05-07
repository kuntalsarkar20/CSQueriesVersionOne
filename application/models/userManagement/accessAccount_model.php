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
		$queryResult = $this->db->query('select verificationlinks.Id, verificationlinks.UserName, verificationlinks.UniqueCode, author.AuthId from verificationlinks, author where verificationlinks.UserName="'.$uname.'" AND author.UserName = verificationlinks.UserName ORDER BY Id DESC LIMIT 1');
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
	public function isEmailExists($useremail){		//checking if a email exits
		$queryResult = $this->db->query('SELECT UserName from author WHERE Email = "'.$useremail.'"');
		return $queryResult->result_array();
	}
	public function insertforgotPassWordLink($username,$randomNumbers,$endTime){
		$queryResult = $this->db->query('INSERT INTO forgotpasswordlog(UserName,RandomCodes,EndTime) VALUES("'.$username.'","'.$randomNumbers.'","'.$endTime.'")');
		return $queryResult;
	}
	public function updatePassword($data){
		$queryResult = $this->db->query('UPDATE author SET PassWord = "'.$data['psw'].'",PassWordSalt = "'.$data['salt'].'" WHERE UserName = "'.$data['username'].'"');
		return $queryResult;
	}
	public function getResetPassData($username){	//to get data about a particular username
		$queryResult = $this->db->query('SELECT * FROM forgotpasswordlog WHERE UserName = "'.$username.'" ORDER BY LogId DESC Limit 1');
		return $queryResult -> result_array();
	}
}
?>