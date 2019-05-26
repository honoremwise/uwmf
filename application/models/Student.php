<?php
/**
 *
 */
class Student extends CI_Model
{
  function __construct()
  {
    parent::__construct();
    $this->load->helper('url');
  }
  public function index()
  {
    $this->load->view('user/index.php');
  }
  public function profilepicture($file,$field)
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
    if ($this->db->affected_rows()>0) {
      return true;
    }else {
      return false;
    }
  }//end of function
  public function changefield($field)
  {
    $data=array(
    $field=>"",
    );
    //update data in database where username and password match
    //retrieve user and password form session variable
    $user=$this->session->userdata('username');
    $pass=$this->session->userdata('password');
    //update command
    $this->db->where('candidate_email',$user);
    $this->db->where('password',$pass);
    $this->db->update('candidates',$data);
    if ($this->db->affected_rows()>0) {
      return true;
    }else {
      return false;
    }
  }//end of function
  public function deleteExisting($field,$reference)
  {
    $sql=$this->db->query("SELECT $field FROM candidates WHERE reference_no='$reference'");
    $result=$sql->result();
    foreach ($result as $value) {
      return $value->$field;
    }
  }
}
 ?>
