<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_accessory extends CI_Model{

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
	
	public function get_accessory($data){
		$this->db->select("*")
		->from("accessory")
		->where("acc_prj_id", $data['acc_prj_id']);

		return $this->db->get();
	}


	public function insert_accessory($data){
		$this->db->insert("accessory", $data);
		if($this->db->affected_rows() > 0)
		{
			return true; // to the controller
		}
	}

	public function get_last_accessory($prj_id){
		$this->db->select("acc_id, pro_model, pro_description, acc_qty, uni_name, pro_price, (pro_price * acc_qty) AS amount ")
		->from("accessory")
		->join("product", "acc_pro_id = product.pro_id")
		->join("unit", "pro_uni_id = uni_id")
		->where("acc_prj_id", $prj_id)
		->order_by("acc_id", "desc")
		->limit(1);

		return $this->db->get();
	}

	public function get_accessory_by_prj_id($prj_id){
		$this->db->select("acc_id, pro_model, pro_description, acc_qty, uni_name, pro_price, (pro_price * acc_qty) AS amount ")
		->from("accessory")
		->join("product", "acc_pro_id = product.pro_id")
		->join("unit", "pro_uni_id = uni_id")
		->where("acc_prj_id", $prj_id);

		return $this->db->get()->result();
	}

	public function delete_accessory($acc_id){
		$this->db->where("acc_id", $acc_id)
		->delete("accessory");
	}

	public function get_accessory_by_acc_id($acc_id){
		$this->db->select("acc_id, pro_model, pro_description, acc_qty, uni_name, pro_price, (pro_price * acc_qty) AS amount, pro_bra_id, pro_id")
		->from("accessory")
		->join("product", "acc_pro_id = product.pro_id")
		->join("unit", "pro_uni_id = uni_id")
		->where("acc_id", $acc_id);

		return $this->db->get()->result();
	}

	public function update_accessory($data){
		$this->db->where("acc_id", $data["acc_id"])
		->update("accessory", $data);
	}
}
