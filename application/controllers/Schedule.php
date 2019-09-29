<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Schedule extends CI_Controller {

	function __construct(){
        parent::__construct();
		
		$this->check_isvalidated();
		$this->load->model('schedule_model');
    }

	public function index(){
	  $this->load->view('schedule_view');
	}
	
	private function check_isvalidated(){
        if(! $this->session->userdata('validated')){
            redirect('/');
        }
    }
	
	public function events(){
	 $this->schedule_model->events();
	}
	
	public function getevents() {
	 $this->schedule_model->getevents();
	}
	
	public function listSchedule(){
	}
	
    public function addSchedule(){
	  $this->schedule_model->addevents();
	  redirect('schedule');
	}
	
    public function editSchedule(){
    }
    
    public function deleteSchedule(){
    }	
}