<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class UserLoginAuthentication extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		// load form helper library
		$this->load->helper('form');
		$this->load->helper('url');
		// load form validation  library
		$this->load->library('form_validation');
		//laod session library
		$this->load->library('session');
		//load database model
		$this->load->Model('SelectModels');
		//show login page
	}
	public function index()
	{
		$this->load->view('index.php');
	}
		//check for user login process
		public function userLoginProcess(){
			//validation of the form inputs
			$this->form_validation->set_rules('Useridname','Email','trim|required');
			$this->form_validation->set_rules('useridPassword','Password','trim|required');
			if ($this->form_validation->run()==FALSE) {
				if (isset($this->session->userdata['username'])) {
					# load a page to next page
					$this->load->view('index.php');
				} else {
					# back to login page
					$this->load->view('index.php');
				}
			} else {
				# process data and check if user exist in database
				$user=$this->input->post('Useridname');
				$pass=$this->input->post('useridPassword');
				//check if user exist in database
				$result=$this->SelectModels->checkLogin($user,$pass);
				//checkLogin is a function in the model called selectModels
				if ($result != FALSE){
					//initialize session
					$this->session->set_userdata('username',$user);
				  $this->session->set_userdata('password',$pass);
					//check if an applicant has became a student
					//get applicant reference number
				 $this->load->model('Certificate_saveFiles');
				 $reference=$this->Certificate_saveFiles->retrieveReference();
				 $condition=array('reference_no'=>$reference);
					//check if an applicant has submitted application
					$value=$this->SelectModels->checkstudent($condition);
					if ($value!=FALSE) {
						$this->session->set_userdata('username',$user);
						$this->load->view('user/index.php');
					}else {//the user is still an applicant or candidate
						//check fro application submission
						$this->load->model('Register');
						$condition=array('reference_no'=>$reference);
						$submit=$this->Register->checkApplications($condition);
						if ($submit!=FALSE) {
						 // get applicant program
						 $program=$this->SelectModels->retrieveprogram();
						 //redirect applicant to submit application page
						 $this->Register->redirectUser($program);
					 }else {
						 // get application forms
						 switch ($result) {
							 case '01':
								//add user data in session
							 //load the model
							 $this->load->Model('SelectPrograms');
							 $data['branches']=$this->SelectPrograms->university_branches();
							 $this->load->view('certificate/application.php',$data);
								 break;
							 case '04':
							 $this->load->Model('SelectPrograms');
							 $data['branches']=$this->SelectPrograms->university_branches();
							 $this->load->view('bachelor_master/application.php',$data);
								 break;
							 case '02':
							//load the model
							$this->load->Model('SelectPrograms');
							$data['branches']=$this->SelectPrograms->university_branches();
							$this->load->view('certificate/application.php',$data);
									 break;
							 case '03':
							 $this->load->Model('SelectPrograms');
							 $data['branches']=$this->SelectPrograms->university_branches();
							 $this->load->view('bachelor_master/application.php',$data);
								 break;
							 default:
								 $this->load->view('index.php',$data);
								 break;
						 }
						 //end of swith statement
					 }
					}
				} else {
					$data=array(
						'messageDisplay'=>'Invalid Username or Password',
					);
					//go back to login page
					$this->load->view('index.php',$data);
				}
			}
		}
}
?>
