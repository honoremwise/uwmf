<?php
/**
 * only this controller is for user to register existing students who were not applied using system
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class TempuserLogin extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->Model('TempModels');
	}
		//check for user login process
		public function account(){
			//validation of the form inputs
			$this->form_validation->set_rules('Useridname','Username','trim|required');
			$this->form_validation->set_rules('useridPassword','Password','trim|required');
			if ($this->form_validation->run()==FALSE) {
				$this->load->view('tempuser/home.php');
			} else {
				# process data and check if user exist in database
				$user=$this->input->post('Useridname');
				$pass=$this->input->post('useridPassword');
				//check if user exist in database
				$result=$this->TempModels->checkLogin($user,$pass);
				//checkLogin is a function in the model called selectModels
				if ($result != FALSE){
					$this->session->set_userdata('validuser',$user);
					$this->load->Model('SelectPrograms');
					$programs=$this->SelectPrograms->university_programs();
					$branches=$this->SelectPrograms->university_branches();
					$data=array(
		        'groups'=>$programs,
		        'branches'=>$branches,
						'modules'=>$this->SelectPrograms->university_modules(),
						'students'=>$this->SelectPrograms->university_students(),
		      );
          $this->load->view('tempuser/index.php',$data);
				} else {
					$data=array(
						'messageDisplay'=>'Invalid Username or Password',
					);
					//go back to login page
					$this->load->view('tempuser/home.php',$data);
				}
			}
		}
		public function index()
		{
			$this->load->view('tempuser/home.php');
		}
}
?>
