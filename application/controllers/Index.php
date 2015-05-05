<?php

class Index extends CI_Controller{
	function __construct(){	
		parent::__construct();
		$this->load->helper(array('url', 'form'));
		$this->load->library(array('session', 'form_validation', 'email'));
		$this->load->model('users_model');
	}

	function view($errorMessage = ""){	
		$data['title'] = "UMTdb HOME";
		$data['errorMessage'] = $errorMessage;
		$this->load->view('inc/header_view', $data);
		$this->load->view('index_view');
		$this->load->view('inc/footer_view');
	}	

	function login(){				

		$data = array(
			'username' => $this->input->post('username'),
			'password' => $this->input->post('password')
		);
		
		$result = $this->users_model->login($data);

		if($result != null){		

			$sess_array = array(
				'userID' => $result->userID,
				'username' => $result->username,
				'password' => $result->password,
				'buildingName' => $result->buildingName,
				'email' => $result->email,
				'address' => $result->address,
				'userType' => $result->userType
			);

			$this->session->set_userdata($sess_array);
			$userType = $_SESSION['userType'];
			
			if($_SESSION['userType'] == 'admin'){
				echo "<script>alert('admin'); </script>";
				redirect('/adminPanel/main');
			}
			else{
				echo "<script>alert('user'); </script>";
				redirect('/userPanel/main');	
			}
		}	
		else{
			$this->view("Error, invalid username and/or password");
		}
	}

	function forgotPassword(){
		$targetEmail = $this->input->post('email');
		$result = $this->users_model->emailVerif($targetEmail);
		if($result == "Invalid"){
			echo "<script>alert('wrong')</script>";
		}
		else{
			echo "<scrpit>alert('$result')</script>";	
		}
		
	}	

	function logout(){
		$this->session->sess_destroy();
		redirect('/index/view');
	}

}

?>