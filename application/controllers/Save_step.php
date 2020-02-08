<?php
class Save_step extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
		$this->load->helper('url');
		$this->load->helper('security');
    $this->load->library('form_validation');
		$this->load->model('SelectModels');
    $this->load->Model('SelectPrograms');
  }
  public function index()
  {
    //check if sessions are valid
    if (!isset($_SESSION['username'])){
      $data=array(
        'messageDisplay'=>'You are logged out',
      );
      $this->load->view('index.php',$data);
    }else {
      //chek whether form data has been previously saved
      if(isset($_GET['pageapplication'])) {
        $this->save_main();
      }
      elseif(isset($_GET['workapplication'])) {
        //chek whether user has submitted his/her relious position information
        $this->saveexperience();
      }elseif (isset($_GET['work_job_attended'])){
        // check whether applicant has submitted work experience
        $this->saveworkexperience();
      }else {
        $this->load->view('index.php');
      }
    }
  }
  public function save_main()
  {
    $user=$this->session->userdata('username');
    //check data from database
    $result=$this->SelectModels->saveData($user);
    if ($result!=FALSE) {
      // redirect to file upload
      switch ($result) {
        case '01':
          $this->load->view('views_pages/bachelor_master_program_uploads.php');
          break;
        case '02':
          $this->load->view('views_pages/bachelor_master_program_uploads.php');
          break;
        case '03':
          $this->load->view('views_pages/bachelor_master_program_uploads.php');
          break;
        case '04':
          $this->load->view('views_pages/bachelor_master_program_uploads.php');
          break;
        default:
          $this->load->view('index.php');
          break;
      }
    }else { // redirect back to the page to complete the page
      // user has not previously filled all required form data
      //get the program
      $result=$this->SelectModels->retrieveprogram();
      $branches=$this->SelectPrograms->university_branches();
      $data=array(
        'messageDisplay'=>'Please fill the form and save it to continue',
        'branches'=>$branches,
      );
      switch ($result) {
        case '01':
        $this->load->view('certificate/application.php',$data);
        //echo "here";
          break;
        case '02':
        $this->load->view('certificate/application.php',$data);
          break;
        case '03':
        //$data['branches']=$this->selectPrograms->university_branches();
        $this->load->view('bachelor_master/application.php',$data);
          break;
        case '04':
        $this->load->view('bachelor_master/application.php',$data);
          break;
        default:
          $this->load->view('index.php');
          break;
      }
    }
  }//end of function definition

  public function saveexperience()
  {
    //get reference for the current applicant
    $this->load->model('Certificate_saveFiles');
    $reference=$this->Certificate_saveFiles->retrieveReference();
    //check data from database
    $result=$this->SelectModels->savework($reference);
    if ($result!=FALSE) {
      switch ($result) {
        case '01':
          $this->load->view('certificate/review_application.php');
          break;
        case '02':
          $this->load->view('certificate/review_application.php');
          break;
        case '03':
          $this->load->view('bachelor_master/job_work_experience.php');
          break;
        case '04':
          $this->load->view('bachelor_master/job_work_experience.php');
          break;
        default:
          $this->load->view('index.php');
          break;
      }
    }else { //user has not previously saved data
      $data=array(
        'messageDisplay'=>'Please fill the form and save it to continue',
      );
      $program=$this->SelectModels->retrieveprogram();
      switch ($program) {
        case '01':
        $this->load->view('certificate/work_experience.php',$data);
          break;
        case '02':
        $this->load->view('certificate/work_experience.php',$data);
          break;
        case '03':
        $this->load->view('bachelor_master/work_experience.php',$data);
          break;
        case '04':
        $this->load->view('bachelor_master/work_experience.php',$data);
          break;
        default:
          $this->load->view('index.php');
          break;
      }
    }
  }//end of function definition
  public function saveworkexperience()
  {
    //get reference for the current applicant
    $this->load->model('Certificate_saveFiles');
    $reference=$this->Certificate_saveFiles->retrieveReference();
    //check data from database
    $result=$this->SelectModels->checkexperience($reference);
    if ($result!=FALSE) {
      switch ($result) {
        case '03':
        $this->load->view('bachelor_master/review_application.php');
          break;
        case '04':
          $this->load->view('bachelor_master/review_application.php');
          break;
        default:
          $this->load->view('index.php');
          break;
      }
    }else {
      $data=array(
        'messageDisplay'=>'Please fill the form and save it to continue',
      );
      $program=$this->SelectModels->retrieveprogram();
      switch ($program) {
        case '03':
          $this->load->view('bachelor_master/job_work_experience.php',$data);
          break;
        case '04':
          $this->load->view('bachelor_master/job_work_experience.php',$data);
          break;
        default:
          $this->load->view('index.php');
          break;
      }
    }
  }//end of function definition
}
 ?>
