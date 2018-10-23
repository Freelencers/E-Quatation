<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_place_type extends CI_Controller{

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
		$this->load->model("M_place_type");
	}

	public function api_get_place_type(){
		$data = $this->M_place_type->get_place_type();
		$data = $data->result();
		echo json_encode($data);
	}

	public function api_insert_place_type(){
		$row = $this->input->post();
		$result = $this->M_place_type->insert_place_type($row);
		
		if($result){
			
			$row = $this->M_place_type->get_last_place_type();
			$data["place_type"] = $row->result();
			$data["last_index"] = $this->M_place_type->get_place_type()->num_rows();

			$data["status"] = 1;
			$data["msg"] = "Insert complete";
			

		}else{

			$data["status"] = 0;
			$data["msg"] = "Insert fail";
		}

		echo json_encode($data);
	}

	public function api_place_type_delete(){
		
		$data = $this->input->post();
		$result = $this->M_place_type->delete_place_type($data);

		if($result){
			
			$resp["status"] = 1;
			$resp["msg"] = "Delete complete";
		}else{

			$resp["status"] = 0;
			$resp["msg"] = "Delete fail";
		}
		echo json_encode($resp);
	}

	public function api_place_type_update(){
		$data = $this->input->post();
		$result = $this->M_place_type->update_place_type($data);

		if($result){
			
			// Get new update
			$row = $this->M_place_type->get_place_type_by_id($data);
			$resp["place_type"] = $row->result();
			$resp["status"] = 1;
			$resp["msg"] = "Update complete";
		}else{

			$resp["status"] = 0;
			$resp["msg"] = "Update fail";
		}
		echo json_encode($resp);
	}
}
