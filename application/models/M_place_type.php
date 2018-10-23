<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_place_type extends CI_Model{

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
	
	public function get_place_type(){
		$this->db->select("*")
		->from("place_type")
		->where("plt_delete", 0);

		return $this->db->get();
	}

	public function delete_place_type($data){

		$data["plt_delete"] = 1;
		$this->db->where("plt_id", $data["plt_id"])
		->update("place_type", $data);

		if($this->db->affected_rows() > 0)
		{
			// Code here after successful insert
			return true; // to the controller
		}
	}

	public function update_place_type($data){
		$this->db->where("plt_id", $data["plt_id"])
		->update("place_type", $data);
		if($this->db->affected_rows() > 0)
		{
			// Code here after successful insert
			return true; // to the controller
		}
	}


	public function get_place_type_by_id($data){
		$this->db->select("*")
		->from("place_type")
		->where("plt_id", $data["plt_id"]);

		return $this->db->get();
	}

	public function insert_place_type($data){
		
		$this->db->insert('place_type', $data);
		if($this->db->affected_rows() > 0)
		{
			// Code here after successful insert
			return true; // to the controller
		}
	}


	public function get_last_place_type(){
		$this->db->select("*")
		->from("place_type")
		->order_by("plt_id", "desc")
		->limit(1);

		return $this->db->get();
	}
}
