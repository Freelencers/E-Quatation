<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_system_log extends CI_Controller{

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
		$this->load->model("M_system_log");
		$this->load->model("M_project");
		$this->load->model("M_brand_log");
	}

	public function api_insert_system_log(){
		$row = $this->input->post();

		if(isset($row["prj_id"])){
			
			$this->M_system_log->delete_system_log_by_prj_id($row["prj_id"]);
			$last_project_id = $row["prj_id"];
		}else{

			if($this->M_project->get_last_project()->num_rows() != 0){
				
				$last_project_id = $this->M_project->get_last_project()->result();
				$last_project_id = $last_project_id[0]->prj_id;
			}else{
			
				$last_project_id = 1;
			}
		}

		for($i=0;$i < count($row["system_type_list"]);$i++){

			$temp["syl_prj_id"] = $last_project_id;
			$temp["syl_syt_id"] = $row["system_type_list"][$i];

			$this->M_system_log->insert_system_log($temp);

			$last_id = $this->M_system_log->get_last_system_log();
			$temp_brand_log["brl_syl_id"] =  $last_id[0]->syl_id;
			for($j=0;$j < count($row["brand_list"][$i]);$j++){

				$temp_brand_log["brl_bra_id"] = $row["brand_list"][$i][$j];
			 	$this->M_brand_log->insert_brand_log($temp_brand_log);
			}
		}
		$data["status"] = 0;
		echo json_encode($data);
	}

	public function api_get_system_log_by_prj_id(){
		$prj_id = $this->input->post("prj_id");
		$result = $this->M_system_log->get_system_log_by_prj_id($prj_id);
		$data["system_log"] = $result->result();

		for($i=0;$i<count($data["system_log"]);$i++){

			$temp_brand = $this->M_brand_log->get_brand_log_by_syl_id($data["system_log"][$i]->syl_id)->result();
			$temp_array = array();
			foreach($temp_brand as $row){
				array_push($temp_array, $row);
			}
			$data["system_log"][$i]->brand_log = $temp_array;

		}
		echo json_encode($data);
		
	}

}
