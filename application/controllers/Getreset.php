<?php
class Getreset extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->helper('url');
    $this->load->library('form_validation');
    $this->load->model('SelectModels');
    $this->load->model('TempModels');
    $this->load->model('SelectPrograms');
  }
  public function index()
  {
    $this->load->view('tempuser/reset.php');
  }//end of function
}
 ?>
