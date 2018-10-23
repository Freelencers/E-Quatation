<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_approve_pdf extends CI_Controller{

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
		//$this->load->model("M_project");
		$this->load->model("M_system_log");
		$this->load->model("M_project");
		$this->load->model("M_hardware");
		$this->load->model("M_accessory");
		$this->load->model("M_condition");
		$this->load->model("M_scope_of_work");

		$this->load->model("M_employee");
		$this->load->model("M_permission_module");
		
		$this->load->library('Pdf'); 
		$this->pdf->SetFontPath("fonts/");

	}


	public function approve_document($emp_id){


		$data["emp_id"] = $emp_id;
		$permission = $this->M_permission_module->get_permission_by_emp_id($data)->result();
		$account_detail = $this->M_employee->get_profile($data)->result();
		$username = $account_detail[0]->emp_username;
		$creat_date = $account_detail[0]->emp_create;
		$first_name = $account_detail[0]->emp_first_name;
		$last_name = $account_detail[0]->emp_last_name;
		$email = $account_detail[0]->emp_email;
		$position = $account_detail[0]->pos_name;


		$border_cell = 0;
		$this->pdf->AddPage();
		$this->pdf->AddFont('THSarabun','','THSarabun.php');
		$this->pdf->AddFont('THSarabun','B','THSarabun.php');
		$this->pdf->AddFont('THSarabun','I','THSarabun.php');
		$this->pdf->AddFont('THSarabun','U','THSarabun.php');
		$this->pdf->SetFont('THSarabun','',24);
		$this->pdf->Cell(159,10,iconv( 'UTF-8','TIS-620','OTEC SUPPLY COMPANY LIMITED'),$border_cell,1,"C");
		
		$this->pdf->SetFont('THSarabun','',16);
		$this->pdf->Cell(195,8,iconv( 'UTF-8','TIS-620','1927 Moo 6 Sukhumvit Rd., Samrong-Nua, Muang, Samutprakarn 10270'),$border_cell,1,"C");
		$this->pdf->Cell(220,8,iconv( 'UTF-8','TIS-620','Tel/Fax. (02) 744-5659, 744-5940, 5942, 5944 Fax. # 102 E-mail: sale@otecsupply.com'),$border_cell,1,"C");
		$this->pdf->Image('assert/pdf/otec_logo.png',10,12,30,0,'','');

		$this->pdf->Cell(0,20,iconv( 'UTF-8','TIS-620','Approve Document'),$border_cell,1,"C");

		$height = 10;
		$this->pdf->Cell(190,$height,iconv('UTF-8','TIS-620', "Account Detail"),'LBTR',0,'L',0); 
		$this->pdf->Ln();

		$this->pdf->Cell(27.5,$height,iconv('UTF-8','TIS-620', "Username"),'LBTR',0,'L',0); 
		$this->pdf->Cell(67.5,$height,iconv('UTF-8','TIS-620', $username),'LBTR',0,'L',0); 
		$this->pdf->Cell(27.5,$height,iconv('UTF-8','TIS-620', "Create date"),'LBTR',0,'L',0); 
		$this->pdf->Cell(67.5,$height,iconv('UTF-8','TIS-620', $creat_date),'LBTR',0,'L',0); 
		$this->pdf->Ln();

		$this->pdf->Cell(27.5,$height,iconv('UTF-8','TIS-620', "Firstname"),'LBTR',0,'L',0); 
		$this->pdf->Cell(67.5,$height,iconv('UTF-8','TIS-620', $first_name),'LBTR',0,'L',0); 
		$this->pdf->Cell(27.5,$height,iconv('UTF-8','TIS-620', "Lastname"),'LBTR',0,'L',0); 
		$this->pdf->Cell(67.5,$height,iconv('UTF-8','TIS-620', $last_name),'LBTR',0,'L',0); 
		$this->pdf->Ln();

		$this->pdf->Cell(27.5,$height,iconv('UTF-8','TIS-620', "Email"),'LBTR',0,'L',0); 
		$this->pdf->Cell(67.5,$height,iconv('UTF-8','TIS-620', $email),'LBTR',0,'L',0); 
		$this->pdf->Cell(27.5,$height,iconv('UTF-8','TIS-620', "Position"),'LBTR',0,'L',0); 
		$this->pdf->Cell(67.5,$height,iconv('UTF-8','TIS-620', $position),'LBTR',0,'L',0); 
		$this->pdf->Ln();

		$this->pdf->Cell(190,$height,iconv('UTF-8','TIS-620', ""),'',0,'L',0); 
		$this->pdf->Ln();

		$this->pdf->Cell(190,$height,iconv('UTF-8','TIS-620', "Permission"),'LRBT',0,'L',0); 
		$this->pdf->Ln();

		$this->pdf->Cell(95,$height,iconv('UTF-8','TIS-620', "Module"),'LBTR',0,'C',0); 
		$this->pdf->Cell(47.5,$height,iconv('UTF-8','TIS-620', "Read"),'LBTR',0,'C',0); 
		$this->pdf->Cell(47.5,$height,iconv('UTF-8','TIS-620', "Copy"),'LBTR',0,'C',0); 
		$this->pdf->Ln();

		$check = "assert/image/checked.png";
		$cross = "assert/image/cross.png";

		foreach($permission as $row){
			$this->pdf->Cell(95,$height,iconv('UTF-8','TIS-620', $row->stm_name),'LBTR',0,'C',0); 
			if($row->pmm_read){

				$read = $check;
			}else{

				$read = $cross;
			}

			if($row->pmm_copy){

				$copy = $check;
			}else{

				$copy = $cross;
			}
			$this->pdf->Cell(47.5,$height, $this->pdf->Image( $read, $this->pdf->GetX() + 22, $this->pdf->GetY() + 3, 5),'LBTR',0,'C',0); 
			$this->pdf->Cell(47.5,$height, $this->pdf->Image( $copy, $this->pdf->GetX() + 22, $this->pdf->GetY() + 3, 5),'LBTR',0,'C',0); 
			$this->pdf->Ln();
		}

		$this->pdf->Cell(190,$height,iconv('UTF-8','TIS-620', ""),'',0,'L',0); 
		$this->pdf->Ln();

		$this->pdf->Cell(190,$height,iconv('UTF-8','TIS-620', "Approve by _______________________"),'',0,'R',0); 
		$this->pdf->Ln();

		$this->pdf->Cell(190,$height,iconv('UTF-8','TIS-620', "(______________________)"),'',0,'R',0); 
		$this->pdf->Ln();

		$this->pdf->Output("Approve_document.pdf","I");
	}

}
