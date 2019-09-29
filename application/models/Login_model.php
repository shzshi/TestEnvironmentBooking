<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Shashikant Bangera
 * Description: Login model class
 */
class Login_model extends CI_Model{

    function __construct(){
        parent::__construct();
    }
    
    public function validate(){
        // grab user input
        $email = $this->security->xss_clean($this->input->post('email'));
        $password = $this->security->xss_clean($this->input->post('password'));
        
        // Prep the query
		$query=$this->db->query("SELECT * from users where username='$email' and password=PASSWORD('$password')");
	    
		// Let's check if there are any results
        if($query->num_rows() > 0)
        {
            // If there is a user, then create session data
            $row = $query->row();
            
            $data = array(
                    'userid' => $row->userid,
                    'firstname' => $row->firstname,
                    'lastname' => $row->lastname,
                    'username' => $row->username,
		    'usertype' => $row->usertype,
                    'validated' => true
                    );
            $this->session->set_userdata($data);
            return true;
        }
        // If the previous process did not validate
        // then return false.
        return false;
    }
}
?>
