<?php
	class Users_Model extends CI_Model{
		
		function getUserInfo($userID){
			$query = $this->db->get_where('users', array('userID' => $userID));
			return $query->result_array();	
		}

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

		public function changeEmail($data){
			echo "<script>alert('change email'); </script>";
			$newdata = array(				
			    'email' => $data['email']
			);

			$this->db->where('userID', $data['userID']);
			$this->db->update('users', $data);
		}

		public function changePassword($data){
			$newdata = array(				
			    'password' => $data->password
			);

			$this->db->where('userID', $data['userID']);
			$this->db->update('users', $data);

		}
	}
?>