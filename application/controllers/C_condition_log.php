<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_condition_log extends CI_Controller{

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
		$this->load->model("M_condition_log");
	}

	public function api_insert_condition_log(){
		
		$row = $this->input->post();
		$this->M_condition_log->insert_condition_log($row);

		$data["status"] = 1;
		echo json_encode($data);
	}

	public function api_get_condition_log_by_prj_id(){

		$row = $this->input->post();
		$data = $this->M_condition_log->get_condition_log_by_prj_id($row["prj_id"]);

		echo json_encode($data);
	}

	public function api_get_condition_log_by_col_id(){
		$row = $this->input->post();
		$data["condition_log"] = $this->M_condition_log->get_condition_log_by_col_id($row["col_id"]);

		echo json_encode($data);
	}

	public function api_update_condition_log(){
		$row = $this->input->post();
		$this->M_condition_log->update_condition_log($row);
		$data["condition_log"] = $this->M_condition_log->get_condition_log_by_col_id($row["col_id"]);
		$data["condition_log"]["no"] = count($this->M_condition_log->get_condition_log_by_prj_id($data["condition_log"][0]->col_prj_id)); 
	
		$json["status"] = 1;
		echo json_encode($json);
	}

	public function api_delete_condition_log(){
		$row = $this->input->post();
		$this->M_condition_log->delete_condition_log($row["col_id"]);
		$data["status"] = 1;

		echo json_encode($data);

	}
}
