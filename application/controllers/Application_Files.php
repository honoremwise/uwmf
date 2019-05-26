<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *when uploading files
 */
class Application_Files extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->helper('url');
    $this->load->helper('form');
    $this->load->model('ApplyFiles');
    $this->load->model('SelectPrograms');
  }
  public function index()//check whether all files have been uploaded for master students
  {
    if (!isset($_SESSION['username'])) {
      $data=array(
        'messageDisplay'=>'Session expired,Please login',
      );
      $this->load->view('views_pages/home.php',$data);
    }else {
      $this->check_uploads();
    }
  }
  public function check_uploads()
  {
    $value_uploads=$_POST['uploadnumber'];
    //get the program code to know which files number to check
    $program=$this->SelectPrograms->applicantProgram();
    switch ($program) {
      case '01':
        $this->ApplyFiles->cert_diploma_Application();
        break;
        case '02':
          $this->ApplyFiles->cert_diploma_Application();
          break;
      case '03':
        // master applicant
        $this->ApplyFiles->masterApplication();
        break;
      case '04':
          $this->ApplyFiles->masterApplication();
          break;
      default:
        // code...
        break;
    }
  }
}//end of class
?>
