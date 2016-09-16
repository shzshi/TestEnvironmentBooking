<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Environment extends CI_Controller {

	function __construct(){
        parent::__construct();
		$this->check_isvalidated();
		$this->load->model('environment_model');
    }

	public function index(){
	   
	   $this->data['title']='Environment';
	   
	   // adding the pagination
	   $this->load->library('pagination');
	   $this->load->library('table'); 
		
	   $config['base_url'] = base_url().'/environment/index/';
	   $config['total_rows'] = $this->db->get('environment')->num_rows();
	   $config['per_page'] = 10;
	   $config['num_links'] = 10;
	   $config['uri_segment'] = 3;
	   
	   $this->pagination->initialize($config);	   
	   
	   //getting record for course from course by logged in user.
	   
	   $this->data=$this->environment_model->get_all($this->session->userdata('userid'),$this->session->userdata('usertype'),$config['per_page'],$this->uri->segment(3));
	   //$this->data['msg'] = $msg;
	   
	   $this->load->view('environment_view',$this->data);
	}
	
    public function add (){
	
	  $msg=$this->environment_model->add();			
	  redirect('environment');
	}
	
	public function environmentdiv(){
	
	    $envID = $this->security->xss_clean($this->input->post('envID'));
		$results=$this->environment_model->getEnvironment($envID);
		
		$attributes = array ('name'=> 'updateEnvironmentForm','id'=>'updateEnvironmentForm');
		$envArray = array("development","non-production","production");
		$appArray = array("apache","dotnet","jboss","mobile","sharepoint","weblogic");
		$dbArray = array("oracle","sqlserver","mysql","mongodb","postgress");
		$mArray = array("soa","camel");
		$componentArray = explode("~",$results->component);
		print_r($componentArray);
		
        $EnvironmentFormDiv="
		  <div class=\"modal-body\">
			  ".form_open_multipart('environment/edit',$attributes)."
				  Environment Name : <input type=\"text\" name=\"envname\" class=\"input-medium\" value=\"".$results->envname."\" /><br/><br/>
				  Environment Type : <select name=\"envtype\">
				  ";
				
				foreach($envArray as $sValue)
				{				
					if($results->envtype == $sValue)
						$EnvironmentFormDiv.="<option value=\"".$sValue."\" selected>".ucwords($sValue)."</option>";
					else
						$EnvironmentFormDiv.="<option value=\"".$sValue."\">".ucwords($sValue)."</option>";
				}
				
				$EnvironmentFormDiv.="</select></BR>
				Component : <select name=\"componentGroup[]\" multiple=\"multiple\" style=\"width: 400px !important; min-width: 350px; max-width: 380px;\">
												<optgroup label=\"Application\">";
												
													foreach($appArray as $aValue)
													{				
														if(in_array($aValue,$componentArray))
															$EnvironmentFormDiv.="<option value=\"".$aValue."\" selected>".ucwords($aValue)."</option>";
														else
															$EnvironmentFormDiv.="<option value=\"".$aValue."\">".ucwords($aValue)."</option>";
													}
												$EnvironmentFormDiv.="</optgroup>
												<optgroup label=\"Databases\">";
													foreach($dbArray as $dbValue)
													{																		
														if(in_array($dbValue,$componentArray))
															$EnvironmentFormDiv.="<option value=\"".$dbValue."\" selected>".ucwords($dbValue)."</option>";
														else
															$EnvironmentFormDiv.="<option value=\"".$dbValue."\">".ucwords($dbValue)."</option>";
													}
												$EnvironmentFormDiv.="</optgroup>
												<optgroup label=\"MiddleWare\">";
													foreach($mArray as $mValue)
													{				
														if(in_array($mValue,$componentArray))
															$EnvironmentFormDiv.="<option value=\"".$mValue."\" selected>".ucwords($mValue)."</option>";
														else
															$EnvironmentFormDiv.="<option value=\"".$mValue."\">".ucwords($mValue)."</option>";
													}
																					
				$EnvironmentFormDiv.="</optgroup></select><div class=\"modal-footer\">
					<a href=\"#\" class=\"btn btn-danger\" data-dismiss=\"modal\" aria-hidden=\"true\">Close</a>
					<button type=\"submit\" name=\"editEnvironment\" class=\"btn btn-success\" id=\"editEnvironment\">Edit this Environment</button>
				</div>
			  <input type='hidden' name='envid' value='".$envID."'>
			  </form>
		  </div>";
			  
      echo $EnvironmentFormDiv;			  
	}
    
    public function edit(){	
	  $this->environment_model->updateEnvironment();
	  redirect('environment');
    }
    
    public function delete(){
		$this->environment_model->delEnvironment($this->uri->segment(3));
		$this->session->set_flashdata('message', '<p>User were successfully deleted!</p>');
		redirect('environment');
	}
	
	private function check_isvalidated(){
        if(! $this->session->userdata('validated')){
            redirect('/');
        }
    }
}