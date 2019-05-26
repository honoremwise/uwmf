<?php
/**
 * this class file is retrieving programs from the database
 */
class GetPrograms extends CI_Controller
{
  public function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->load->model('SelectPrograms');
        $this->load->model('StartApp');
    }
    public function index()
    {
      // check if current application is open
      $result=$this->StartApp->checkApplication();
  		if ($result==TRUE) {
        $data['groups'] = $this->SelectPrograms->university_programs();
  			$this->load->view('views_pages/registerFormMain.php',$data);
  		} else {
        $data = array('application' =>'Application is Currently Closed',);
  			$this->load->view('index.php',$data);
  		}
    }
}
 ?>
