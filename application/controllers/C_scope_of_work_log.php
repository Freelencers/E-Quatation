<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_scope_of_work_log extends CI_Controller{

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
		$this->load->model("M_scope_of_work_log");
	}

	public function api_insert_scope_of_work_log(){

		$row = $this->input->post();
		$this->M_scope_of_work_log->insert_scope_of_work_log($row);

		$json["status"] = 1;
		echo json_encode($json);

	}

	public function api_get_scope_of_work_log_by_prj_id(){

		$row = $this->input->post();
		$data = $this->M_scope_of_work_log->get_scope_of_work_log_by_prj_id($row["prj_id"]);

		echo json_encode($data);
	}

	public function api_get_scope_of_work_log_by_sol_id(){
		$row = $this->input->post();
		$data["scope_of_work"] = $this->M_scope_of_work_log->get_scope_of_work_log_by_sol_id($row["sol_id"]);

		echo json_encode($data);
	}

	public function api_update_scope_of_work_log(){
		$row = $this->input->post();
		$this->M_scope_of_work_log->update_scope_of_work_log($row);

		$data["status"] = 1;
		echo json_encode($data);
	}

	public function api_delete_scope_of_work_log(){
		$row = $this->input->post();
		$this->M_scope_of_work_log->delete_scope_of_work_log($row["sol_id"]);

		$data["status"] = 1;
		echo json_encode($data);

	}
}
