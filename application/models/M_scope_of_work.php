<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_scope_of_work extends CI_Model{

	/**
	 * Index Page for this sowtroller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this sowtroller is set as the default sowtroller in
	 * sowfig/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	
	public function insert_scope_of_work($data){

		$this->db->insert('scope_of_work', $data);
		if($this->db->affected_rows() > 0)
		{
			// Codhere after successful insert
			return true; // to the sowtroller
		}
	}

	public function get_last_scope_of_work(){
		$this->db->select("*")
		->from("scope_of_work")
		->order_by("sow_id", "desc")
		->limit(1);

		return $this->db->get()->result();
	}

	public function get_scope_of_work_by_prj_id($prj_id){
		$this->db->select("*")
		->from("scope_of_work")
		->where("sow_prj_id", $prj_id)
		->order_by("sow_id", "DESC");

		return $this->db->get()->result();
	}

	public function get_scope_of_work_by_sow_id($sow_id){
		$this->db->select("*")
		->from("scope_of_work")
		->where("sow_id", $sow_id);

		return $this->db->get()->result();
	}

	public function update_scope_of_work($data){
		$this->db->where("sow_id", $data["sow_id"])
		->update("scope_of_work", $data);
	}

	public function delete_scope_of_work($sow_id){
	
		$this->db->where("sow_id", $sow_id)
		->delete("scope_of_work");
	}
}
