<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_permission_module extends CI_Controller{

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
		$this->load->model("M_permission_module");
		$this->load->model("M_employee");
	}

	public function api_get_permission_by_emp_id(){
		$data = $this->input->post();
		$data = $this->M_permission_module->get_permission_by_emp_id($data);
		$data = $data->result();
		echo json_encode($data);
	}

	public function api_update_permission(){
		// emp_id, pmm_read, pmm_copy
		$data = $this->input->post();

		// Log
		$emp_id["emp_id"] = $data["pmm_emp_id"]; 
		$log = $this->M_employee->get_profile($emp_id)->result();
		action_log("Grand permission user " . $log[0]->emp_username);

		$data = $this->M_permission_module->update_permission($data);
	}
}
