<?php
/**
 * This class was inherited to help in loading system homepage and define functions to load other pages
 */
class LoadPages extends CI_Controller
{
	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('form_validation');
	}
	function index(){
		$this->load->view('index.php');
	}
	function LoadRegister(){ // This function will help to load a register form for a new student
		$this->load->view('views_pages/registerFormMain.php');
	}
	public function LoadRegisterFiles(){
		$this->load->view('views_pages/bachelor_master_program_uploads.php');
	}
	public function LoadHome()
	{
		$this->load->view('views_pages/registerFormMain.php');
	}
	public function ResumeApplication(){
		$this->load->view('index.php');
	}
	public function loadHeader(){
		$this->load->view('views_pages/header.php');
	}
	public function test()//will be deleted
	{
		if (isset($_SESSION['validuser'])) {
			$this->load->view('views_pages/getaccount.php');
			//$this->load->view('tempuser/index.php');
		}else {
			$this->load->view('views_pages/getcount.php');
		}
	}
}
?>
