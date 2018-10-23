<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_hardware extends CI_Model{

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
	
	public function get_hardware($data){
		$this->db->select("*")
		->from("hardware")
		->where("har_prj_id", $data['har_prj_id'])
		->order_by("har_id", "DESC");

		return $this->db->get();
	}


	public function insert_hardware($data){
		$this->db->insert("hardware", $data);
		if($this->db->affected_rows() > 0)
		{
			return true; // to the controller
		}
	}

	public function get_last_hardware($prj_id){
		$this->db->select("syt_name, har_id, pro_model, pro_description, har_qty, uni_name, pro_price, (pro_price * har_qty) AS amount ")
		->from("hardware")
		->join("product", "har_pro_id = product.pro_id")
		->join("unit", "pro_uni_id = uni_id")
		->join("system_type", "syt_id = har_syt_id")
		->where("har_prj_id", $prj_id)
		->order_by("har_id", "desc")
		->limit(1);

		return $this->db->get();
	}

	public function get_hardware_by_prj_id($prj_id){
		$this->db->select("syt_name, har_id, pro_model, har_syt_id, pro_description, har_qty, uni_name, pro_price, (pro_price * har_qty) AS amount ")
		->from("hardware")
		->join("product", "har_pro_id = product.pro_id")
		->join("unit", "pro_uni_id = uni_id")
		->join("system_type", "syt_id = har_syt_id")
		->where("har_prj_id", $prj_id)
		->order_by("har_id", "DESC");;

		return $this->db->get()->result();
	}

	public function delete_hardware($har_id){
		$this->db->where("har_id", $har_id)
		->delete("hardware");
	}

	public function get_hardware_by_har_id($har_id){
		$this->db->select("syt_name, har_id, pro_model, pro_description, har_qty, uni_name, pro_price, (pro_price * har_qty) AS amount, pro_bra_id")
		->from("hardware")
		->join("product", "har_pro_id = product.pro_id")
		->join("unit", "pro_uni_id = uni_id")
		->join("system_type", "syt_id = har_syt_id")
		->where("har_id", $har_id);

		return $this->db->get()->result();
	}

	public function update_hardware($data){
		$this->db->where("har_id", $data["har_id"])
		->update("hardware", $data);
	}

}
