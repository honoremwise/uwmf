<?php
class Update extends CI_Controller
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
      $this->load->view('views_pages/home.php',$data);
    }else {
      //chek whether form data has been previously saved
      if(isset($_GET['submitMainupdate'])) {
        $this->save_update();
      }
      elseif(isset($_GET['churchexperienceupdate'])) {
        //chek whether user has submitted his/her relious position information
        $this->saveexperience();
      }elseif (isset($_GET['workexperienceupdate'])){
        // check whether applicant has submitted work experience
        $this->saveworkexperience();
      }elseif (isset($_GET['fileseupdate'])) {
        // redirect to file uploads page
        //get progra for the current applicant
        $user=$this->session->userdata('username');
        //check data from database
        $result=$this->SelectModels->saveData($user);
        switch ($result) {
          case '01':
            $this->load->view('views_pages/cert_diploma_program_uploads.php');
            break;
          case '02':
            $this->load->view('views_pages/cert_diploma_program_uploads.php');
            break;
          case '03':
            $this->load->view('views_pages/bachelor_master_program_uploads.php');
            break;
          case '04':
            $this->load->view('views_pages/bachelor_master_program_uploads.php');
            break;
          default:
            $this->load->view('views_pages/home.php');
            break;
        }
      }else {
        $this->load->view('views_pages/home.php');
      }
    }
  }
  public function save_update()
  {
    $user=$this->session->userdata('username');
    //check data from database
    $result=$this->SelectModels->saveData($user);
    if ($result!=FALSE) {
      // redirect to update file
      $branches=$this->SelectPrograms->university_branches();
      $data=array(
        'branches'=>$branches,
      );
      switch ($result) {
        case '01':
          $this->load->view('certificate/application.php',$data);
          break;
        case '02':
          $this->load->view('certificate/application.php',$data);
          break;
        case '03':
          $this->load->view('bachelor_master/application.php',$data);
          break;
        case '04':
          $this->load->view('bachelor_master/application.php',$data);
          break;
        default:
          $this->load->view('views_pages/home.php');
          break;
      }
    }else { // redirect back to the login page
      $this->load->view('views_pages/home.php');
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
          $this->load->view('certificate/work_experience.php');
          break;
        case '02':
          $this->load->view('certificate/work_experience.php');
          break;
        case '03':
          $this->load->view('bachelor_master/work_experience.php');
          break;
        case '04':
          $this->load->view('bachelor_master/work_experience.php');
          break;
        default:
          $this->load->view('views_pages/home.php');
          break;
      }
    }else {
      $this->load->view('views_pages/home.php');
    }
  }//end of function
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
        $this->load->view('bachelor_master/job_work_experience.php');
          break;
        case '04':
          $this->load->view('bachelor_master/job_work_experience.php');
          break;
        default:
          $this->load->view('views_pages/home.php');
          break;
      }
    }else {
      $this->load->view('views_pages/home.php');
    }
  }//end of function
  public function updateprogram()
  {
    $this->form_validation->set_rules('program','Program applying for','required');
    if ($this->form_validation->run()==TRUE) {
      // update current program to attend in candidates table
      //get candidate reference
      $reference=$this->SelectPrograms->applicantreference();
      if (!empty($reference) && isset($reference)) {
        //run update in candidates table
        $dataupdate=array('reference_no' => $reference,
        'program_code'=>$this->input->post('program'),
      );
      $this->load->model('Register');
      $update=$this->Register->updateprogramcode($dataupdate);
      if ($update!=FALSE) {
        //$program=$this->input->post('program');
        switch ($update) {
    			case '01':
    				$this->load->view('certificate/application.php');
    				break;
    			case '02':
    				$this->load->view('certificate/application.php');
    				break;
    			case '03':
    					$this->load->view('bachelor_master/application.php');
    					break;
    			case '04':
    					$this->load->view('bachelor_master/application.php');
    					break;
    			default:
    				$this->load->view('views_pages/home.php');
    				break;
    		}
      } else {
        // give update error
        $error=array('error'=>'Error of updating');
        $program=$this->input->post('program');
        switch ($program) {
    			case '01':
    				$this->load->view('certificate/review_application.php',$error);
    				break;
    			case '02':
    				$this->load->view('certificate/review_application.php',$error);
    				break;
    			case '03':
    					$this->load->view('bachelor_master/review_application.php',$error);
    					break;
    			case '04':
    					$this->load->view('bachelor_master/review_application.php',$error);
    					break;
    			default:
    				$this->load->view('views_pages/home.php');
    				break;
    		}
      }
      }else {
        $this->load->view('index.php');
      }
    } else {
      // back to review page and return an error of form_validation
      $this->load->model('Certificate_saveFiles');
      $program=$this->SelectPrograms->applicantProgram();
      if ($program!=FALSE){
        switch ($program) {
          case '01':
            $this->load->view('certificate/review_application.php');
            break;
          case '02':
            $this->load->view('certificate/review_application.php');
            break;
          case '03':
            $this->load->view('bachelor_master/review_application.php');
            break;
          case '04':
            $this->load->view('bachelor_master/review_application.php');
            break;
          default:
            $this->load->view('views_pages/home.php');
            break;
        }
      }else{
        $this->load->view('index.php');
      }
    }
  }
}
 ?>
