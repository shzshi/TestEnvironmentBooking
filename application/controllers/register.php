<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Register extends CI_Controller {

	function __construct(){
        parent::__construct();
		
		$this->load->model('users_model');
    }
   
    public function index($msg = NULL) {
	 
	  $data['msg'] = $msg;
	  $this->load->view('register_view', $data);
	}
	
	public function register_user() {
	   // Load the model
        $this->load->model('register_model');
        // Validate the user can login
        $result = $this->register_model->register();
		
        // Now we verify the result        
        $msg = '<font color=red>Thanks for registering, you can go ahead and login</font><br />';
        $this->session->set_flashdata('flashMsg', $msg);
		redirect('main');
	}
	
	public function forgot() {
		
		$email = $this->security->xss_clean($this->input->post('email'));
		$this->data = $this->users_model->getUserDetailsByEmail($email);
		//print_r($results);
		$this->load->view('forget_view', $this->data);
	}
	
	public function forgotEmail()
	{
		$this->load->view('forgetEmail_view');
	}
	
	public function passwordNew() {
      
	  $secureCheck=$this->users_model->checkSecurityQuestion();
	  if($secureCheck) {
		 $this->load->view('newpassword_view');
	  } else {
	    redirect('register/forgotEmail');
	  }
	}
	
	public function updatePassword(){	  
	  $this->users_model->updatePassword();
      redirect('home');	  
	}
}