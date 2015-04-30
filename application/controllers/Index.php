<?php

class Index extends CI_Controller{
	function __construct(){	
		parent::__construct();
		$this->load->helper(array('url', 'form'));
		$this->load->library(array('session', 'form_validation'));
		$this->load->model('users_model');
	}

	function view(){	
		$data['title'] = "UMTdb HOME";
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
			echo "<script>alert('valid'); </script>";			

			$sess_array = array(
				'userID' => $result->userID,
				'username' => $result->username,
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
			echo "<script>alert('not valid'); </script>";
			$this->view();
		}
	}

	function forgotPassword(){
		
	}	

	function logout(){
		$this->session->sess_destroy();
		redirect('/index/view');
	}

}

?>