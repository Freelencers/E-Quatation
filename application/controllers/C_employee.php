<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_employee extends CI_Controller{

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
		$this->load->model("M_system_module");

		//action_log("TEST");
	}

	public function index()
	{

		// Log
		action_log("Acess Employee");

		$nav[0]["page"] = "Employee";
		$nav[0]["icon"] = "fa fa-users";
		$nav[0]["link"] = "#";
		$nav[0]["active"] = "";

		// Permissino check
		$permission = $this->M_permission_module->check_user_permission($this->session->userdata("emp_id"), "Employee");
		if($permission == 0){

			echo "<script>";
			echo "	alert('You not have permission');";
			echo "	window.location.replace('C_manual');";
			echo "</script>";
		}else{

			$data["permission"] = $permission;
			$view = $this->load->view("V_employee", $data, TRUE);
			template( "Employee Management", "This page for management username in system", $view, $nav);
		}


		
	}

	public function api_insert(){


		$row = $this->input->post();
		$result = $this->M_employee->new_user($row);
	
		// Log
		action_log("Create user " . $row["emp_username"]);

		if($result){
			
			$row = $this->M_employee->get_last_employee();
			$data["employee"] = $row->result();
			$data["last_index"] = $this->M_employee->get_employee()->num_rows();

			// Set permission
			$module = $this->M_system_module->get_module()->result();
			$data_pmm["pmm_emp_id"] = $data["employee"][0]->emp_id;
			foreach($module as $row){
				$data_pmm["pmm_stm_id"] = $row->stm_id;
				$this->M_permission_module->insert_permission_module($data_pmm);
			}

			$data["status"] = 1;
			$data["msg"] = "Insert complete";
			

		}else{

			$data["status"] = 0;
			$data["msg"] = "Insert fail";
		}

		echo json_encode($data);
	}

	public function api_get_employee(){
		$data = $this->M_employee->get_employee();
		$data = $data->result();
		echo json_encode($data);
	}

	public function api_change_password(){

		// Login
		$data["username"] = $this->input->post("username");
		$data["password"] = $this->input->post("password");

		$verify = http_request($data, "POST", base_url("index.php/C_login/api_login"));
		$verify = json_decode($verify);

		if($verify->status == 1){
			
			// New password
			$data["emp_new_password"] = $this->input->post("new_password");
			$data["emp_new_password_confirm"] = $this->input->post("confirm_password");
			
			if($data["emp_new_password"] == $data["emp_new_password_confirm"]){

				$this->M_employee->change_password($data);
				$resp["status"] = 1;
				$resp["emp_id"] = $this->input->post("emp_id");

				// Log
				action_log("Change password of " . $data["username"]);
			}else{
				$resp["status"] = 3;
				$resp["msg"] = "Your new password is not same confirm password.";
			}
		}else{
			$resp["status"] = 2;
			$resp["msg"] = "Password is incorrect.";
		}

		echo json_encode($resp);
		
	}


	// Change Profile
	public function api_get_profile(){
		
		$data["emp_id"] = $this->input->post("emp_id");
		$profile = $this->M_employee->get_profile($data);
		$profile = $profile->result();

		echo json_encode($profile);
	}

	public function api_change_profile(){
		$data = $this->input->post();
		$data["emp_update"] = date("Y-m-d H:i:s");
		$result = $this->M_employee->change_profile($data);

		if($result){
			
			// Get new update
			$row = $this->M_employee->get_profile($data);
			$row = $row->result();
			$resp["employee"] = $row;
			$resp["status"] = 1;
			$resp["msg"] = "Update complete";
		
			// Log
			action_log("Change profile of " . $row[0]->emp_username);
		}else{

			$resp["status"] = 0;
			$resp["msg"] = "Update fail";
		}
		echo json_encode($resp);
	}

	public function api_employee_delete(){
		
		$data = $this->input->post();
		$result = $this->M_employee->delete($data);
		
		// Log
		$log = $this->M_employee->get_profile($data)->result();
		action_log("Delete user " . $log[0]->emp_username);

		if($result){
			
			$resp["status"] = 1;
			$resp["msg"] = "Delete complete";
		}else{

			$resp["status"] = 0;
			$resp["msg"] = "Delete fail";
		}
		echo json_encode($resp);
	}

	public function api_get_sale_man(){

		$result = $this->M_employee->get_sale_man();
		$data["sale_man"] = $result->result();
		echo json_encode($data);
	}

	public function api_get_waitting_approve(){
		$result = $this->M_employee->get_waitting_approve();
		$data = $result->result();
		echo json_encode($data);
	}

	public function api_approve(){

		$data = $this->input->post();
		$this->M_employee->approve($data);

		// Log
		$log = $this->M_employee->get_profile($data)->result();
		action_log("Approve user " . $log[0]->emp_username);
	}
}
