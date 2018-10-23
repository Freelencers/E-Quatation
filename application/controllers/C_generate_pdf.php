<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_generate_pdf extends CI_Controller{

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
		$this->load->model("M_condition_log");
		$this->load->model("M_scope_of_work_log");

		$this->load->model("M_employee");
		$this->load->model("M_permission_module");

		$this->load->library('Pdf_quatation'); 
		$this->pdf_quatation->SetFontPath("fonts/");

		//$this->pdf_quatation->SetTextColor(0,0,128);
	}

	public function header_paper(){
		$border_cell = 0;
		$this->pdf_quatation->AddFont('THSarabun','','THSarabun.php');
		$this->pdf_quatation->AddFont('THSarabun','B','THSarabun.php');
		$this->pdf_quatation->AddFont('THSarabun','I','THSarabun.php');
		$this->pdf_quatation->AddFont('THSarabun','U','THSarabun.php');
		$this->pdf_quatation->SetFont('THSarabun','',24);
		$this->pdf_quatation->SetTextColor(0,0,128);
		$this->pdf_quatation->Cell(159,10,iconv( 'UTF-8','TIS-620','OTEC SUPPLY COMPANY LIMITED'),$border_cell,1,"C");
		$this->pdf_quatation->SetFont('THSarabun','',16);
		$this->pdf_quatation->Cell(195,8,iconv( 'UTF-8','TIS-620','1927 Moo 6 Sukhumvit Rd., Samrong-Nua, Muang, Samutprakarn 10270'),$border_cell,1,"C");
		$this->pdf_quatation->Cell(220,8,iconv( 'UTF-8','TIS-620','Tel/Fax. (02) 744-5659, 744-5940, 5942, 5944 Fax. # 102 E-mail: sale@otecsupply.com'),$border_cell,1,"C");
		$this->pdf_quatation->Image('assert/pdf/otec_logo.png',10,12,30,0,'','');

		$this->pdf_quatation->Cell(0,10,iconv( 'UTF-8','TIS-620','ใบเสนอราคา - Quatation'),$border_cell,1,"C");
	}

	public function header_table($height=10){

		// New line
		$this->pdf_quatation->AddPage();
		$this->pdf_quatation->Cell(20,$height,' ','LTRB',0,'L',0); 
		$this->pdf_quatation->Text(15,50,iconv( 'UTF-8','TIS-620',"ลำดับที่"));
		$this->pdf_quatation->Text(14,79-25,iconv( 'UTF-8','TIS-620',"ITEM NO."));
		$this->pdf_quatation->Cell(20,$height,' ','LTRB',0,'L',0); 
		$this->pdf_quatation->Text(38,75-25,iconv( 'UTF-8','TIS-620',"รุ่น"));
		$this->pdf_quatation->Text(36,79-25,iconv( 'UTF-8','TIS-620',"Model"));
		$this->pdf_quatation->Cell(65,$height,' ','LTRB',0,'L',0); 
		$this->pdf_quatation->Text(77,75-25,iconv( 'UTF-8','TIS-620',"รายการ"));
		$this->pdf_quatation->Text(73,79-25,iconv( 'UTF-8','TIS-620',"DESCRIPTION"));
		$this->pdf_quatation->Cell(15,$height,'','LTRB',0,'L',0); 
		$this->pdf_quatation->Text(119,75-25,iconv( 'UTF-8','TIS-620',"จำนวน"));
		$this->pdf_quatation->Text(116,79-25,iconv( 'UTF-8','TIS-620',"QUANTITY"));
		$this->pdf_quatation->Cell(15,$height,' ','LTRB',0,'L',0); 
		$this->pdf_quatation->Text(135,75-25,iconv( 'UTF-8','TIS-620',"หน่วย"));
		$this->pdf_quatation->Text(135,79-25,iconv( 'UTF-8','TIS-620',"UNIT"));
		$this->pdf_quatation->Cell(25,$height,' ','LTRB',0,'L',0); 
		$this->pdf_quatation->Text(150,75-25,iconv( 'UTF-8','TIS-620',"ราคาต่อหน่วย"));
		$this->pdf_quatation->Text(151,79-25,iconv( 'UTF-8','TIS-620',"UNIT PRICE"));
		$this->pdf_quatation->Cell(30,$height,' ','LTRB',0,'L',0); 
		$this->pdf_quatation->Text(178,75-25,iconv( 'UTF-8','TIS-620',"จำนวนเงิน"));
		$this->pdf_quatation->Text(178,79-25,iconv( 'UTF-8','TIS-620',"AMOUNT"));
		$this->pdf_quatation->Ln();
	}
	public function quatation_pdf($prj_id, $root_prj_id){

		// Get detail of project
		$project_detail = $this->M_project->get_project_by_id($prj_id)->row_array();
		// Get system of this project
		$system_list = $this->M_system_log->get_system_log_by_prj_id($root_prj_id)->result();
		// Get hardware 
		$hardware_list = $this->M_hardware->get_hardware_by_prj_id($prj_id);
		// Get acessory 
		$accessory_list = $this->M_accessory->get_accessory_by_prj_id($prj_id);
		// Get condition
		$condition_list = $this->M_condition_log->get_condition_log_by_prj_id($prj_id);
		// Get scope of work
		$scope_of_work_list = $this->M_scope_of_work_log->get_scope_of_work_log_by_prj_id($prj_id);

	
		$this->pdf_quatation->AddPage();

		// Header detail 

		$border_table = 1;
		$height = 10;
		$this->pdf_quatation->SetFont('THSarabun','',12);
		$this->pdf_quatation->Cell(20, 5,'','',0,'L',0); 
		$this->pdf_quatation->Ln();

		$this->pdf_quatation->Text(17,50,iconv( 'UTF-8','TIS-620',"เรื่อง"));
		$this->pdf_quatation->Cell(20, ($height * 2),'','LTRB',0,'L',0); 
		$this->pdf_quatation->Text(15,56,iconv( 'UTF-8','TIS-620',"เสนอให้แก่"));
		$this->pdf_quatation->Text(32,56,iconv( 'UTF-8','TIS-620', $project_detail["prj_company"]));
		$this->pdf_quatation->Text(12,60,iconv( 'UTF-8','TIS-620',"QUATATION"));
		$this->pdf_quatation->Text(21,65,iconv( 'UTF-8','TIS-620',"TELL"));
		$this->pdf_quatation->Text(32,65,iconv( 'UTF-8','TIS-620', $project_detail["prj_tel"]));
		$this->pdf_quatation->Text(22,69,iconv( 'UTF-8','TIS-620',"FAX"));
		$this->pdf_quatation->Text(32,69,iconv( 'UTF-8','TIS-620', $project_detail["prj_fax"]));

		$this->pdf_quatation->Cell(40,$height,' ','LTRB',0,'L',0); 
		$this->pdf_quatation->Text(83,55,iconv( 'UTF-8','TIS-620',"เรียน"));
		$this->pdf_quatation->Text(93,55,iconv( 'UTF-8','TIS-620', $project_detail["prj_contact"]));
		$this->pdf_quatation->Text(74,59,iconv( 'UTF-8','TIS-620',"ATTENTION"));

		$this->pdf_quatation->Cell(20,$height,' ','LTRB',0,'C',0); 
		$this->pdf_quatation->Text(133,55,iconv( 'UTF-8','TIS-620',"ใบเสนอราคาเลขที่"));
		$this->pdf_quatation->Text(133,59,iconv( 'UTF-8','TIS-620',"QUATATION NO"));
		$this->pdf_quatation->Text(173,57,iconv( 'UTF-8','TIS-620', $project_detail["prj_ref_no"]));

		$this->pdf_quatation->Cell(40,$height,' ','LTRB',0,'L',0); 
		$this->pdf_quatation->Text(93,59,iconv( 'UTF-8','TIS-620',"Mobile"));
		$this->pdf_quatation->Text(103,59,iconv( 'UTF-8','TIS-620', $project_detail["prj_mobile"]));

		$this->pdf_quatation->Cell(40,$height,' ','LTRB',0,'L',0); 
		$this->pdf_quatation->Cell(30,$height,' ','LTRB',0,'L',0); 
		$this->pdf_quatation->Ln();


		// New line
		$this->pdf_quatation->Cell(20,$height,'','',0,'L',0); 
		$this->pdf_quatation->Cell(40,$height,' ','LTRB',0,'L',0); 
		$this->pdf_quatation->Cell(20,$height,' ','LTRB',0,'C',0); 
		$this->pdf_quatation->Text(81,65,iconv( 'UTF-8','TIS-620',"อ้างอิง"));
		$this->pdf_quatation->Text(74,69,iconv( 'UTF-8','TIS-620',"REFERENCE"));

		$this->pdf_quatation->Cell(40,$height,' ','LTRB',0,'L',0); 
		$this->pdf_quatation->Text(93,65,iconv( 'UTF-8','TIS-620',"Your Reuired"));
		$this->pdf_quatation->Text(93,69,iconv( 'UTF-8','TIS-620',"Email"));
		$this->pdf_quatation->Text(101,69,iconv( 'UTF-8','TIS-620', $project_detail["prj_email"]));

		$this->pdf_quatation->Cell(15,$height,' ','LTRB',0,'L',0); 

		$this->pdf_quatation->Text(133,65,iconv( 'UTF-8','TIS-620',"ลงวันที่"));
		$this->pdf_quatation->Text(133,69,iconv( 'UTF-8','TIS-620',"Date"));
		$this->pdf_quatation->Text(150,67,iconv( 'UTF-8','TIS-620', $project_detail["prj_wot_date"]));
		$this->pdf_quatation->Cell(25,$height,' ','LTRB',0,'L',0); 
		$this->pdf_quatation->Cell(30,$height,' ','LTRB',0,'L',0); 

		$this->pdf_quatation->AliasNbPages('{totalPages}');
		$this->pdf_quatation->Text(173,65,iconv( 'UTF-8','TIS-620',"แผนที่ ".$this->pdf_quatation->PageNo()."/{totalPages}"));
		$this->pdf_quatation->Text(173,69,iconv( 'UTF-8','TIS-620',"Revised ". $project_detail["prj_version"]));
		$this->pdf_quatation->Ln();

		// Header table
		$this->pdf_quatation->Cell(20,$height,' ','LTRB',0,'L',0); 
		$this->pdf_quatation->Text(15,75,iconv( 'UTF-8','TIS-620',"ลำดับที่"));
		$this->pdf_quatation->Text(14,79,iconv( 'UTF-8','TIS-620',"ITEM NO."));
		$this->pdf_quatation->Cell(20,$height,' ','LTRB',0,'L',0); 
		$this->pdf_quatation->Text(38,75,iconv( 'UTF-8','TIS-620',"รุ่น"));
		$this->pdf_quatation->Text(36,79,iconv( 'UTF-8','TIS-620',"Model"));
		$this->pdf_quatation->Cell(65,$height,' ','LTRB',0,'L',0); 
		$this->pdf_quatation->Text(77,75,iconv( 'UTF-8','TIS-620',"รายการ"));
		$this->pdf_quatation->Text(73,79,iconv( 'UTF-8','TIS-620',"DESCRIPTION"));
		$this->pdf_quatation->Cell(15,$height,'','LTRB',0,'L',0); 
		$this->pdf_quatation->Text(119,75,iconv( 'UTF-8','TIS-620',"จำนวน"));
		$this->pdf_quatation->Text(116,79,iconv( 'UTF-8','TIS-620',"QUANTITY"));
		$this->pdf_quatation->Cell(15,$height,' ','LTRB',0,'L',0); 
		$this->pdf_quatation->Text(135,75,iconv( 'UTF-8','TIS-620',"หน่วย"));
		$this->pdf_quatation->Text(135,79,iconv( 'UTF-8','TIS-620',"UNIT"));
		$this->pdf_quatation->Cell(25,$height,' ','LTRB',0,'L',0); 
		$this->pdf_quatation->Text(150,75,iconv( 'UTF-8','TIS-620',"ราคาต่อหน่วย"));
		$this->pdf_quatation->Text(151,79,iconv( 'UTF-8','TIS-620',"UNIT PRICE"));
		$this->pdf_quatation->Cell(30,$height,' ','LTRB',0,'L',0); 
		$this->pdf_quatation->Text(178,75,iconv( 'UTF-8','TIS-620',"จำนวนเงิน"));
		$this->pdf_quatation->Text(178,79,iconv( 'UTF-8','TIS-620',"AMOUNT"));
		$this->pdf_quatation->Ln();


		// Print system list
		$current_page = $this->pdf_quatation->PageNo();
		$system_index = "A";
		$total = 0;
		$discount = $project_detail["prj_discount"];
		$sub_total = 0;
		$index_str = "";
		
		// Header bug
		$time = 0;
		
		foreach($system_list as $system_row){

			// Clear total
			$total = 0;

			$this->pdf_quatation->Cell(20,($height / 2),$system_index,'LR',0,'C',0); 
			$this->pdf_quatation->Cell(20,($height / 2),'','LR',0,'L',0); 
			$this->pdf_quatation->Cell(65,($height / 2),$system_row->syt_name,'LR',0,'C',0); 
			$this->pdf_quatation->Cell(15,($height / 2),'','LR',0,'L',0); 
			$this->pdf_quatation->Cell(15,($height / 2),'','LR',0,'L',0); 
			$this->pdf_quatation->Cell(25,($height / 2),'','LR',0,'L',0); 
			$this->pdf_quatation->Cell(30,($height / 2),'','LR',0,'L',0); 
			$this->pdf_quatation->Ln();

			foreach($hardware_list as $hardware_row){

				//Check header
				if($this->pdf_quatation->GetY() > 270){

					$get_y = $this->pdf_quatation->GetY();
					$this->pdf_quatation->Line(10, $get_y, 200, $get_y);
					$this->header_table();
				}
				if($hardware_row->har_syt_id == $system_row->syl_syt_id){

					$this->pdf_quatation->Cell(20,($height / 2),'','LR',0,'C',0); 
					$this->pdf_quatation->Cell(20,($height / 2), $hardware_row->pro_model,'LR',0,'C',0); 

					// check string width
					$str_width = $this->pdf_quatation->GetStringWidth($hardware_row->pro_description);

					if($str_width > 60){

						// This case for text more than 1 line
						$char = str_split($hardware_row->pro_description);
						$first_line = true;
						$temp = "";
						for($i=0;$i<count($char);$i++){

							$temp .= $char[$i];
							$width = $this->pdf_quatation->GetStringWidth($temp);
							//echo $width."<BR>";
							if($width >= 60){

								if($first_line){
									// Discount
									$discount_list = explode("+", $hardware_row->har_discount);
									$amount = $hardware_row->amount;
									for($i=0;$i<count($discount_list);$i++){
										$amount -= ($discount_list[$i] * $amount) / 100;
									}
									$this->pdf_quatation->Cell(65,($height / 2), $temp,'LR',0,'L',0);
									$this->pdf_quatation->Cell(15,($height / 2), $hardware_row->har_qty,'LR',0,'C',0); 
									$this->pdf_quatation->Cell(15,($height / 2), iconv('UTF-8','TIS-620',$hardware_row->uni_name),'LR',0,'C',0); 
									$this->pdf_quatation->Cell(25,($height / 2), number_format(($amount / $hardware_row->har_qty)),'LR',0,'C',0); 
									$this->pdf_quatation->Cell(30,($height / 2), number_format($amount),'LR',0,'C',0); 
									$this->pdf_quatation->Ln();

									// Set line status
									$first_line = false;

									// Reset
									$temp = "";
								}else{
									
									$this->pdf_quatation->Cell(20,($height / 2),'','LR',0,'C',0); 
									$this->pdf_quatation->Cell(20,($height / 2),'','LR',0,'C',0); 
									$this->pdf_quatation->Cell(65,($height / 2), $temp,'LR',0,'L',0); 
									$this->pdf_quatation->Cell(15,($height / 2),'','LR',0,'C',0); 
									$this->pdf_quatation->Cell(15,($height / 2),'','LR',0,'C',0); 
									$this->pdf_quatation->Cell(25,($height / 2),'','LR',0,'C',0); 
									$this->pdf_quatation->Cell(30,($height / 2),'','LR',0,'C',0); 
									$this->pdf_quatation->Ln();

									// Reset
									$temp = "";
								}
							}
						}
					}else{
						// Discount
						$discount_list = explode("+", $hardware_row->har_discount);
						$amount = $hardware_row->amount;
						for($i=0;$i<count($discount_list);$i++){
							$amount -= ($discount_list[$i] * $amount) / 100;
						}
						$this->pdf_quatation->Cell(65,($height / 2), $hardware_row->pro_description,'LR',0,'L',0);
						$this->pdf_quatation->Cell(15,($height / 2), $hardware_row->har_qty,'LR',0,'C',0); 
						$this->pdf_quatation->Cell(15,($height / 2), iconv('UTF-8','TIS-620',$hardware_row->uni_name),'LR',0,'C',0); 
						$this->pdf_quatation->Cell(25,($height / 2), number_format(($amount / $hardware_row->har_qty)),'LR',0,'C',0); 
						$this->pdf_quatation->Cell(30,($height / 2), number_format($amount),'LR',0,'C',0); 
						$this->pdf_quatation->Ln();
					}

					// Total sum
					$total += $amount;
				}
			}


			// Discount
			$discount_price = (($total * $discount) / 100);
			$this->pdf_quatation->Cell(20,($height / 2),'','LR',0,'C',0); 
			$this->pdf_quatation->Cell(20,($height / 2),'','LR',0,'C',0); 
			$this->pdf_quatation->Cell(65,($height / 2),'Discount '.$discount.' %','LR',0,'C',0); 
			$this->pdf_quatation->Cell(15,($height / 2),'','LR',0,'C',0); 
			$this->pdf_quatation->Cell(15,($height / 2),'','LR',0,'C',0); 
			$this->pdf_quatation->Cell(25,($height / 2),'','LR',0,'C',0); 
			$this->pdf_quatation->Cell(30,($height / 2), number_format($discount_price),'LR',0,'R',0);
			$this->pdf_quatation->Ln();

			$total = $total - $discount_price;

			// Total
			$total_final = $total;
			$index_str .= $system_index. " + ";

			$this->pdf_quatation->Cell(20,($height / 2),'','LR',0,'C',0); 
			$this->pdf_quatation->Cell(20,($height / 2),'','LR',0,'C',0); 
			$this->pdf_quatation->Cell(65,($height / 2),'Total '.$system_index,'LR',0,'C',0); 
			$this->pdf_quatation->Cell(15,($height / 2),'','LR',0,'C',0); 
			$this->pdf_quatation->Cell(15,($height / 2),'','LR',0,'C',0); 
			$this->pdf_quatation->Cell(25,($height / 2),'','LR',0,'C',0); 
			$this->pdf_quatation->Cell(30,($height / 2), number_format($total_final),'LR',0,'R',0);

			$sub_total += $total_final;

			$this->pdf_quatation->Ln();
			$system_index++;
		}

		// Accessorry
		$this->pdf_quatation->Cell(20,($height / 2), $system_index,'LR',0,'C',0); 
		$this->pdf_quatation->Cell(20,($height / 2),'','LR',0,'C',0); 
		$this->pdf_quatation->Cell(65,($height / 2),'Acessory','LR',0,'L',0); 
		$this->pdf_quatation->Cell(15,($height / 2),'','LR',0,'C',0); 
		$this->pdf_quatation->Cell(15,($height / 2),'','LR',0,'C',0); 
		$this->pdf_quatation->Cell(25,($height / 2),'','LR',0,'C',0); 
		$this->pdf_quatation->Cell(30,($height / 2),'','LR',0,'R',0); 
		$this->pdf_quatation->Ln();

		// Acessory list 
		$total = 0;
		foreach($accessory_list as $accessory_row){
			
			//Check header
			if($this->pdf_quatation->GetY() > 270){
				
				$get_y = $this->pdf_quatation->GetY();
				$this->pdf_quatation->Line(10, $get_y, 200, $get_y);
				$this->header_table();
			}
			$this->pdf_quatation->Cell(20,($height / 2), '','LR',0,'C',0); 
			$this->pdf_quatation->Cell(20,($height / 2), $accessory_row->pro_model,'LR',0,'C',0); 
			//$this->pdf_quatation->Cell(65,($height / 2), $accessory_row->pro_description,'LR',0,'L',0); 

			// check string width
			$str_width = $this->pdf_quatation->GetStringWidth($accessory_row->pro_description);
			
			if($str_width > 60){

				// This case for text more than 1 line
				$char = str_split($accessory_row->pro_description);
				$first_line = true;
				$temp = "";
				for($i=0;$i<count($char);$i++){

					$temp .= $char[$i];
					$width = $this->pdf_quatation->GetStringWidth($temp);
					//echo $width."<BR>";
					if($width >= 60){

						if($first_line){

							// Discount
							$discount_list = explode("+", $accessory_row->acc_discount);
							$amount = $accessory_row->amount;
							for($i=0;$i<count($discount_list);$i++){
								$amount -= ($discount_list[$i] * $amount) / 100;
							}

							$this->pdf_quatation->Cell(65,($height / 2), $temp,'LR',0,'L',0);
							$this->pdf_quatation->Cell(15,($height / 2), $accessory_row->acc_qty,'LR',0,'C',0); 
							$this->pdf_quatation->Cell(15,($height / 2), iconv('UTF-8','TIS-620',$accessory_row->uni_name),'LR',0,'C',0); 
							$this->pdf_quatation->Cell(25,($height / 2), number_format(($amount / $accessory_row->acc_qty)),'LR',0,'C',0); 
							$this->pdf_quatation->Cell(30,($height / 2), number_format($amount),'LR',0,'C',0); 
							$this->pdf_quatation->Ln();

							// Set line status
							$first_line = false;

							// Reset
							$temp = "";
						}else{
							
							$this->pdf_quatation->Cell(20,($height / 2),'','LR',0,'C',0); 
							$this->pdf_quatation->Cell(20,($height / 2),'','LR',0,'C',0); 
							$this->pdf_quatation->Cell(65,($height / 2), $temp,'LR',0,'L',0); 
							$this->pdf_quatation->Cell(15,($height / 2),'','LR',0,'C',0); 
							$this->pdf_quatation->Cell(15,($height / 2),'','LR',0,'C',0); 
							$this->pdf_quatation->Cell(25,($height / 2),'','LR',0,'C',0); 
							$this->pdf_quatation->Cell(30,($height / 2),'','LR',0,'C',0); 
							$this->pdf_quatation->Ln();

							// Reset
							$temp = "";
						}
					}
				}
			}else{

				// Discount
				$discount_list = explode("+", $accessory_row->acc_discount);
				$amount = $accessory_row->amount;
				for($i=0;$i<count($discount_list);$i++){
					$amount -= ($discount_list[$i] * $amount) / 100;
				}

				$this->pdf_quatation->Cell(65,($height / 2), $accessory_row->pro_description,'LR',0,'L',0);
				$this->pdf_quatation->Cell(15,($height / 2), $accessory_row->acc_qty,'LR',0,'C',0); 
				$this->pdf_quatation->Cell(15,($height / 2), iconv('UTF-8','TIS-620',$accessory_row->uni_name),'LR',0,'C',0); 
				$this->pdf_quatation->Cell(25,($height / 2), number_format(($amount / $accessory_row->acc_qty)),'LR',0,'C',0); 
				$this->pdf_quatation->Cell(30,($height / 2), number_format($amount),'LR',0,'C',0); 
				$this->pdf_quatation->Ln();
			}


			$total +=  $amount;
		}

		// Total acccessory 
		$this->pdf_quatation->Cell(20,($height / 2),'','LR',0,'C',0); 
		$this->pdf_quatation->Cell(20,($height / 2),'','LR',0,'C',0); 
		$this->pdf_quatation->Cell(65,($height / 2),'Total '.$system_index,'LR',0,'C',0); 
		$this->pdf_quatation->Cell(15,($height / 2),'','LR',0,'C',0); 
		$this->pdf_quatation->Cell(15,($height / 2),'','LR',0,'C',0); 
		$this->pdf_quatation->Cell(25,($height / 2),'','LR',0,'C',0); 
		$this->pdf_quatation->Cell(30,($height / 2), number_format($total),'LR',0,'R',0); 
		$this->pdf_quatation->Ln();
		$sub_total += $total;
		$index_str .= $system_index;

		// Sub Total A + B
		$this->pdf_quatation->Cell(20,($height / 2),'','LR',0,'C',0); 
		$this->pdf_quatation->Cell(20,($height / 2),'','LR',0,'C',0);
		$this->pdf_quatation->Cell(65,($height / 2),'Sub Total '.$index_str,'LR',0,'C',0); 
		$this->pdf_quatation->Cell(15,($height / 2),'','LR',0,'C',0); 
		$this->pdf_quatation->Cell(15,($height / 2),'','LR',0,'C',0); 
		$this->pdf_quatation->Cell(25,($height / 2),'','LR',0,'C',0); 
		$this->pdf_quatation->Cell(30,($height / 2), number_format($sub_total),'LR',0,'R',0); 
		$this->pdf_quatation->Ln();

		
		// Vat
		$vat = $project_detail["prj_vat"];
		$vat_price = ($sub_total * $vat) / 100;
		$this->pdf_quatation->Cell(20,($height / 2),'','LR',0,'C',0); 
		$this->pdf_quatation->Cell(20,($height / 2),'','LR',0,'C',0); 
		$this->pdf_quatation->Cell(65,($height / 2),'Vat '.$vat.'%','LR',0,'C',0); 
		$this->pdf_quatation->Cell(15,($height / 2),'','LR',0,'C',0); 
		$this->pdf_quatation->Cell(15,($height / 2),'','LR',0,'C',0); 
		$this->pdf_quatation->Cell(25,($height / 2),'','LR',0,'C',0); 
		$this->pdf_quatation->Cell(30,($height / 2), number_format($vat_price),'LR',0,'R',0); 
		$this->pdf_quatation->Ln();

		// Grand
		$grand_price = $vat_price + $sub_total;
		$this->pdf_quatation->Cell(20,($height / 2),'','LR',0,'C',0); 
		$this->pdf_quatation->Cell(20,($height / 2),'','LR',0,'C',0); 
		$this->pdf_quatation->Cell(65,($height / 2),'Grand Total','LR',0,'C',0); 
		$this->pdf_quatation->Cell(15,($height / 2),'','LR',0,'C',0); 
		$this->pdf_quatation->Cell(15,($height / 2),'','LR',0,'C',0); 
		$this->pdf_quatation->Cell(25,($height / 2),'','LR',0,'C',0); 
		$this->pdf_quatation->Cell(30,($height / 2), number_format($grand_price),'LR',0,'R',0); 
		$this->pdf_quatation->Ln();

		// Under line
		$this->pdf_quatation->Cell(190,0,'','BLR',0,'C',0); 
		$this->pdf_quatation->Ln();

		// Count max of list
		$line_number = 0;
		if(count($condition_list) > count($scope_of_work_list)){

			$line_number = count($condition_list);
		}else{

			$line_number = count($scope_of_work_list);
		}

		// Condition
		$this->pdf_quatation->Cell(100,$height,iconv('UTF-8','TIS-620',"เงื่อนไขการเสนอราคา"),'',0,'L',0); 
		// Scope of work
		$this->pdf_quatation->Cell(60,$height,iconv('UTF-8','TIS-620',"Scope of Work"),'',0,'L',0); 
		$this->pdf_quatation->Ln();

		for($i=0;$i<$line_number;$i++){

			// Check is end of list
			$temp_condition = "";
			$temp_sow = "";
			if($i<count($condition_list)){

				if($condition_list[$i]->con_id == 99){

					$temp_condition = $condition_list[$i]->col_con_other;
				}else{

					$temp_condition = $condition_list[$i]->con_value;
				}
			}else{

				$temp_condition = "";
			}

			if($i<count($scope_of_work_list)){

				if($scope_of_work_list[$i]->sow_id == 99){

					$temp_sow = $scope_of_work_list[$i]->sol_sow_other;
				}else{

					$temp_sow = $scope_of_work_list[$i]->sow_value;
				}
			}else{

				$temp_sow = "";
			}

			$this->pdf_quatation->Cell(100,$height / 2,iconv('UTF-8','TIS-620', $temp_condition),'',0,'L',0); 
			$this->pdf_quatation->Cell(60,$height / 2,iconv('UTF-8','TIS-620', $temp_sow),'',0,'L',0); 
			$this->pdf_quatation->Ln();
		}

		$this->pdf_quatation->Cell(100,$height / 2,"",'',0,'L',0); 
		$this->pdf_quatation->Cell(60,$height / 2,iconv('UTF-8','TIS-620', "หมายเหตุ ค่าส่งสินค้าฟรีเฉพาะ Site งานในกรุงเทพฯ เท่านั้น"),'',0,'L',0); 
		$this->pdf_quatation->Ln();

		//$this->pdf_quatation->Cell(100,$height / 2,iconv('UTF-8','TIS-620', "- 70% ของมูลค่าสินค้าที่จัดส่งจริงในแต่ละวงด โปรดชำระเป็น PDC เช็ค 30 เมื่อได้เซ็นรับสินค้า"),'',0,'L',0); 
		$this->pdf_quatation->Cell(60,$height / 2,iconv('UTF-8','TIS-620', ""),0,'L',0); 
		$this->pdf_quatation->Ln();
		$this->pdf_quatation->Ln();

		$this->pdf_quatation->Cell(63,$height,iconv('UTF-8','TIS-620', "ขอยืนยันการสั่งซื้อข้างต้นทุกประการ"),'LTR',0,'C',0); 
		$this->pdf_quatation->Cell(63,$height,iconv('UTF-8','TIS-620', "ผู้เสนอราคา"),'LTR',0,'C',0); 
		$this->pdf_quatation->Cell(63,$height,iconv('UTF-8','TIS-620', "ผู้อนุมัติการเสนอราคา"),'LTR',0,'C',0); 
		$this->pdf_quatation->Ln();

		$this->pdf_quatation->Cell(63,$height,iconv('UTF-8','TIS-620', ".................................................."),'LTR',0,'C',0); 
		$this->pdf_quatation->Cell(63,$height,iconv('UTF-8','TIS-620', ".................................................."),'LTR',0,'C',0); 
		$this->pdf_quatation->Cell(63,$height,iconv('UTF-8','TIS-620', ".................................................."),'LTR',0,'C',0); 
		$this->pdf_quatation->Ln();

		$this->pdf_quatation->Cell(63,$height,iconv('UTF-8','TIS-620', "(..................................................)"), 'LRB',0,'C',0);
		$this->pdf_quatation->Cell(63,$height,iconv('UTF-8','TIS-620', ""),'LRB',0,'C',0); 
		$this->pdf_quatation->Cell(63,$height,iconv('UTF-8','TIS-620', "(นายอนันต์ แซ่จวง)"),'LRB',0,'C',0); 
		$this->pdf_quatation->Ln();

		$this->pdf_quatation->Output("Quatation.pdf","I");
	}


}
