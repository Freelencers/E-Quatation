<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_manual extends CI_Controller{

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
	}

	public function index()
	{
		$nav[0]["page"] = "Manual";
		$nav[0]["icon"] = "fa fa-book";
		$nav[0]["link"] = "#";
		$nav[0]["active"] = "";

		$data["permission"] = 1;
		$view = $this->load->view("V_manual", $data, TRUE);
		template( "Manual", "This page for manual of system", $view, $nav);			
		
	}
}
