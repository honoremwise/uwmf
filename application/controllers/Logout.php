<?php
class Logout extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->helper('url');
    $this->load->library('form_validation');
  }
  public function index(){
    $this->session->sess_destroy();
    $data=array('logout' => 'You are logged out', );
    $this->load->view('index.php',$data);
  }
}
 ?>
