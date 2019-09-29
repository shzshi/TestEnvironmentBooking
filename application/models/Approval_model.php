<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Shashikant Bangera
 * Description: Login model class
 */
class Approval_model extends CI_Model{

    function __construct(){
        parent::__construct();
    }

    function get_all($user_id,$user_type,$limit,$offset) {
		$this->db->select('cl.calendarid,cl.reservename,en.envname,u.firstname,u.lastname,cl.reservetype,cl.starttime,cl.endtime,cl.status');
		$this->db->from('calendar cl');
		$this->db->join('environment en','cl.envid=en.envid','SELF');
		$this->db->join('users u','cl.createdby=u.userid','SELF');
		
		if($user_type!='admin')
		$this->db->where('cl.createdby',$user_id);
		
		$this->db->limit($limit,$offset);
		$this->db->order_by("cl.calendarid", "desc");
		$query = $this->db->get();
		
		return $query->result_array();
	}
	
	public function updateSchedule()
	{	
		// grab user input
        $reservename = $this->security->xss_clean($this->input->post('reservename'));
        $envtype = $this->security->xss_clean($this->input->post('envtype'));
		$start = $this->security->xss_clean($this->input->post('start'));
		$end = $this->security->xss_clean($this->input->post('end'));
		$status = $this->security->xss_clean($this->input->post('status'));
		$reservetype = $this->security->xss_clean($this->input->post('reservetype'));
		$calendarid = $this->security->xss_clean($this->input->post('calendarid'));
		
		$this->db->set('reservename', $reservename);
		$this->db->set('envid', $envtype);
		
		$dateChange = DateTime::createFromFormat('m/d/Y H:i:s', $start.' 00:00:00');
		$mysql_start_date = $dateChange->format('Y-m-d H:i:s');
		$this->db->set('starttime', $mysql_start_date);
		
		$dateChange = DateTime::createFromFormat('m/d/Y H:i:s', $end.' 00:00:00');
		$mysql_end_date = $dateChange->format('Y-m-d H:i:s');
		$this->db->set('endtime', $mysql_end_date);
		
		$this->db->set('reservetype', $reservetype);
		
		if($status!="")
		$this->db->set('status', $status);

		$this->db->where('calendarid', $calendarid);
		$this->db->update('calendar');
		
		return;
	}
	
	public function delSchedule($scheduleId){	
	    $this->db->where('calendarid', $scheduleId);
		$this->db->delete('calendar');
	}
	
	public function getScheduleByID($calendarId)
	{	
		$this->db->select('cl.calendarid,cl.reservename,cl.envid,u.firstname,u.lastname,cl.reservetype,cl.starttime,cl.endtime,cl.status');
		$this->db->from('calendar cl');
		//$this->db->join('environment en','cl.envid=en.envid','SELF');
		$this->db->join('users u','cl.createdby=u.userid','SELF');
		$this->db->where('cl.calendarid', $calendarId);
		$query = $this->db->get();
		return $query->row();
	}
}