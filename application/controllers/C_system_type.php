<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_system_type extends CI_Controller{

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
		$this->load->model("M_system_type");
	}

	public function api_get_system_type(){
		$data = $this->M_system_type->get_system_type();
		$data = $data->result();
		echo json_encode($data);
	}

	public function api_insert_system_type(){
		$row = $this->input->post();
		$result = $this->M_system_type->insert_system_type($row);
		
		if($result){

			// Log
			action_log("Create System Type ".$row["syt_name"]);

			$row = $this->M_system_type->get_last_system_type();
			$data["system_type"] = $row->result();
			$data["last_index"] = $this->M_system_type->get_system_type()->num_rows();

			$data["status"] = 1;
			$data["msg"] = "Insert complete";
			

		}else{

			$data["status"] = 0;
			$data["msg"] = "Insert fail";
		}

		echo json_encode($data);
	}

	
	public function api_system_type_delete(){
		
		$data = $this->input->post();
		$result = $this->M_system_type->delete_system_type($data);

		if($result){

			// Log
			action_log("Delete System Type id:".$data["syt_id"]);

			$resp["status"] = 1;
			$resp["msg"] = "Delete complete";
		}else{

			$resp["status"] = 0;
			$resp["msg"] = "Delete fail";
		}
		echo json_encode($resp);
	}

	public function api_system_type_update(){
		$data = $this->input->post();
		$result = $this->M_system_type->update_system_type($data);

		if($result){
			
			// Log
			action_log("Update System Type id:".$data["syt_id"]. " to ". $data["syt_name"]);

			// Get new update
			$row = $this->M_system_type->get_system_type_by_id($data);
			$resp["system_type"] = $row->result();
			$resp["status"] = 1;
			$resp["msg"] = "Update complete";
		}else{

			$resp["status"] = 0;
			$resp["msg"] = "Update fail";
		}
		echo json_encode($resp);
	}


}
