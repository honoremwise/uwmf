<?php
/**
 *
 */
class Certificate_saveFiles extends CI_Model
{
  function __construct()
  {
    parent::__construct();
		$this->load->helper('url');
  }
  public function cert_files_upload($file,$field)
  {
    $data=array(
    $field=>$file,
    );
    //update data in database where username and password match
    //retrieve user and password form session variable
    $user=$this->session->userdata('username');
    $pass=$this->session->userdata('password');
    //update command
    $this->db->where('candidate_email',$user);
    $this->db->where('password',$pass);
    $this->db->update('candidates',$data);
    //get the program code to know which page to load
				$pro=$this->db->query("SELECT program_code FROM candidates WHERE candidate_email LIKE '$user'");
		    foreach ($pro->result() as $row) {
		      $program=$row->program_code;
		    }
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
  //get current applicant reference number
  public function retrieveReference()
  {
    $user=$this->session->userdata('username');
    $pass=$this->session->userdata('password');
    $value=$this->db->query("SELECT reference_no FROM candidates WHERE candidate_email LIKE '$user'");
    foreach ($value->result() as $row) {
      return $row->reference_no;
    }
  }
}
?>
