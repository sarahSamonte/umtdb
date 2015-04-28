<?php

class AdminPanel extends CI_Controller{

   function __construct(){
        parent::__construct();
        $this->load->helper('url');
        //for navbar names or use sessions
        $this->load->model('shared_model');
        $this->load->model('admin_model');
    }

	function main(){		
		$data['title'] = "UMTdb - Admin Panel";
		$this->load->view('inc/header_view', $data);
		
		$data['username'] = "TO DO: session usernames";
		$this->load->view('inc/navbar', $data);

		$data['buildingList'] = $this->admin_model->getBuildingNames();
		$this->load->view('adminPanel_view', $data);

		$this->load->view('inc/footer_view');
	}

	function buildingView(){		
		$data['title'] = "UMTdb - Building View";
		$this->load->view('inc/header_view', $data);
		
		$data['username'] = "TO DO: session usernames";
		$this->load->view('inc/navbar', $data);

		$userID = 23;
		$data['submeterList'] = $this->admin_model->getSubmeterNames($userID);
		$this->load->view('adminPanel_view2', $data);

		$this->load->view('inc/footer_view');
	}

	function adminPanelstatistics(){
		$this->load->view('inc/header_view');
		$this->load->view('inc/navbar');
		$this->load->view('statistics_view');
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
}

?>