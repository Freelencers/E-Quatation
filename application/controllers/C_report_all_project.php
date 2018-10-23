<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_report_all_project extends CI_Controller{
	public function __construct(){
		parent::__construct();
		// $this->load->helper('url');
		$this->load->model("M_report_all_project","rfu");
		$this->load->helper('form');
	}
	public function index(){
		
		$nav[0]["page"] = "Follow";
		$nav[0]["icon"] = "fa fa-users";
		$nav[0]["link"] = "#";
		$nav[0]["active"] = "";
		// Permissino check
		$permission = $this->M_permission_module->check_user_permission($this->session->userdata("emp_id"), "Report");
		if($permission == 0){

			echo "<script>";
			echo "	alert('You not have permission');";
			echo "	window.location.replace('C_manual');";
			echo "</script>";
		}else{

			$data["permission"] = $permission;
			// Chart--------------------------------
			$this->month = null;
			$this->year = null;
			// $this->emp_id = $this->session->userdata("emp_id");
			
			
			if($this->input->post("prj_month") != null && $this->input->post("prj_year") != null){
				$this->month = $this->input->post("prj_month");
				$this->year = $this->input->post("prj_year");
				// die;
			}else{
				$this->month = date('m');
				$this->year = date('Y');
				// $this->month = '10';
				// $this->year = '2017';
			}
			$data['month1'] = $this->month;
			$data['nyear'] = $this->year;
			$data['get_year'] = $this->rfu->get_report_project_year();
			$data['get_month'] = $this->rfu->get_report_project_month();
			$data['report'] = $this->rfu->get_report_project();
			$data['em'] = $this->rfu->get_empFor_report();
			$data['fl'] = $this->rfu->get_project_report();
			// $a = date('d-m-Y');
			// echo date("F", strtotime($a));
			/*
			$sum = 0;
			$sum1 = 0;
			foreach($data['em']->result() as $row){
				echo $row->emp_first_name."=>";
				foreach($data['fl']->result() as $f){
					if($f->prj_emp_id == $row->emp_id){
						$sum+=count($f->prj_emp_id);
					}
					
				}
				echo $sum-$sum1;
				echo "<br>";
				
				$sum1 = $sum;
			}
			*/
			// echo date("F", strtotime("11-12-10")); 
			//-----------------------------------
			$view = $this->load->view("V_report_all_project", $data, TRUE);
			template( "All Project", "All Project (work)", $view, $nav);

		}

	}
}
?>