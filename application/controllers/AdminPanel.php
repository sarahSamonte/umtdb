<?php

class AdminPanel extends CI_Controller{

   function __construct(){
        parent::__construct();
        $this->load->helper(array('url', 'form', 'date', 'text'));
		$this->load->library(array('session', 'form_validation'));
        //for navbar names or use sessions
        $this->load->model('shared_model');
        $this->load->model('admin_model');
        $this->load->model('users_model');
    }


	function main(){		
		//$url = site_url('adminPanel/main');
		//$url = base_url();
		unset($_SESSION['targetID']);

		$userID = $this->session->userID;
		$data['title'] = "UMTdb - Admin Panel";
		$this->load->view('inc/header_view', $data);
		
		$data['username'] = $this->session->username;
		$this->load->view('inc/navbar', $data);

		$data['buildingList'] = $this->admin_model->getBuildingNames();
		$this->load->view('adminPanel_view', $data);

		$this->load->view('inc/footer_view');
	}

	function selectBuilding(){	
		$buildingName = $this->input->post('viewBuilding');
		$result = $this->admin_model->getUserID($buildingName);		
		$userID = $result;
		$this->session->set_userdata('targetID', $userID);			

		redirect('/adminPanel/buildingView');
	}

	function buildingView(){
		$userID = $this->session->targetID;

		if($userID == ""){
			echo "<script>alert('invalid!')</script>";
			redirect('/adminPanel/main');
		}
		else{
			$data['title'] = "UMTdb - Building View";
			$this->load->view('inc/header_view', $data);
			
			$data['username'] = $this->session->username;
			$this->load->view('inc/navbar', $data);

			$data['submeterList'] = $this->admin_model->getSubmeterNames($userID);
			$data['ebillList'] = $this->shared_model->getEbillList($userID);
			$data['wbillList'] = $this->shared_model->getWbillList($userID);
			$this->load->view('adminPanel_view2', $data);

			$this->load->view('inc/footer_view');
		}		
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
		$userID = $this->session->targetID;
		$data = array(
			'userID' => $userID,
			'submeterName' => $this->input->post('submeterName'),
		);

		$this->admin_model->addSubmeter($data);
		redirect('/adminPanel/buildingView');
	}

	function editSubmeter(){
		$userID = $this->session->targetID;
		$sName = $this->input->post('sName');
		echo "<script>alert('$sName')</script>";
		
		$data = array(
			'userID' => $userID,
			'oldName' => $this->input->post('sName'),
			'submeterName' => $this->input->post('submeterName'),
		);

		$this->admin_model->editSubmeter($data);
		//redirect('/adminPanel/buildingView');
	}

	function addBuilding(){
		if($this->input->post('username') == ""){
			$username = $this->input->post('buildingName'); 			
		}
		else{
			$username = $this->input->post('username'); 				
		}
		if($this->input->post('password') == ""){		
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

	function editBuilding(){
		echo "<script>alert('Edit building controller')</script>";
		if(($this->input->post('username') == "") and ($this->input->post('buildingName') == "")){
			echo "<script>alert('Nothing changed!')</script>" ;
		}
		else{
			echo "<script>alert('Edit building changing')</script>";
			$buildingName = $this->input->post('bName');
			echo "<script>alert('Bname: $buildingName')</script>";
			$result = $this->admin_model->getUserID($buildingName);		
			$userID = $result;

			$data = array(
				'userID' => $userID,
				'buildingName' => $this->input->post('buildingName'),
				'username' => $this->input->post('username')
			);

			$this->admin_model->editBuilding($data);
			//redirect('/adminPanel/main');
		}			
	}

	function addEbill(){
		$userID = $this->session->targetID;
		$submeterName = $this->input->post('submeterName');
		$serviceID = $this->input->post('serviceID');
		$submeterID = $this->admin_model->getSubmeterID(array('userID' => $userID, 'submeterName' => $submeterName));
		$data = array(
			'serviceID' => $serviceID,
			'submeterID' => $submeterID,
			'userID' => $userID,
			'startDate' => $this->input->post('startDate1'),
			'endDate' => $this->input->post('endDate1'),
			'totalKwh' => $this->input->post('totalKwh'),
			'totalCost' => $this->input->post('totalCost'),
			'genCharge' => $this->input->post('gcharge'),
			'transCharge' => $this->input->post('tcharge'),
			'distCharge' => $this->input->post('dcharge'),
			'imgDest' => $serviceID . ".jpg"
		);


		$config['upload_path']          = './public/db_img/ebill/';
		$config['file_name']          	= $serviceID;
		$config['allowed_types']        = 'jpg';

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload()){            
        	echo "<script>alert('Error uploading image!')</script>"	;

		}
		else{                        
        	echo "<script>alert('Success!')</script>";     
        	$this->admin_model->addEbill($data);
			redirect('/adminPanel/buildingView');
		}		
	}

	function addWbill(){
		$userID = $this->session->targetID;		
		$serviceID = $this->input->post('serviceID');
		
		$data = array(
			'serviceID' => $serviceID,			
			'userID' => $userID,
			'startDate' => $this->input->post('startDate2'),
			'endDate' => $this->input->post('endDate2'),
			'totalCc' => $this->input->post('totalCc'),
			'totalCost' => $this->input->post('totalCost'),
			'imgDest' => $serviceID . ".jpg"
		);


		$config['upload_path']          = './public/db_img/wbill';
		$config['file_name']          	= $serviceID;
		$config['allowed_types']        = 'jpg';

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload()){            
        	echo "<script>alert('Error uploading image!')</script>"	;

		}
		else{                        
        	echo "<script>alert('Success!')</script>";     
        	$this->admin_model->addWbill($data);
			redirect('/adminPanel/buildingView');
		}		
	}

