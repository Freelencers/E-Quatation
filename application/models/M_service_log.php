<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_service_log extends CI_Model{

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
	
	public function insert_service_log($data){

		$this->db->insert("service_log", $data);
		if($data["sel_ser_id"] == 99){

			$temp["ser_name"] = $data["sel_ser_other"];
			$this->db->insert("services", $temp);
		}
		if($this->db->affected_rows() > 0)
		{
			// Code here after successful insert
			return true; // to the controller
		}
	}

	public function get_last_service_log($prj_id){
		$this->db->select('*')
		->from("service_log")
		->join("services", "ser_id = sel_ser_id")
		->where("sel_prj_id", $prj_id)
		->order_by("sel_id","desc")
		->limit("1");

		return $this->db->get()->result();
	}

	public function get_service_log_by_prj_id($prj_id){
		$this->db->select("sel_id, sel_ser_id, ser_name, sel_ser_price, sel_ser_unit, sel_ser_other")
		->from("service_log")
		->join("services", "ser_id = sel_ser_id")
		->where("sel_prj_id", $prj_id)
		->order_by("sel_id", "DESC");

		return $this->db->get()->result();
	}

	public function get_service_log_by_sel_id($sel_id){
		$this->db->select("sel_id, ser_name, sel_ser_value, sel_ser_id, ser_name, sel_prj_id")
		->from("service_log")
		->join("services", "ser_id = sel_ser_id")
		->where("sel_id", $sel_id);

		return $this->db->get()->result();
	}

	public function update_service_log($data){
		$this->db->where("sel_id", $data["sel_id"])
		->update("service_log", $data);
	}

	public function delete_service_log($sel_id){
		$this->db->where("sel_id", $sel_id)
		->delete("service_log");
	}
}
