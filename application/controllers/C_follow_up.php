<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_follow_up extends CI_Controller{

	public function __construct(){
		parent::__construct();
		// $this->load->helper('url');
		// $this->load->model("M_project");
		$this->load->model("M_follow_up");
	}
	public function index(){
		$nav[0]["page"] = "Follow";
		$nav[0]["icon"] = "fa fa-users";
		$nav[0]["link"] = "#";
		$nav[0]["active"] = "";
		// Permissino check
		$permission = $this->M_permission_module->check_user_permission($this->session->userdata("emp_id"), "Follow up");
		if($permission == 0){

			echo "<script>";
			echo "	alert('You not have permission');";
			echo "	window.location.replace('C_manual');";
			echo "</script>";
		}else{
			// print_r($this->session->all_userdata());
			
			$data["permission"] = $permission;
			$this->emp_id = $this->session->userdata("emp_id");
			$pos = $this->M_follow_up->position_name()->row_array();
			$data['pos_name'] = "";
			// if($this->session->userdata("position_id") == 2){
				//------------
				$view = $this->load->view("V_follow_up", $data, TRUE);
				template( "Follow up", "Follow up work", $view, $nav);
			/*
			}elseif($this->session->userdata("position_id") == 3 || $this->session->userdata("position_id") == 4){
				if($pos['fol_type'] == 0){
					$data['pos_name'] = "Support";
				}elseif($pos['fol_type'] == 1){
					$data['pos_name'] = "Estimate";
				}
			
				$view = $this->load->view("V_follow_up", $data, TRUE);
				template( "Follow up", "Follow up work", $view, $nav);	
			}
			*/
		}

	}
	
	public function api_get_project(){
		$data['nowDate'] = date("Y-m-d");
		
		$project = $this->M_follow_up->get_project1($this->input->post("limit"), $this->input->post("page"), $this->input->post("search"));
		// $project = $this->M_follow_up->get_project1();
		$data['project'] = $project->result();
		// print_r($data['project']);die;
		echo json_encode($data);
	}
	public function api_get_follow_up(){
		$prj_id = 0;
		$prj_id = $this->input->post('prj_id');

		$this->prj_id = $prj_id;
		$this->limit = $this->input->post('limit');
		$this->page = $this->input->post('page');
		$data['follow_up'] = $this->M_follow_up->get_follow_up()->result();
		echo json_encode($data); // ส่ง data ไปที่ follow_up.js เพื่อทำการ เซตตาราง
	}

	public function api_insert_follow_up(){

		$data = $this->input->post();

		$data['fol_emp_id'] = $this->session->userdata("emp_id");
		$result = $this->M_follow_up->insert_follow_up($data);
		$json["status"] = "1";
		echo json_encode($json);

	}
	
}

?>