	function statistics(){
		$startingMonth = $this->input->post('s_month');
		$endingMonth = $this->input->post('e_month');
		$startingYear = $this->input->post('s_year');
		$endingYear = $this->input->post('e_year');

		//empty fields
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

	function dlReport(){
		if($this->input->post('r_type') == 1){		
			$rType = "ELECTRICITY";
			$unit = "KWH";
			$table = "ebill";			
		}
		else{
			$rType = "WATER";
			$unit = "m3";
			$table = "wbill";
		}

		$buildingName = $this->input->post('b_name');
		//echo "<script>alert('yahoo')</script>";
		//echo "<script>alert('$buildingName')</script>";

		$data['userID'] = $this->admin_model->getUserID($buildingName);
		$userID = $data['userID'];

		$startMonth = $this->input->post('s_month');
		$year = $this->input->post('year');
		$startDate1 = $year . "-" . $startMonth . "-01";
		$data['startDate1'] = nice_date($startDate1, 'Y-m-d');
		$startMonth2 = $startMonth + 1;
		$startDate2 = $year . "-" . $startMonth2 . "-01";
		$data['startDate2'] = nice_date($startDate2, 'Y-m-d');			
		$data['table'] = $table;

		$newData = $this->admin_model->getReportInfo($data);		

		header("Content-Type: text/csv");
		header("Content-Disposition: attachment; filename=report.csv");
		header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1
		header("Pragma: no-cache"); // HTTP 1.0
		header("Expires: 0"); // Proxies

		
		function outputCSV($data) {	    
			$output = fopen("php://output", "a");
		    foreach ($data as $row) {
		        fputcsv($output, $row); // here you can change delimiter/enclosure
		    }
		    fclose($output);
		}

		$i = 0;		
		$totalCost = 0;
		$totalCons = 0;

		foreach ($newData as $row) {
			if($i == 0){
				$serviceID = $row['serviceID'];
				$startDate = $row['startDate'];
				$endDate = $row['endDate'];

				outputCSV(array(
				    array("", "", "", "               UTILITIES MANAGEMENT TEAM", "", "", "", "", ""),
				    array("", "", "", "Office of the Vice Chancellor for Administration", "", "", "", "", ""),
				    array("", "", "", "                  University of the Philippines", "", "", "", "", ""),
				    array("", "", "", "", "     Diliman, Quezon City", "", "", "", ""),
				    array("", "", "", "", "", "", "", "", ""),
				    array("", "", "", "", "", "", "", "", ""),
				    array("BREAKDOWN OF $rType BILL:", "", "", "", "", "", "SERVICE ID# $serviceID", "", ""),
				    array("", "", "", "", "", "", "", "", ""),
				    array("", "", "", "", "", "", "", "", ""),
				    array("FOR THE PERIOD $startDate TO $endDate", "", "", "", "", "", "", "", ""),
				    array("", "", "", "", "", "", "", "", "")
				));   
			}
			if($rType == "ELECTRICITY"){
				$submeterName = $row['submeterName'];
				$kwh = $row['totalKwh'];
				$cost = $row['totalCost'];

				outputCSV(array(
					array("", "$submeterName", "", "", "", "", "$kwh $unit", "", "P $cost"),	
					array("", "", "", "", "", "", "", "", "")
				));		
				$totalCost += $cost;
				$totalCons += $kwh;
			}	
			else{
				$totalCost = $row['totalCost'];
				$totalCons = $row['totalCc'];
			}					
			$i += 1;
		}

		$pName = $this->input->post('p_name');
		$pTitle = $this->input->post('p_title');
		$nName = $this->input->post('n_name');
		$nTitle = $this->input->post('n_title');
		
		outputCSV(array(
		    array("", "TOTAL", "", "", "", "", "$totalCons $unit", "", "P $totalCost"),
		    array("", "", "", "", "", "", "", "", ""),
		    array("", "", "", "", "", "", "", "", ""),
		    array("Prepared by:", "", "", "", "", "", "", "", ""),
		    array("", "", "", "", "", "", "", "", ""),
		    array("", "", "", "", "", "", "", "", ""),
		    array("$pName", "", "", "", "", "", "Noted:", "", ""),
		    array("$pTitle", "", "", "", "", "", "", "", ""),
		    array("", "", "", "", "", "", "", "", ""),
		    array("", "", "", "", "", "", "$nName", "", ""),
		    array("", "", "", "", "", "", "$nTitle", "", "")
		));

	}
	
	function getElecDb(){
		$newdata = $this->admin_model->getAllEbill();

		header("Content-Type: text/csv");		
		header("Content-Disposition: attachment; filename=eDatabase.csv");
		header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1
		header("Pragma: no-cache"); // HTTP 1.0
		header("Expires: 0"); // Proxies

		function outputCSV($data) {	    
			$output = fopen("php://output", "a");
		    foreach ($data as $row) {
		        fputcsv($output, $row); // here you can change delimiter/enclosure
		    }
		    fclose($output);
		}

		outputCSV(array(
		    array("Service ID", "Building Name", "Submeter Name", "Start Date", "End Date", "Total KWH", "Total Cost", "Generation Charge", "Transmission Charge", "Distribution Charge")	    
		));   

		foreach ($newdata as $row){
			$buildingName = $row['buildingName'];
			$submeterName = $row['submeterName'];
			$serviceID = $row['serviceID'];
			$startDate = $row['startDate'];
			$endDate = $row['endDate'];
			$totalKwh = $row['totalKwh'];
			$totalCost = $row['totalCost'];
			$genCharge = $row['genCharge'];
			$transCharge = $row['transCharge'];
			$distCharge = $row['distCharge'];

			outputCSV(array(		    		    
			    array($serviceID, $buildingName, $submeterName, $startDate, $endDate, $totalKwh, $totalCost, $genCharge, $transCharge, $distCharge)
			));   
		}
	}

	function getWaterDb(){
		$newdata = $this->admin_model->getAllWbill();

		header("Content-Type: text/csv");		
		header("Content-Disposition: attachment; filename=wDatabase.csv");
		header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1
		header("Pragma: no-cache"); // HTTP 1.0
		header("Expires: 0"); // Proxies

		function outputCSV($data) {	    
			$output = fopen("php://output", "a");
		    foreach ($data as $row) {
		        fputcsv($output, $row); // here you can change delimiter/enclosure
		    }
		    fclose($output);
		}

		outputCSV(array(
		    array("Service ID", "Building Name", "Start Date", "End Date", "Total Cubic Meters", "Total Cost")	    
		));   

		foreach ($newdata as $row){
			$buildingName = $row['buildingName'];
			$serviceID = $row['serviceID'];
			$startDate = $row['startDate'];
			$endDate = $row['endDate'];
			$totalCc = $row['totalCc'];
			$totalCost = $row['totalCost'];

			outputCSV(array(		    		    
			    array($serviceID, $buildingName, $startDate, $endDate, $totalCc, $totalCost)
			));   
		}
	}

	function changeEmail(){
		echo "<script>alert('change email controller'); </script>";
		$data = array(		
			'userID' => $this->session->userID,	
			'email' => $this->input->post('new_email')
		);

		$result = $this->users_model->changeEmail($data);
		echo "<script>alert('$result'); </script>";
		redirect('/adminPanel/main');
	}

	function changePassword(){
		echo "<script>alert('change password controller'); </script>";
		//error checking
		$pass = $this->input->post('current_p');
		$sesPass = $this->session->password;
		if(!password_verify($pass, $sesPass)){
			echo "<script>alert('Current password invalid'); </script>";	
		}
		else if($this->input->post('retype_p') != $this->input->post('new_p')){
			echo "<script>alert('passwords do not match'); </script>";	
		}
		else{
			$data = array(		
				'userID' => $this->session->userID,	
				'password' => password_hash($this->input->post('new_p'), PASSWORD_BCRYPT)
			);

			$result = $this->users_model->changePassword($data);
			echo "<script>alert('$result'); </script>";	
			redirect('/adminPanel/main');
		}		
	}
}

?>