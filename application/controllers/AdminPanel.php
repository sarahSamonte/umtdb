<?php

class AdminPanel extends CI_Controller{

   function __construct(){
        parent::__construct();
        $this->load->helper(array('url', 'form', 'date', 'text'));
		$this->load->library(array('session', 'form_validation'));
        //for navbar names or use sessions
        $this->load->model('shared_model');
        $this->load->model('admin_model');
    }

	function main(){		
		//$url = site_url('adminPanel/main');
		//$url = base_url();

		$data['title'] = "UMTdb - Admin Panel";
		$this->load->view('inc/header_view', $data);
		
		$data['username'] = $this->session->username;
		$this->load->view('inc/navbar', $data);

		$data['buildingList'] = $this->admin_model->getBuildingNames();
		$this->load->view('adminPanel_view', $data);

		$this->load->view('inc/footer_view');
	}

	function buildingView(){	
		$buildingName = $this->input->post('viewBuilding');
		$result = $this->admin_model->getUserID($buildingName);		
		$userID = $result;
		
		$data['title'] = "UMTdb - Building View";
		$this->load->view('inc/header_view', $data);
		
		$data['username'] = "TO DO: session usernames";
		$this->load->view('inc/navbar', $data);

		$data['submeterList'] = $this->admin_model->getSubmeterNames($userID);
		$data['ebillList'] = $this->shared_model->getEbillList($userID);
		$data['wbillList'] = $this->shared_model->getWbillList($userID);
		$this->load->view('adminPanel_view2', $data);

		$this->load->view('inc/footer_view');
	}

	function addBuildingForm(){
		$this->load->view('add_building');
	}
	function datePicker(){
		$data['title'] = "UMTdb - Building View";
		$this->load->view('inc/header_view', $data);
		
		$data['username'] = "TO DO: session usernames";
		$this->load->view('inc/navbar', $data);
		$this->load->view('date');
		$this->load->view('inc/footer_view');
	}

	function addSubmeter(){
		
		$data = array(
			'userID' => 23,
			'submeterName' => $this->input->post('submeterName'),
		);

		$this->admin_model->addSubmeter($data);
	}

	function addBuilding(){
		if($this->input->post('username') == ""){
			$username = $this->input->post('buildingName'); 			
		}
		else{
			$username = $this->input->post('username'); 				
		}
		if($this->input->post('password') == ""){
			echo "<script>alert('null password'); </script>";			
			$password = password_hash($this->input->post('buildingName'), PASSWORD_BCRYPT);
		}
		else{
			$password = password_hash($this->input->post('password'), PASSWORD_BCRYPT);
		}
		
		$data = array(
			'username' => $username,
			'password' => $password,
			'buildingName' => $this->input->post('buildingName'),
			'email' => $this->input->post('email'),
			'address' => $this->input->post('address'),
			'userType' => "user"
		);

		$this->admin_model->addBuilding($data);
		redirect('/adminPanel/main');
	}

	function statistics(){
		$startingMonth = $this->input->post('s_month');
		$endingMonth = $this->input->post('e_month');
		$startingYear = $this->input->post('s_year');
		$endingYear = $this->input->post('e_year');

		//empty fields
		if($startingMonth == ""){
			$startingMonth = "01";
		}
		if($startingYear == ""){
			$startingYear = 2010;
		}
		$string = date(DATE_ATOM);
		$now = substr($string, 0, 10);
		if($endingMonth == ""){
			$endingMonth = substr($now, 5, 2);
		}
		if($endingYear == ""){
			$endingYear = substr($now, 0, 4);
		}

		//error checking
		if($startingYear == $endingYear && $startingMonth > $endingMonth){
			echo "<script>alert('invalid'); </script>";					
		}
		else{
			$start_date = $startingMonth . "-" . "01-" . $startingYear;
			$start_date = nice_date($start_date, 'Y-m-d');
			$end_date = $endingMonth . "-" . "01-" . $endingYear;
			$end_date = nice_date($end_date, 'Y-m-d');

			//echo "<script>alert('$start_date'); </script>";		
			//echo "<script>alert('$end_date'); </script>";	

			$data = array(
				'start_date' => $start_date,
				'end_date' => $end_date
			);	

			$newData = array(
				'title' => "Statistics Page",
				'username' => "admin",
				'ebillStat' => $this->admin_model->getEStatistics($data), 
				'wbillStat' => $this->admin_model->getWStatistics($data) 
			);

			$this->load->view('inc/header_view', $newData);
			$this->load->view('inc/navbar', $newData);
			$this->load->view('statistics_view', $newData);
			$this->load->view('inc/footer_view');
		}
	}	
}

?>