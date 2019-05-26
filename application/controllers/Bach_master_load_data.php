<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//class definition
class Bach_master_load_data extends CI_Controller //
{
	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('form_validation');
	}
	public function index()
	{
		if (!isset($_SESSION['username'])) {
			$data=array(
				'error_login'=>'Invalid Session Try again',
			);
			$this->load->view('index.php',$data);
		}else{
			$this->LoadData();
		}
	}
	public function LoadData()// only this function will be called when upload has done successful
	{
		// get and validate input data
		$this->form_validation->set_rules('CandidateFname','Firstname','required|trim');
		$this->form_validation->set_rules('CandidateLname','Lastname','required|trim');
		$this->form_validation->set_rules('CandidateNative','Native language(s)','required|trim');
		$this->form_validation->set_rules('candidateaddress','Current Address','required|trim');
		$this->form_validation->set_rules('Candidateenglish','Level of English','required|trim');
		//$this->form_validation->set_rules('Candidatestudy','Previous Level','required');
		$this->form_validation->set_rules('candidatemajor','Mojor Field','required|trim');
		$this->form_validation->set_rules('candidategraduation','Date graduated','required|trim');
		$this->form_validation->set_rules('candidateschool','School name','required|trim');
		$this->form_validation->set_rules('candidatelocation','Location','required|trim');
		$this->form_validation->set_rules('Candidatebranch','','required|trim');
		$this->form_validation->set_rules('Candidatestudy','Previous Level','required|trim');

		//$this->form_validation->set_rules('Candidateenglish','Level of English','required');
		$this->form_validation->set_rules('CandidatePhone','Telephone','required|min_length[10]|is_natural|trim');
		$this->form_validation->set_rules('CandidateIDnumber','ID number/Passport','required|min_length[4]|alpha_numeric|trim');
		$this->form_validation->set_rules('CandidateBirthDate','Date of birth','required|trim');
		$this->form_validation->set_rules('CandidateNationality','Nationality','required|alpha|trim');
		$this->form_validation->set_rules('CandidateProvince','Address(Province)','required|trim|alpha');
		$this->form_validation->set_rules('CandidateDistrict','District of Birth','required|alpha');
		$this->form_validation->set_rules('Candidatebranch','Choose University branch','required');
		$this->form_validation->set_rules('CandidateNative','Native language','required|alpha|trim');
		$this->form_validation->set_rules('CandidateGender','Gender','required|alpha');
		$this->form_validation->set_rules('Candidatestudy','Previous Level','required|trim');
		$this->form_validation->set_rules('CandidatePhone','Telephone','required|min_length[10]|is_natural|trim');
		$this->form_validation->set_rules('studydegree','Degree Awarded','required|trim');
		if ($this->form_validation->run()==FALSE) {
			//return to form page with errors
			$this->load->Model('SelectPrograms');
			$data['branches']=$this->SelectPrograms->university_branches();
			$this->load->view('bachelor_master/application.php',$data);
		}else{// get all input data

			$data=array(
				'college_location'=>$this->input->post('candidatelocation'),
				'date_graduated'=>$this->input->post('candidategraduation'),
				'current_address'=>$this->input->post('candidateaddress'),
				'previous_subject'=>$this->input->post('candidatemajor'),
				'college_name'=>$this->input->post('candidateschool'),
				'english_proficiency'=>$this->input->post('Candidateenglish'),
				'first_name'=>$this->input->post('CandidateFname'),
				'last_name'=>$this->input->post('CandidateLname'),
				'candidate_telephone'=>$this->input->post('CandidatePhone'),
				'id_passport'=>$this->input->post('CandidateIDnumber'),
				'dob'=>$this->input->post('CandidateBirthDate'),
				'nationality'=>$this->input->post('CandidateNationality'),
				'address_province'=>$this->input->post('CandidateProvince'),
				'address_district'=>$this->input->post('CandidateDistrict'),
				'branch_code'=>$this->input->post('Candidatebranch'),
				'native_language'=>$this->input->post('CandidateNative'),
				'education_background'=>$this->input->post('Candidatestudy'),
				'gender'=>$this->input->post('CandidateGender'),
				'highest_degree'=>$this->input->post('studydegree'),
				'year_registered'=>date('Y-m-d'),
			);
			// send to the model for database operation
			//check if the session is valid
			if (isset($_SESSION['username'])) {
				$user=$_SESSION['username'];
				$this->load->model('Register_certificate_diploma'); // load the model
				$this->Register_certificate_diploma->registerBasicData($data);
			} else {
				$data=array(
					'error_login'=>'Invalid Session Try again',
				);
				$this->load->view('index.php',$data);
			}
		}
	}
}
?>
