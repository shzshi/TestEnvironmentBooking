<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

	function __construct(){
        parent::__construct();
		$this->check_isvalidated();
		$this->load->model('users_model');
    }

	public function index(){
	
	   $this->data['title']='Users';
	   
	   // adding the pagination
	   $this->load->library('pagination');
	   $this->load->library('table'); 
		
	   $config['base_url'] = '/mobizar/user/index/';
	   $config['total_rows'] = $this->db->get('users')->num_rows();
	   $config['per_page'] = 10;
	   $config['num_links'] = 10;
	   $config['uri_segment'] = 3;
	   
	   $this->pagination->initialize($config);	   
	   
	   //getting record for course from course by logged in user.
	   $this->data=$this->users_model->get_all($this->session->userdata('userid'),$this->session->userdata('usertype'),$config['per_page'],$this->uri->segment(3));
	   //$this->data['msg'] = $msg;
	   
	   $this->load->view('users_view',$this->data);
	}
	
    public function add (){
	
	  $msg=$this->users_model->add();			
	  redirect('user');
	}
	
	public function userdiv(){
	
	    $userID = $this->security->xss_clean($this->input->post('userID'));
		$results=$this->users_model->getUser($userID);
		$attributes = array ('name'=> 'uploadUserForm','id'=>'uploadUserForm','class'=>'form-inline');
		
        $userFormDiv="
		  <div class=\"modal-body\">
			  ".form_open_multipart('user/edit',$attributes)."
				  <input type=\"text\" name=\"username\" value='".$results->username."' class=\"input-medium\" placeholder=\"Email\" />
				  <input type=\"text\" name=\"lastname\" value='".$results->lastname."' class=\"input-medium\" placeholder=\"Last Name\" />
				  <input type=\"text\" name=\"firstname\" value='".$results->firstname."' class=\"input-medium\" placeholder=\"First Name\" /><br/><br/>
				  <input type=\"text\" name=\"phone\" value='".$results->phone."' class=\"input-medium\" placeholder=\"Phone No\" />
				  <input type=\"text\" name=\"organisation\" value='".$results->organization."' class=\"input-medium\" placeholder=\"Organisation\" />
				  <input type=\"text\" name=\"designation\" value='".$results->designation."' class=\"input-medium\" placeholder=\"Designation\" /><br/><br/>
					<div class=\"modal-footer\">
				<a href=\"#\" class=\"btn btn-danger\" data-dismiss=\"modal\" aria-hidden=\"true\">Close</a>
				<button type=\"submit\" name=\"addUser\" class=\"btn btn-success\" id=\"addUser\">Edit this User</button>
			  </div>
			  <input type='hidden' name='userid' value='".$userID."'>
			  </form>
			  </div>";
			  
      echo $userFormDiv;			  
	}
    
    public function edit(){	
	  $this->users_model->updateUser();
	  redirect('user');
    }
    
    public function delete(){
		$this->users_model->delUser($this->uri->segment(3));
		$this->session->set_flashdata('message', '<p>User were successfully deleted!</p>');
		redirect('user');
	}
	
	private function check_isvalidated(){
        if(! $this->session->userdata('validated')){
            redirect('/');
        }
    }
}