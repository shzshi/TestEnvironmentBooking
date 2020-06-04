<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

	function __construct(){
        parent::__construct();
    }

	public function index($msg = NULL){
        // Load our view to be displayed
        // to the user
        $data['msg'] = $msg;
        $this->load->view('login_view', $data);
    }
    
    public function login_validation(){
        // Load the model
        $this->load->model('login_model');
        // Validate the user can login
        $result = $this->login_model->validate();
        // Now we verify the result
		
        if(! $result){
            // If user did not validate, then show them login page again
            $msg = '<font color=red>Invalid username and/or password.</font><br />';
			$this->session->set_flashdata('flashMsg', $msg);
            //$this->index();
			redirect('main');
        }else{
            // If user did validate, 
            // Send them to members area
            redirect('schedule');
        }        
    }
	
	public function logout(){
		$this->session->userdata = array();
		$this->session->sess_destroy();
        redirect('main');
    }
	
	public function forgot() {
	  $this->load->view('forget_view');   
	}
	
	public function forgot_add(){
	}
}