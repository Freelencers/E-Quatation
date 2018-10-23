<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_project extends CI_Controller{

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
		$this->load->model("M_attachment_log");
	}

	public function api_get_project(){

		$post = $this->input->post();
		$data = $this->M_project->get_project($post["limit"], $post["page"], $post["search"]);
		$json["project"] = $data->result();
		echo json_encode($json);
	}

	public function api_get_project_by_id(){

		$prj_id = $this->input->post("prj_id");
		$data = $this->M_project->get_project_by_id($prj_id);
		$json["project"] = $data->result();
		echo json_encode($json);
	}

	public function api_insert_project(){
		$data = $this->input->post();

		// Copy to new array
		$list = "";
		if(isset($data["prj_att_list"])){
			$list = $data["prj_att_list"];
		}

		// Delete element
		unset($data["prj_att_list"]);
		
		// REFNO
		$max_id = $this->M_project->get_max_id();
		if($max_id->num_rows() == 0){
			
			$data["prj_ref_no"] = date("Ymd") . "001";
		}else{
			$max_id = $max_id->result();
			$data["prj_ref_no"] = date("Ymd") . sprintf("%'.03d\n", (intval($max_id[0]->max_id) + 1));
		}

		$this->M_project->insert_project($data);

		if($list != ""){
			if($this->M_project->get_last_project()->num_rows() != 0){
				
				$last_project_id = $this->M_project->get_last_project()->result();
				$last_project_id = $last_project_id[0]->prj_id;
			}else{
			
				$last_project_id = 1;
			}

			$temp_data['atl_prj_id'] = $last_project_id;
			foreach($list as $row){

				$temp_data['atl_att_id'] = $row;
				$this->M_attachment_log->insert_attachment_log($temp_data);
			}
		}
	}

	public function api_upload_file(){
		$row = $this->input->post();
		
		// Upload file
		$config['upload_path']          = 'assert/project';
		$config['allowed_types']        = '*'; 
		$config["size"]					= 8000000; //byte
		$config['encrypt_name'] 		= TRUE;

		$this->load->library('upload', $config);
		if ( ! $this->upload->do_upload("pro_pic"))
		{
			$error = array('error' => $this->upload->display_errors());
			$data["upload"] = $error;
			$data["status"] = 0;
		}
		else
		{

			$upload_data = array('upload_data' => $this->upload->data());
			if($this->M_project->get_last_project()->num_rows() != 0){
				
				$temp_data["prj_id"] = $this->M_project->get_last_project()->result();
				$temp_data["prj_id"] = $temp_data["prj_id"][0]->prj_id;
			}else{
			
				$temp_data["prj_id"] = 1;
			}
			$temp_data["prj_att_file"] = $upload_data["upload_data"]["file_name"];
			$this->M_project->update_project($temp_data);
			echo json_encode($upload_data);
		}
	}

	public function api_update_project(){
		$data = $this->input->post();

		// Copy to new array
		$list = "";
		if(isset($data["prj_att_list"])){
			$list = $data["prj_att_list"];
		}

		// Delete element
		unset($data["prj_att_list"]);

		$this->M_project->update_project($data);

		// Clear old attachemnt log
		$this->M_attachment_log->delete_attachment_log_by_prj_id($data["prj_id"]);

		// Insert new attahcment log
		if($list != ""){
			$temp_data['atl_prj_id'] = $data["prj_id"];
			foreach($list as $row){

				$temp_data['atl_att_id'] = $row;
				$this->M_attachment_log->insert_attachment_log($temp_data);
			}
		}
	}

	public function api_delete_project(){
		$data = $this->input->post();
		$this->M_project->delete_project_by_prj_id($data);
	}

	public function api_get_revise(){
		$data = $this->input->post();
		$result = $this->M_project->get_revise_history($data);

		$json["revise_history"] = $result;
		echo json_encode($json);
	}

	public function api_create_new_revised(){
		
		$data = $this->input->post();
		$this->M_project->create_new_revised($data["prj_id"]);
		$json["status"] = 0;
		echo json_encode($json);
	}

	public function api_discount(){
		$data = $this->input->post();
		$this->M_project->update_discount($data);
	}

	public function api_change_status(){
		$data= $this->input->post();
		$this->M_project->update_project($data);

		$json["status"] = 1;
		echo json_encode($json);
	}

	public function api_get_vat_by_prj_id(){
		$data = $this->input->post();
		$result = $this->M_project->get_vat_by_prj_id($data["prj_id"]);
		$result = $result->result();

		echo json_encode($result);
	}

	public function api_change_vat(){
		$data = $this->input->post();
		$this->M_project->update_project($data);

		$json["status"] = 1;
		echo json_encode($json);
	}
}
