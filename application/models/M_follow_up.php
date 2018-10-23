<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_follow_up extends CI_Model{
	public function get_max_date(){ // by mod
		$this->db->select_max("fol_date")
		->select('fol_prj_id')
		->from("project")
		->join("follow_up", "prj_id = fol_prj_id", "left");
		return $this->db->get();
	}
	public function get_project1($limit="", $page="", $search=""){ // by mods
		$this->db->select("*")
			->select_max('fol_date','max_date')
			->from("project")
			->join("work_type", "wor_id = prj_wor_id", "inner")
			->join("follow_up", "prj_id = fol_prj_id", "left")
			->where("prj_delete", 0)
			->where("prj_parent_id", null)
			->group_by('prj_id');
		
			if($limit != ""){
				$this->db->limit($limit, $limit * $page);
			}
			if($search != ""){

				$this->db->like("prj_ref_no", $search);
				$this->db->or_like("prj_title", $search);
			}
		return $this->db->get();
	}
	public function get_follow_up(){ // by mod
		$this->db->select("*")
		->from("follow_up")
		->join("employee", "employee.emp_id = follow_up.fol_emp_id")
		->where('fol_prj_id',$this->prj_id)
		->order_by('fol_id','desc');

		return $this->db->get();
	}

	public function insert_follow_up($data){ // by mod
		$this->db->insert('follow_up', $data);
		if($this->db->affected_rows() > 0)
		{
			// Code here after successful insert
			return true; // to the controller
		}
	}
	public function position_name(){ // by mod
		$this->db->select('*')
		->from("follow_up")
		->where('fol_emp_id',$this->emp_id);
		return $this->db->get();
	}
	public function get_position_by_prj_id(){ // by mod
		$this->db->select('*')
		->from("employee")
		->join("employee", "emp_id = prj_emp_id", "inner")
		->where('prj_id',$this->prj_id);
		return $this->db->get();
	}
	
}