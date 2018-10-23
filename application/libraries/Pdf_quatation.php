<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require('fpdf.php');
class Pdf_quatation extends FPDF
{
  // Extend FPDF using this class
  // More at fpdf.org -> Tutorials
  function __construct($orientation='P', $unit='mm', $size='A4')
  {
    // Call parent constructor
    parent::__construct($orientation,$unit,$size);
  }

  function Header(){
    $border_cell = 0;
		$this->AddFont('THSarabun','','THSarabun.php');
		$this->AddFont('THSarabun','B','THSarabun.php');
		$this->AddFont('THSarabun','I','THSarabun.php');
		$this->AddFont('THSarabun','U','THSarabun.php');
		$this->SetFont('THSarabun','',24);
		$this->Cell(159,10,iconv( 'UTF-8','TIS-620','OTEC SUPPLY COMPANY LIMITED'),$border_cell,1,"C");
		
		$this->SetFont('THSarabun','',16);
		$this->Cell(195,8,iconv( 'UTF-8','TIS-620','1927 Moo 6 Sukhumvit Rd., Samrong-Nua, Muang, Samutprakarn 10270'),$border_cell,1,"C");
		$this->Cell(220,8,iconv( 'UTF-8','TIS-620','Tel/Fax. (02) 744-5659, 744-5940, 5942, 5944 Fax. # 102 E-mail: sale@otecsupply.com'),$border_cell,1,"C");
		$this->Image('assert/pdf/otec_logo.png',10,12,30,0,'','');

		$this->Cell(0,10,iconv( 'UTF-8','TIS-620','ใบเสนอราคา - Quatation'),$border_cell,1,"C");
  }
}
?>