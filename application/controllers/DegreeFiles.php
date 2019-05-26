<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *when uploading files
 */
 if (!isset($_SESSION['username'])) {
   $data=array(
     'error_login'=>'Invalid Session Try again',
   );
   //redirect('views_pages/home.php');
 }
class DegreeFiles extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->helper('url');
    $this->load->helper('form');
    $this->load->helper('file');
    $this->load->library('form_validation');
    $this->load->model('Certificate_saveFiles');
    $this->load->model('SelectPrograms');
    $this->load->model('TempModels');
  }
  public function index()
  {
    $this->load->view('views_pages/home.php');
  }
  //function to validate file
  public function checkUploadne(){
    $allowed_mime_type_arr= array('application/pdf');
    //get all files required to be uploaded
    if (isset($_FILES['candidatediploma']['name'])) {
      $mime=get_mime_by_extension($_FILES['candidatediploma']['name']);
      if (isset($_FILES['candidatediploma']['name']) && $_FILES['candidatediploma']['name']!="") {
        if (in_array($mime,$allowed_mime_type_arr)) {
          return true;
        }else {
          $this->form_validation->set_message('checkUploadne', 'Please select only  file of type pdf');
          return false;
        }
      } else {
        $this->form_validation->set_message('checkUploadne','upload required file');
        return false;
      }
    } else {
      $this->form_validation->set_message('checkUploadne', 'Please choose a file to upload.');
      return false;
    }
  }//end of function
  //save file
  public function saveFiles()
  {
    $reference=$this->Certificate_saveFiles->retrieveReference(); //getting current student reference
    $config['upload_path'] ='./profiles/';
    $config['allowed_types']='pdf';
    $config['max_size']      =2000;
    $file=$_FILES['candidatediploma']['name'];
    $this->form_validation->set_rules('candidatediploma', '', 'callback_checkUploadne');
    if ($this->form_validation->run()==TRUE) {
      $user=$_SESSION['username'];
      $type= pathinfo($_FILES['candidatediploma']['name'], PATHINFO_EXTENSION);
      $config["file_name"] = $reference."_candidatediploma.".$type;
      $file= $reference."_candidatediploma.".$type;
      $this->load->library('upload', $config);
      $checkExisting=$_SERVER['DOCUMENT_ROOT'].'/real/profiles/'.$file;
      if (count($checkExisting)!=0) {
        //delete the file
        @unlink($checkExisting);
      }else {
      }
      $save = $this->upload->do_upload('candidatediploma');
      if ($save==FALSE) {
        $error = array('error_file_upload' => $this->upload->display_errors());
        //get candidate program to know which upload page to direct
        $error = array('error_file_upload' => $this->upload->display_errors());
        $program=$this->SelectPrograms->applicantProgram();
        switch ($program) {
          case '01':
            $this->load->view('views_pages/cert_diploma_program_uploads.php',$error);
            break;
          case '02':
            $this->load->view('views_pages/cert_diploma_program_uploads.php',$error);
            break;
          case '03':
              $this->load->view('views_pages/bachelor_master_program_uploads.php',$error);
              break;
          case '04':
              $this->load->view('views_pages/bachelor_master_program_uploads.php',$error);
              break;
          default:
            $this->load->view('views_pages/home.php');
            break;
        }
      }else {
        $save = $this->upload->data("file_name");
        $data = array('upload_data' => $this->upload->data());
        $field='degree_copy';
        //save the file name in database
        $this->Certificate_saveFiles->cert_files_upload($file,$field);
      }
    } else {
      $program=$this->SelectPrograms->applicantProgram();
      switch ($program) {
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
    }
  }//end of function
  public function studentidentity()
  {
    $config['upload_path'] ='./profiles/';
    $config['allowed_types']='pdf';
    $file=$_FILES['candidatediploma']['name'];
    $this->form_validation->set_rules('candidatediploma', '', 'callback_checkUploadne');
    $this->form_validation->set_rules('studentprogram','Student','required|trim');
    if ($this->form_validation->run()==TRUE) {
      $data=array(
      'registration_no'=>$this->input->post('studentprogram'),
      );
      $reference=$this->TempModels->retrieveReference($data); //getting current student reference
      if ($reference!=false) { //correct reference number
        $type= pathinfo($_FILES['candidatediploma']['name'], PATHINFO_EXTENSION);
        $config["file_name"] = $reference[0]."_candidatediploma.".$type;
        $file= $reference[0]."_candidatediploma.".$type;
        $this->load->library('upload', $config);
        $checkExisting=$_SERVER['DOCUMENT_ROOT'].'/real/profiles/'.$file;
        if (count($checkExisting)!=0) {
          //delete the file
          @unlink($checkExisting);
        }else {
        }
        $save = $this->upload->do_upload('candidatediploma');
        if ($save==FALSE) {
          $error = array('error_file_upload' => $this->upload->display_errors());
          //redirect to uploads page display and correct errors
          $programs=$this->SelectPrograms->university_programs();
  				$branches=$this->SelectPrograms->university_branches();
  				$data=array(
  					'groups'=>$programs,
  					'branches'=>$branches,
            'modules'=>$this->SelectPrograms->university_modules(),
  					'students'=>$this->SelectPrograms->university_students(),
  					'erroruser'=>'Invalid student number, try again'
  				);
          $this->load->view('tempuser/index.php', $data);
        }else {
          $save = $this->upload->data("file_name");
          $data = array('upload_data' => $this->upload->data());
          $field='degree_copy';
          //save the file name in database
          $savefile=$this->TempModels->cert_files_upload($file,$field,$reference[0]);
          if ($savefile!=false) {
            $programs=$this->SelectPrograms->university_programs();
    				$branches=$this->SelectPrograms->university_branches();
    				$data=array(
    					'groups'=>$programs,
    					'branches'=>$branches,
              'modules'=>$this->SelectPrograms->university_modules(),
    					'students'=>$this->SelectPrograms->university_students(),
    					'success'=>'File successfuly uploaded',
    				);
    				$this->load->view('tempuser/index.php', $data);
          }else {
            $programs=$this->SelectPrograms->university_programs();
    				$branches=$this->SelectPrograms->university_branches();
    				$data=array(
    					'groups'=>$programs,
    					'branches'=>$branches,
              'modules'=>$this->SelectPrograms->university_modules(),
    					'students'=>$this->SelectPrograms->university_students(),
    					'erroruser'=>'File upload error. try again',
    				);
    				$this->load->view('tempuser/index.php', $data);
          }
        }
      }else {//error of getting reference
        $programs=$this->SelectPrograms->university_programs();
				$branches=$this->SelectPrograms->university_branches();
				$data=array(
					'groups'=>$programs,
					'branches'=>$branches,
          'modules'=>$this->SelectPrograms->university_modules(),
					'students'=>$this->SelectPrograms->university_students(),
					'erroruser'=>'Invalid student number, try again',
				);
				$this->load->view('tempuser/index.php', $data);
      }
    } else {
      $programs=$this->SelectPrograms->university_programs();
      $branches=$this->SelectPrograms->university_branches();
      $data=array(
        'groups'=>$programs,
        'branches'=>$branches,
        'modules'=>$this->SelectPrograms->university_modules(),
        'students'=>$this->SelectPrograms->university_students(),
      );
      unset($_SESSION['username']);
      $this->load->view('tempuser/index.php',$data);
    }
  }//end of function
}//end of class
?>
