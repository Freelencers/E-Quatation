<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_generate_excel extends CI_Controller{

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
		$this->load->model("M_system_log");
		$this->load->model("M_brand_log");
		$this->load->model("M_follow_up");

		// $this->load->model("M_project");
		// $this->load->model("M_hardware");
		// $this->load->model("M_accessory");
		// $this->load->model("M_condition_log");
		// $this->load->model("M_scope_of_work_log");

		// $this->load->model("M_employee");
		// $this->load->model("M_permission_module");
		$this->load->model("M_system_type");

		$this->load->library('PHPExcel'); 
		$this->load->library('PHPExcel/IOFactory');

	}

	public function follow_up($period="", $year=""){
		// We'll be outputting an excel file
		header('Content-type: application/vnd.ms-excel');
		// It will be called file.xls
		header('Content-Disposition: attachment; filename="file.xls"');


		// Get date
		$project_list = $this->M_project->follow_up_project($period, $year);
		$project_list = $project_list->result();

		$system_type = $this->M_system_type->get_system_type();
		$system_list = $system_type->result();

		// Prepare for excel export
		$objPHPExcel = new PHPExcel();
		$objPHPExcel->getProperties()->setTitle("Follow up")
						 ->setDescription("Follow up");
							
		$col = "J";
		for($i=1;$i<count($system_list);$i++){

			$col++;
		}	
		$temp_col = $col;
		$temp_col++;

		// table header 
		$objPHPExcel->setActiveSheetIndex(0);
		$objPHPExcel->getActiveSheet()
		->setCellValue('A1', 'Date-Out')
		->setCellValue('B1', 'Status')
		->setCellValue('C1', 'Quotation No.')
		->setCellValue('D1', 'Project')
		->setCellValue('E1', 'Location')
		->setCellValue('F1', 'Company')
		->setCellValue('G1', 'To')
		->setCellValue('H1', 'Tell')
		->setCellValue('I1', 'From')
		->setCellValue('J1', 'System') // System type
		//->setCellValue($temp_col.'1', 'Brand')
		//->mergeCells(($temp_col).'1:'.($temp_col++).'2')
		->setCellValue($temp_col.'1', 'Customer')
		->mergeCells(($temp_col).'1:'.($temp_col++).'2')
		->setCellValue($temp_col.'1', 'volume')
		->mergeCells(($temp_col).'1:'.($temp_col++).'2')
		->setCellValue($temp_col.'1', 'Status')
		->mergeCells(($temp_col).'1:'.($temp_col).'2');

		// Show system type
		$syt_col = "J";
		for($i=0;$i<count($system_list);$i++){

			$objPHPExcel->getActiveSheet()
			->setCellValue(($syt_col++).'2', $system_list[$i]->syt_name); // System type
		}
		
		// Merg cell of header
		$objPHPExcel->getActiveSheet()
		->mergeCells("A1:A2")
		->mergeCells("B1:B2")
		->mergeCells("C1:C2")
		->mergeCells("D1:D2")
		->mergeCells("E1:E2")
		->mergeCells("F1:F2")
		->mergeCells("G1:G2")
		->mergeCells("H1:H2")
		->mergeCells("I1:I2")
		->mergeCells("J1:".($col)."1"); // system type

		// project detail list 
		$line = 3;
		for($i=0;$i<count($project_list);$i++){

			$temp_col = $col;
			$temp_col++;
			$objPHPExcel->getActiveSheet()
			->setCellValue('A'.$line, $project_list[$i]->prj_wot_date)
			->setCellValue('B'.$line, $project_list[$i]->sta_name)
			->setCellValue('C'.$line, $project_list[$i]->prj_ref_no)
			->setCellValue('D'.$line, $project_list[$i]->prj_title)
			->setCellValue('E'.$line, '')
			->setCellValue('F'.$line, $project_list[$i]->prj_company) 
			->setCellValue('G'.$line, $project_list[$i]->prj_contact)
			->setCellValue('H'.$line, $project_list[$i]->prj_tel)
			->setCellValue('I'.$line, $project_list[$i]->emp_first_name)
			//->setCellValue(($temp_col++).$line, '')
			->setCellValue(($temp_col++).$line, $project_list[$i]->prj_customer_name)
			->setCellValue(($temp_col++).$line, $project_list[$i]->prj_price)
			->setCellValue(($temp_col++).$line, $project_list[$i]->wor_name);

			// Check system type
			$system_type_check = $this->M_system_log->get_system_log_by_prj_id($project_list[$i]->prj_id);
			$system_type_check = $system_type_check->result();
			$syt_col = "J";
			for($j=0;$j<count($system_list);$j++){

				for($k=0;$k<count($system_type_check);$k++){

					if($system_type_check[$k]->syt_name == $system_list[$j]->syt_name){

						$brand_log = $this->M_brand_log->get_brand_log_by_syl_id($system_type_check[$k]->syl_id);
						$brand_log = $brand_log->result();

						// Merg string of brand with ,
						$temp_brand = "";
						for($l=0;$l<count($brand_log);$l++){

							$temp_brand .= $brand_log[$l]->bra_name;
							if($l != count($brand_log) - 1){

								$temp_brand .= ", ";
							}
						}

						$objPHPExcel->getActiveSheet()
						->setCellValue($syt_col.$line, $temp_brand);
					}
				}
				$syt_col++;
			}

			// Follow up detail
			$line++;

			// Header follow up 
			$objPHPExcel->getActiveSheet()
			->setCellValue('B'.$line, "Date")
			->setCellValue('C'.$line, "Progress")
			->setCellValue('D'.$line, "Detail")
			->mergeCells("D$line:P$line");

			$objPHPExcel->getActiveSheet()
			->getRowDimension($line)
			->setOutlineLevel(2)
			->setVisible(false)
			->setCollapsed(true);

			$this->M_follow_up->prj_id = $project_list[$i]->prj_id;
			$follow_up_list = $this->M_follow_up->get_follow_up();
			$follow_up_list = $follow_up_list->result();
			for($j=0;$j<count($follow_up_list);$j++){

				$line++;
				$objPHPExcel->getActiveSheet()
				->setCellValue('B'.$line, $follow_up_list[$j]->fol_date)
				->setCellValue('C'.$line, $follow_up_list[$j]->fol_success)
				->setCellValue('D'.$line, $follow_up_list[$j]->fol_msg)
				->mergeCells("D$line:P$line");

				$objPHPExcel->getActiveSheet()
				->getRowDimension($line)
				->setOutlineLevel(2)
				->setVisible(false)
				->setCollapsed(true);
			}


			// Next line
			$line++;
		}
		// Save it as an excel 2003 file
		$objWriter = IOFactory::createWriter($objPHPExcel, 'Excel5');
		$file_name = "test.xls";
		$objWriter->save('php://output');
	}

}