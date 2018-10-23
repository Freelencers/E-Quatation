<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_report_follow_up extends CI_Model{

	public function get_tracking_rate($period="", $year=""){
		//get sale employee
		$employee = $this->db->select("prj_emp_id, emp_first_name, emp_last_name")
		->from("project")
		->join("employee", "emp_id = prj_emp_id")
		->group_by("prj_emp_id")
		->get()->result();

		$graph = array();
		$table = array();
		for($i=0;$i<count($employee);$i++){
			$emp_id = $employee[$i]->prj_emp_id;

			// Graph data
			$graph[$i] = array(); 
			$graph[$i][0] = $employee[$i]->emp_first_name;
			$graph[$i][1] = 0;

			// Table data
			$table[$i] = array(); 
			$table[$i][0] = $employee[$i]->emp_first_name;
			$table[$i][1] = $employee[$i]->emp_last_name;
			$table[$i][2] = 0;
		

			// Get prj_id from follow up
			$prj_id = $this->db->select("fol_prj_id")
			->from("follow_up")
			->where("fol_emp_id", $emp_id)
			->group_by("fol_emp_id")
			->get()->result();

			for($j=0;$j<count($prj_id);$j++){

				$fol_prj_id = $prj_id[$j]->fol_prj_id;

				$this->db->select("fol_date")
				->from("follow_up")
				->where("fol_prj_id", $fol_prj_id);
				if($month != ""){
					
					$period = 0;
					$between = 0;
					if($period == 1){

						$between == 1;
					}else if($period == 2){

						$between == 4;
					}else if($period == 3){

						$between == 7;
					}else if($period == 4){

						$between == 10;
					}
					//$this->db->where("MONTH(fol_date)", $period);
					$this->db->where("MONTH(fol_date) >= ", $between);
					$this->db->where("MONTH(fol_date) <=", $between + 2);
				}

				if($year != ""){
					
					$this->db->where("YEAR(fol_date)", $year);
				}
				$date_fol = $this->db->get()->result();

				for($k=0; $k<count($date_fol)-1; $k++){

					//echo $date_fol[$k]->fol_date. " : ";

					$date1=date_create($date_fol[$k]->fol_date);
					$date2=date_create($date_fol[$k+1]->fol_date);
					$diff=date_diff($date1,$date2);

					if($diff->format("%R%a days") > 15){
						
						// Count
						$graph[$i][1]++; 
						$table[$i][2]++; 

					}
				}

			}
		}

		$data["graph"] = $graph;
		$data["table"] = $table;
		
		return $data;
	}


}