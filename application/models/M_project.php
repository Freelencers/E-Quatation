<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_project extends CI_Model{

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
	
	public function get_project($limit="", $page="", $search=""){
		$condition = array("prj_delete" => 0, "prj_parent_id" => NULL);
		$this->db->select("*")
		->from("project")
		->join("place_type", "plt_id = prj_plt_id", "left")
		->join("work_type", "wor_id = prj_wor_id", "left")
		->join("status", "sta_id = prj_sta_id", "left")
		->join("customer_type", "ctp_id = prj_ctp_id", "left")
		->join("employee", "emp_id = prj_emp_id", "left")
		->where($condition)
		->order_by("prj_id", "DESC");

		if($limit != ""){

			$this->db->limit($limit, $limit * $page);
		}

		if($search != ""){

			$this->db->like("prj_ref_no", $search);
			$this->db->or_like("prj_title", $search);
		}
		
		return $this->db->get();
	}
	public function get_project1(){ // by mod
		$nowDate = date("Y-m-d");
		$condition = array("prj_delete" => 0, "prj_parent_id" => NULL);
		$this->db->select("*")
		->from("project")
		->join("place_type", "plt_id = prj_plt_id", "left")
		->join("work_type", "wor_id = prj_wor_id", "left")
		->join("status", "sta_id = prj_sta_id", "left")
		->join("customer_type", "ctp_id = prj_ctp_id", "left")
		->join("employee", "emp_id = prj_emp_id", "left")
		->join("follow_up", "prj_id = fol_prj_id", "left")
		->where($condition);
		
		return $this->db->get();
	}

	public function get_project_by_id($prj_id){
		$this->db->select("*")
		->from("project")
		->join("place_type", "plt_id = prj_plt_id", "left")
		->join("work_type", "wor_id = prj_wor_id", "left")
		->join("status", "sta_id = prj_sta_id", "left")
		->join("customer_type", "ctp_id = prj_ctp_id", "left")
		->join("employee", "emp_id = prj_emp_id", "left")
		->where("prj_id", $prj_id);

		return $this->db->get();
	}

	public function insert_project($data){
		$this->db->insert('project', $data);
		if($this->db->affected_rows() > 0)
		{
			// Code here after successful insert
			return true; // to the controller
		}
	}

	public function get_last_project(){
		$this->db->select('*')
		->from("project")
		->order_by("prj_id","DESC")
		->limit("1");

		return $this->db->get();
	}

	public function update_project($data){

		$this->db->where("prj_id", $data["prj_id"])
		->update("project", $data);

		if($this->db->affected_rows() > 0)
		{
			// Code here after successful insert
			return true; // to the controller
		}

	}


	public function delete_project_by_prj_id($data){

		$delete["prj_delete"] = 1;

		$this->db->where("prj_id", $data['prj_id'])
		->update("project", $delete);
	}

	public function get_revise_history($data){
		$condition = "prj_parent_id = '".$data["prj_id"]."' OR prj_id='".$data["prj_id"]."'";
		$this->db->select("*")
		->from("project")
		->where($condition)
		->order_by("prj_version");

		return $this->db->get()->result();
	}

	public function get_cost_of_project($prj_id){

		$data["sum_cost"] = 0;
		$data["sum_price"] = 0;

		
		$this->db->select("pro_cost, pro_price, har_qty ")
		->from("product")
		->join("hardware", "har_pro_id = pro_id")
		->where("har_prj_id", $prj_id);
		$hardware = $this->db->get()->result();


		$this->db->select("pro_cost, pro_price, acc_qty")
		->from("product")
		->join("accessory", "acc_pro_id = pro_id")
		->where("acc_prj_id", $prj_id);
		$accessory = $this->db->get()->result();

		$this->db->select("*")
		->from("service_log")
		->where("sel_prj_id", $prj_id);
		$services = $this->db->get()->result();

		$sum_cost = 0;
		$sum_price = 0;


		foreach($hardware as $row){

			$sum_cost += $row->pro_cost * $row->har_qty;
			$sum_price += $row->pro_price * $row->har_qty;
		}

		foreach($accessory as $row){

			$sum_cost += $row->pro_cost * $row->acc_qty;
			$sum_price += $row->pro_price * $row->acc_qty;
		}

		foreach($services as $row){

			$sum_cost += $row->sel_ser_value;
		}

		$data["sum_cost"] = $sum_cost;
		$data["sum_price"] = $sum_price;
		
		return $data;
	}
	
	public function create_new_revised($prj_id){

		$this->db->select("*")
		->from("project")
		->where("prj_id", $prj_id);

		$duplicate_from["project"] = $this->db->get()->row_array();


		// Delete element
		unset($duplicate_from["project"]["prj_id"]);

		// If first revised
		if($duplicate_from["project"]["prj_parent_id"] == NULL){

			$duplicate_from["project"]["prj_parent_id"] = $prj_id;
			$duplicate_from["project"]["prj_version"] = 1;
		}

		// Revised number increase
		$parent_id = $this->db->select("prj_parent_id")
		->from("project")
		->where("prj_id", $prj_id)
		->get()->result();

		if($parent_id[0]->prj_parent_id == NULL){

			$revised_no = $this->db->select("*")
			->from("project")
			->where("prj_parent_id", $prj_id)
			->get()->num_rows();

			if($revised_no == 0){

				$duplicate_from["project"]["prj_version"] = 1;
			}else{

				$duplicate_from["project"]["prj_version"] = $revised_no + 1;
			}
		}else{
			$max_version = $this->db->select("MAX(prj_version) as version")
			->from("project")
			->where("prj_parent_id", $parent_id[0]->prj_parent_id)
			->get()->result();

			$duplicate_from["project"]["prj_version"] = $max_version[0]->version + 1;	
		}
			
		// Set date
		$duplicate_from["project"]["prj_wot_date"] = date("Y-m-d");
		// Insert project
		$this->db->insert("project", $duplicate_from["project"]);

		//Select last index
		$last_index = $this->db->select("prj_id")->from("project")->order_by("prj_id", "desc")->limit(1);
		$last_index = $this->db->get()->result_array();
		$new_prj_id = $last_index[0]["prj_id"];

		//#################
		// Hardware
		//#################
		$this->db->select("*")
		->from("hardware")
		->where("har_prj_id", $prj_id);

		$hardware_list = $this->db->get()->result();
		foreach($hardware_list as $row){

			$data["har_pro_id"] = $row->har_pro_id;
			$data["har_syt_id"] = $row->har_syt_id;
			$data["har_prj_id"] = $new_prj_id;
			$data["har_qty"] = $row->har_qty;
			$this->db->insert("hardware", $data);
		}

		//#################
		// accessory
		//#################
		$data = NULL;
		$this->db->select("*")
		->from("accessory")
		->where("acc_prj_id", $prj_id);

		$accessory_list = $this->db->get()->result();
		foreach($accessory_list as $row){

			$data["acc_pro_id"] = $row->acc_pro_id;
			$data["acc_prj_id"] = $new_prj_id;
			$data["acc_qty"] = $row->acc_qty;
			$this->db->insert("accessory", $data);
		}

		//#################
		// service
		//#################
		$data = NULL;
		$this->db->select("*")
		->from("service_log")
		->where("sel_prj_id", $prj_id);

		$service_list = $this->db->get()->result();
		foreach($service_list as $row){

			$data["sel_ser_id"] = $row->sel_ser_id;
			$data["sel_prj_id"] = $new_prj_id;
			$data["sel_ser_value"] = $row->sel_ser_value;
			$this->db->insert("service_log", $data);
		}

		//#################
		// condition
		//#################
		$data = NULL;
		$this->db->select("*")
		->from("condition")
		->where("con_prj_id", $prj_id);

		$condition_list = $this->db->get()->result();
		foreach($condition_list as $row){

			$data["con_value"] = $row->con_value;
			$data["con_prj_id"] = $new_prj_id;
			$this->db->insert("condition", $data);
		}

		//#################
		// scope of work
		//#################
		$data = NULL;
		$this->db->select("*")
		->from("scope_of_work")
		->where("sow_prj_id", $prj_id);

		$scope_of_work = $this->db->get()->result();
		foreach($scope_of_work as $row){

			$data["sow_value"] = $row->sow_value;
			$data["sow_prj_id"] = $new_prj_id;
			$this->db->insert("scope_of_work", $data);
		}
	}

	public function update_discount($data){
		$this->db->where("prj_id", $data["prj_id"])
		->update("project", $data);
	}

	public function get_max_id(){
		$this->db->select("MAX(prj_id) as max_id ")
		->from("project");

		return $this->db->get();
	}
}
