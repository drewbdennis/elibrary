<?php
class Profile_model extends CI_Model {
	
	function __construct(){
		parent::__construct();
	}
	
	# get user profile info
	function Get($system_id = NULL){
		$this->db->select('*');
		$this->db->from('user_profile');
		# check if we're getting only one row or all records
		if($system_id != NULL){
			# getting only one row
			$this->db->where('system_id', $system_id);
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
		$this->db->insert('user_profile',$data);
		return $this->db->insert_id();
	}
	
	# edit user profile info
	function Edit($id, $data){
		$this->db->where('id',$id);
		$result = $this->db->update('user_profile', $data);
		# return
		if($result){
			return $id;
		}else{
			return FALSE;
		}
	}
}
