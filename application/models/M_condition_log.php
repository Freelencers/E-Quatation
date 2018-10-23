<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_condition_log extends CI_Model{

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
	
	public function insert_condition_log($data){

		$this->db->insert("condition_log", $data);

		// Insert other case
		if($data["col_con_id"] == 99){

			$temp["con_value"] = $data["col_con_other"];
			$this->db->insert("condition", $temp);
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

	public function get_condition_log_by_prj_id($prj_id){
		$this->db->select("*")
		->from("condition_log")
		->join("condition", "con_id = col_con_id")
		->where("col_prj_id", $prj_id)
		->order_by("col_id", "DESC");

		return $this->db->get()->result();
	}

	public function get_condition_log_by_col_id($col_id){
		$this->db->select("*")
		->from("condition_log")
		->join("condition", "con_id = col_con_id")
		->where("col_id", $col_id);

		return $this->db->get()->result();
	}

	public function update_condition_log($data){
		$this->db->where("col_id", $data["col_id"])
		->update("condition_log", $data);
	}

	public function delete_condition_log($col_id){
		$this->db->where("col_id", $col_id)
		->delete("condition_log");
	}
}
