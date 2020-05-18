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
		$result=$this->db->query('SELECT AuthId,PassWord,PassWordSalt,AuthId,isVerified,Image from author where UserName="'.$uname.'"');
		return $result->result_array();
	}
	public function getUserData($uname){
		$queryResult=$this->db->query('SELECT author.*,count(contents.ContentId) as userUploadedQuestionNo,sum(contents.Views) as totalView from author,contents where author.UserName="'.$uname.'" AND contents.AuthId = author.AuthId');
		return $queryResult->result_array();
	}
	public function getAuthorExperience($authorUsername){
		$queryResult=$this->db->query('SELECT * FROM authorexperienced,author WHERE author.UserName = "'.$authorUsername.'" AND authorexperienced.AuthId = author.AuthId');
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
	public function updateUserDetails($data){
		$queryResult = "UPDATE author SET AuthorCollege = ? ,Degree = ? ,YearOfGraduation = ? ,About = ? WHERE AuthId = ?";
		$status= $this->db->query($queryResult, [''.$data['college'].'',''.$data['degree'].'',$data['graduationYear'],''.$data['about'].'',''.$data['authorId'].'']);
		return $status;
	}
	public function updateUserPicture($imageName,$AuthorId){
		$queryResult = "UPDATE author SET Image = ? WHERE AuthId = ?";
		$status= $this->db->query($queryResult, [''.$imageName.'',''.$AuthorId.'']);
		return $status;
	}
	public function updateUserKnownTopics($id,$topics){
		$queryResult = "insert into authorexperienced(AuthId,Topics) values(?,?) on duplicate key update Topics = ?;";
		$status= $this->db->query($queryResult, [$id,''.$topics.'',''.$topics.'']);
		return $status;
	}
	public function top3Contributers(){	//getting the details of top 3 contributers of Homepage
		$queryResult = $this->db->query('select * from author,contents where contents.AuthId = author.AuthId group by author.AuthId order by count(contents.AuthId) DESC limit 3');
		return $queryResult->result_array();
	}	
}
?>