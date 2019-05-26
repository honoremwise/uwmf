<?php
class StartApplication extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->Model('StartApp');
		$this->load->library('form_validation');
	}
	 public function index()
	{
		$result=$this->StartApp->checkApplication();
		if ($result==TRUE) {
			$this->load->view('views_pages/registerFormMain.php');
		} else {
			$data=array(
				'applicationMessage'=>'Application currently closed',
			);
			$this->load->view('index.php',$data);
		}
	}
}
?>
