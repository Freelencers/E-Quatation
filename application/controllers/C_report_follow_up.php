<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_report_follow_up extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model("M_report_follow_up","rfu");
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
			$view = $this->load->view("V_report_follow_up", $data, TRUE);
			template( "Follow up", "Follow up work", $view, $nav);
		}			
	}

	public function api_get_follow_up(){

		$post = $this->input->post();
		$result = $this->rfu->get_tracking_rate($post["month"], $post["year"]);
		echo json_encode($result);
	}


}
?>