<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_system_log extends CI_Model{

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
	
	public function insert_system_log($data){

		$this->db->insert('system_log', $data);
		if($this->db->affected_rows() > 0)
		{
			// Codhere after successful insert
			return true; // to the controller
		}
	}

	public function get_last_system_log(){
		$this->db->select("syl_id")
		->from("system_log")
		->order_by("syl_id", "desc")
		->limit(1);

		return $this->db->get()->result();
	}

	public function get_system_log_by_prj_id($prj_id){
		$this->db->select("*")
		->from("system_log")
		->join("system_type", "system_log.syl_syt_id = system_type.syt_id")
		->where("syl_prj_id", $prj_id);

		return $this->db->get();
	}

	public function delete_system_log_by_prj_id($prj_id){
	

		$this->db->select("syl_id")
		->from("system_log")
		->where("syl_prj_id", $prj_id);
		$syl_id = $this->db->get()->result();

		foreach($syl_id as $row){
			$this->db->where("brl_syl_id", $row->syl_id)
			->delete("brand_log");
		}

		$this->db->where("syl_prj_id", $prj_id)
		->delete("system_log");

	}
}
