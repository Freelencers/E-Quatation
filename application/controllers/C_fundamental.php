<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_fundamental extends CI_Controller{

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
	}

	public function index()
	{
		$nav[0]["page"] = "Setting";
		$nav[0]["icon"] = "fa fa-gear";
		$nav[0]["link"] = "#";
		$nav[0]["active"] = "";

		// Permissino check
		$permission = $this->M_permission_module->check_user_permission($this->session->userdata("emp_id"), "Setting");
		if($permission == 0){

			echo "<script>";
			echo "	alert('You not have permission');";
			echo "	window.location.replace('C_manual');";
			echo "</script>";
		}else{

			// Log
			action_log("Acess Fundamental");
			$data["permission"] = $permission;
			$view = $this->load->view("V_fundamental", $data, TRUE);
			template( "Fundamental Setting", "This page for setting fundamaental data in system", $view, $nav);			
		}


		
	}
}
