<?php
//load send mail class files
use PHPMailer\PHPMailer\PHPMailer;
require_once(APPPATH.'views/mails/vendor/autoload.php');
class Adminuser extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
		$this->load->helper('url');
		$this->load->library('form_validation');
    $this->load->model('SelectModels');
    $this->load->model('Register');
  }
  public function logout(){
    unset($_SESSION['adminuserlogin']);
    $data=array('logout' => 'You are logged out', );
    $this->load->view('admin/home.php',$data);
  }//end of function
  public function index()
  {
    if (!isset($_SESSION['adminuserlogin'])) {
      $this->load->view('admin/home.php');
    }else {
      $this->load->view('admin/home.php');
    }
  }//end of function
  public function account(){
    //validation of the form inputs
    $this->form_validation->set_rules('Useridname','Username','trim|required');
    $this->form_validation->set_rules('useridPassword','Password','trim|required');
    if ($this->form_validation->run()==FALSE) {
      #
      if (isset($this->session->userdata['adminuserlogin'])) {
        # load a page to next page
        $data=array(
        'session'=>'You are logged out');
        $this->load->view('admin/home.php',$data);
      } else {
        $this->load->view('admin/home.php');
      }
    } else {
      # process data and check if user exist in database
      $user=$this->input->post('Useridname');
      $pass=$this->input->post('useridPassword');
      //check if user exist in database
      $result=$this->SelectModels->checkuser($user,$pass);
      //checkLogin is a function in the model called SelectModels
      if ($result != FALSE){
        //initialize session
        $this->session->set_userdata('adminuserlogin',$user);
        $data=array(
          'users'=>$this->SelectModels->getusers(),
          'positions'=>$this->SelectModels->getpositions(),
          'files'=>$this->SelectModels->getfiles(),
        );
        $this->load->view('admin/index.php',$data);
      } else {
        $data=array(
          'messageDisplay'=>'Invalid Username or Password',
        );
        //go back to login page
        $this->load->view('admin/home.php',$data);
      }
    }
  }//end of function
  public function addUser()
  {
    $this->form_validation->set_rules('positiontype','','required|trim|alpha');
    if ($this->form_validation->run()!=FALSE) {
      //insert responsability
      $data=array('responsability' => $this->input->post('positiontype'),);
      $add=$this->Register->addUsertype($data);
      if ($add!=FALSE) {
        $data=array(
          'users'=>$this->SelectModels->getusers(),
          'positions'=>$this->SelectModels->getpositions(),
          'files'=>$this->SelectModels->getfiles(),
          'success'=>'Record saved',
        );
        $this->load->view('admin/index.php',$data);
      }else {
        $data=array(
          'users'=>$this->SelectModels->getusers(),
          'positions'=>$this->SelectModels->getpositions(),
          'files'=>$this->SelectModels->getfiles(),
          'recorderror'=>'Unable to save data',
        );
        $this->load->view('admin/index.php',$data);
      }
    }else {
      $data=array(
        'users'=>$this->SelectModels->getusers(),
        'positions'=>$this->SelectModels->getpositions(),
        'files'=>$this->SelectModels->getfiles(),
      );
      $this->load->view('admin/index.php',$data);
    }
  }//add user
  public function addUserdata()
  {
    // validate
    $this->form_validation->set_rules('userfname','','required|trim');
    $this->form_validation->set_rules('userlname','','required|trim');
    $this->form_validation->set_rules('useremail','','required|trim|valid_email');
    $this->form_validation->set_rules('usertelephone','','required|trim');
    $this->form_validation->set_rules('responsability','','required|trim');
    if ($this->form_validation->run()!=FALSE) {
      // save new user
      $data=array(
        'first_name'=>$this->input->post('userfname'),
        'last_name'=>$this->input->post('userlname'),
        'email'=>$this->input->post('useremail'),
        'telephone'=>$this->input->post('usertelephone'),
        '	user_respo_id'=>$this->input->post('responsability'),
      );
      $add=$this->Register->addUserdata($data);
      if ($add!=FALSE) {//send an email to choose Username and password
        $data=array(
          'users'=>$this->SelectModels->getusers(),
          'positions'=>$this->SelectModels->getpositions(),
          'files'=>$this->SelectModels->getfiles(),
          'success'=>'Record Saved',
        );
        //send email
        $to=$this->input->post('useremail');
        $message = $this->load->view('admin/sendaccount.php', '', TRUE);
        //$message= "Please copy the follwing link to your browser to complete user account   ".base_url().'index.php/Adminuser/backaccount';
        $this->sendMail($to,"UWMF-MIS-Administrator/User Account Confirmation", $message);
      }else {
        $data=array(
          'users'=>$this->SelectModels->getusers(),
          'positions'=>$this->SelectModels->getpositions(),
          'files'=>$this->SelectModels->getfiles(),
          'recorderror'=>'Unable to save data',
        );
        $this->load->view('admin/index.php',$data);
      }
    }else {
      $data=array(
        'users'=>$this->SelectModels->getusers(),
        'positions'=>$this->SelectModels->getpositions(),
        'files'=>$this->SelectModels->getfiles(),
      );
      $this->load->view('admin/index.php',$data);
    }
  }//end of function
  public function uploads()
  {
    $this->form_validation->set_rules('fileusetype','File title','required|trim|numeric');
    $test=$this->form_validation->run();
    if (isset($_SESSION['adminuserlogin']) && $test==true){
      //configure file uploads
      $config['upload_path']   ='./files';
      $config['allowed_types'] ='pdf';
      $config['max_size']      =100000;
      $type= ".".pathinfo($_FILES['fileuploadid']['name'], PATHINFO_EXTENSION);
      $id=$this->input->post('fileusetype');
      $config["file_name"] ="uwmf".$id.$type;
      $file="uwmf".$id.$type;
      $this->load->library('upload',$config);
      //check if the file id is already saved in database
      $existing=$config['upload_path'].'/'.$file;
      if (file_exists($existing)){
        unlink($existing);
        //update table field to empty
        $data= array('file_name'=>'',
      );
        $this->SelectModels->editfile($id,$data);
        //upload file
        $savefile=$this->upload->do_upload('fileuploadid');
        if ($savefile==true){
          // save record in database
          $data= array('file_name' =>$file,);
          $savefield=$this->SelectModels->editfile($id,$data);
          if ($savefield==true){
            //return success
            $data=array(
              'users'=>$this->SelectModels->getusers(),
              'positions'=>$this->SelectModels->getpositions(),
              'files'=>$this->SelectModels->getfiles(),
              'success'=>'file saved',
            );
            $this->load->view('admin/index.php',$data);
          } else {
            // return table update error
            $data=array(
              'users'=>$this->SelectModels->getusers(),
              'positions'=>$this->SelectModels->getpositions(),
              'files'=>$this->SelectModels->getfiles(),
              'recorderror'=>'file not saved',
            );
            $this->load->view('admin/index.php',$data);
          }
        }else{
          // return upload error
          $error=array('errorfile'=>$this->upload->display_errors(),
          'users'=>$this->SelectModels->getusers(),
          'positions'=>$this->SelectModels->getpositions(),
          'files'=>$this->SelectModels->getfiles(),
        );
          $this->load->view('admin/index.php',$error);
        }
      }else{//file not existing
        //update table field to empty
        $data= array('file_name' =>'',
      );
        $this->SelectModels->editfile($id,$data);
        //upload file
        $savefile=$this->upload->do_upload('fileuploadid');
        if ($savefile==true){
          // save record in database
          $data= array('file_name' =>$file,);
          $savefield=$this->SelectModels->editfile($id,$data);
          if ($savefield==true){
            // return success;
            $data=array(
              'users'=>$this->SelectModels->getusers(),
              'positions'=>$this->SelectModels->getpositions(),
              'files'=>$this->SelectModels->getfiles(),
              'success'=>'file saved',
            );
            $this->load->view('admin/index.php',$data);
          }else{
            // return table update error
            $data=array(
              'users'=>$this->SelectModels->getusers(),
              'positions'=>$this->SelectModels->getpositions(),
              'files'=>$this->SelectModels->getfiles(),
              'recorderror'=>'file not saved',
            );
            $this->load->view('admin/index.php',$data);
          }
        } else{
          // return upload error
          // return upload error
          $error=array('errorfile'=>$this->upload->display_errors(),
          'users'=>$this->SelectModels->getusers(),
          'positions'=>$this->SelectModels->getpositions(),
          'files'=>$this->SelectModels->getfiles(),
        );
          $this->load->view('admin/index.php',$error);
        }
      }
    }else {
      if (isset($_SESSION['adminuserlogin'])) {
        $data=array(
          'users'=>$this->SelectModels->getusers(),
          'positions'=>$this->SelectModels->getpositions(),
          'files'=>$this->SelectModels->getfiles(),
          'recorderror'=>'file not saved',
        );
        $this->load->view('admin/index.php',$data);
      } else {
        $this->load->view('admin/home.php');
      }
    }
  }//end of function
  public function statusblock()
  {
    if (!isset($_SESSION['adminuserlogin']) || !isset($_POST['useridvalue'])) {
      $data=array(
        'users'=>$this->SelectModels->getusers(),
        'positions'=>$this->SelectModels->getpositions(),
        'files'=>$this->SelectModels->getfiles(),
      );
      $this->load->view('admin/index.php',$data);
    }else {
      $id=$_POST['useridvalue'];
      $status=$_POST['userstatusid'];
      //block a user
      if ($status=='Active' && isset($_POST['buttonblock'])) {
        $condition=array('email'=>$id,
        'status'=>'Blocked',
      );
      }else {
        $condition=array('email'=>$id,
        'status'=>'Active',
      );
      }
    $status=$this->Register->changeStatus($condition);
    if ($status==true) {
      $data=array(
        'users'=>$this->SelectModels->getusers(),
        'positions'=>$this->SelectModels->getpositions(),
        'files'=>$this->SelectModels->getfiles(),
        'success'=>'User status changed',
      );
      $this->load->view('admin/index.php',$data);
    }else {
      $data=array(
        'users'=>$this->SelectModels->getusers(),
        'positions'=>$this->SelectModels->getpositions(),
        'files'=>$this->SelectModels->getfiles(),
        'recorderror'=>'An error occured, try again.',
      );
      $this->load->view('admin/index.php',$data);
    }
    }
  }//end of function
  public function updatedate()//update application schedule
  {
    if (isset($_SESSION['adminuserlogin'])) {
      // validate form
      $this->form_validation->set_rules('addstartdate','Application start date','required|trim');
      $this->form_validation->set_rules('addclosedate','Application close date','required|trim');
      if ($this->form_validation->run()==TRUE){
        $start=$this->input->post('addstartdate');
        $close=$this->input->post('addclosedate');
        $data = array('	application_start_date' =>$start,
        'application_close_date'=>$close,
      );
        $update=$this->Register->updatedate($data);
        if ($update==true) {
          $data=array(
            'users'=>$this->SelectModels->getusers(),
            'positions'=>$this->SelectModels->getpositions(),
            'files'=>$this->SelectModels->getfiles(),
            'success'=>'Date saved',
          );
          $this->load->view('admin/index.php',$data);
        }else {
          $data=array(
            'users'=>$this->SelectModels->getusers(),
            'positions'=>$this->SelectModels->getpositions(),
            'files'=>$this->SelectModels->getfiles(),
            'recorderror'=>'Unable to save Record',
          );
          $this->load->view('admin/index.php',$data);
        }
      } else {
        $data=array(
          'users'=>$this->SelectModels->getusers(),
          'positions'=>$this->SelectModels->getpositions(),
          'files'=>$this->SelectModels->getfiles(),
        );
        $this->load->view('admin/index.php',$data);
      }
    } else {
      $this->load->view('admin/home.php');
    }
  }//end of function
  public function backaccount()
  {
    $this->load->view('admin/getaccount.php');
  }//end of function
  public function create()
  {
    // validation
    $this->form_validation->set_rules('Useridname','','required|valid_email');
    $this->form_validation->set_rules('useridPassword','','required');
    $this->form_validation->set_rules('useridconfPassword','','required|matches[useridPassword]');
    if ($this->form_validation->run()==TRUE) {
      //save data in data base
      $data=array('password'=>$this->input->post('useridPassword'));
      $email=$this->input->post('Useridname');
      $save=$this->Register->savePassword($data,$email);
      if ($save==TRUE) {
        $data=array('created' =>"Account Created Please Login");
        $this->load->view('admin/getaccount.php',$data);
      } else {
        $data=array('messageDisplay' => "Record Error,Try again");
        $this->load->view('admin/getaccount.php',$data);
      }
    }else {
      $this->load->view('admin/getaccount.php');
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
  	$email->SetFromName='University of World Mission';
  	$mail->Subject = $subj;
  	$mail->Body = $message;
  	$mail->AddAddress($to);
  	if (!$mail->send()){
  			//echo 'Mailer Error: ' . $mail->ErrorInfo;
  			$data=array(
          'users'=>$this->SelectModels->getusers(),
          'positions'=>$this->SelectModels->getpositions(),
          'files'=>$this->SelectModels->getfiles(),
  				'recorderror'=>'Unable to confirm Account Created email,try again or resend email'
  			);
  			$this->load->view('admin/index.php',$data);
  	}else{
  		$data=array(
        'users'=>$this->SelectModels->getusers(),
        'positions'=>$this->SelectModels->getpositions(),
        'files'=>$this->SelectModels->getfiles(),
  			'success'=>'Account Created and Email has been Successfully Sent',
  			);
  			$this->load->view('admin/index.php',$data);
  	}
  }//end of function
  public function addfiledata()
  {
    //validate input
    $this->form_validation->set_rules('userfileid','File Title','required');
    if ($this->form_validation->run()==true){
      //save data
      $data = array('file_usage' => $this->input->post('userfileid'),
      'uploaded_date'=>date('Y:m:d'),
    );
      //load library
      $this->db->insert('files',$data);
       if ($this->db->affected_rows()>0) {
         $data=array(
           'users'=>$this->SelectModels->getusers(),
           'positions'=>$this->SelectModels->getpositions(),
           'files'=>$this->SelectModels->getfiles(),
     			'success'=>'Record saved',
     			);
     			$this->load->view('admin/index.php',$data);
       } else {
         $data=array(
           'users'=>$this->SelectModels->getusers(),
           'positions'=>$this->SelectModels->getpositions(),
           'files'=>$this->SelectModels->getfiles(),
     			'recorderror'=>'Unable to save record,try again',
     			);
     			$this->load->view('admin/index.php',$data);
       }
    } else {
      $data=array(
        'users'=>$this->SelectModels->getusers(),
        'positions'=>$this->SelectModels->getpositions(),
        'files'=>$this->SelectModels->getfiles(),
  			);
  			$this->load->view('admin/index.php',$data);
    }
  }//end of function
  public function changeuser()
  {
    // change student email address
    //validate user input
    $this->form_validation->set_rules('useremailid','Old email','required|valid_email');
    $this->form_validation->set_rules('emailid','New email','required|valid_email');
    if ($this->form_validation->run()==true) {
      // update email address
      $old=$this->input->post('useremailid');
      $data=array('candidate_email' => $this->input->post('emailid'));
      $this->db->where('candidate_email',$old);
  		$this->db->update('candidates',$data);
  		if ($this->db->affected_rows()>0) {
        $data=array(
          'users'=>$this->SelectModels->getusers(),
          'positions'=>$this->SelectModels->getpositions(),
          'files'=>$this->SelectModels->getfiles(),
         'success'=>'Record saved',
         );
         $this->load->view('admin/index.php',$data);
  		} else {
        $data=array(
          'users'=>$this->SelectModels->getusers(),
          'positions'=>$this->SelectModels->getpositions(),
          'files'=>$this->SelectModels->getfiles(),
         'recorderror'=>'Unable to save record,try again',
         );
         $this->load->view('admin/index.php',$data);
  		}
    } else {
      $data=array(
        'users'=>$this->SelectModels->getusers(),
        'positions'=>$this->SelectModels->getpositions(),
        'files'=>$this->SelectModels->getfiles(),
  			);
  			$this->load->view('admin/index.php',$data);
    }

  }
}
 ?>
