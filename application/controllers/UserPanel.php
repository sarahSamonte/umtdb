<?php

class UserPanel extends CI_Controller{
	
	function __construct(){
        parent::__construct();
        $this->load->helper(array('url', 'form'));
        $this->load->model('shared_model');
        $this->load->model('users_model');
        $this->load->library(array('session', 'form_validation'));       
    }

	function main(){			
		$data['title'] = "UMTdb - User Panel";
		$this->load->view('inc/header_view', $data);
		
		$data['username'] = $this->session->username;
		$this->load->view('inc/navbar', $data);
		
		$data['buildingName'] = $this->session->buildingName;
		$userID = $this->session->userID;
		$data['ebillList'] = $this->shared_model->getEbillList($userID);
		$data['wbillList'] = $this->shared_model->getWbillList($userID);
		$data['userData'] = $this->users_model->getUserInfo($userID);
		$this->load->view('userPanel_view', $data);
		$this->load->view('inc/footer_view');
	}	

	function changeEmail(){
		echo "<script>alert('change email controller'); </script>";
		$data = array(		
			'userID' => $this->session->userID,	
			'email' => $this->input->post('new_email')
		);

		$result = $this->users_model->changeEmail($data);
		echo "<script>alert('$result'); </script>";
		redirect('/userPanel/main');
	}

	function changePassword(){
		echo "<script>alert('change password controller'); </script>";
		//error checking
		if($this->input->post('retype_p') != $this->input->post('new_p')){
			echo "<script>alert('passwords do not match'); </script>";	
		}
		else{
			$data = array(		
				'userID' => $this->session->userID,	
				'password' => password_hash($this->input->post('new_p'), PASSWORD_BCRYPT)
			);

			$result = $this->users_model->changePassword($data);
			echo "<script>alert('$result'); </script>";	
		}
		redirect('/userPanel/main');
	}
	
}

?>
