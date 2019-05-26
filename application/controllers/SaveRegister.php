<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class SaveRegister extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('file');
		$this->load->library('form_validation');
		$this->load->helper('security');
		$this->load->helper(array('form','url'));
		$this->load->helper('email');
		$this->load->model('SelectModels');
		$this->load->model('Register');
	}
	public function index()
	{
		$this->load->view('views_pages/home.php');
	}
	public function RegisterMainData()
	{
		function passwordCheck($str){
			if (preg_match("/^(([a-zA-Z]{1,})|([0-9]{1,}))([a-zA-Z]{1,}|([0-9]{1,4}))$/i",$str)) {
				$result=TRUE;
				return $result;
			} else {
				$password=$this->input->post('CandidatePassword');
				$str->form_validation->set_message('passwordCheck','Password must be a combination of alphabets and numbers');
				$result=FALSE;
				return $result;
			}
		}
		$this->form_validation->set_rules('CandidateEmail', 'Email','trim|required|valid_email|xss_clean');
		$this->form_validation->set_rules('CandidatePassword', 'Password', 'required|min_length[8]');
		$this->form_validation->set_rules('CandidatePasswordConf','Confirm Password','required|matches[CandidatePassword]');
		$this->form_validation->set_rules('program','Program applying for','required');

		if ($this->form_validation->run()==FALSE) {
			$this->load->model('SelectPrograms');
			$data['groups'] = $this->SelectPrograms->university_programs();
			$this->load->view('views_pages/registerFormMain.php', $data);
		} else {
			//Perform database action
			$firstname=$this->input->post('CandidateFname');
			$lastname=$this->input->post('CandidateLname');
			$email=$this->input->post('CandidateEmail');
			$programcode=$this->input->post('program');
			$password=$this->input->post('CandidatePassword');
			//check if password contains alphabets and numbers
			$keywords=str_split($password);
			if ($keywords==true) {
				$elements=array(0,1,2,3,4,5,6,7,8,9);
				$checkexist=0;
				foreach ($keywords as $key => $value) {
					$cmp=array_search($value,$elements);
					if ($cmp!=FALSE) {
						$checkexist=$checkexist+1;
					}else {
						$checkexist+=0;
					}
				}
				if ($checkexist>=1) {
					//check if no email as the input previously saved
					$condition=array('candidate_email'=>$email);
					$check=$this->SelectModels->checkuseremail($condition);
					if ($check!=false) {
						$this->load->model('Register');
						$data=array(
							'password'=>$password,
							'candidate_email'=>$email,
							 'program_code'=>$programcode,
							'year_registered'=>date('Y-m-d'),
						);
						$this->Register->registerNew($data);
					} else {
						$this->load->model('SelectPrograms');
						$programs=$this->SelectPrograms->university_programs();
						$data=array(
							'erroruser'=>'User of the same email already exists, please login',
							'groups'=>$programs,
						);
						$this->load->view('views_pages/registerFormMain.php',$data);
					}
				}else {
					$this->load->model('SelectPrograms');
					$programs = $this->SelectPrograms->university_programs();
					$data=array(
						'erroruser'=>'Password must be the combination of alphabets and numbers',
						'groups'=>$programs,
					);
					$this->load->view('views_pages/registerFormMain.php',$data);
				}
			}else {
				exit("An error occured, Please try again later");
			}
		}
	}//end of the function
	public function saveNotification()
	{
		// validate input
		$this->form_validation->set_rules('useridnumber','','required|trim');
		$this->form_validation->set_rules('msgidrequest','','required|trim');
		if ($this->form_validation->run()==TRUE) {
			//save notification
			$data=array(
			'sender'=>$this->input->post('Useridname'),
			'receiver'=>$this->input->post('useridnumber'),
			'date'=>date('Y-m-d'),
			'message'=>$this->input->post('msgidrequest'),
		);
		//save notification
		$this->load->model('Register');
		$save=$this->Register->requestmessage($data);
		if ($save==TRUE) {
			$data=array("success"=>'Message Saved');
			$this->load->view('user/index.php',$data);
		} else {
			$data=array("error"=>'Unable to save message,try again',);
			$this->load->view('user/index.php',$data);
		}
		} else {
			$this->load->view('user/index.php');
		}
	}//end of function
	public function checkUploadne(){
    $allowed_mime_type_arr= array('application/pdf');
    //get all files required to be uploaded
    if (isset($_FILES['fileidupload']['name'])) {
      $mime=mime_content_type($_FILES['fileidupload']['tmp_name']);
      if (isset($_FILES['fileidupload']['name']) && $_FILES['fileidupload']['name']!="") {
        if (in_array($mime,$allowed_mime_type_arr)) {
          return true;
        }else {
          $this->form_validation->set_message('checkUploadne', 'Please select only  file of type pdf');
          return false;
        }
      } else {
        $this->form_validation->set_message('checkUploadne','upload required file');
        return false;
      }
    } else {
      $this->form_validation->set_message('checkUploadne', 'Please choose a file to upload.');
      return false;
    }
  }//end of function
	public function savepayement()
	{
		// validate form element
		$this->form_validation->set_rules('reasonpayid','','required|trim');
		$this->form_validation->set_rules('amountpayid','','required|trim');
		$this->form_validation->set_rules('userid','','required|trim');
		$this->form_validation->set_rules('fileidupload', '', 'callback_checkUploadne');
		if ($this->form_validation->run()==TRUE) {
			//save payement
			$file=$_FILES['fileidupload']['name'];
			$data= array('id' =>$this->input->post('reasonpayid'),
			'registration_no'=>$this->input->post('userid'),
			'	bankslip_amount'=>$this->input->post('amountpayid'),
			'date'=>date('Y-m-d'),
			'bankslip'=>$file,
		);
		$save=$this->Register->payement($data);
		if ($save==TRUE) {
			// save file
			$config['upload_path'] ='./profiles/';
	    $config['allowed_types']='pdf';
	    $config['max_size']      =2000;
			$config["file_name"]=$_FILES['fileidupload']['name'];
			$this->load->library('upload', $config);
			$savefile= $this->upload->do_upload('fileidupload');
			if ($savefile==TRUE) {
				$data=array("success"=>'Record saved');
				$this->load->view('user/index.php',$data);
			} else {
				$data=array('error'=>'Unable to save records');
				$this->load->view('user/index.php',$data);
			}

		} else {
			$data=array('error'=>'Unable to save records');
			$this->load->view('user/index.php',$data);
		}
		} else {
			$data=array('fillform'=>'Please fill all fields');
			$this->load->view('user/index.php',$data);
	}
}//end of function
public function changePassword()
{
	$this->form_validation->set_rules('CandidatePassword', 'Password', 'required|min_length[8]|xss_clean');
		$this->form_validation->set_rules('CandidatePasswordConf','Confirm Password','required|matches[CandidatePassword]|xss_clean');
		if ($this->form_validation->run()==FALSE) {
			$data = array('error' => 'Please Password must be atleast 8 characters long and matches all fields');
			$this->load->view('user/index.php', $data);
		} else {
			//Perform database action
			$password=$this->input->post('CandidatePassword');
			//check if password contains alphabets and numbers
			$keywords=str_split($password);
			if ($keywords==true) {
				$elements=array(0,1,2,3,4,5,6,7,8,9);
				$checkexist=0;
				foreach ($keywords as $key => $value) {
					$cmp=array_search($value,$elements);
					if ($cmp!=FALSE) {
						$checkexist=$checkexist+1;
					}else {
						$checkexist+=0;
					}
				}
				if ($checkexist>=1) {
					//update password
					$data=array(
					'password'=>$this->input->post('CandidatePassword'),
				);
				$this->load->model('Register');
				$update=$this->Register->changePassword($data);
				if ($update==TRUE) {
					$this->load->view('index.php');
				} else {
					$data=array(
						'error'=>'Unable to change Password,Try again',
					);
					$this->load->view('user/index.php',$data);
				}
				}else {
					$data=array(
						'error'=>'Password must be the combination of alphabets and numbers',
					);
					$this->load->view('user/index.php',$data);
				}
			}else {
				$data = array('error' =>'An error occured, Please try again later');
				$this->load->view('user/index.php',$data);
			}
}//end of function
}
}
?>
