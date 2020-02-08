<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * only these is for registering a new student form the first page
 */
 //load send mail class files
 use PHPMailer\PHPMailer\PHPMailer;
 require_once(APPPATH.'views/mails/vendor/autoload.php');
class Register extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
	}
	public function registerNew($data)//register username and password
	{
		//get the number of candidates in the database of the same date to assign a reference number
    $code=$data['program_code'];
    $yearOnly=substr($data['year_registered'],0,4);
    $gets=$this->db->query("SELECT * FROM candidates WHERE program_code='$code' AND substr(year_registered,1,4)='$yearOnly'");
    $elements=$gets->result_array();
    $num_elements=$gets->num_rows();
    $num_elements++;
    $reference=$yearOnly.$num_elements;
    // query to save data in the database
    $data['reference_no']=$data['program_code'].$reference;
     $this->db->insert('candidates',$data);
     if ($this->db->affected_rows()>0) {
			 //confirm account
       $data=array('account'=>'Account successfuly created login with the email and password you entered.',
			 );
       $this->load->view('views_pages/registerFormMain.php',$data);//back to page
     } else {
       $this->load->view('index.php');
     }
	}
	//submit/save application
	public function saveApplication($data)
	{
		// check if an applicant of the details as current user has submitted application
		$ref=$data['reference_no'];
		$condition=array(
	    'reference_no'=>$data['reference_no'],
	  );
		$values=$this->db->get_where('applications',$condition);
	  $elements=$values->result_array();
		if (count($elements)>0) {
			// run update
			//get the current number of applications submitted
			foreach ($values->result() as $row) {
	      $number=$row->number_of_application;
	    }
			$data['number_of_application']=$number+1;
			$this->db->where('reference_no',$ref);
		  $this->db->update('applications',$data);
			//redirect
			$prog=$data['program_code'];
			//send an email to the applicant
			//$message = $this->load->view('tempuser/sendaccount.php', '', TRUE);
			$message="application has been submitted";
			$to=$_SESSION['username'];
			$this->sendApplication($to,$subj, $message,$prog);
		}else {
			//insert application
			$this->db->insert('applications',$data);
			$prog=$data['program_code'];
			//send email to the applicant
			//$message = $this->load->view('tempuser/sendaccount.php', '', TRUE);
			$message="Application has been submitted";
			$to=$_SESSION['username'];
			$this->sendApplication($to,$subj, $message,$prog);
		}
	}
	//only to redirect
	public function redirectUser($program) //redirect back to review page
	{
		switch ($program) {
			case '01':
				$this->load->view('certificate/review_application.php');
				break;
			case '02':
				$this->load->view('certificate/review_application.php');
				break;
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
	}
	//check if application has been submitted
	public function checkApplications($condition)
	{
		//retrieve application
		$values=$this->db->get_where('applications',$condition);
	  $elements=$values->result_array();
		if (count($elements)>0) {
			return TRUE;
		}else {
			return FALSE;
		}
	}//end of the function
	public function addUsertype($data)
	{
		//check if no same responsability already saved
		$values=$this->db->get_where('users_responsabilities',$data);
		$elements=$values->result_array();
		if (count($elements)>0) {
			return false;
		} else {
			// add new system user responsability in database
			$this->db->where('responsability!=',$data['responsability']);
			$this->db->insert('users_responsabilities',$data);
			//$sql=$this->db->query("INSERT INTO users_responsabilities(responsability) VALUES('$cond') WHERE responsability NOT IN '$cond'");
			if ($this->db->affected_rows()>0) {
				return true;
			}else {
				return false;
			}
		}
	}//end of the function
	public function addUserdata($data)
	{
		// add new system user responsability in database
		$this->db->insert('users',$data);
		if ($this->db->affected_rows()>0) {
			return true;
		}else {
			return false;
		}
	}//end of function
	public function savefile($files)
	{
		//save file
		$this->db->insert('files',$files);
		if ($this->db->affected_rows()>0) {
			return true;
		}else {
			return false;
		}
	}//end of function
	public function changeStatus($data)
	{
		$this->db->where('email',$data['email']);
		$this->db->update('users',array('status'=>$data['status']));
		if ($this->db->affected_rows()>0) {
			return true;
		}else {
			return false;
		}
	}//end of function
	public function updateprogramcode($data)
	{
		// unset reference number
		$reference=$data['reference_no'];
		unset($data['reference_no']);
		$this->db->where('reference_no',$reference);
		$this->db->update('candidates',$data);
		if ($this->db->affected_rows()>0) {
			// update also program in applications
			$cond=array('reference_no'=>$reference);
			$applicant=$this->checkApplications($cond);
			if ($applicant!=FALSE) {
				$this->db->where('reference_no',$reference);
				$this->db->update('applications',$data);
				if ($this->db->affected_rows()>0) {
					return TRUE;
				}else {
					return false;
				}
			}else {
				return true;
			}
		} else {
			return false;
		}
	}//end of function
	public function updatedate($values)
	{
		$this->db->update('academic_schedule',$values);
		if ($this->db->affected_rows()>0) {
			return true;
		}else {
			return false;
		}
	}//end of function
	public function requestmessage($data)
	{
		//insert into database
		$this->db->insert('notifications',$data);
		if ($this->db->affected_rows()>0) {
			return true;
		}else {
			return false;
		}
	}//end of function
	public function payement($values)
	{
		//insert into database
		$this->db->insert('students_payment',$values);
		if ($this->db->affected_rows()>0) {
			return true;
		}else {
			return false;
		}
	}//end of function
	public function savePassword($data,$email)
	{
		// run update
		$this->db->where('email',$email);
		$this->db->update('users',$data);
		if($this->db->affected_rows()>0){
			return true;
		}else {
			return false;
		}
	}//end function
	function sendApplication($to,$subj, $message,$prog)
	{
		$mail=new PHPMailer();
		$mail->IsSMTP(); // enable SMTP
		$mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
		$mail->SMTPAuth = true; // authentication enabled
		$mail->SMTPSecure = 'tsl'; // secure transfer enabled REQUIRED for Gmail
		$mail->Host = "smtp.gmail.com";
		$mail->Port = 587; // or 587
		$mail->IsHTML(true);
		$mail->Username = "admission.uwmf@gmail.com";
		$mail->Password = "0781549903";
		$mail->SetFrom($to);
		$email->SetFromName='MWISENEZA Honore';
		$mail->Subject = $subj;
		$mail->Body = $message;
		$mail->AddAddress($to);
		if (!$mail->send()){
				//echo 'Mailer Error: ' . $mail->ErrorInfo;
				$this->redirectUser($prog);
		}else{
			$this->redirectUser($prog);
		}
	}//end of function
  public function changePassword($data)
  {
    $email=$_SESSION['username'];
    $this->db->where('candidate_email',$email);
		$this->db->update('candidates',$data);
		if($this->db->affected_rows()>0){
			return true;
		}else {
			return false;
		}
  }
}
 ?>
