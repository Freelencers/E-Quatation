<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_brand extends CI_Controller{

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
		$this->load->model("M_brand");
	}

	public function api_get_brand(){
		$data = $this->M_brand->get_brand();
		$data = $data->result();
		echo json_encode($data);
	}


	public function api_insert_brand(){
		$row = $this->input->post();
		$result = $this->M_brand->insert_brand($row);
		
		if($result){
		
			// Log
			action_log("Create Brand ".$row["bra_name"]);
			$row = $this->M_brand->get_last_brand();
			$data["brand"] = $row->result();
			$data["last_index"] = $this->M_brand->get_brand()->num_rows();

			$data["status"] = 1;
			$data["msg"] = "Insert complete";
			

		}else{

			$data["status"] = 0;
			$data["msg"] = "Insert fail";
		}

		echo json_encode($data);
	}

	public function api_brand_delete(){
		
		$data = $this->input->post();
		$result = $this->M_brand->delete_brand($data);

		if($result){
			
			// Log
			action_log("Delete Brand id:" . $data["bra_id"]);
			$resp["status"] = 1;
			$resp["msg"] = "Delete complete";
		}else{

			$resp["status"] = 0;
			$resp["msg"] = "Delete fail";
		}
		echo json_encode($resp);
	}

	public function api_brand_update(){
		$data = $this->input->post();
		$result = $this->M_brand->update_brand($data);

		if($result){
			
			// Log
			action_log("Update Brand id:" . $data["bra_id"] . " to " . $data["bra_name"]);
			// Get new update
			$row = $this->M_brand->get_brand_by_id($data);
			$resp["brand"] = $row->result();
			$resp["status"] = 1;
			$resp["msg"] = "Update complete";
		}else{

			$resp["status"] = 0;
			$resp["msg"] = "Update fail";
		}
		echo json_encode($resp);
	}
}
