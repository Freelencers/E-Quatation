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
			$view = $this->load->view("V_report_all_project", $data, TRUE);
			template( "All Project", "All Project (work)", $view, $nav);

		}

	}

	public function api_income_report(){
		$data = $this->input->post();
		$json = "";

		$result = $this->rfu->get_graph($data["period"],$data["year"]);
		$result = $result->result();
		for($i=0;$i<count($result);$i++){

			// Graph
			$json["graph"][$i][0] = $result[$i]->emp_first_name;
			$json["graph"][$i][1] = intval($result[$i]->amount);

			// Table
			$json["table"][$i][0] = $result[$i]->emp_first_name;
			$json["table"][$i][1] = $result[$i]->emp_last_name;
			$json["table"][$i][2] = $result[$i]->amount;
		}




		echo json_encode($json);
	}
}
?>