<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_login extends CI_Controller{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function __construct(){

		parent::__construct();
		$this->load->model("M_employee");
		$this->load->model("M_log");
	}

	public function index()
	{
        //template();
		$this->load->view("V_login");
	}

	public function api_login(){
		$username = $this->input->post("username");
		$password = $this->input->post("password");

		//$username = "test";
		//$password = "test";

		$find_username = $this->M_employee->find_username($username);
		$find_username = $find_username->num_rows();

		$data["msg"] = "";
		$data["status"] = 0;
		if($find_username == 0){

			$data['msg'] = "Username or Password is wrong";
			$data['status'] = 0;
		}else if($find_username >= 1){
			
			$query = $this->M_employee->login($username,$password);
			$login =  $query->num_rows();
			if($login >= 1){

				$data["msg"] = "Success";
				$data['status'] = 1;

				$login = $query->row_array();
				$session_data = array(
					"emp_id" => $login["emp_id"],
					"username" => $login["emp_username"],
					"first_name" => $login["emp_first_name"],
					"last_name" => $login["emp_last_name"],
					"position_id" => $login["pos_id"],
					"position" => $login["pos_name"]
				);
				$this->session->set_userdata($session_data);

			}else{
				$data["msg"] ="Password is wrong";
				$data['status'] = 0;
			}
		}
		echo json_encode($data);
	}
	
	public function api_forgot_password(){
	    
	    // Mail servcer config
	    $config['protocol'] = 'POP3';
        $config['mailpath'] = '/usr/sbin/sendmail';
        $config['charset'] = 'iso-8859-1';
        $config['wordwrap'] = TRUE;
        $this->email->initialize($config);
	    
	    // Check username as email in databse
	    $data = $this->input->post();
	    
	    //$data["emp_email"] = "pakorn_traipan@icloud.com";
	    //$data["emp_username"] = "user01";
	    $query = $this->M_employee->forgot_password($data);
	    $result = $query->result();
	    
	    if($query->num_rows() != 0 ){
	        //echo json_encode($result);
    	    $this->email->from('den-pakorn@den-pakorn.webstarterz.com', 'OTEC Quatation System');
            $this->email->to($data["emp_email"]);
            
            $this->email->subject('Forget your password');
            $this->email->message('Your password is : ' . $result[0]->emp_password);
            
            $this->email->send();
            
            $json["status"] = 1;
	    }else{
	        
	        $json["status"] = 0;
	    }
	    echo json_encode($json);
	}

	public function forget_password_view(){
		
		$this->load->view("V_forget_password");
	}

	public function logout(){
		$this->session->sess_destroy();
		redirect("");
	}

	public function get_log(){

		$result = $this->M_log->get_log()->result();

		$nav[0]["page"] = "System Log";
		$nav[0]["icon"] = "fa fa-history";
		$nav[0]["link"] = "#";
		$nav[0]["active"] = "";

		// Permissino check
		$permission = $this->M_permission_module->check_user_permission($this->session->userdata("emp_id"), "Log");
		if($permission == 0){

			echo "<script>";
			echo "	alert('You not have permission');";
			echo "	history.back();";
			echo "</script>";
		}else{

			$data["permission"] = $permission;
			$data["log"] = $result;
			$view = $this->load->view("V_log", $data, TRUE);
			template( "System Log", "This page for monitoring log", $view, $nav);
		}
	}
}
