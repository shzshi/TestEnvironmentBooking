<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
   
    /**
     * Get All Data from this method.
     *
     * @return Response
    */
    public function __construct() {
       parent::__construct();
       $this->load->database();
    } 
  
    /**
     * Get All Data from this method.
     *
     * @return Response
    */
    public function index()
    {
        $query = $this->db->query("select count(reservename) as count from calendar GROUP BY MONTH(starttime) ORDER BY starttime"); 
        $data['booking'] = json_encode(array_column($query->result(), 'count'),JSON_NUMERIC_CHECK);
   
        $this->load->view('environment_view', $data);
    }
}
?>