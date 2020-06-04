<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Approval extends CI_Controller {

	function __construct(){
        parent::__construct();
		$this->check_isvalidated();
		$this->load->model('approval_model');
		$this->load->model('schedule_model');
    }
	
	public function index($msg = NULL) {
	   
	   $this->data['title']='Approval';
	   
	   // adding the pagination
	   $this->load->library('pagination');
	   $this->load->library('table');
	   $config['base_url'] = base_url().'/approval/index/';
	   $config['total_rows'] = $this->db->get('calendar')->num_rows();
	   $config['per_page'] = 10;
	   $config['num_links'] = 10;
	   $config['uri_segment'] = 3;
	   
	   $this->pagination->initialize($config);
	   
		$this->data=$this->approval_model->get_all($this->session->userdata('userid'),$this->session->userdata('usertype'),$config['per_page'],$this->uri->segment(3));
		$this->load->view('approval_view',$this->data);
	}
	
	public function approvalschedule()
	{
		$calendarID = $this->security->xss_clean($this->input->post('scheduleId'));
		$results=$this->approval_model->getScheduleByID($calendarID);
		$startdate=date("m/d/Y", strtotime($results->starttime));
		$enddate=date("m/d/Y", strtotime($results->endtime));
		
		$attributes = array ('name'=> 'uploadScheduleForm','id'=>'uploadScheduleForm','class'=>'form-horizontal');
		
		$dropDownGroups=$this->schedule_model->getEnvforDropdown();
		
		$editSchedule="<div class=\"modal-body\">
		".form_open_multipart('approval/edit',$attributes)."
		    <div class=\"control-group\">
				<label class=\"control-label\" for=\"\">Reservation Name</label>
				<div class=\"controls\">
						<p><input type=\"text\" name=\"reservename\" class=\"input-medium\" value=\"".$results->reservename."\" /></p>
				</div>
			</div>
			
			<div class=\"control-group\">
			  <label class=\"control-label\" for=\"\">Environment Type</label>
				<div class=\"controls\">
				<select name=\"envtype\">
				<option value=\"none\" selected>--Environment Type--</option>";
				
					foreach($dropDownGroups as $row){
						if($row->envid == $results->envid)
							$editSchedule.="<option value='".$row->envid."' selected>".$row->envname."</option>";
						else
							$editSchedule.="<option value='".$row->envid."'>".$row->envname."</option>";
					}		
				
				$editSchedule.="</select>
			    </div>
			</div>
			<div class=\"control-group\">
			  <label class=\"control-label\" for=\"\">Reservation Type</label>
				<div class=\"controls\">
				<select name=\"reservetype\">
					<option value=\"\" selected>--Reservation Type--</option>";
				$reserveType = array("generic","release","maintainance");
				
				foreach($reserveType as $rValue)
				{				
					if($results->reservetype === $rValue)
						$editSchedule.="<option value=\"".$rValue."\" selected>".ucwords($rValue)."</option>";
					else
						$editSchedule.="<option value=\"".$rValue."\">".ucwords($rValue)."</option>";
				}
				
				$editSchedule.="</select>
				</div>
			</div>
			<div class=\"control-group\">
			  <label class=\"control-label\" for=\"\">Planned From</label>
				<div class=\"controls\">
					<input type=\"text\" name=\"start\" id=\"datepicker\" class=\"input-medium\" value=\"".$startdate."\" />
				</div>
			</div>
			<div class=\"control-group\">
			  <label class=\"control-label\" for=\"\">Planned To</label>
				<div class=\"controls\">
					<input type=\"text\" name=\"end\" id=\"datepicker1\" class=\"input-medium\" value=\"".$enddate."\" />
				</div>
			</div>";
			if($this->session->userdata('usertype')=='admin')
			{
			  $editSchedule.="<div class=\"control-group\">
			  <label class=\"control-label\" for=\"\">Status</label>
				<div class=\"controls\">
				<select name=\"status\">
					<option value=\"\" selected>--Status--</option>";
				$reserveStatus = array("in-progress","approved","on-hold","rejected");
				
				foreach($reserveStatus as $sValue)
				{				
					if($results->status === $sValue)
						$editSchedule.="<option value=\"".$sValue."\" selected>".ucwords($sValue)."</option>";
					else
						$editSchedule.="<option value=\"".$sValue."\">".ucwords($sValue)."</option>";
				}
				
				$editSchedule.="</select>
				</div>
			</div>";
			}
			
			$editSchedule.="<div class=\"modal-footer\">
			<a href=\"#\" class=\"btn btn-danger\" data-dismiss=\"modal\" aria-hidden=\"true\">Close</a>
			<button type=\"submit\" name=\"addCourse\" class=\"btn-success\" id=\"addCourse\">Save Changes</button>
		</div>
		<input type='hidden' name='calendarid' value='".$calendarID."'>
		</form>
		</div>";

		echo $editSchedule;
	}
	
	public function edit(){
	
		$msg=$this->approval_model->updateSchedule();
		$this->session->set_flashdata('message', '<p>Schedule is successfully Updated!</p>');
		redirect('approval');	  
	}
	
	public function delete(){
		$this->approval_model->delSchedule($this->uri->segment(3));
		$this->session->set_flashdata('message', '<p>Product were successfully deleted!</p>');
		redirect('approval');
	}
	
	private function check_isvalidated(){
        if(! $this->session->userdata('validated')){
            redirect('/');
        }
    }
	
	public function logout(){
		$this->session->userdata = array();
		$this->session->sess_destroy();
        redirect('main');
    }
}