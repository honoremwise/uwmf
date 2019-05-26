<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//class definition
class Crt_dpl_experience extends CI_Controller //
{
	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('form_validation');
    $this->load->Model('Certificate_saveFiles');
	}
	public function index()
	{
		if (!isset($_SESSION['username'])) {
			$data=array(
				'error_login'=>'You are logged out',
			);
			$this->load->view('index.php',$data);
		}elseif(isset($_POST['submitMainForm'])){
			$this->LoadData();
		}elseif (isset($_POST['submitFormExperience'])) {
			$this->LoadDataExperience();
		}else {
			$this->load->view('index.php');
		}
	}
	public function LoadData()// only this function will be called when upload has done successful
	{
		// get and validate input data
		$this->form_validation->set_rules('candidatedenomination','Denomination','required|trim');
		$this->form_validation->set_rules('candidatechurch','Name of the Church','required|trim');
		$this->form_validation->set_rules('churchaddress','Address','required|trim');
		$this->form_validation->set_rules('contactPhone','Phone','required|trim|min_length[10]|is_natural');
		$this->form_validation->set_rules('pastorName','Names of the Pastor','required|trim');
		$this->form_validation->set_rules('experiencechurch','Name of the church','required|trim');
		$this->form_validation->set_rules('churchposition','Position Held','required|trim');
		$this->form_validation->set_rules('startdate','Start Date','required|trim');
		$this->form_validation->set_rules('statelocation','State/Province','required|trim');
		$this->form_validation->set_rules('citylocation','City/District','required|trim');
		$this->form_validation->set_rules('workactivities','Responsibities','required|trim|max_length[50]|min_length[10]');
		if ($this->form_validation->run()==FALSE) {
			//return to form page with errors
			$this->load->view('certificate/work_experience.php');
		}else{// get all input data
			$data=array(
				'denomination'=>$this->input->post('candidatedenomination'),
				'church_name'=>$this->input->post('candidatechurch'),
				'church_address'=>$this->input->post('churchaddress'),
				'church_phone'=>$this->input->post('contactPhone'),
				'church_pastor'=>$this->input->post('pastorName'),
				'otherwork_cmp'=>$this->input->post('experiencechurch'),
				'otherwork_position'=>$this->input->post('churchposition'),
				'otherwork_startdate'=>$this->input->post('startdate'),
				'otherwork_province'=>$this->input->post('statelocation'),
        'otherwork_district'=>$this->input->post('citylocation'),
				'church_activities'=>$this->input->post('workactivities'),
			);
      //get reference for the current applicant
      $reference=$this->Certificate_saveFiles->retrieveReference();
      //add value t my data
      $data['reference_no']=$reference;
			// send to the model for database operation
      $this->load->model('Register_certificate_diploma'); // load the model
      $this->Register_certificate_diploma->work_experience($data);
		}
	}//end of function definition
	public function LoadDataExperience()
	{
		$this->form_validation->set_rules('workcompany','','required|trim');
		$this->form_validation->set_rules('workposition','Name of the Church','required|trim');
		$this->form_validation->set_rules('startworkdate','Start Date','required|trim');
		$this->form_validation->set_rules('worklocation','Province','required|alpha');
		$this->form_validation->set_rules('workcitylocation','District','required|alpha');
		$this->form_validation->set_rules('workjobactivities','Responsibities','required|trim|max_length[50]|min_length[10]');
		if ($this->form_validation->run()==FALSE) {
			$this->load->view('bachelor_master/job_work_experience.php');
		}else {
			$data=array(
				'realwork_cmp'=>$this->input->post('workcompany'),
				'realwork_pos'=>$this->input->post('workposition'),
				'realwork_start'=>$this->input->post('startworkdate'),
				'realwork_pro'=>$this->input->post('worklocation'),
				'realwork_dist'=>$this->input->post('workcitylocation'),
				'work_activities'=>$this->input->post('workjobactivities'),
			);
			$reference=$this->Certificate_saveFiles->retrieveReference();
      //add value to my data
      $data['reference_no']=$reference;
			$this->load->model('Register_certificate_diploma'); // load the model
      $this->Register_certificate_diploma->job_experience($data);
		}
	}//end of function definition
}
?>
