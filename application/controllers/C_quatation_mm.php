<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_quatation_mm extends CI_Controller{

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
		$this->load->model("M_project");
	}

	public function index()
	{
		$nav[0]["page"] = "Quotation";
		$nav[0]["icon"] = "fa fa-gear";
		$nav[0]["link"] = "#";
		$nav[0]["active"] = "";

		// Permissino check
		$permission = $this->M_permission_module->check_user_permission($this->session->userdata("emp_id"), "Quatation");
		if($permission == 0){

			echo "<script>";
			echo "	alert('You not have permission');";
			echo "	window.location.replace('C_manual');";
			echo "</script>";
		}else{

			$data["permission"] = $permission;
			$view = $this->load->view("V_quatation", $data, TRUE);
			template( "Quotation", "This page for management you quatation", $view, $nav);		
		}
	}

	public function cost_monitor(){

		$row = $this->input->post();

		$prj_id = $row["prj_id"];
		$data = $this->M_project->get_cost_of_project($prj_id);

		//update project price
		$price["prj_id"] = $prj_id;
		$price["prj_price"] = $data["sum_cost"];
		$this->M_project->update_project($price);
		echo json_encode($data);
	}

}
