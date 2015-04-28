<?php
class Admin_Model extends CI_Model{

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
}
?>