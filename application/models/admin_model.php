<?php
class Admin_Model extends CI_Model{
	
	function getUserID($buildingName){
		$this->db->select('userID');
		$query = $this->db->get_where('users', array('buildingName' => $buildingName));
		$count = $this->db->count_all_results();
		$result = $query->result_array();
		foreach ($result as $row) {
			return $row['userID'];
		}
	}

	function getBuildingNames(){
		$this->db->select('buildingName');
		$this->db->order_by('buildingName', 'asc');
		$query = $this->db->get('users');
		return $query->result_array();
	}	

	function getSubmeterNames($userID){
		$this->db->select('submeterName');
		$query = $this->db->get_where('ebillsubmeters', array('userID' => $userID));
		return $query->result_array();
	}	

	function addBuilding($data){
		$this->db->insert('users', $data);
	}

	function addSubmeter($data){
		$this->db->insert('ebillsubmeters', $data);
	}

	function getEStatistics($data){
		$startingDate = $data['start_date'];
		$endingDate = $data['end_date'];
			
		$array = array('ebill.startDate >=' => $startingDate, 'ebill.endDate <=' => $endingDate);
		$this->db->where($array);		
		$this->db->from('ebill');
		$this->db->join('ebillsubmeters', 'ebill.submeterID = ebillsubmeters.submeterID');
		$this->db->join('users', 'ebill.userID = users.userID');
		$query = $this->db->get();
		return $query->result_array();	
	}

	function getWStatistics($data){
		$startingDate = $data['start_date'];
		$endingDate = $data['end_date'];

		$array = array('wbill.startDate >=' => $startingDate, 'wbill.endDate <=' => $endingDate);
		$this->db->where($array);		
		$this->db->from('wbill');
		$this->db->join('users', 'wbill.userID = users.userID');
		$query = $this->db->get();
		return $query->result_array();	
	}
}
?>