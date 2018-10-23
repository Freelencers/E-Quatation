<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_condition extends CI_Controller{

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
		$this->load->model("M_condition");
		$this->load->model("M_condition_log");
	}

	public function api_insert_condition(){

		$row = $this->input->post();
		$this->M_condition_log->insert_condition_log($row);

		$data["status"] = 1;
		echo json_encode($data);
	}

	// public function api_get_condition_by_prj_id(){

	// 	$row = $this->input->post();
	// 	$data = $this->M_condition->get_condition_by_prj_id($row["prj_id"]);

	// 	echo json_encode($data);
	// }

	// public function api_get_condition_by_con_id(){
	// 	$row = $this->input->post();
	// 	$data["condition"] = $this->M_condition->get_condition_by_con_id($row["con_id"]);

	// 	echo json_encode($data);
	// }

	// public function api_update_condition(){
	// 	$row = $this->input->post();
	// 	$this->M_condition->update_condition($row);
	// 	$data["condition"] = $this->M_condition->get_condition_by_con_id($row["con_id"]);
	// 	$data["condition"]["no"] = count($this->M_condition->get_condition_by_prj_id($data["condition"][0]->con_prj_id)); 
		
	// 	echo json_encode($data);
	// }

	// public function api_delete_condition(){
	// 	$row = $this->input->post();
	// 	$this->M_condition->delete_condition($row["con_id"]);

	// }

	public function api_get_condition(){

		$data = $this->M_condition->get_condition();
		$data = $data->result();
		echo json_encode($data);
	}
}
