<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Shashikant Bangera
 * Description: Login model class
 */
class Register_model extends CI_Model{

    function __construct(){
        parent::__construct();
    }

    public function register() {
       // grab user input
        $email = $this->security->xss_clean($this->input->post('usr_email'));
        $password = $this->security->xss_clean($this->input->post('pwd'));	    
        $firstName = $this->security->xss_clean($this->input->post('first_name'));	    
        $lastName = $this->security->xss_clean($this->input->post('last_name'));	    
        $organisation = $this->security->xss_clean($this->input->post('organisation'));	    
        $designation = $this->security->xss_clean($this->input->post('designation'));	    
        $phone = $this->security->xss_clean($this->input->post('phone'));
		$securityQuestion = $this->security->xss_clean($this->input->post('securityQuestion'));
		$securityAnswer = $this->security->xss_clean($this->input->post('securityAnswer'));
		
		// Prep the query
		/*$data= array(
		'username'=> $email,
		'password' => 'PASSWORD("'.$password.'")', 
		'firstname' => $firstName, 
		'lastname' => $lastName, 
		'usertype' => 'instructor', 
		'organisation' => $organisation, 
		'designation' => $designation, 
		'phone' => '$phone', 
		'createdon' => 'NOW()'
		);*/ 
	   if(!empty($email) && !empty($password) && !empty($firstName) && !empty($lastName))
	   {   
		$this->db->set('username', $email);
		$this->db->set('password', 'PASSWORD("'.$password.'")',FALSE);
		$this->db->set('firstname', $firstName);
		$this->db->set('lastname', $lastName);
		$this->db->set('usertype', 'instructor');
		$this->db->set('organization', $organisation);
		$this->db->set('designation', $designation);
		$this->db->set('securityquestion', $securityQuestion);
		$this->db->set('securityanswer', $securityAnswer);
		$this->db->set('phone', $phone);
		$this->db->set('createdon','NOW()',FALSE);
		
		return $this->db->insert('users');
           }
    }	
}
