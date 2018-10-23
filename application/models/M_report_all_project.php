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

	public function get_graph($period = 0 , $year = 0){

		$start = 0;
		switch($period){
			case 1: $start = 1;
					break;
			case 2: $start = 4;
					break;
			case 3: $start = 7;
					break;
			case 4: $start = 10;
					break;
		}

		$this->db->select("SUM(prj_price) AS amount, prj_emp_id, emp_first_name, emp_last_name")
		->from("project")
		->join("employee", "prj_emp_id = emp_id")
		->group_by("prj_emp_id")
		->where("prj_last_version", 1) // last revied
		->where("prj_sta_id", 3); // PO status

		if($year != 0){

			$this->db->where("YEAR(prj_wot_date)", $year);
		}

		if($period != 0){

			$this->db->where("MONTH(prj_wot_date) >=", $start)
			->where("MONTH(prj_wot_date) <=", $start + 2);
		}

		return $this->db->get();
	}
}
?>