<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Login_Controller extends MY_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('Admin_Login_model');
	}
	public function index()
	{
		$this->load->view('admin_login');
	}
	public function admin_login()
	{
		$this->load->view('admin_login');
	}

	public function login_check()
	{
		$email=$this->input->post('email');
		$password=$this->input->post('password');
		// $remember=$this->input->post('remember');
		$hpassword=md5($password);
		$login=$this->Admin_Login_model->login_data($email,$hpassword);
		if($login=="valid"){

			$data['email']=$email;
			$data['password']=$password;
			$data['message']='Login sucessfully';
			$data['success']=1;	

			// if($remember==true) {
			// 	$cookie_username=array(
			// 		'name'=>'admin_username',
			// 		'value'=>$email,
			// 		'expire'=>86400*15
			// 	);
			// 	$cookie_password=array(
			// 		'name'=>'admin_password',
			// 		'value'=>$password,
			// 		'expire'=>86400*15
			// 	);
			// 	$this->input->set_cookie($cookie_username);
			// 	$this->input->set_cookie($cookie_password);
				
			// } else {
			// 	delete_cookie('admin_username');
			// 	delete_cookie('admin_password');
			// }
			
			$this->session->set_userdata('admin_email',$data['email']);
			echo json_encode($data);
		}else{
			$check_mail=$this->Admin_Login_model->Check_email($email);
			if($check_mail=="incorrect_email"){
				$data['message']='Email is not registered';
				$data['success']=0;
			}else{
				$data['message']='please enter valid id or password';	
				$data['success']=0;
			}
			echo json_encode($data);
			// return $data;
		}
	}
}
