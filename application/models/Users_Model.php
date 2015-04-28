<?php
	class Users_Model extends CI_Model{
		public function login($data){
			$condition = "username =" . "'" . $data['username'] . "'";
			$this->db->select('*');
			$this->db->from('users');
			$this->db->where($condition);
			$query = $this->db->get();

			if ($query->num_rows() == 1) {				
				$result = $query->row();
				
				if(password_verify($data['password'], $result->password)){					
					return $result;
				}
			} else {
				return null;				
			}
		}
	}
?>