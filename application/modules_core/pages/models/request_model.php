<?php
Class Request_model extends CI_Model{
	function __construct(){
		parent::__construct();
	}
	
	# get records
	function Get($title=NULL){
		$this->db->select('*');
		$this->db->from('book_request');
		# check if we're getting only one row or all records
		if($title != NULL){
			# getting only one row
			$this->db->where('title', $title);
			$this->db->limit('1');
			$query = $this->db->get();
			if($query->num_rows() == 1){
				# one row, match!
				return $query->row();
			}else{
				# none
				return FALSE;
			}
		}else{
			# get all
			$query = $this->db->get();
			if($query->num_rows() > 0){
				# get some rows, return as assoc array
				return $query->result();
			}else{
				# no rows
				return FALSE;
			}
		}
	}
	
	# add records
	function Add($data){
		$this->db->insert('book_request',$data);
		return $this->db->insert_id();
	}
	
	# edit records
	function Update($title,$data){
		$this->db->where('title',$title);
		$this->db->update('book_request',$data);
		return $this->db->insert_id();
	}
	
	# delete records
	function Delete($data){
		$this->db->where($data);
		$result = $this->db->delete('book_request');
		return $result;
	}
}