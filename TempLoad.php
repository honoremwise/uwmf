<?php
//load send mail class files
use PHPMailer\PHPMailer\PHPMailer;
require_once(APPPATH.'views/mails/vendor/autoload.php');
require_once(APPPATH.'views/mails/mail.php');
/**
 * Only this controller is for user to register existing students who were not applied using system
 */
class TempLoad extends CI_Controller
{
	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('form_validation');
		$this->load->Model('SelectPrograms');
		$this->load->Model('TempModels');
	}
	function index(){
		if (isset($_SESSION['validuser'])) {
			$this->load->view('tempuser/home.php');
		}else {
			$this->load->view('tempuser/home.php');
		}
	}
	function experience(){
		$this->form_validation->set_rules('candidatenumber', 'Student number','trim|required');
		$this->form_validation->set_rules('workcompany','Company name','required|trim');
		$this->form_validation->set_rules('workposition','Position','required|trim');
		$this->form_validation->set_rules('startworkdate','Start Date','required|trim');
		$this->form_validation->set_rules('worklocation','State/Province','required|trim|alpha');
		$this->form_validation->set_rules('workcitylocation','City/District','required|trim|alpha');
		if ($this->form_validation->run()==FALSE) {
			$branches=$this->SelectPrograms->university_branches();
			$programs = $this->SelectPrograms->university_programs();
			$data=array(
				'groups'=>$programs,
				'branches'=>$branches,
				'modules'=>$this->SelectPrograms->university_modules(),
				'students'=>$this->SelectPrograms->university_students(),
			);
			$this->load->view('tempuser/index.php',$data);
		}else {
			$data=array(
				'realwork_cmp'=>$this->input->post('workcompany'),
				'realwork_pos'=>$this->input->post('workposition'),
				'realwork_start'=>$this->input->post('startworkdate'),
				'realwork_pro'=>$this->input->post('worklocation'),
				'realwork_dist'=>$this->input->post('workcitylocation'),
			);
			$regno=array(
				'registration_no'=>$this->input->post('candidatenumber'),
			);
			$reference=$this->TempModels->retrieveReference($regno); //retrieve a reference number
			if ($reference!=false) {
				$data['reference_no']=$reference[0];
				$this->load->model('register_certificate_diploma'); // load the model
	      $save=$this->TempModels->job_experience($data);
				if ($save!=false) {
					$year=$reference[1];
					//activate student learning status
					$data=array('registration_no'=>$regno['registration_no'],
					'status_date'=>$year,
				);
				$status=$this->TempModels->learningStatus($data);
				if ($status!=false) {
					$branches=$this->SelectPrograms->university_branches();
					$programs = $this->SelectPrograms->university_programs();
					$data=array(
					  'groups'=>$programs,
					  'branches'=>$branches,
					  'modules'=>$this->SelectPrograms->university_modules(),
					  'students'=>$this->SelectPrograms->university_students(),
					  'success'=>'Record saved, contiue with step 5',
					);
					$this->load->view('tempuser/index.php',$data);
				}else {
					$programs=$this->SelectPrograms->university_programs();
					$branches=$this->SelectPrograms->university_branches();
					$data=array(
						'groups'=>$programs,
						'branches'=>$branches,
						'modules'=>$this->SelectPrograms->university_modules(),
						'students'=>$this->SelectPrograms->university_students(),
						'erroruser'=>'An error occured, try again',
					);
					$this->load->view('tempuser/index.php', $data);
				}
				}else {
					$programs=$this->SelectPrograms->university_programs();
					$branches=$this->SelectPrograms->university_branches();
					$data=array(
						'groups'=>$programs,
						'branches'=>$branches,
						'modules'=>$this->SelectPrograms->university_modules(),
						'students'=>$this->SelectPrograms->university_students(),
						'erroruser'=>'An error occured, try again',
					);
					$this->load->view('tempuser/index.php', $data);
				}
			}else {
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
			}
		}
	}//end of the function
	public function review(){
		if(isset($_SESSION['validuser'])){
			$this->form_validation->set_rules('searchitem', 'Search','trim|required');
			if ($this->form_validation->run()==FALSE || !isset($_SESSION['validuser'])) {
				$programs=$this->SelectPrograms->university_programs();
				$branches=$this->SelectPrograms->university_branches();
				$data=array(
					'groups'=>$programs,
					'branches'=>$branches,
					'modules'=>$this->SelectPrograms->university_modules(),
					'students'=>$this->SelectPrograms->university_students(),
					);
				 $this->load->view('tempuser/index.php',$data);
			}else {
				//get the reference number and the email for the student
				$std=$this->input->post('searchitem');
				$email=$this->TempModels->getuser($std);
				if ($email!=false) {
					$this->session->set_userdata('username',$email);
					$this->session->set_userdata('registration',$std);
					$programs=$this->SelectPrograms->university_programs();
					$branches=$this->SelectPrograms->university_branches();
					$data=array(
						'groups'=>$programs,
						'branches'=>$branches,
						'modules'=>$this->SelectPrograms->university_modules(),
						'students'=>$this->SelectPrograms->university_students(),
						'validsearch'=>true,
					);
					$this->load->view('tempuser/index.php',$data);
				}else {
					$data=array(
						'groups'=>$this->SelectPrograms->university_programs(),
						'branches'=>$this->SelectPrograms->university_branches(),
						'modules'=>$this->SelectPrograms->university_modules(),
						'students'=>$this->SelectPrograms->university_students(),
						'recorderror'=>'Student not found',
					);
					unset($_SESSION['registration']);
					unset($_SESSION['username']);
					$std=date('Y');
					//$this->session->set_userdata('registration',$std);
					$this->load->view('tempuser/index.php',$data);
				}
			}
		}else {
			$data=array('logout' => 'You are logged out', );
	    $this->load->view('tempuser/home.php',$data);
		}
	}
	public function logout(){
    unset($_SESSION['validuser']);
		unset($_SESSION['student']);
    $data=array('logout' => 'You are logged out', );
    $this->load->view('tempuser/home.php',$data);
  }
	public function addexperience(){
		// get and validate input data
		$this->form_validation->set_rules('candidatenumber', 'Student number','trim|required');
		$this->form_validation->set_rules('CandidateEmail', 'Email','trim|required|valid_email');
		$this->form_validation->set_rules('candidatedenomination','Denomination','required|trim');
		$this->form_validation->set_rules('candidatechurch','Name of the Church','required|trim');
		$this->form_validation->set_rules('churchaddress','Address','required|trim');
		$this->form_validation->set_rules('contactPhone','Phone','required|trim|min_length[10]|is_natural');
		$this->form_validation->set_rules('pastorName','Names of the Pastor','required|trim');
		$this->form_validation->set_rules('experiencechurch','Name of the church','required|trim');
		$this->form_validation->set_rules('churchposition','Position Held','required|trim');
		$this->form_validation->set_rules('startdate','Start Date','required|trim');
		$this->form_validation->set_rules('statelocation','State/Province','required|trim|trim');
		$this->form_validation->set_rules('citylocation','City/District','required|trim');
		if ($this->form_validation->run()==FALSE) {
			//return to form page with errors
			$data=array(
				'groups'=>$this->SelectPrograms->university_programs(),
				'branches'=>$this->SelectPrograms->university_branches(),
				'modules'=>$this->SelectPrograms->university_modules(),
				'students'=>$this->SelectPrograms->university_students(),
			);
			$this->load->view('tempuser/index.php',$data);
		}else{// get all input data
			$data=array(
				'studentnumber'=>$this->input->post('candidatenumber'),
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
			);
      //get reference for the current applicant using his/her email
			$regno=array(
				'registration_no'=>$this->input->post('candidatenumber'),
			);
      $reference=$this->TempModels->retrieveReference($regno);
      //add value to my data
			if ($reference!=false) {
				$data['reference_no']=$reference[0];
				$save=$this->TempModels->work_experience($data);
				if ($save!=false) {
					$branches=$this->SelectPrograms->university_branches();
					$programs = $this->SelectPrograms->university_programs();
					$data=array(
						'groups'=>$programs,
						'branches'=>$branches,
						'modules'=>$this->SelectPrograms->university_modules(),
						'students'=>$this->SelectPrograms->university_students(),
						'success'=>'Record saved, contiue with step 4',
					);
					$this->load->view('tempuser/index.php',$data);
				}else {
					$programs=$this->SelectPrograms->university_programs();
					$branches=$this->SelectPrograms->university_branches();
					$data=array(
						'groups'=>$programs,
						'branches'=>$branches,
						'modules'=>$this->SelectPrograms->university_modules(),
						'students'=>$this->SelectPrograms->university_students(),
						'erroruser'=>'An error occured, try again',
					);
					$this->load->view('tempuser/index.php', $data);
				}
			}else {
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
			}
		}
	}//end of function definition

	public function registerData()// register personal data
	{
		// get and validate input data
		$this->form_validation->set_rules('candidatenumber', 'Student number','trim|required');
		$this->form_validation->set_rules('CandidateFname','Firstname','required|trim');
		$this->form_validation->set_rules('CandidateLname','Lastname','required|trim');
		$this->form_validation->set_rules('CandidateNative','Native language(s)','required');
		$this->form_validation->set_rules('candidateaddress','Current Address','required|trim');
		$this->form_validation->set_rules('Candidateenglish','Level of English','required|trim');
		//$this->form_validation->set_rules('Candidatestudy','Previous Level','required');
		$this->form_validation->set_rules('candidatemajor','Mojor Field','required');
		$this->form_validation->set_rules('candidategraduation','Date graduated','required');
		$this->form_validation->set_rules('candidateschool','School name','required|trim');
		$this->form_validation->set_rules('candidatelocation','Location','required|trim');
		$this->form_validation->set_rules('Candidatebranch','','required');
		$this->form_validation->set_rules('Candidatestudy','Previous Level','required');

		//$this->form_validation->set_rules('Candidateenglish','Level of English','required');
		$this->form_validation->set_rules('CandidatePhone','Telephone','required|min_length[10]|is_natural');
		$this->form_validation->set_rules('CandidateIDnumber','ID number/Passport','required|min_length[5]|alpha_numeric');
		$this->form_validation->set_rules('CandidateBirthDate','Date of birth','required');
		$this->form_validation->set_rules('CandidateNationality','Nationality','required|alpha');
		$this->form_validation->set_rules('CandidateProvince','Address(Province)','required');
		$this->form_validation->set_rules('CandidateDistrict','District of Birth','required|alpha');
		$this->form_validation->set_rules('Candidatebranch','Choose University branch','required');
		$this->form_validation->set_rules('CandidateNative','Native language','required|alpha');
		$this->form_validation->set_rules('CandidateGender','Gender','required');
		$this->form_validation->set_rules('Candidatestudy','Previous Level','required');
		$this->form_validation->set_rules('CandidatePhone','Telephone','required|min_length[10]|is_natural');
		$this->form_validation->set_rules('studydegree','Degree Awarded','required');
		$this->form_validation->set_rules('CandidateEmail', 'Email','trim|required|valid_email');
		if ($this->form_validation->run()==FALSE) {
			//return to form page with errors
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
		}else{// get all input data

			$data=array(
				'candidate_email'=>$this->input->post('CandidateEmail'),
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
			);
			// send to the model for database operation
			//check if the session is valid
			if (isset($_SESSION['validuser'])) {
				//add student number to session
				$regno=$this->input->post('candidatenumber');
				$this->session->set_userdata('student',$regno);
				$this->load->model('TempModels'); // load the model
				$save=$this->TempModels->registerBasicData($data);
				if ($save!=FALSE) {//make a candidate a student
					$reference=$save[0];
					$program=$save[1];
					$branchid=$save[2];
					$year=$save[3];
					//get branch code based on id
					$branchcode=$this->TempModels->getbranchcode($branchid);
					//format year applied
					$yearuse=substr($year,2,2);
					//now form a registration number
					$studentnumber=$branchcode.$yearuse.$program;
					$data=array(
						'reference_no'=>$reference,
						'year_registered'=>$year,
						'registration'=>$studentnumber,
					);
					//now save the year and reference number in student to know how many student in the year of application and give student number
					$newstudent=$this->TempModels->saveStudent($data);
					if ($newstudent!=FALSE) {
						//save student default password
						$password=date('Y-m-d').$newstudent[1];
						$reference=$newstudent[0];
						$save=$this->TempModels->savePassword($password,$reference);
						if ($save!=false) {
							$branches=$this->SelectPrograms->university_branches();
							$programs = $this->SelectPrograms->university_programs();
							$data=array(
								'groups'=>$programs,
								'branches'=>$branches,
								'modules'=>$this->SelectPrograms->university_modules(),
								'students'=>$this->SelectPrograms->university_students(),
								'success'=>'Record saved, contiue with step 3',
							);
							unset($_SESSION['username']);
							$this->load->view('tempuser/index.php',$data);
						}else {
							$programs=$this->SelectPrograms->university_programs();
							$branches=$this->SelectPrograms->university_branches();
							$data=array(
								'groups'=>$programs,
								'branches'=>$branches,
								'modules'=>$this->SelectPrograms->university_modules(),
								'students'=>$this->SelectPrograms->university_students(),
								'erroruser'=>'An error occured, Please try again'
							);
							unset($_SESSION['username']);
							$this->load->view('tempuser/index.php', $data);
						}
					}else {//some errors of giving student number
						$programs=$this->SelectPrograms->university_programs();
						$branches=$this->SelectPrograms->university_branches();
						$data=array(
							'groups'=>$programs,
							'branches'=>$branches,
							'modules'=>$this->SelectPrograms->university_modules(),
							'students'=>$this->SelectPrograms->university_students(),
							'erroruser'=>'Student number error occured, Please try again'
						);
						unset($_SESSION['username']);
						$this->load->view('tempuser/index.php', $data);
					}
				}else {
					$programs=$this->SelectPrograms->university_programs();
					$branches=$this->SelectPrograms->university_branches();
					$data=array(
						'groups'=>$programs,
						'branches'=>$branches,
						'modules'=>$this->SelectPrograms->university_modules(),
						'students'=>$this->SelectPrograms->university_students(),
						'erroruser'=>'An error occured, Please try again to save personal data'
					);
					unset($_SESSION['username']);
					$this->load->view('tempuser/index.php', $data);
				}
			} else {
				$data=array(
					'error_login'=>'Invalid Session Try again',
				);
				$this->load->view('tempuser/home.php',$data);
			}
		}
	}//end of the function
	public function RegisterMainData()
	{
		$this->form_validation->set_rules('CandidateEmail', 'Email','trim|required|valid_email');
	  $this->form_validation->set_rules('CandidateEmailConfirm', 'Confirm Email', 'trim|required|valid_email|matches[CandidateEmail]');
	  $this->form_validation->set_rules('CandidateFname','Firstname','required|trim');
	  $this->form_validation->set_rules('CandidateLname','Lastname','required|trim');
	  $this->form_validation->set_rules('program','Program applying for','required');
	  $this->form_validation->set_rules('CandidateDate','Date of application','required');
		if ($this->form_validation->run()==FALSE) {
			$this->load->Model('SelectPrograms');
	    $programs=$this->SelectPrograms->university_programs();
	    $branches=$this->SelectPrograms->university_branches();
	    $data=array(
	      'groups'=>$programs,
	      'branches'=>$branches,
	      'modules'=>$this->SelectPrograms->university_modules(),
	      'students'=>$this->SelectPrograms->university_students(),
	    );
	    $this->load->view('tempuser/index.php', $data);
		}else {
			$firstname=$this->input->post('CandidateFname');
	    $lastname=$this->input->post('CandidateLname');
	    $email=$this->input->post('CandidateEmail');
	    $programcode=$this->input->post('program');
	    $date=$this->input->post('CandidateDate');
			//check if no email as the input previously saved
			$condition=array('candidate_email'=>$email);
			$this->load->model('SelectModels');
			$check=$this->SelectModels->checkuseremail($condition);
			if ($check!=false) {
				$data=array(
					'first_name'=>$firstname,
					'last_name'=>$lastname,
					'candidate_email'=>$email,
					 'program_code'=>$programcode,
					'year_registered'=>$date,
				);
				$results=$this->TempModels->registerNew($data);
				if ($results!=false) {
					$ref=$results[0];
          $prog=$results[1];
          //submit application call function
          $this->SubmitApplication($ref,$prog,$date);
				}else {
					$data=array('erroruser'=>'An error occured, Please try again',
					'groups'=>$programs,
					'branches'=>$branches,
					'modules'=>$this->SelectPrograms->university_modules(),
					'students'=>$this->SelectPrograms->university_students(),
				);
					$this->load->view('tempuser/index.php',$data);
				}
			}else {
				$this->load->model('selectPrograms');
				$branches=$this->SelectPrograms->university_branches();
				$programs = $this->SelectPrograms->university_programs();
				$data=array(
					'erroruser'=>'User of the same email already exists, please enter valid candidate email or contiue with step 2',
					'groups'=>$programs,
					'branches'=>$branches,
					'modules'=>$this->SelectPrograms->university_modules(),
					'students'=>$this->SelectPrograms->university_students(),
				);
				$this->load->view('tempuser/index.php',$data);
			}
		}
	}//end of function
	public function submitApplication($reference,$program,$year)
  {
    // check if session is valid
    if (!empty($reference) && !empty($program) && !empty($year)){
      //submit application
			$reference=$reference;
      $data=array('reference_no' => $reference,
      'program_code'=>$program,
      'year_last_application'=>$year,
       'number_of_application'=>1,
			 'application_status'=>'Approved',
      );
      $this->load->model('tempModels');
      $submit=$this->TempModels->saveApplication($data);
			if (!empty($submit)) {
				$programs=$this->SelectPrograms->university_programs();
				$branches=$this->SelectPrograms->university_branches();
				$data=array(
					'groups'=>$programs,
					'branches'=>$branches,
					'modules'=>$this->SelectPrograms->university_modules(),
					'students'=>$this->SelectPrograms->university_students(),
					'success'=>"Account created, contiue step 2",
				);
				$this->load->view('tempuser/index.php',$data);
			}
    }else {
			$data=array('erroruser'=>'An error occured, Please try again');
			$this->load->view('tempuser/index.php',$data);
    }
  }//end of function
	public function personaldata()
	{
		$this->form_validation->set_rules('custidreference', '','trim|required');
		$this->form_validation->set_rules('CandidateFname','Firstname','required');
		$this->form_validation->set_rules('CandidateLname','Lastname','required');
		$this->form_validation->set_rules('CandidateNative','Native language(s)','required');
		$this->form_validation->set_rules('candidateaddress','Current Address','required|trim');
		$this->form_validation->set_rules('Candidateenglish','Level of English','required|trim');

		$this->form_validation->set_rules('CandidatePhone','Telephone','required|min_length[10]|is_natural');
		$this->form_validation->set_rules('CandidateIDnumber','ID number/Passport','required|min_length[5]|alpha_numeric');
		$this->form_validation->set_rules('CandidateBirthDate','Date of birth','required');
		$this->form_validation->set_rules('CandidateNationality','Nationality','required');
		$this->form_validation->set_rules('CandidateProvince','Address(Province)','required');
		$this->form_validation->set_rules('CandidateDistrict','District of Birth','required');
		$this->form_validation->set_rules('CandidateGender','Gender','required');
		$this->form_validation->set_rules('CandidatePhone','Telephone','required|min_length[10]|is_natural');
		if ($this->form_validation->run()==FALSE) {
			$this->load->Model('SelectPrograms');
			$programs=$this->SelectPrograms->university_programs();
			$branches=$this->SelectPrograms->university_branches();
			$data=array(
				'groups'=>$programs,
				'branches'=>$branches,
				'modules'=>$this->SelectPrograms->university_modules(),
				'students'=>$this->SelectPrograms->university_students(),
			);
			$this->load->view('tempuser/index.php', $data);
		}else {//update record
			$reference=$this->input->post('custidreference');
			$first=$this->input->post('CandidateFname');
			$last=$this->input->post('CandidateLname');
			$tel=$this->input->post('CandidatePhone');
			$idnumber=$this->input->post('CandidateIDnumber');
			$date=$this->input->post('CandidateBirthDate');
			$gender=$this->input->post('CandidateGender');
			$nat=$this->input->post('CandidateNationality');
			$pro=$this->input->post('CandidateProvince');
			$dist=$this->input->post('CandidateDistrict');
			$addr=$this->input->post('candidateaddress');
			$engl=$this->input->post('Candidateenglish');
			$native=$this->input->post('CandidateNative');
			//run update
			$data=array('first_name' => $first,
			'last_name'=>$last,
			'candidate_telephone'=>$tel,
			'id_passport'=>$idnumber,
			'dob'=>$date,
			'gender'=>$gender,
			 'native_language'=>$native,
			 'address_province'=>$pro,
			 'address_district'=>$dist,
			 'current_address'=>$addr,
			 'english_proficiency'=>$engl,
			 'nationality'=>$nat,
			 'reference_no'=>$reference,
		);
		$update=$this->TempModels->updateData($data);
		if ($update!=FALSE) {
			$data=array(
				'groups'=>$this->SelectPrograms->university_programs(),
				'branches'=>$this->SelectPrograms->university_branches(),
				'modules'=>$this->SelectPrograms->university_modules(),
				'students'=>$this->SelectPrograms->university_students(),
				'success'=>'Record updated',
			);
			$this->load->view('tempuser/index.php', $data);
		}else {
			$data=array(
				'groups'=>$this->SelectPrograms->university_programs(),
				'branches'=>$this->SelectPrograms->university_branches(),
				'students'=>$this->SelectPrograms->university_students(),
				'modules'=>$this->SelectPrograms->university_modules(),
				'erroruser'=>'Update error occured try again',
			);
			$this->load->view('tempuser/index.php', $data);
		}
		}
	}//end of the function
	public function getreference()
	{
		// get submited data
		$this->form_validation->set_rules('candidatenumberid','Student number','required');
		$this->form_validation->set_rules('studentnumberid','New student number','required');
		if ($this->form_validation->run()!=FALSE) {
			$regno=$this->input->post('candidatenumberid');
			$newregno=$this->input->post('studentnumberid');
			$update=$this->TempModels->updatenumber($regno,$newregno);
			if ($update==true) {
				$data=array(
					'groups'=>$this->SelectPrograms->university_programs(),
					'branches'=>$this->SelectPrograms->university_branches(),
					'students'=>$this->SelectPrograms->university_students(),
					'modules'=>$this->SelectPrograms->university_modules(),
					'success'=>'Record updated',
				);
				$this->load->view('tempuser/index.php', $data);
			}else {
				$data=array(
					'groups'=>$this->SelectPrograms->university_programs(),
					'branches'=>$this->SelectPrograms->university_branches(),
					'students'=>$this->SelectPrograms->university_students(),
					'modules'=>$this->SelectPrograms->university_modules(),
					'erroruser'=>'Update error occured try again',
				);
				$this->load->view('tempuser/index.php', $data);
			}
		}else {
			$data=array(
				'groups'=>$this->SelectPrograms->university_programs(),
				'branches'=>$this->SelectPrograms->university_branches(),
				'modules'=>$this->SelectPrograms->university_modules(),
				'students'=>$this->SelectPrograms->university_students(),
			);
			$this->load->view('tempuser/index.php', $data);
		}
	}//end of function
	public function send()//all necessary data have been given it's time to send an email
	{
		// check if session is valid for current user
		if (!isset($_SESSION['validuser'])) {
			$data=array('logout' => 'You are logged out',);
	    $this->load->view('tempuser/home.php',$data);
		}else{
			// validate input
			$this->form_validation->set_rules('emailid','Email address','required');
			$this->form_validation->set_rules('studentidentity','Student number','required');
			if ($this->form_validation->run()==FALSE) {
				// form validation errors
				$data=array(
					'groups'=>$this->SelectPrograms->university_programs(),
					'branches'=>$this->SelectPrograms->university_branches(),
					'modules'=>$this->SelectPrograms->university_modules(),
					'students'=>$this->SelectPrograms->university_students(),
				);
				$this->load->view('tempuser/index.php', $data);
			} else {
				// check all saved data and send an email
				$student=$this->input->post('studentidentity');
				$check=$this->TempModels->checkData($student);
				if ($check!=false) {
					$registration=$check[0];
					$password=$check[1];
					$email=$check[2];
					//$message = $this->load->view('tempuser/sendaccount.php', '', TRUE);
					//This is php data {$password}</span></body></html>
					$message='
					<html><body style="text-align:justify">
					<p>Dear Student, the following are user credentials to access University of World Mission Frontier
					online Student Management System
			    accessible on <a href="uwmf-ac.org">Login Here</a></p>
					<p>Note that you are advised to change it once you have logged to the system, Use the email that you have used
					when you applied to University of World Mission and the following Password
					</p>
					<strong>System Password is '.$password.' </strong>that your are strongly advised to change  when you first login to the system.</p>
					</body>
					</html>
					';
		      //send student account message email
		      $to=$email;
		      $this->senddata($to,"UWMF-MIS-Administrator/Student Account Confirmation", $message);
					//check if email has been sent Successfully and direct the user with sendnotified function
				} else {//when record of student not found
					$data=array(
						'groups'=>$this->SelectPrograms->university_programs(),
						'branches'=>$this->SelectPrograms->university_branches(),
						'modules'=>$this->SelectPrograms->university_modules(),
						'students'=>$this->SelectPrograms->university_students(),
						'erroruser'=>'Student record not compeleted, record and try again',
					);
					$this->load->view('tempuser/index.php', $data);
				}
			}
		}
	}//end of function

	public function churchdata()
	{
		$this->form_validation->set_rules('candidatedenomination','Denomination','required|trim');
		$this->form_validation->set_rules('candidatechurch','Name of the Church','required|trim');
		$this->form_validation->set_rules('churchaddress','Address','required|trim');
		$this->form_validation->set_rules('contactPhone','Phone','required|trim|min_length[10]|is_natural');
		$this->form_validation->set_rules('pastorName','Names of the Pastor','required|trim');
		$this->form_validation->set_rules('custidreference', '','trim|required');
		if ($this->form_validation->run()==TRUE) {
			//run update
			$data = array(
				'denomination'=>$this->input->post('candidatedenomination'),
				'church_name'=>$this->input->post('candidatechurch'),
				'church_address'=>$this->input->post('churchaddress'),
				'church_phone'=>$this->input->post('contactPhone'),
				'church_pastor'=>$this->input->post('pastorName'),
		);
		$reference=$this->input->post('custidreference');//run update here
		$run=$this->TempModels->churchdata($data,$reference);
		if ($run!=FALSE) {
			$data=array(
				'groups'=>$this->SelectPrograms->university_programs(),
				'branches'=>$this->SelectPrograms->university_branches(),
				'modules'=>$this->SelectPrograms->university_modules(),
				'students'=>$this->SelectPrograms->university_students(),
				'success'=>'Record updated',
			);
			$this->load->view('tempuser/index.php', $data);
		}else {
			$data=array(
				'groups'=>$this->SelectPrograms->university_programs(),
				'branches'=>$this->SelectPrograms->university_branches(),
				'students'=>$this->SelectPrograms->university_students(),
				'modules'=>$this->SelectPrograms->university_modules(),
				'erroruser'=>'Update error occured try again',
			);
			$this->load->view('tempuser/index.php', $data);
		}
		}else {
			$data=array(
				'groups'=>$this->SelectPrograms->university_programs(),
				'branches'=>$this->SelectPrograms->university_branches(),
				'modules'=>$this->SelectPrograms->university_modules(),
				'students'=>$this->SelectPrograms->university_students(),
			);
			$this->load->view('tempuser/index.php', $data);
		}
	}//end of function
	public function churchexperience()
	{//validate form
		$this->form_validation->set_rules('experiencechurch','Name of the church','required|trim');
		$this->form_validation->set_rules('churchposition','Position Held','required|trim');
		$this->form_validation->set_rules('startdate','Start Date','required|trim');
		$this->form_validation->set_rules('statelocation','State/Province','required|trim|trim');
		$this->form_validation->set_rules('citylocation','City/District','required|trim');
		$this->form_validation->set_rules('custidreference', '','trim|required');
		if ($this->form_validation->run()==FALSE) {
			$data=array(
				'groups'=>$this->SelectPrograms->university_programs(),
				'branches'=>$this->SelectPrograms->university_branches(),
				'students'=>$this->SelectPrograms->university_students(),
				'modules'=>$this->SelectPrograms->university_modules(),
			);
			$this->load->view('tempuser/index.php', $data);
		}else {
			//run update
			$data = array(
				'otherwork_cmp'=>$this->input->post('experiencechurch'),
				'otherwork_position'=>$this->input->post('churchposition'),
				'otherwork_startdate'=>$this->input->post('startdate'),
				'otherwork_province'=>$this->input->post('statelocation'),
				'otherwork_district'=>$this->input->post('citylocation'),
			);
			$reference=$this->input->post('custidreference');
			$run=$this->TempModels->churchdata($data,$reference);
			if ($run!=FALSE) {
				$data=array(
					'groups'=>$this->SelectPrograms->university_programs(),
					'branches'=>$this->SelectPrograms->university_branches(),
					'modules'=>$this->SelectPrograms->university_modules(),
					'students'=>$this->SelectPrograms->university_students(),
					'success'=>'Record updated',
				);
				$this->load->view('tempuser/index.php', $data);
			}else {
				$data=array(
					'groups'=>$this->SelectPrograms->university_programs(),
					'branches'=>$this->SelectPrograms->university_branches(),
					'students'=>$this->SelectPrograms->university_students(),
					'modules'=>$this->SelectPrograms->university_modules(),
					'erroruser'=>'Update error occured try again',
				);
				$this->load->view('tempuser/index.php', $data);
			}
		}
	}//end of function
	public function updateacademic()
	{
		if (isset($_SESSION['validuser'])) {
			//get submitted data
			$branch=$this->input->post('branchesid');
			$brlocation=$this->input->post('branchlocationid');
			$registid=$this->input->post('dateappliedid');
			$studylevel=$this->input->post('studyidlevel');
			$fieldstudy=$this->input->post('studyfieldid');
			$graduatedate=$this->input->post('graduatedateid');
			$college=$this->input->post('collegeid');
			$collegelocation=$this->input->post('collegeidlocation');
			$degree=$this->input->post('degreetypeid');
			//get reference_no
			$reference=$this->input->post('custidreference');
			$data=array(
				'branch_code' => $branch,
				'year_registered'=>$registid,
				'highest_degree'=>$degree,
				'previous_subject'=>$fieldstudy,
				'date_graduated'=>$graduatedate,
				'college_name'=>$college,
				'college_location'=>$collegelocation,
				'education_background'=>$studylevel,
			);
			//save data
			$run=$this->TempModels->academicrecord($data,$reference);
			if ($run!=FALSE) {
				$data=array(
					'groups'=>$this->SelectPrograms->university_programs(),
					'branches'=>$this->SelectPrograms->university_branches(),
					'modules'=>$this->SelectPrograms->university_modules(),
					'students'=>$this->SelectPrograms->university_students(),
					'success'=>'Record updated',
				);
				$this->load->view('tempuser/index.php', $data);
			}else {
				$data=array(
					'groups'=>$this->SelectPrograms->university_programs(),
					'branches'=>$this->SelectPrograms->university_branches(),
					'students'=>$this->SelectPrograms->university_students(),
					'modules'=>$this->SelectPrograms->university_modules(),
					'erroruser'=>'Update error occured try again',
				);
				$this->load->view('tempuser/index.php', $data);
			}
			//
		} else {
			$this->load->view('tempuser/home.php');
		}

	}//end of function
	public function workdata()
	{
		$this->form_validation->set_rules('custidreference', '','trim|required');
		$this->form_validation->set_rules('workcompany','Company name','required|trim');
		$this->form_validation->set_rules('workposition','Position','required|trim');
		$this->form_validation->set_rules('startworkdate','Start Date','required|trim');
		$this->form_validation->set_rules('worklocation','State/Province','required|trim');
		$this->form_validation->set_rules('workcitylocation','City/District','required|trim');
		if ($this->form_validation->run()==FALSE) {
			$branches=$this->SelectPrograms->university_branches();
			$programs = $this->SelectPrograms->university_programs();
			$data=array(
				'groups'=>$programs,
				'branches'=>$branches,
				'modules'=>$this->SelectPrograms->university_modules(),
				'students'=>$this->SelectPrograms->university_students(),
			);
			$this->load->view('tempuser/index.php',$data);//back to index page
		}else {
			//run update
			$data=array(
				'realwork_cmp'=>$this->input->post('workcompany'),
				'realwork_pos'=>$this->input->post('workposition'),
				'realwork_start'=>$this->input->post('startworkdate'),
				'realwork_pro'=>$this->input->post('worklocation'),
				'realwork_dist'=>$this->input->post('workcitylocation'),
			);
			$reference=$this->input->post('custidreference');
			$run=$this->TempModels->churchdata($data,$reference);
			if ($run!=FALSE) {
				$data=array(
					'groups'=>$this->SelectPrograms->university_programs(),
					'branches'=>$this->SelectPrograms->university_branches(),
					'modules'=>$this->SelectPrograms->university_modules(),
					'students'=>$this->SelectPrograms->university_students(),
					'success'=>'Record updated',
				);
				$this->load->view('tempuser/index.php', $data);
			}else {
				$data=array(
					'groups'=>$this->SelectPrograms->university_programs(),
					'branches'=>$this->SelectPrograms->university_branches(),
					'students'=>$this->SelectPrograms->university_students(),
					'modules'=>$this->SelectPrograms->university_modules(),
					'erroruser'=>'Update error occured try again',
				);
				$this->load->view('tempuser/index.php', $data);
			}
		}//end of update
	}//end of function

	public function updateprogram()
	{
		$this->form_validation->set_rules('candidatenumber','Student Number','required');
		$this->form_validation->set_rules('program','Program applying for','required');
    if ($this->form_validation->run()==TRUE){
      // update current program to attend in candidates table
      //get candidate reference
			$student=$this->input->post('candidatenumber');
      $reference=$this->TempModels->applicantreference($student);
      if (!empty($reference) && isset($reference) && $reference!=FALSE) {
        //run update in candidates table
        $dataupdate=array('reference_no' => $reference,
        'program_code'=>$this->input->post('program'),
      );
      $this->load->model('Register');
      $update=$this->Register->updateprogramcode($dataupdate);
			if ($update!=FALSE) {
				$data=array(
					'groups'=>$this->SelectPrograms->university_programs(),
					'branches'=>$this->SelectPrograms->university_branches(),
					'modules'=>$this->SelectPrograms->university_modules(),
					'students'=>$this->SelectPrograms->university_students(),
					'success'=>'Record updated',
				);
				$this->load->view('tempuser/index.php', $data);
			} else {
				$data=array(
					'groups'=>$this->SelectPrograms->university_programs(),
					'branches'=>$this->SelectPrograms->university_branches(),
					'students'=>$this->SelectPrograms->university_students(),
					'modules'=>$this->SelectPrograms->university_modules(),
					'erroruser'=>'Update error occured try again',
				);
				$this->load->view('tempuser/index.php', $data);
			}

		}else {
			echo "errror";
		}
	}else {
		$data=array(
			'groups'=>$this->SelectPrograms->university_programs(),
			'branches'=>$this->SelectPrograms->university_branches(),
			'students'=>$this->SelectPrograms->university_students(),
			'modules'=>$this->SelectPrograms->university_modules(),
		);
		$this->load->view('tempuser/index.php', $data);
	}
}//end of function
function senddata($to,$subj, $message)
{
	$mail=new PHPMailer();
	$mail->IsSMTP(); // enable SMTP
	$mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
	$mail->SMTPAuth = true; // authentication enabled
	$mail->SMTPSecure = 'tsl'; // secure transfer enabled REQUIRED for Gmail
	$mail->Host = "smtp.gmail.com";
	$mail->Port = 587; // or 587
	$mail->IsHTML(true);
	$mail->Username = "superuser.uwmf@gmail.com";
	$mail->Password = "0781549903";
	$mail->SetFrom($to);
	//$email->SetFromName='MWISENEZA Honore';
	$mail->Subject = $subj;
	$mail->Body = $message;
	$mail->AddAddress($to);
	if (!$mail->send()){
			$data=array(
				'groups'=>$this->SelectPrograms->university_programs(),
				'branches'=>$this->SelectPrograms->university_branches(),
				'modules'=>$this->SelectPrograms->university_modules(),
				'students'=>$this->SelectPrograms->university_students(),
				'erroruser'=>'Unable to confirm and send student email,try again'
			);
			$this->load->view('tempuser/index.php', $data);
	}else{
		$data=array(
				'groups'=>$this->SelectPrograms->university_programs(),
				'branches'=>$this->SelectPrograms->university_branches(),
				'modules'=>$this->SelectPrograms->university_modules(),
				'students'=>$this->SelectPrograms->university_students(),
				'success'=>'Student Saved and Email has been Successfully Sent',
			);
			$this->load->view('tempuser/index.php', $data);
	}
}//end of function
public function universitydata()
{
	//validate form data
	$this->form_validation->set_rules('collegenameid','University Branch','required|alpha');
	$this->form_validation->set_rules('dateregisteredid','Date registered','required');
	$this->form_validation->set_rules('collegelocation','University location','required');
	if ($this->form_validation->run()!=FALSE){
		echo $this->input->post('collegenameid');
	} else {
		$this->load->view('tempuser/index.php');
	}

}
}
?>
