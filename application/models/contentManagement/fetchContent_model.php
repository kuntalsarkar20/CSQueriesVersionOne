<?php

class fetchContent_model extends CI_Model{
	public function categories(){
		$queryResult=$this->db->query('SELECT * from category');
		return $queryResult->result_array();
	}
}
?>