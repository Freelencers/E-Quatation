<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_hardware extends CI_Controller{

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
		$this->load->model("M_hardware");
		$this->load->model("M_item_set_log");
	}

	public function api_insert_hardware(){
		$row = $this->input->post();
		$result = $this->M_hardware->insert_hardware($row);
		
		if($result){
			
			$last = $this->M_hardware->get_last_hardware($row["har_prj_id"]);
			$data["hardware"] = $last->result();

			$data["last_index"] = $this->M_hardware->get_hardware($row)->num_rows();

			$data["status"] = 1;
			$data["msg"] = "Insert complete";
			

		}else{

			$data["status"] = 0;
			$data["msg"] = "Insert fail";
		}

		echo json_encode($data);
	}

	public  function api_get_hardware_by_project(){
		$row = $this->input->post();
		$result["hardware"] = $this->M_hardware->get_hardware_by_prj_id($row["prj_id"]);

		echo json_encode($result);
	}

	public function api_delete_hardware(){
		$row = $this->input->post();
		$this->M_hardware->delete_hardware($row["har_id"]);
	}

	public function api_get_hardware_by_har_id(){
		$row = $this->input->post();
		$result["hardware"] = $this->M_hardware->get_hardware_by_har_id($row["har_id"]);
		
		echo json_encode($result);
	}

	public function api_update_hardware(){
		$row = $this->input->post();
		$this->M_hardware->update_hardware($row);

		$result["hardware"] = $this->M_hardware->get_hardware_by_har_id($row["har_id"]);
		$result["last_index"] = $this->M_hardware->get_hardware($row)->num_rows();
		echo json_encode($result);
	}

	public function api_add_hardawre_by_item_set(){
		$row = $this->input->post();
		$list_product = $this->M_item_set_log->get_item_set_by_its_id($row)->result();

		$har_row["har_syt_id"] = $row["isl_syt_id"];
		$har_row["har_prj_id"] = $row["isl_prj_id"];
		$json["hardware"] = array();
		foreach($list_product as $row){

			$har_row["har_qty"] = $row->isl_qty;
			$har_row["har_pro_id"] = $row->isl_pro_id;
			$this->M_hardware->insert_hardware($har_row);

			// get data last row
			$last = $this->M_hardware->get_last_hardware($har_row["har_prj_id"])->result();
			$last[0]->index = $this->M_hardware->get_hardware($har_row)->num_rows();
			array_push($json["hardware"], $last[0]);
		}

		echo json_encode($json);

	}

	public function api_get_discount(){
		$data = $this->input->post();
		$result = $this->M_hardware->get_discount($data["har_id"]);
		echo json_encode($result);
	}

	public function api_set_discount(){
		$data = $this->input->post();
		$result = $this->M_hardware->set_discount($data);

		$resp["status"] = 1;
		echo json_encode($resp);
	}
}
