<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_log extends CI_Model{

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
	
	public function create_log($msg){
		$data["log_emp_id"] = $this->session->userdata("emp_id");
		$data["log_msg"] = $msg;
		$this->db->insert("log", $data);

	}

	public function get_log(){
		$this->db->select("*")
		->from("log")
		->join("employee", "employee.emp_id = log.log_emp_id")
		->order_by("log_id", "DESC");

		return $this->db->get();
	}
	
}
