<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_condition extends CI_Model{

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
	
	public function insert_condition($data){

		$this->db->insert('condition', $data);
		if($this->db->affected_rows() > 0)
		{
			// Codhere after successful insert
			return true; // to the controller
		}
	}

	public function get_last_condition(){
		$this->db->select("*")
		->from("condition")
		->order_by("con_id", "desc")
		->limit(1);

		return $this->db->get()->result();
	}

	public function get_condition_by_prj_id($prj_id){
		$this->db->select("*")
		->from("condition")
		->where("con_prj_id", $prj_id)
		->order_by("con_id", "DESC");;

		return $this->db->get()->result();
	}

	public function get_condition_by_con_id($con_id){
		$this->db->select("*")
		->from("condition")
		->where("con_id", $con_id);

		return $this->db->get()->result();
	}

	public function update_condition($data){
		$this->db->where("con_id", $data["con_id"])
		->update("condition", $data);
	}

	public function delete_condition($con_id){
	
		$this->db->where("con_id", $con_id)
		->delete("condition");
	}
}
