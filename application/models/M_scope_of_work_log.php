<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_scope_of_work_log extends CI_Model{

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
	
	public function insert_scope_of_work_log($data){

		$this->db->insert("scope_of_work_log", $data);
		if($data["sol_sow_id"] == 99){

			$temp["sow_value"] = $data["sol_sow_other"];
			$this->db->insert("scope_of_work", $temp);
		}
		if($this->db->affected_rows() > 0)
		{
			// Code here after successful insert
			return true; // to the controller
		}
	}

	// public function get_last_service_log($prj_id){
	// 	$this->db->select('*')
	// 	->from("service_log")
	// 	->join("services", "ser_id = sel_ser_id")
	// 	->where("sel_prj_id", $prj_id)
	// 	->order_by("sel_id","desc")
	// 	->limit("1");

	// 	return $this->db->get()->result();
	// }

	public function get_scope_of_work_log_by_prj_id($prj_id){
		$this->db->select("*")
		->from("scope_of_work_log")
		->join("scope_of_work", "sow_id = sol_sow_id")
		->where("sol_prj_id", $prj_id)
		->order_by("sol_id", "DESC");

		return $this->db->get()->result();
	}

	public function get_scope_of_work_log_by_sol_id($sol_id){
		$this->db->select("*")
		->from("scope_of_work_log")
		->join("scope_of_work", "sow_id = sol_sow_id")
		->where("sol_id", $sol_id);

		return $this->db->get()->result();
	}

	public function update_scope_of_work_log($data){
		$this->db->where("sol_id", $data["sol_id"])
		->update("scope_of_work_log", $data);
	}

	public function delete_scope_of_work_log($sol_id){
		$this->db->where("sol_id", $sol_id)
		->delete("scope_of_work_log");
	}
}
