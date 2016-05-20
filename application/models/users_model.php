<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Shashikant Bangera
 * Description: Login model class
 */
class Users_model extends CI_Model{

    function __construct(){
        parent::__construct();
    }

    function get_all($user_id,$user_type,$limit,$offset) {
		$this->db->select('userid, username, firstname, lastname, usertype,organization,designation,phone');
		$this->db->from('users');
		
		if($user_type!='admin')
		$this->db->where('userid',$user_id);
		
		$this->db->limit($limit,$offset);
		$query = $this->db->get();
		
                #print_r($query);
			
		return $query->result_array();
	}
	
	public function getUser($userID){
	
	    $this->db->select('userid, username, firstname, lastname, usertype,organization,designation,phone');
		$this->db->where('userid', $userID);
		$query = $this->db->get('users');
		return $query->row();
	}
	
	public function updateUser()
	{	
		// grab user input
		$userName = $this->security->xss_clean($this->input->post('username'));
        $firstName = $this->security->xss_clean($this->input->post('firstname'));	    
        $lastName = $this->security->xss_clean($this->input->post('lastname'));	    
        $organisation = $this->security->xss_clean($this->input->post('organisation'));	    
        $designation = $this->security->xss_clean($this->input->post('designation'));	    
        $phone = $this->security->xss_clean($this->input->post('phone'));	
		$userID = $this->security->xss_clean($this->input->post('userid'));
	    
		$this->db->set('username', $userName);
		$this->db->set('firstname', $firstName);
		$this->db->set('lastname', $lastName);
		$this->db->set('usertype', $this->session->userdata('usertype'));
		$this->db->set('organization', $organisation);
		$this->db->set('designation', $designation);
		$this->db->set('phone', $phone);		
		//$this->db->set('modifiedon','NOW()',FALSE);

		$this->db->where('userid', $userID);
		$this->db->update('users');
		
		return;
	}
	
	public function add()
	{
		// grab user input
        $email = $this->security->xss_clean($this->input->post('username'));        
        $firstName = $this->security->xss_clean($this->input->post('firstname'));	    
        $lastName = $this->security->xss_clean($this->input->post('lastname'));	    
        $organisation = $this->security->xss_clean($this->input->post('organisation'));	    
        $designation = $this->security->xss_clean($this->input->post('designation'));	    
        $phone = $this->security->xss_clean($this->input->post('phone'));	
	    
		$this->db->set('username', $email);
		$this->db->set('password', 'PASSWORD("password")',FALSE);
		$this->db->set('firstname', $firstName);
		$this->db->set('lastname', $lastName);
		$this->db->set('usertype', 'student');
		$this->db->set('organisation', $organisation);
		$this->db->set('designation', $designation);
		$this->db->set('phone', $phone);
		$this->db->set('createdon','NOW()',FALSE);
		$this->db->set('createdby',$this->session->userdata('userid'));
		
		return $this->db->insert('users'); 
	}
	
	public function delUser($userId){	
	    $this->db->where('userid', $userId);
		$this->db->delete('users');
	}
	
	public function getUserDetailsByEmail($email){
	   $this->db->select('userid, username, firstname, lastname, usertype,organization,designation,phone,securityquestion,securityanswer');
	   $this->db->where('username', $email);
	   $query = $this->db->get('users');
	   return $query->row();
	}
	
	public function checkSecurityQuestion()
	{
		$email = $this->security->xss_clean($this->input->post('email'));
	    $answer = $this->security->xss_clean($this->input->post('answer'));
		$query=$this->db->query("select * from users where username='".$email."' and securityanswer='".$answer."'");
		return $query->num_rows();
	}
	
	public function updatePassword()
	{
		// update password for the user. 
		$userName = $this->security->xss_clean($this->input->post('email'));
        $password = $this->security->xss_clean($this->input->post('password'));
		
		$this->db->set('password', 'PASSWORD(\''.$password.'\')',FALSE);
		$this->db->where('username', $userName);
		$this->db->update('users');
	}
}
