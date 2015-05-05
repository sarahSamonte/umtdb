<?php
class Admin_Model extends CI_Model{
	
	function getUserID($buildingName){
		$this->db->select('userID');
		$query = $this->db->get_where('users', array('buildingName' => $buildingName));
		$result = $query->result_array();
		foreach ($result as $row) {
			return $row['userID'];
		}
	}

	function getSubmeterID($data){
		$userID = $data['userID'];
		$submeterName = $data['submeterName'];
		echo "<script>alert('$userID')</script>";
		echo "<script>alert('$submeterName')</script>";

		$query = $this->db->get_where('ebillsubmeters', array('submeterName' => $submeterName, 'userID' => $userID));
		$result = $query->result_array();
		
		echo "<script>alert('before for')</script>";
		foreach ($result as $row) {			
			echo "<script>alert('here')</script>";
			$id = $row['submeterID'];
			echo "<script>alert('$id')</script>";
			return $row['submeterID'];
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

	function editBuilding($data){
		echo "<script>alert('Edit building model')</script>";
		$userID = $data['userID'];
		echo "<script>alert('userID: $userID')</script>";			
		$buildingName = $data['buildingName'];
		$username = $data['username'];
		
		$this->db->where('userID', $userID);	
		if($buildingName == ""){
		echo "<script>alert('B name empty')</script>";			
			$this->db->update('users', array('username' => $username));
		}		
		elseif($username == ""){
			echo "<script>alert('U name empty')</script>";			
			$this->db->update('users', array('buildingName' => $buildingName));
		}
		else{
			echo "<script>alert('All filled')</script>";				
			$this->db->update('users', array('username' => $username, 'buildingName' => $buildingName));	
		}
		
	}

	function addSubmeter($data){
		$this->db->insert('ebillsubmeters', $data);
	}

	function editSubmeter($data){		
		$userID = $data['userID'];		
		$oldName = $data['oldName'];
		$submeterName = $data['submeterName'];
		
		echo "<script>alert('Edit submeter model')</script>";
		$this->db->where(array('userID'=> $userID, 'submeterName' => $oldName));	
		$this->db->update('ebillsubmeters', array('submeterName' => $submeterName));
		
	}

	function addEbill($data){
		$this->db->insert('ebill', $data);
	}

	function addWbill($data){
		$this->db->insert('wbill', $data);
	}

	function getEStatistics($data){
		$startingDate = $data['start_date'];
		$endingDate = $data['end_date'];
			
		echo "<script>alert('$startingDate'); </script>";		
		echo "<script>alert('$endingDate'); </script>";	

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

	function getReportInfo($data){
		$startDate1 = $data['startDate1'];
		$startDate2 = $data['startDate2'];
		$userID = $data['userID'];
		$tableName = $data['table'];

		if($tableName == 'ebill')
			$this->db->where(array('ebill.userID' => $userID, 'startDate >=' => $startDate1, 'startDate <' => $startDate2));
		else
			$this->db->where(array('userID' => $userID, 'startDate >=' => $startDate1, 'startDate <' => $startDate2));	
		
		if($tableName == "ebill"){
			//echo "<script>alert('ebill report')</script>";
			$this->db->join('ebillsubmeters', 'ebillsubmeters.submeterID = ebill.submeterID');
		}

		$query = $this->db->get($tableName);

		$count = $query->num_rows();

		//echo "<script>alert('count: $count')</script>";

		if($count >= 1){
			//echo "<script>alert('has content')</script>";
			$result = $query->result_array();

			return $result;
			
		}
		else{
			//echo "<script>alert('is null')</script>";	
			return null;
		}

	}

	function getAllEbill(){
		$this->db->from('ebill');
		$this->db->join('users', 'ebill.userID = users.userID');
		$this->db->join('ebillsubmeters', 'ebill.submeterID = ebillsubmeters.submeterID');
		$query = $this->db->get();
		return $query->result_array();
	}

	function getAllWbill(){
		$this->db->from('wbill');
		$this->db->join('users', 'wbill.userID = users.userID');
		$query = $this->db->get();
		return $query->result_array();
	}


}
?>