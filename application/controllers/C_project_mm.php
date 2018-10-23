<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_project_mm extends CI_Controller{

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

	public function __construct(){
		parent::__construct();
		$this->load->model("M_employee");
		$this->load->model("M_system_type");
		$this->load->model("M_system_log");
		$this->load->model("M_brand");
		$this->load->model("M_brand_log");
	}

	public function index()
	{
		$nav[0]["page"] = "Project Managment";
		$nav[0]["icon"] = "fa fa-gear";
		$nav[0]["link"] = "#";
		$nav[0]["active"] = "";

		// Permissino check
		$permission = $this->M_permission_module->check_user_permission($this->session->userdata("emp_id"), "Project");
		if($permission == 0){

			echo "<script>";
			echo "	alert('You not have permission');";
			echo "	window.location.replace('C_manual');";
			echo "</script>";
		}else{

			$data["permission"] = $permission;
			$view = $this->load->view("V_project_mm", $data, TRUE);
			template( "Project Mangement", "This page for management you project", $view, $nav);			
		}
		

		
	}

	public function add_project_view(){
		$nav[0]["page"] = "Add new project";
		$nav[0]["icon"] = "fa fa-gear";
		$nav[0]["link"] = "#";
		$nav[0]["active"] = "";

		// Get system type for create input
		$data["system_num"] = $this->M_system_type->get_system_type()->num_rows();
		$data["status"] = "ADD";
		$data["prj_id"] = "";

		// Permissino check
		$permission = $this->M_permission_module->check_user_permission($this->session->userdata("emp_id"), "Project");
		if($permission == 0){

			//echo "ACCESS DENINE<BR>";
			redirect(base_url());
		}else{

			$data["permission"] = $permission;
		}

		$view = $this->load->view("V_add_project", $data, TRUE);
		template( "Create new project", "This page for create new project to system", $view, $nav);
	}


	public function detail_project($prj_id){
		$nav[0]["page"] = "Project Detail";
		$nav[0]["icon"] = "fa fa-gear";
		$nav[0]["link"] = "#";
		$nav[0]["active"] = "";

		$data["system_num"] = $this->M_system_log->get_system_log_by_prj_id($prj_id)->num_rows();
		$data["status"] = "DETAIL";
		$data["prj_id"] = $prj_id;

		// Permissino check
		$permission = $this->M_permission_module->check_user_permission($this->session->userdata("emp_id"), "Project");
		if($permission == 0){

			//echo "ACCESS DENINE<BR>";
			redirect(base_url());
		}else{

			$data["permission"] = $permission;
		}

		$view = $this->load->view("V_add_project", $data, TRUE);
		template( "Detail of project", "This page show all detail of project", $view, $nav);
	}

	public function edit_project($prj_id){
		$nav[0]["page"] = "Update Project";
		$nav[0]["icon"] = "fa fa-gear";
		$nav[0]["link"] = "#";
		$nav[0]["active"] = "";

		$data["system_num"] = $this->M_system_type->get_system_type()->num_rows();
		$data["syl_num"] = $this->M_system_log->get_system_log_by_prj_id($prj_id);

		$data["brand_log"] = array();
		$index = 0;
		foreach($data["syl_num"]->result() as $row){

			$temp_arr = array();
			$brand_log_result = $this->M_brand_log->get_brand_log_by_syl_id($row->syl_id)->result();
			foreach($brand_log_result as $row_j){
				array_push($temp_arr, $row_j->bra_id);
			}
			array_push( $data["brand_log"], $temp_arr);
		}
		$data["system_type"] = $this->M_system_type->get_system_type()->result();
		$data["brand"] = $this->M_brand->get_brand()->result();

		$data["prj_id"] = $prj_id;

		// Permissino check
		$permission = $this->M_permission_module->check_user_permission($this->session->userdata("emp_id"), "Project");
		if($permission == 0){

			//echo "ACCESS DENINE<BR>";
			redirect(base_url());
		}else{

			$data["permission"] = $permission;
		}

		$view = $this->load->view("V_edit_project", $data, TRUE);
		template( "Update project", "This page for edit detail in project", $view, $nav);
	}

	public function api_delete_project(){
		$data = $this->input->post();
		$this->M_project->delete_project($data);
	}
}
