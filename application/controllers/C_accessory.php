<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_accessory extends CI_Controller{

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
		//$this->load->model("M_hardware");
		$this->load->model("M_accessory");
	}

	public function api_insert_accessory(){
		$row = $this->input->post();
		$result = $this->M_accessory->insert_accessory($row);
		
		if($result){
			
			$last = $this->M_accessory->get_last_accessory($row["acc_prj_id"]);
			$data["accessory"] = $last->result();

			$data["last_index"] = $this->M_accessory->get_accessory($row)->num_rows();

			$data["status"] = 1;
			$data["msg"] = "Insert complete";
			

		}else{

			$data["status"] = 0;
			$data["msg"] = "Insert fail";
		}

		echo json_encode($data);
	}

	public  function api_get_accessory_by_project(){
		$row = $this->input->post();
		$result["accessory"] = $this->M_accessory->get_accessory_by_prj_id($row["prj_id"]);

		echo json_encode($result);
	}

	public function api_delete_accessory(){
		$row = $this->input->post();
		$this->M_accessory->delete_accessory($row["acc_id"]);
	}

	public function api_get_accessory_by_acc_id(){
		$row = $this->input->post();
		$result["accessory"] = $this->M_accessory->get_accessory_by_acc_id($row["acc_id"]);
		
		echo json_encode($result);
	}

	public function api_update_accessory(){
		$row = $this->input->post();
		$this->M_accessory->update_accessory($row);

		$result["accessory"] = $this->M_accessory->get_accessory_by_acc_id($row["acc_id"]);
		echo json_encode($result);
	}

	public function api_get_discount(){
		$data = $this->input->post();
		$result = $this->M_accessory->get_discount($data["acc_id"]);
		echo json_encode($result);
	}

	public function api_set_discount(){
		$data = $this->input->post();
		$result = $this->M_accessory->set_discount($data);

		$resp["status"] = 1;
		echo json_encode($resp);
	}
}
