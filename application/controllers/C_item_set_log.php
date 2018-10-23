<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_item_set_log extends CI_Controller{

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
		$this->load->model("M_item_set_log");
	}


	// public function api_get_item_set(){
	// 	$data = $this->M_item_set->get_item_set();
	// 	$data = $data->result();
	// 	echo json_encode($data);
	// }


	public function api_insert_item_set_log(){
		$row = $this->input->post();
		$result = $this->M_item_set_log->insert_item_set_log($row);
		
		if($result){
			
			$row = $this->M_item_set_log->get_last_item_set_log();
			$data["item_set_log"] = $row->result();
			$data["last_index"] = $this->M_item_set_log->get_item_set_log()->num_rows();

			$data["status"] = 1;
			$data["msg"] = "Insert complete";
			

		}else{

			$data["status"] = 0;
			$data["msg"] = "Insert fail";
		}

		echo json_encode($data);
	}

	public function api_delete_item_set_log(){
		
		$data = $this->input->post();
		$result = $this->M_item_set_log->delete_item_set_log($data);

		if($result){
			
			$resp["status"] = 1;
			$resp["msg"] = "Delete complete";
		}else{

			$resp["status"] = 0;
			$resp["msg"] = "Delete fail";
		}
		echo json_encode($resp);
	}

	// public function api_item_set_update(){
	// 	$data = $this->input->post();
	// 	$result = $this->M_item_set->update_item_set($data);

	// 	if($result){
			
	// 		// Get new update
	// 		$row = $this->M_item_set->get_item_set_by_id($data);
	// 		$resp["item_set"] = $row->result();
	// 		$resp["status"] = 1;
	// 		$resp["msg"] = "Update complete";
	// 	}else{

	// 		$resp["status"] = 0;
	// 		$resp["msg"] = "Update fail";
	// 	}
	// 	echo json_encode($resp);
	// }
}
