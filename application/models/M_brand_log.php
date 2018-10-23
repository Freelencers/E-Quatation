<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_brand_log extends CI_Model{

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
	
	public function insert_brand_log($data){

		$this->db->insert('brand_log', $data);
		if($this->db->affected_rows() > 0)
		{
			// Code here after successful insert
			return true; // to the controller
		}
	}

	public function get_brand_log_by_syl_id($syl_id){
		$this->db->select("bra_id, bra_name")
		->from("brand_log")
		->join("brand", "brand_log.brl_bra_id = brand.bra_id")
		->where("brl_syl_id", $syl_id);

		return $this->db->get();

	}
}
