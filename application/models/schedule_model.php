<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* Author: Shashikant Bangera

 * Description: schedule model class

 */

class Schedule_model extends CI_Model{

    function __construct(){

        parent::__construct();

    }

	public function events() {
		//$this->db->select('c.calendarid as id, CONCAT("Reservation Name : ",c.reservename, " \nReservation Type : ", c.reservetype, " \nEnvironment : ", en.envname) as title,en.color as color, c.starttime as start, c.endtime as end',FALSE);
		$this->db->select('c.calendarid as id, CONCAT("Reservation Name : ",c.reservename) as title, CONCAT("\nReservation Type : ", c.reservetype, " \nEnvironment : ", en.envname) as description,en.color as color, c.starttime as start, c.endtime as end',FALSE);
		$this->db->from('calendar c');		
		$this->db->where('c.status','approved');
		$this->db->join('environment en','c.envid=en.envid','SELF');
		//$this->db->limit($limit,$offset);
		$query = $this->db->get();
		
		echo json_encode($query->result_array());
	}
	
	public function getEnvforDropdown() 
	{
		$this->db->select('envid, envname');
		$this->db->from('environment');		
		//$this->db->where('createdby',$user_id);
		$query = $this->db->get();
		
		return $query->result();
	}

	public function addevents(){

		$reserveName = $this->security->xss_clean($this->input->post('reservename'));
		$envType = $this->security->xss_clean($this->input->post('envtype'));
		$reserveType = $this->security->xss_clean($this->input->post('reservetype'));

        $startDate = $this->security->xss_clean($this->input->post('start'));

		$endDate = $this->security->xss_clean($this->input->post('end'));

        $loginUserid = $this->session->userdata('userid');		

	    
		$this->db->set('reservename', $reserveName);
		$this->db->set('reservetype', $reserveType);
		$this->db->set('envid', $envType);
		
		$dateChange = DateTime::createFromFormat('m/d/Y H:i:s', $startDate.' 00:00:00');
		$mysql_start_date = $dateChange->format('Y-m-d H:i:s');
		$this->db->set('starttime', $mysql_start_date);
		
		$dateChange = DateTime::createFromFormat('m/d/Y H:i:s', $endDate.' 00:00:00');
		$mysql_end_date = $dateChange->format('Y-m-d H:i:s');
		$this->db->set('endtime', $mysql_end_date);
		
		$this->db->set('status', 'in-progress');
		
		$this->db->set('createdon','NOW()',FALSE);
		$this->db->set('createdby',$loginUserid);

		return $this->db->insert('calendar');

	}

}