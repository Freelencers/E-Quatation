<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_scope_of_work extends CI_Controller{

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
		$this->load->model("M_scope_of_work");
	}

	public function api_insert_scope_of_work(){

		$row = $this->input->post();
		$this->M_scope_of_work->insert_scope_of_work($row);

		$data = $this->M_scope_of_work->get_last_scope_of_work($row["sow_prj_id"]);
		$data["no"] = count($this->M_scope_of_work->get_scope_of_work_by_prj_id($row["sow_prj_id"]));
		echo json_encode($data);
	}

	public function api_get_scope_of_work_by_prj_id(){

		$row = $this->input->post();
		$data = $this->M_scope_of_work->get_scope_of_work_by_prj_id($row["prj_id"]);

		echo json_encode($data);
	}

	public function api_get_scope_of_work_by_sow_id(){
		$row = $this->input->post();
		$data["scope_of_work"] = $this->M_scope_of_work->get_scope_of_work_by_sow_id($row["sow_id"]);

		echo json_encode($data);
	}

	public function api_update_scope_of_work(){
		$row = $this->input->post();
		$this->M_scope_of_work->update_scope_of_work($row);
		$data["scope_of_work"] = $this->M_scope_of_work->get_scope_of_work_by_sow_id($row["sow_id"]);
		$data["scope_of_work"]["no"] = count($this->M_scope_of_work->get_scope_of_work_by_prj_id($data["scope_of_work"][0]->sow_prj_id)); 
		
		echo json_encode($data);
	}

	public function api_delete_scope_of_work(){
		$row = $this->input->post();
		$this->M_scope_of_work->delete_scope_of_work($row["sow_id"]);

	}
}
