<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_product extends CI_Controller{

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
		$this->load->model("M_product");
	}

	public function api_get_product(){
		$data = $this->M_product->get_product();
		$data = $data->result();
		echo json_encode($data);
	}

	public function api_get_product_by_item_set_id(){
		$data = $this->input->post();
		$data = $this->M_product->get_product_by_item_set_id($data);
		$data = $data->result();
		echo json_encode($data);
	}

	public function api_get_product_by_brand_id(){
		$data = $this->input->post();
		$data = $this->M_product->get_product_by_brand_id($data);
		$data = $data->result();
		echo json_encode($data);
	}

	public function api_get_product_by_id(){
		$data = $this->input->post();
		$data = $this->M_product->get_product_by_id($data);
		$data = $data->result();
		echo json_encode($data);
	}

	public function api_insert_product(){
		$row = $this->input->post();

		// Upload file
		$config['upload_path']          = 'assert/product';
		$config['allowed_types']        = 'gif|jpg|png'; 
		$config['max_size']             = 9000;
		$config['max_width']            = 1024;
		$config['max_height']           = 768;
		$config['encrypt_name'] 		= TRUE;

		$this->load->library('upload', $config);


		if(!isset($row["pro_pic"])){
			if ( ! $this->upload->do_upload("pro_pic"))
			{
				$error = array('error' => $this->upload->display_errors());
				$data["upload"] = $error;
				$data["status"] = 0;

			}
			else
			{
				$upload_data = array('upload_data' => $this->upload->data());
				$data["upload"] = $upload_data;

				// Insert data
				$row["pro_pic"] = $upload_data["upload_data"]["file_name"];
				$result = $this->M_product->insert_product($row);

				
				if($result){
					$row = $this->M_product->get_last_product();
					$data["product"] = $row->result();
					$data["last_index"] = $this->M_product->get_product()->num_rows();

					$data["status"] = 1;
					$data["msg"] = "Insert complete";
					

				}else{

					$data["status"] = 0;
					$data["msg"] = "Insert fail";
				}
			}
		}else{
			// Insert data
			$row["pro_pic"] = null;
			$result = $this->M_product->insert_product($row);

			
			if($result){
				$row = $this->M_product->get_last_product();
				$data["product"] = $row->result();
				$data["last_index"] = $this->M_product->get_product()->num_rows();

				$data["status"] = 1;
				$data["msg"] = "Insert complete";
				

			}else{

				$data["status"] = 0;
				$data["msg"] = "Insert fail";
			}
		}

		echo json_encode($data);
	}

	public function api_product_delete(){
		
		$data = $this->input->post();
		$result = $this->M_product->delete_product($data);

		if($result){
			
			$resp["status"] = 1;
			$resp["msg"] = "Delete complete";
		}else{

			$resp["status"] = 0;
			$resp["msg"] = "Delete fail";
		}
		echo json_encode($resp);
	}

	public function api_update_product(){
		$row = $this->input->post();

		// Upload file
		$config['upload_path']          = 'assert/product';
		$config['allowed_types']        = 'gif|jpg|png'; 
		$config['max_size']             = 9000;
		$config['max_width']            = 1024;
		$config['max_height']           = 768;
		$config['encrypt_name'] 		= TRUE;

		$this->load->library('upload', $config);

		if(!isset($row["pro_pic"])){
			if ( ! $this->upload->do_upload("pro_pic"))
			{
				$error = array('error' => $this->upload->display_errors());
				$data["upload"] = $error;
				$data["status"] = 0;
			}
			else
			{
				$upload_data = array('upload_data' => $this->upload->data());
				$data["upload"] = $upload_data;

				// Insert data
				$row["pro_pic"] = $upload_data["upload_data"]["file_name"];
				$result = $this->M_product->update_product($row);

				
				if($result){
					$row = $this->M_product->get_product_by_id($row);
					$data["product"] = $row->result();
					$data["last_index"] = $this->M_product->get_product()->num_rows();

					$data["status"] = 1;
					$data["msg"] = "Update complete";
					

				}else{

					$data["status"] = 0;
					$data["msg"] = "Update fail";
				}
			}
		}else{
			// Insert data
			unset($row["pro_pic"]);
			$result = $this->M_product->update_product($row);


			$row = $this->M_product->get_product_by_id($row);
			$data["product"] = $row->result();
			$data["last_index"] = $this->M_product->get_product()->num_rows();

			$data["status"] = 1;
			$data["msg"] = "Insert complete";

		}

		echo json_encode($data);
	}

}
