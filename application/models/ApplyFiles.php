<?php
/**
 *
 */
class ApplyFiles extends CI_Model
{

  function __construct()
  {
    function __construct()
    {
      parent::__construct();
  		$this->load->helper('url');
    }
  }
  public function masterApplication()
  {
    //check if all required uploads for master and bachelor student have been uploaded
    $user=$_SESSION['username'];
    //select fields
    $query=$this->db->query("SELECT statement_faith,photo,birth_certificate,scanned_id,degree_copy,recomm_letter,motivation_letter,transcript FROM candidates WHERE candidate_email LIKE '$user'");
    foreach ($query->result() as $row) {
      $photo=$row->photo;
      $stat=$row->statement_faith;
      $identity=$row->scanned_id;
      $degree=$row->degree_copy;
      $recomm=$row->recomm_letter;
      $motivation=$row->motivation_letter;
      $report=$row->transcript;
      if ($photo!="" && $stat!="" && $identity!="" && $degree!="" && $recomm!="" && $motivation!="" && $report!="") {
        $this->load->view('bachelor_master/work_experience.php');
      }else {
        $data=array('minimum_upload' => 'You did not submit all required uploads' );
	      $this->load->view('views_pages/bachelor_master_program_uploads.php',$data);
      }
    }
  }
  // for certificate and diploma program
  public function cert_diploma_Application()
  {
    //check if all required uploads for master student have been uploaded
    $user=$_SESSION['username'];
    //select fields
    $query=$this->db->query("SELECT statement_faith,photo,scanned_id,degree_copy,recomm_letter,transcript FROM candidates WHERE candidate_email LIKE '$user'");
    foreach ($query->result() as $row) {
      $photo=$row->photo;
      $identity=$row->scanned_id;
      $degree=$row->degree_copy;
      $recomm=$row->recomm_letter;
      $report=$row->transcript;
      $stat=$row->statement_faith;
      if ($photo!="" && $identity!="" && $degree!="" && $recomm!="" && $report!="" && $stat=!"") {
        $this->load->view('certificate/work_experience.php');
      }else {
        $data=array('minimum_upload' => 'You did not submit all required uploads' );
	      //$this->load->view('views_pages/cert_diploma_program_uploads',$data);
        $this->load->view('views_pages/bachelor_master_program_uploads.php',$data);
      }
    }
  }//end of function
}
 ?>
