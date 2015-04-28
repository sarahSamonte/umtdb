<?php

class UserPanel extends CI_Controller{
	
	function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('shared_model');
        $this->load->model('user_model');
    }

	function main(){			
		$data['title'] = "UMTdb - User Panel";
		$this->load->view('inc/header_view', $data);
		
		$data['username'] = "TO DO: session usernames";
		$this->load->view('inc/navbar', $data);
		
		$userID = 23;
		$data['ebillList'] = $this->shared_model->getEbillList($userID);
		$data['wbillList'] = $this->shared_model->getWbillList($userID);
		$data['userData'] = $this->user_model->getUserInfo($userID);
		$this->load->view('userPanel_view', $data);
		$this->load->view('inc/footer_view');
	}	

}

?>
