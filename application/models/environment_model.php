<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Shashikant Bangera
 * Description: Login model class
 */
class Environment_model extends CI_Model{

    function __construct(){
        parent::__construct();
    }

    function get_all($user_id,$user_type,$limit,$offset) {
		$this->db->select('envid, envname, envtype');
		$this->db->from('environment');
		
		if($user_type!='admin')
		$this->db->where('createdby',$user_id);
		
		$this->db->limit($limit,$offset);
		$query = $this->db->get();
		
		return $query->result_array();
	}
	
	public function getEnvironment($envID){
	
	    $this->db->select('envid, envname, envtype');
		$this->db->where('envid', $envID);
		$query = $this->db->get('environment');
		return $query->row();
	}
	
	public function updateEnvironment()
	{	
		// grab user input
		$envname = $this->security->xss_clean($this->input->post('envname'));
        $envtype = $this->security->xss_clean($this->input->post('envtype'));	    
		$envid = $this->security->xss_clean($this->input->post('envid'));
	    
		$this->db->set('envname', $envname);
		$this->db->set('envtype', $envtype);
		$this->db->where('envid', $envid);
		$this->db->update('environment');
		
		return;
	}
	
	public function add()
	{
		// grab environment input
        $envname = $this->security->xss_clean($this->input->post('envname'));        
        $envtype = $this->security->xss_clean($this->input->post('envtype'));	    	
		$componentGroup = implode('~',$this->security->xss_clean($this->input->post('componentGroup')));
		
		$this->db->set('envname', $envname);
		$this->db->set('envtype', $envtype);
		$this->db->set('component', $componentGroup);
		$this->db->set('createdon','NOW()',FALSE);
		$this->db->set('createdby',$this->session->userdata('userid'));
		
		//return $this->db->insert('environment'); 
	}
	
	public function delEnvironment($envId){	
		$this->db->delete('environment', array('envid' => $envId));
		$this->db->delete('calendar', array('envid' => $envId));
		
		return;
	}
	
}