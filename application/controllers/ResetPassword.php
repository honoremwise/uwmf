<?php
use PHPMailer\PHPMailer\PHPMailer;
require_once(APPPATH.'views/mails/vendor/autoload.php');
//require_once(APPPATH.'views/mails/mail.php');
class ResetPassword extends CI_Controller
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
    $this->load->view('index.php');
  }//end of function
  public function reset()
  {
    //check if a user exist in data base with the same email if so send the following link to reset password on the email
    $this->load->view('views_pages/reset.php');
  }
  public function confirmReset()
  {
    // validate user input
    $this->form_validation->set_rules('Useridname','','required|trim|valid_email');
    $this->form_validation->set_rules('userbirthdate','','required|trim');
    $this->form_validation->set_rules('userpassidname','','required|trim');
    if ($this->form_validation->run()==TRUE) {
      // check user email from database
      $data=array('candidate_email'=>$this->input->post('Useridname'),
      'dob'=>$this->input->post('userbirthdate'),
      'id_passport'=>$this->input->post('userpassidname'),
    );
    //check data in database
    $check=$this->SelectModels->checkUserPassword($data);
    if ($check==true) {
      $id=$this->input->post('Useridname');
      $this->session->set_userdata('resetuserid',$id);
      //send reset password email
      $to=$id;
      $url=base_url()."index.php/ResetPassword/backaccount";
      $message='
      <html><body style="text-align:justify">
      <p>Dear User, you have requested to reset your University of World Mission Frontier
      online Student Management System Account Password,
      <p>You open the follwing link below into the browser to reset password.
      </p>
      '.$url.'
      <p>Regards,</p>
      <p>University of World Mission System Suppport</p>
      </body>
      </html>';
      $this->sendMail($to,"UWMF-MIS-Administrator/Account Password Reset", $message);
    } else {
      $data=array('messageDisplay'=>'User not Found');
      $this->load->view('views_pages/reset.php',$data);
    }
  } else {
      $this->load->view('views_pages/reset.php');
    }
  }//end of function
  public function password()
  {
    //validate input
    $this->form_validation->set_rules('Useridname','','required|trim|valid_email');
    $this->form_validation->set_rules('useridPassword','','required|trim');
    $this->form_validation->set_rules('useridconfPassword','','required|trim|matches[useridPassword]');
    if ($this->form_validation->run()==TRUE) {
      //compare reset session id with the input email
      $email=$this->input->post('Useridname');
      if (isset($email) && isset($email)){
        //reset data from database
        $newpassword=$this->input->post('useridconfPassword');
        $data=array(
          'password'=>$newpassword,
        );
        $reset=$this->SelectModels->resetPassword($data,$email);
        if ($reset==TRUE) {
          $data=array('reset' =>"Successfully reset, Login",);
          $this->load->view('index.php',$data);
        } else {
          $data=array('messageDisplay'=>"Unable to reset the password,try again");
          $this->load->view('views_pages/accountPassword.php',$data);
        }
      }else {
        $data=array('messageDisplay'=>"Invalid User");
        $this->load->view('views_pages/accountPassword.php',$data);
      }
    }else {
      $this->load->view('views_pages/accountPassword.php');
    }
  }
  public function backaccount()
  {
    $this->load->view('views_pages/accountPassword.php');
  }
  public function backaUserccount()
  {
    $this->load->view('tempuser/accountPassword.php');
  }
  public function confirmUserReset()// this function helps other users not student to reset passwords
  {
    // validate user input
    $this->form_validation->set_rules('Useridname','','required|trim|valid_email');
    if ($this->form_validation->run()==TRUE) {
      // check user email from database
      $data=array('email'=>$this->input->post('Useridname'),
    );
    //check data in database
    $check=$this->SelectModels->checkUserexistPassword($data);
    if ($check==true) {
      $id=$this->input->post('Useridname');
      $this->session->set_userdata('resetuserexistingid',$id);
      //send reset password email
      $to=$id;
      $url=base_url()."index.php/ResetPassword/backaUserccount";
      $message='
      <html><body style="text-align:justify">
      <p>Dear User, you have requested to reset your University of World Mission Frontier
      online Student Management System Account Password,
      <p>You open the follwing link below into the browser to reset password.
      </p>
      '.$url.'
      <p>Regards,</p>
      <p>University of World Mission MIS Suppport</p>
      </body>
      </html>';
      //$message= "Please copy the follwing link to your browser to reset Account Password  ".base_url().'index.php/ResetPassword/backaUserccount';
      $this->sendResetMail($to,"UWMF-MIS-Administrator/Account Password Reset", $message);
    } else {
      $data=array('messageDisplay'=>'User not Found');
      $this->load->view('tempuser/reset.php',$data);
    }
  } else {
      $this->load->view('tempuser/reset.php');
    }
  }//end of function
  public function userresetpassword()
  {
    //validate input
    $this->form_validation->set_rules('Useridname','','required|trim|valid_email');
    $this->form_validation->set_rules('useridPassword','','required|trim');
    $this->form_validation->set_rules('useridconfPassword','','required|trim|matches[useridPassword]');
    if ($this->form_validation->run()==TRUE) {
      //compare reset session id with the input email
      $email=$this->input->post('Useridname');
      if (isset($email) && isset($email)){
        //reset data from database
        $newpassword=$this->input->post('useridconfPassword');
        $data=array(
          'password'=>$newpassword,
        );
        $reset=$this->SelectModels->resetuserPassword($data,$email);
        if ($reset==TRUE) {
          $data=array('reset' =>"Successfully reset, Login",);
          $this->load->view('tempuser/home.php',$data);
        } else {
          $data=array('messageDisplay'=>"Unable to reset the password,try again");
          $this->load->view('tempuser/accountPassword.php',$data);
        }
      }else {
        $data=array('messageDisplay'=>"Invalid User");
        $this->load->view('tempuser/accountPassword.php',$data);
      }
    }else {
      $this->load->view('tempuser/accountPassword.php');
    }
  }//end of function
  function sendMail($to,$subj, $message)
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
  	$email->SetFromName='MWISENEZA Honore';
  	$mail->Subject = $subj;
  	$mail->Body = $message;
  	$mail->AddAddress($to);
  	if (!$mail->send()){
  			//echo 'Mailer Error: ' . $mail->ErrorInfo;
  			$data=array(
  				'messageDisplay'=>'An error occured,try again'
  			);
  			$this->load->view('views_pages/reset.php',$data);
  	}else{
  		$data=array(
  				'success'=>'The link has been sent to your email.',
  			);
  			$this->load->view('views_pages/reset.php',$data);
  	}
  }//end of function
  function sendResetMail($to,$subj, $message)
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
  			//echo 'Mailer Error: ' . $mail->ErrorInfo;
  			$data=array(
  				'$messageDisplay'=>'An error occured,try again'
  			);
  			$this->load->view('tempuser/reset.php',$data);
  	}else{
  		$data=array(
  				'success'=>'The reset password link has been sent to your email.',
  			);
  			$this->load->view('tempuser/reset.php',$data);
  	}
  }//end of function to send email of reset password for system users
}
 ?>
