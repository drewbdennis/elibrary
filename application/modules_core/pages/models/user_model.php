<?php
class User_model extends CI_Model {
	
	function __construct(){
		parent::__construct();
	}
	
	# check user login details
	function check_login($username,$password){
		#set query string to null
		$query_str = null;
		#hash user password using sha1
		$hashed_password = sha1($password.$password);	
		#check if email was enter
		if(filter_var($username,FILTER_VALIDATE_EMAIL)){
			# valid email
			$query_str = 'SELECT id FROM `user` WHERE email = ? and password = ?'; #query string
		}else{
			# invalid email
			$query_str = 'SELECT id FROM `user` WHERE username = ? and password = ?'; #query string
		}
		
		#query the db and assign the response to result
		$result = $this->db->query($query_str, array($username,$hashed_password));
		
		if($result->num_rows() == 1){
			return $result->row(0)->id;
		}else{
			return false;
		}
	}
	
	# get user info
	function Get($id = NULL){
		$this->db->select('*');
		$this->db->from('user');
		# check if we're getting only one row or all records
		if($id != NULL){
			# getting only one row
			$this->db->where('id', $id);
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
	
	# add new user info
	function Add($data){
		$this->db->insert('user',$data);
		return $this->db->insert_id();
	}
	
	# edit user profile info
	function Edit($id, $data){
		$this->db->where('id',$id);
		$result = $this->db->update('user', $data);
		# return
		if($result){
			return $id;
		}else{
			return FALSE;
		}
	}
	
	
}
