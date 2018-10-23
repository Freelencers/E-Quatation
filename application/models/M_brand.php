<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_brand extends CI_Model{

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
	
	public function get_brand(){
		$this->db->select("*")
		->from("brand")
		->where("bra_delete", 0);

		return $this->db->get();
	}

	public function delete_brand($data){

		$data["bra_delete"] = 1;
		$this->db->where("bra_id", $data["bra_id"])
		->update("brand", $data);
		if($this->db->affected_rows() > 0)
		{
			// Code here after successful insert
			return true; // to the controller
		}
	}

	public function update_brand($data){
		$this->db->where("bra_id", $data["bra_id"])
		->update("brand", $data);
		if($this->db->affected_rows() > 0)
		{
			// Code here after successful insert
			return true; // to the controller
		}
	}

	public function get_brand_by_id($data){
		$this->db->select("*")
		->from("brand")
		->where("bra_id", $data["bra_id"]);

		return $this->db->get();
	}

	public function insert_brand($data){
		
		$this->db->insert('brand', $data);
		if($this->db->affected_rows() > 0)
		{
			// Code here after successful insert
			return true; // to the controller
		}
	}

	public function get_last_brand(){
		$this->db->select("*")
		->from("brand")
		->order_by("bra_id", "desc")
		->limit(1);

		return $this->db->get();
	}
}
