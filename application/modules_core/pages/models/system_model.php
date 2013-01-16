<?php
class System_model extends CI_Model {
	
	function __construct(){
		parent::__construct();
	}
	
	# get user info
	function get($id = NULL){
		$this->db->select('*');
		$this->db->from('system');
		# check if we're getting only one row or all records
		if($id != NULL){
			# getting only one row
			$this->db->where('ower_id', $id);
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

	# add new user profile info
	function Add($data){
		$this->db->insert('system',$data);
		return $this->db->insert_id();
	}

}
