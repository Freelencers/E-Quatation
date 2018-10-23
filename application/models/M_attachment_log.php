<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_attachment_log extends CI_Model{

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
	
	public function insert_attachment_log($data){
		$this->db->insert('attachment_log', $data);
		if($this->db->affected_rows() > 0)
		{
			// Code here after successful insert
			return true; // to the controller
		}
	}

	public function get_attachment_log_by_prj_id($prj_id){
		$this->db->select("*")
		->from("attachment_log")
		->join("attachment", "att_id = atl_att_id")
		->where("atl_prj_id", $prj_id);

		return $this->db->get();
	}

	public function delete_attachment_log_by_prj_id($prj_id){
		$this->db->where("atl_prj_id", $prj_id)
		->delete("attachment_log");
	}
}
