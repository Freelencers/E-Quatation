<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_product extends CI_Model{

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
	
	public function get_product(){
		$this->db->select("*")
		->from("product")
		->where("pro_delete", 0);

		return $this->db->get();
	}

	public function delete_product($data){

		$data["pro_delete"] = 1;
		$this->db->where("pro_id", $data["pro_id"])
		->update("product", $data);
		if($this->db->affected_rows() > 0)
		{
			// Code here after successful insert
			return true; // to the controller
		}
	}

	public function update_product($data){
		$this->db->where("pro_id", $data["pro_id"])
		->update("product", $data);
		if($this->db->affected_rows() > 0)
		{
			// Code here after successful insert
			return true; // to the controller
		}
	}

	public function get_product_by_id($data){
		$condition = array("pro_id" => $data["pro_id"], "pro_delete" => 0);
		$this->db->select("*")
		->from("product")
		->where($condition);

		return $this->db->get();
	}

	public function get_product_by_brand_id($data){

		$condition = array("pro_bra_id" => $data["pro_bra_id"], "pro_delete" => 0);
		$this->db->select("*")
		->from("product")
		->where($condition);

		if($data["limit"] != ""){
			
			$this->db->limit($data["limit"], $data["limit"] * $data["page"]);
		}

		if($data["search"] != ""){

			$this->db->like("pro_model", $data["search"]);
			//$this->db->or_like("prj_title", $search);
		}

		return $this->db->get();
	}

	public function get_product_by_item_set_id($data){

		$condition = array("isl_its_id" => $data["isl_its_id"]);
		$this->db->select("*")
		->from("item_set_log")
		->join("product", "pro_id = isl_pro_id")
		->join("unit", "pro_uni_id = uni_id")
		->where($condition);

		return $this->db->get();
	}

	public function insert_product($data){
		
		$this->db->insert('product', $data);
		if($this->db->affected_rows() > 0)
		{
			// Code here after successful insert
			return true; // to the controller
		}
	}

	public function get_last_product(){
		$this->db->select("*")
		->from("product")
		->order_by("pro_id", "desc")
		->limit(1);

		return $this->db->get();
	}
}
