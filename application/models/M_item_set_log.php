<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_item_set_log extends CI_Model{

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
	
	public function get_item_set_log(){
		$this->db->select("*")
		->from("item_set_log");

		return $this->db->get();
	}

	public function delete_item_set_log($data){

		$this->db->where("isl_id", $data["isl_id"])
		->delete("item_set_log");
		if($this->db->affected_rows() > 0)
		{
			// Code here after successful insert
			return true; // to the controller
		}
	}

	// public function update_item_set($data){
	// 	$this->db->where("its_id", $data["its_id"])
	// 	->update("item_set", $data);
	// 	if($this->db->affected_rows() > 0)
	// 	{
	// 		// Code here after successful insert
	// 		return true; // to the controller
	// 	}
	// }

	public function get_item_set_by_its_id($data){
		$this->db->select("*")
		->from("item_set_log")
		->where("isl_its_id", $data["isl_its_id"]);

		return $this->db->get();
	}

	public function insert_item_set_log($data){
		
		$this->db->insert('item_set_log', $data);
		if($this->db->affected_rows() > 0)
		{
			// Code here after successful insert
			return true; // to the controller
		}
	}

	public function get_last_item_set_log(){
		$this->db->select("*")
		->from("item_set_log")
		->join("product", "pro_id = isl_pro_id")
		->order_by("isl_id", "desc")
		->limit(1);

		return $this->db->get();
	}
}
