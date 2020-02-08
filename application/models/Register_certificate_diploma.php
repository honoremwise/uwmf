<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * only these is for registering a new student form the first page of program certificate or diploma
 */
class Register_certificate_diploma extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
	}
	//save basic data from certificate/application.php  //the same function for diploma
	public function registerBasicData($data)
	{
		    //update data in database where username and password match
		    //retrieve user and password form session variable
		    $user=$this->session->userdata('username');
		    $pass=$this->session->userdata('password');
		    //update command
		    $this->db->where('candidate_email',$user);
		    $this->db->where('password',$pass);
		    $this->db->update('candidates',$data);
		// If the query runs well go to upload files page
		//get the program code to know which page to load
				$pro=$this->db->query("SELECT program_code FROM candidates WHERE candidate_email LIKE '$user'");
		    foreach ($pro->result() as $row) {
		      $program=$row->program_code;
		    }
				switch ($program) {
					case '01':
						$this->load->view('views_pages/bachelor_master_program_uploads.php');
						break;
					case '02':
						$this->load->view('views_pages/bachelor_master_program_uploads.php');
						break;
					case '03':
							$this->load->view('views_pages/bachelor_master_program_uploads.php');
					 break;
					case '04':
						$this->load->view('views_pages/bachelor_master_program_uploads.php');
						break;
					default:
						$this->load->view('index.php');
						break;
				}
	}
	public function work_experience($data)
	{
		//register church information and candidate experience(certificate && diploma)
		//retrieve reference number for this id
		$user=$_SESSION['username'];
		$ref=$data['reference_no'];
		$reference=$this->db->query("SELECT reference_no FROM church_information WHERE reference_no LIKE '$ref'");
		$elements=$reference->result_array();
		if (count($elements)>0) {
			$remove_reference=array_pop($data);
			$this->db->where('reference_no',$ref);
		  $this->db->update('church_information',$data);
			//redirect to the next page by program applied
			$pro=$this->db->query("SELECT program_code FROM candidates WHERE reference_no LIKE '$ref'");
			foreach ($pro->result() as $row) {
				$program=$row->program_code;
			}
			$this->redirectUser($program); //redirect a user
			//end
		}else {
			//run insert instead of updating
			$this->db->insert('church_information',$data);
			//redirect to the next page
			$pro=$this->db->query("SELECT program_code FROM candidates WHERE reference_no LIKE '$ref'");
			foreach ($pro->result() as $row) {
				$program=$row->program_code;
			}
			$this->redirectUser($program); //redirect a user
		}
	}
	public function redirectUser($program) //redirect to another page after saving work experience
	{
		switch ($program) {
			case '01':
				$this->load->view('certificate/review_application.php');
				break;
			case '02':
				$this->load->view('certificate/review_application.php');
				break;
			case '03':
					$this->load->view('bachelor_master/job_work_experience.php');
					break;
			case '04':
					$this->load->view('bachelor_master/job_work_experience.php');
					break;
			default:
				$this->load->view('index.php');
				break;
		}
	}
	public function job_experience($data)
	{
		$ref=$data['reference_no'];
		$remove_reference=array_pop($data);
		$this->db->where('reference_no',$ref);
		$this->db->update('church_information',$data);
		$pro=$this->db->query("SELECT program_code FROM candidates WHERE reference_no LIKE '$ref'");
		foreach ($pro->result() as $row) {
			$program=$row->program_code;
		}
		switch ($program) {
			case '03':
				$this->load->view('bachelor_master/review_application.php');
				break;
			case '04':
				$this->load->view('bachelor_master/review_application.php');
				break;
			default:
				$this->load->view('views_pages/home.php');
				break;
		}
	}//end of the function
}
 ?>
