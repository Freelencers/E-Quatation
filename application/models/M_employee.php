<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_employee extends CI_Model{

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
	public function find_username($username){
		$this->db->select("*")
		->from("employee")
		->where("emp_username", $username);

		return $this->db->get();
	}

	public function login($username, $password)
	{
		$condition = array('emp_username =' => $username, 'emp_password =' => $password, "emp_delete =" => 0, "emp_approve" => 1);
        $this->db->select("*")
		->from("employee")
		->join("position", "pos_id = emp_pos_id")
        ->where($condition);

        return $this->db->get();
	}

	public function new_user($data){

		$this->db->insert('employee', $data);
		if($this->db->affected_rows() > 0)
		{
			// Code here after successful insert
			return true; // to the controller
		}
	}

	public function get_employee(){
		$this->db->select("*")
		->from("employee")
		->join("position", "employee.emp_pos_id = position.pos_id", "inner")
		->where("emp_approve", 1)
		->where("emp_delete", 0);

		return $this->db->get();
	}

	public function get_waitting_approve(){
		$this->db->select("*")
		->from("employee")
		->join("position", "employee.emp_pos_id = position.pos_id", "inner")
		->where("emp_approve", 0)
		->where("emp_delete", 0);

		return $this->db->get();
	}

	public function change_password($data){
		$new_data["emp_password"] = $data["emp_new_password"];

		$this->db->where('emp_username', $data["username"])
		->update("employee", $new_data);
		
		if($this->db->affected_rows() > 0)
		{
			// Code here after successful insert
			return true; // to the controller
		}
	}

	public function get_profile($data){
		$this->db->select("*")
		->from("employee")
		->join("position", "employee.emp_pos_id = position.pos_id", "inner")
		->where("emp_id", $data["emp_id"]);

		return $this->db->get();
	}

	public function change_profile($data){
		$this->db->where("emp_id", $data["emp_id"])
		->update("employee", $data);
		if($this->db->affected_rows() > 0)
		{
			// Code here after successful insert
			return true; // to the controller
		}
	}


	public function delete($data){

		$delete["emp_delete"] = 1;
		
		$this->db->where("emp_id", $data['emp_id'])
		->update("employee", $delete);

		if($this->db->affected_rows() > 0)
		{
			// Code here after successful insert
			return true; // to the controller
		}

	}

	public function get_last_employee(){
		$this->db->select("*")
		->from("employee")
		->join("position", "employee.emp_pos_id = position.pos_id", "inner")
		->order_by("emp_id", "desc")
		->limit(1);

		return $this->db->get();
	}

	public function get_sale_man(){
		$this->db->select("*")
		->from("employee")
		->where("emp_pos_id", 3);

		return $this->db->get();
	}
	
	public function forgot_password($data){
	    
	    $condition = array("emp_email" => $data["emp_email"], "emp_username" => $data["emp_username"]);
	    $this->db->select("*")
	    ->from("employee")
	    ->where($condition);
	    
	    return $this->db->get();
	}

	public function approve($data){

		$data["emp_approve"] = 1;
		$this->db->where("emp_id", $data["emp_id"])
		->update("employee", $data);
	}
}
