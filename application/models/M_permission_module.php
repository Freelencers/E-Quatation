<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_permission_module extends CI_Model{

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
	
	// public function get_item_set(){
	// 	$this->db->select("*")
	// 	->from("item_set");

	// 	return $this->db->get();
	// }

	// public function delete_item_set($data){

		
	// 	$this->db->where("its_id", $data["its_id"])
	// 	->delete("item_set");
	// 	if($this->db->affected_rows() > 0)
	// 	{
	// 		// Code here after successful insert
	// 		return true; // to the controller
	// 	}
	// }

	public function update_permission($data){
		$this->db->where("pmm_emp_id", $data["pmm_emp_id"])
		->where("pmm_stm_id", $data["pmm_stm_id"])
		->update("permission_module", $data);
		if($this->db->affected_rows() > 0)
		{
			// Code here after successful insert
			return true; // to the controller
		}
	}

	// public function get_item_set_by_id($data){
	// 	$this->db->select("*")
	// 	->from("item_set")
	// 	->where("its_id", $data["its_id"]);

	// 	return $this->db->get();
	// }

	public function insert_permission_module($data){
		
		$this->db->insert('permission_module', $data);
		if($this->db->affected_rows() > 0)
		{
			// Code here after successful insert
			return true; // to the controller
		}
	}

	public function get_permission_by_emp_id($data){
		$this->db->select("*")
		->from("permission_module")
		->join("system_module", "stm_id = pmm_stm_id")
		->where("pmm_emp_id", $data["emp_id"]);

		return $this->db->get();
	}

	public function check_user_permission($emp_id, $module_name){
		$this->db->select("*")
		->from("permission_module")
		->join("system_module", "stm_id = pmm_stm_id")
		->where("pmm_emp_id", $emp_id)
		->where("stm_name", $module_name);

		$permission = $this->db->get()->result();
		if($permission[0]->pmm_read){

			if($permission[0]->pmm_copy){

				return 2;
			}else{

				return 1;
			}
		}else{

			return 0;
		}
	}

	// public function get_last_item_set(){
	// 	$this->db->select("*")
	// 	->from("item_set")
	// 	->order_by("its_id", "desc")
	// 	->limit(1);

	// 	return $this->db->get();
	// }
}
