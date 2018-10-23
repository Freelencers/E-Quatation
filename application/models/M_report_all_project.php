<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_report_all_project extends CI_Model{

	public function get_report_project(){ // by mod
		// $where = "";
		$select = "*, sum(prj_price) AS sPrice";
		// $where = "YEAR(fol_date)=".$this->year." AND MONTH(fol_date) = ".$this->month;
		$where = "((YEAR(prj_wot_date)=".$this->year." AND MONTH(prj_wot_date) = ".$this->month.") AND emp_pos_id = 3)";
		$this->db->select($select)
		->from("employee")
		->join("project", "emp_id = prj_emp_id", "left")
		->where($where)
		->group_by("emp_id");
		return $this->db->get();
		
	}
	public function get_report_project_year(){ // by mod
		// $where = "YEAR(prj_wot_date) != '0000'";
		$select = "*";
		$where = "YEAR(prj_wot_date) != '0000'";
		$this->db->select($select)
		->from("employee")
		->join("project", "emp_id = prj_emp_id", "inner")
		->where($where)
		->group_by("YEAR(prj_wot_date)");
		return $this->db->get();
	}
	public function get_report_project_month(){ // by mod
		$where = "MONTH(prj_wot_date) != '00'";
		$select = "*";
		$this->db->select($select)
		->from("employee")
		->join("project", "emp_id = prj_emp_id", "inner")
		->where($where)
		->group_by("MONTH(prj_wot_date)");
		return $this->db->get();
	}
	public function get_empFor_report(){ // by mod
		$select = "*";
		$where = "emp_pos_id = 3";
		$this->db->select($select)
		->from("employee")
		->where($where);
		return $this->db->get();
		
	}
	public function get_project_report(){ // by mod
	
		$select = "*";
		$where = "YEAR(prj_wot_date)=".$this->year." AND MONTH(prj_wot_date) = ".$this->month;
		$this->db->select($select)
		->from("project")
		->where($where);
		return $this->db->get();
		
	}
}
?>