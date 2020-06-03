<?php
class HomePage_model extends CI_Model{
	public function SendContactMessages($PersonName,$PersonEmail,$Message){
		$queryResult = "INSERT INTO contactmessages(Name,Email,Message) VALUES(?,?,?)";
		$status= $this->db->query($queryResult, [''.$PersonName.'',''.$PersonEmail.'',''.$Message.'']);
		return $status;
	}	
}
?>