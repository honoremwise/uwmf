<?php
/**
 *get all programs to display them on the from as a dropdown
 */
class SelectPrograms extends CI_Model
{
  function __construct()
  {
    parent::__construct();
    $this->load->helper('url');
  }
  public function university_programs()
  {
    //sql query
    return $this->db->query('SELECT program_code,program_name FROM programs')->result();
  }
  public function university_branches()
  {
    //run query
    return $this->db->query('SELECT branch_id,branch_code,branch_name FROM branches')->result();
  }
  public function applicantProgram()
  {
    //select program id
    $user=$_SESSION['username'];
    $program=$this->db->query("SELECT program_code FROM candidates WHERE candidate_email LIKE '$user'");
    foreach ($program->result() as $row) {
      return $row->program_code;
    }
  }
  public function university_students()
  {
    return $this->db->query('SELECT registration_no FROM students')->result();
  }
  public function university_modules()
  {
    return $this->db->query('SELECT module_id,module_name,module_code FROM modules')->result();
  }//end of function
  public function applicantreference()
  {
    $user=$_SESSION['username'];
    $ref=$this->db->query("SELECT reference_no FROM candidates WHERE candidate_email LIKE '$user'");
    foreach ($ref->result() as $row) {
      return $row->reference_no;
    }
  }//end of function
}
?>
