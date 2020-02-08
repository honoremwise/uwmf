<?php
class SubmitApplication extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
		$this->load->helper('url');
		$this->load->helper('security');
    $this->load->library('form_validation');
		$this->load->model('SelectModels');
  }
  public function index()
  {
    // check if session is valid
    if (isset($_SESSION['username'])){
      // get reference number
      $this->load->model('Certificate_saveFiles');
      $reference=$this->Certificate_saveFiles->retrieveReference();
      //get program identification
      $program=$this->SelectModels->retrieveprogram();
      //initialize current applicatio year
      $yearapplication=date("Y-m-d");
      //submit application
      $data=array('reference_no' => $reference,
      'program_code'=>$program,
      'year_last_application'=>$yearapplication,
       'number_of_application'=>1,
      );
      $this->load->model('Register');
      $this->load->model('StartApp');
      //check if application is currently open or closed
      $this->load->model('StartApp');
      $check=$this->StartApp->checkApplication();
      if ($check==true){
        $this->Register->saveApplication($data);
      } else {
        $data = array('application' =>'Application has ended');
        $this->load->view('index.php',$data);
      }
    }else {
      $data=array('session' => 'You are logged out', );
      $this->load->view('views_pages/home.php',$data);
    }
  }//end of function
}
 ?>
