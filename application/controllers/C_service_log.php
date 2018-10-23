<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_service_log extends CI_Controller{

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
		$this->load->model("M_service_log");
	}

	public function api_insert_service_log(){

		$row = $this->input->post();
		$this->M_service_log->insert_service_log($row);

		$data = $this->M_service_log->get_last_service_log($row["sel_prj_id"]);
		$data["no"] = count($this->M_service_log->get_service_log_by_prj_id($row["sel_prj_id"]));
		echo json_encode($data);
	}

	public function api_get_service_log_by_prj_id(){

		$row = $this->input->post();
		$data = $this->M_service_log->get_service_log_by_prj_id($row["prj_id"]);

		echo json_encode($data);
	}

	public function api_get_service_log_by_sel_id(){
		$row = $this->input->post();
		$data["service_log"] = $this->M_service_log->get_service_log_by_sel_id($row["sel_id"]);

		echo json_encode($data);
	}

	public function api_update_service_log(){
		$row = $this->input->post();
		$this->M_service_log->update_service_log($row);
		$data["service_log"] = $this->M_service_log->get_service_log_by_sel_id($row["sel_id"]);
		$data["service_log"]["no"] = count($this->M_service_log->get_service_log_by_prj_id($data["service_log"][0]->sel_prj_id)); 
		
		echo json_encode($data);
	}

	public function api_delete_service_log(){
		$row = $this->input->post();
		$this->M_service_log->delete_service_log($row["sel_id"]);

	}
}
