<?php
/**
 *only this model is for user to register existing students who did not applied using system
 */
class TempModels extends CI_Model
{

  function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
	}
	public function retrieveprogram()
  {
    $user=$this->session->userdata('username');
    $pass=$this->session->userdata('password');
    $value=$this->db->query("SELECT program_code FROM candidates WHERE candidate_email LIKE '$user'");
    foreach ($value->result() as $row) {
      return $row->program_code;
    }
  }//end of functio definition
	public function checkLogin($user,$pass){
		//check that a user id and username exist in database
    $condition=array(
      'email'=>$user,
      'password'=>$pass,
    );
    $this->db->where('status','Active');
    $data=$this->db->get_where('users',$condition);
    $elements=$data->result_array();
    if (count($elements)) {
      foreach ($data->result() as $row) {
        $emailid=$row->email;
        $passportid=$row->password;
        if ($emailid==$user && $passportid==$pass) {
          return TRUE;
        }
      }
    }else {
      return FALSE;
    }
	}//end of function definition
  public function registerNew($data)//register username and password
	{
    //get the number of candidates in the database of the same date to assign a reference number
    $code=$data['program_code'];
    $yearOnly=substr($data['year_registered'],0,4);
    $gets=$this->db->query("SELECT * from candidates WHERE substr(year_registered,1,4)='$yearOnly' AND program_code='$code'");
    $elements=$gets->result_array();
    $num_elements=count($elements);
    $num_elements++;
    $reference=$yearOnly.$code.$num_elements;
    // query to save data in the database
    $data['reference_no']=$reference;
    $this->db->insert('candidates',$data);
     if ($this->db->affected_rows()>0) {
       //make a candidate an applicant
       return array($reference,$data['program_code']);
     } else{
       return false;
     }
	}//end of function definition
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
			$data['number_of_application']=$number;
			$this->db->where('reference_no',$ref);
		  $this->db->update('applications',$data);
			$prog=$data['program_code'];
      return $prog;
		}else {
			//insert application
			$this->db->insert('applications',$data);
			//redirect
			$prog=$data['program_code'];
			return $prog; //its time to save personal data
		}
	}//end of function
  public function registerBasicData($data)
	{
		    //update data in database where username and password match
		    //retrieve user and password form session variable
		    //update command
        $user=$data['candidate_email'];
		    $this->db->where('candidate_email',$user);
		    $this->db->update('candidates',$data);
        if ($this->db->affected_rows()>0) {
          //If the query runs well make an applicant a student
          //select branch_id, program_code,year_registered,reference_no
          $values=$this->db->get_where('candidates',array('candidate_email'=>$user));
          $elements=$values->result_array();
          if (count($elements)>0) {
            foreach ($values->result() as $row) {
              $reference=$row->reference_no;
              $program=$row->program_code;
              $branch=$row->branch_code;
              $year=$row->year_registered;
              if (!empty($program)) {
                return array($reference,$program,$branch,$year);
              }else {
                return FALSE;
              }
            }
          }else {
            return false;
          }
        }else {//error of update
          return false;
        }
	}//end of function definition
  public function getbranchcode($id){
    $value=$this->db->query("SELECT branch_code FROM branches WHERE branch_id LIKE '$id'");
    foreach ($value->result() as $row) {
      return $row->branch_code;
    }
  }//end of the function
  public function saveStudent($value)
  {
    $data=array(
      'reference_no'=>$value['reference_no'],
      'year_registered'=>$value['year_registered'],
      'registration_no'=>'0',
    );
    //check if student of the same index exist
    $values=$this->db->get_where('students',array('reference_no'=>$value['reference_no']));
	  $elements=$values->result_array();
		if (count($elements)>0) {
      foreach ($values->result() as $row) {
        $regno=$row->registration_no;
        if (!empty($regno)) {
          $reference=$value['reference_no'];
          return array($reference,$regno);
        }else {//run update
          //get number of student registered with the same year as current registered
          $values=$this->db->get_where('students',array('year_registered'=>$data['year_registered']));
          $elements=$values->result_array();
          $numberstudents=count($elements);
          $regno=$value['registration'].$numberstudents;
          //register a registration number and assigns a password as student number
          if ($regno==$_SESSION['student']) {
            $this->db->where('reference_no',$value['reference_no']);
            $this->db->update("students",array('registration_no'=>$regno));
            if ($this->db->affected_rows()>0) {
              $reference=$value['reference_no'];
              $registration=$regno;
              return array($reference,$registration);
            }else {//error of updating
              return false;
            }
          }else {//student number exists
            foreach ($values->result() as $row) {
              $regno=$row->registration_no;
              if (!empty($regno)) {
                $reference=$value['reference_no'];
                return array($reference,$regno);
              }else {//run update
                //get number of student registered with the same year as current registered
                $values=$this->db->get_where('students',array('year_registered'=>$data['year_registered']));
                $elements=$values->result_array();
                $numberstudents=count($elements);
                $regno=$value['registration'].$numberstudents;
                //register a registration number and assigns a password as student number
                if ($regno==$_SESSION['student']) {
                  $this->db->where('reference_no',$value['reference_no']);
                  $this->db->update("students",array('registration_no'=>$regno));
                  if ($this->db->affected_rows()>0) {
                    $reference=$value['reference_no'];
                    $registration=$regno;
                    return array($reference,$registration);
                  }else {//error of updating
                    return false;
                  }
                }else {//student number entered and the one generated are not the same i save the one entered
                  $this->db->where('reference_no',$value['reference_no']);
                  $this->db->update("students",array('registration_no'=>$_SESSION['student']));
                  if ($this->db->affected_rows()>0) {
                    $reference=$value['reference_no'];
                    $registration=$regno;
                    return array($reference,$registration);
                  }else {//error of updating
                    return false;
                  }
                }
              }
            }
          }
        }
      }
    }else {//run insert
      $this->db->insert('students',$data);
      if ($this->db->affected_rows()>0) {
        // give a student a student number and default password
        //get number of student registered with the same year as current registered
        $values=$this->db->get_where('students',array('year_registered'=>$data['year_registered']));
        $elements=$values->result_array();
        $numberstudents=count($elements);
        $regno=$value['registration'].$numberstudents;
        if ($regno==$_SESSION['student']) {//when student number entered is the same as one generated
          //register a registration number and assigns a password as student number
          $this->db->where('reference_no',$value['reference_no']);
          $this->db->update("students",array('registration_no'=>$regno));
          if ($this->db->affected_rows()>0) {
            $reference=$value['reference_no'];
            $registration=$regno;
            return array($reference,$registration);
          }else {//error of updating
            return false;
          }
        }else {//student number entered and the one generated are not the same i save the one entered
          $this->db->where('reference_no',$value['reference_no']);
          $this->db->update("students",array('registration_no'=>$_SESSION['student']));
          if ($this->db->affected_rows()>0) {
            $reference=$value['reference_no'];
            $registration=$regno;
            return array($reference,$registration);
          }else {//error of updating
            return false;
          }
        }
      }else {//error of saving student
        return false;
      }
    }
  }//end of function definition
  public function savePassword($password,$reference)
  {
    // update table based on reference
    $this->db->where('reference_no',$reference);
    $this->db->update("candidates",array('password'=>$password));
    if ($this->db->affected_rows()>0) {
      return true;
    }else {
      return false;
    }
  }
  public function retrieveReference($data)
  {
    $values=$this->db->get_where('students',$data);
    $elements=$values->result_array();
    if (count($elements)>0) {
      foreach ($values->result() as $row) {
        $reference=$row->reference_no;
        $date=$row->year_registered;
        return array($reference,$date);
      }
    }else {
      return false;
    }
  }//end of the function
  public function work_experience($data)
	{
		//register church information and candidate experience(certificate && diploma)
		//retrieve reference number for this id
		$ref=$data['reference_no'];
		$reference=$this->db->query("SELECT reference_no FROM church_information WHERE reference_no LIKE '$ref'");
		$elements=$reference->result_array();
		if (count($elements)>0) {
			unset($data['reference_no']);
      unset($data['studentnumber']);
			$this->db->where('reference_no',$ref);
		  $this->db->update('church_information',$data);
			//redirect to the next page (inex)
      if ($this->db->affected_rows()>0) {
        return true;
      }else {
        return false;
      }
		}else {
			//run insert instead of updating
      unset($data['studentnumber']);
			$this->db->insert('church_information',$data);
			//redirect to the next page(index)
			if ($this->db->affected_rows()>0) {
        return true;
      }else {
        return false;
      }
		}
	}//end of the function
  public function job_experience($data)
	{
		$ref=$data['reference_no'];
		unset($data['reference_no']);
		$this->db->where('reference_no',$ref);
		$this->db->update('church_information',$data);
		if ($this->db->affected_rows()>0) {
      return true;
    }else {
      return false;
    }
	}//end of the function
  public function cert_files_upload($file,$field,$reference)
  {
    $data=array(
    $field=>$file,
    );
    //update command
    $this->db->where('reference_no',$reference);
    $this->db->update('candidates',$data);
    //get the program code to know which page to load
    if ($this->db->affected_rows()>0) {
      return true;
    }else {
      return false;
    }
  }//end of the function
  public function getuser($value)
  {
    $values=$this->db->get_where('students',array('registration_no'=>$value));
    $elements=$values->result_array();
    if (count($elements)>0) {
      foreach ($values->result() as $row) {
        $ref=$row->reference_no;
        //retrieve email address
        $value=$this->db->query("SELECT candidate_email FROM candidates WHERE reference_no like '$ref'");
        $elements=$value->result_array();
        if (count($elements)>0) {
          foreach ($value->result() as $get) {
            return $get->candidate_email;
          }
        }else {
          return false;
        }
      }
    }else {
      return false;
    }
  }//end of function
  public function updateData($data)
  {
    $cond=$data['reference_no'];
    unset($data['reference_no']);
    $this->db->where('reference_no',$cond);
    $this->db->update('candidates',$data);
    if ($this->db->affected_rows()>0) {
      return true;
    }else {
      return false;
    }
  }//end of function
  public function churchdata($data,$reference)
  {
    $this->db->where('reference_no',$reference);
    $this->db->update('church_information',$data);
    if ($this->db->affected_rows()>0) {
      return true;
    }else {
      return false;
    }
  }//end of function
  public function academicrecord($data,$reference)
  {
    $this->db->where('reference_no',$reference);
    $this->db->update('candidates',$data);
    if ($this->db->affected_rows()>0) {
      return true;
    }else {
      return false;
    }
  }//end of function
  public function checkuser($data)
  {
    $values=$this->db->get_where('students',array('registration_no'=>$data['registration_no']));
    $elements=$values->result_array();
    if (count($elements)>0) {
      $user=$_SESSION['validuser'];
      $marks=$data['points'];
      $date=$data['date'];
      //get user id and marks grade
      $gradeUser=$this->db->query("SELECT users.user_id, grades.grade,grades.establishement_date FROM users,grades WHERE users.email='$user' AND grades.lowerbound<='$marks' AND grades.upperbound >='$marks' AND grades.establishement_date<='$date'")->result();
      if (count($gradeUser)>0) {
        foreach ($gradeUser as $row) {
          return(array($row->user_id,$row->grade));//add marks
        }
      }else {
        return false;
      }
    }else {
      return false;
    }
  }//end of function
  public function addMarks($values)
  {
    //check if marks already recorded
    $check=$this->db->get_where('marks',array('registration_no'=>$values['registration_no'],'module_id'=>$values['module_id']));
    $el=$check->result_array();
    if (count($el)>0){
      return false;
    }else {
      //run insert
      $sql=$this->db->insert('marks',$values);
      if ($this->db->affected_rows()>0) {
        return true;
      }else {
        return false;
      }
    }
  }//end of function
  public function updatenumber($regno,$newregno)
  {
    //check that a user id and username exist in database
    $condition=array(
      'registration_no'=>$regno,
    );
    $data=$this->db->get_where('students',$condition);
    $elements=$data->result_array();
    if (count($elements)>0) {
      // user exist, update query
      $data=array('registration_no'=>$newregno);
      $this->db->where('registration_no',$regno);
      $this->db->update('students',$data);
      $this->db->update('learning_status',$data);
      if ($this->db->affected_rows()>0) {
        return true;
      }else {
        return false;
      }
    }else {
      return false;
    }
  }//end of function
  public function checkMarks($cond)
  {
    $regno=$cond['registration_no'];
    $mod=$cond['module_id'];
    $checkvalues=$this->db->query("SELECT registration_no,module_id FROM marks WHERE registration_no='$regno' AND module_id='$mod'")->result();
    if (count($checkvalues)>0) {
      $mark=$cond['marks'];
      $dt=$cond['date'];
      $sqlvalue=$this->db->query("SELECT grade,establishement_date FROM grades WHERE lowerbound<='$mark' AND upperbound >='$mark' AND establishement_date<='$dt'")->result();
      if (count($sqlvalue)>0) {
        foreach ($sqlvalue as $grades) {
          $grade=$grades->grade;
          $date=$grades->establishement_date;
        }
        //update
        $data=array(
          'points'=>$mark,
          'addition_date'=>$date,
          'grade'=>$grade,
        );
        $this->db->where('module_id',$mod);
        $this->db->where('registration_no',$regno);
        $this->db->update('marks',$data);
        if ($this->db->affected_rows()>0) {
          return true;
        }else {
          return false;
        }
      }else {
        return false;
      }
    } else {
      return false;
    }
  }//end of function
  public function learningStatus($data)
  {
    //check current status
    $values=$this->db->get_where('learning_status',array('registration_no'=>$data['registration_no'],'status'=>'Active'));
    $el=$values->result_array();
    if (count($el)>0){
      return false;
    }else {
      //insert learning status
      $this->db->insert('learning_status',$data);
      if ($this->db->affected_rows()>0) {
      return true;
      }else {
      return false;
      }
    }
  }//end of function
  public function checkData($regno)
  {
    $gets=$this->db->query("SELECT * FROM students join candidates using(reference_no) join applications using (reference_no) join church_information using(reference_no) where applications.application_status!='pending' AND students.registration_no='$regno'");
    $elements=$gets->result_array();
    if (count($elements)>0) {
      foreach ($gets->result() as $values) {
        $idnumber=$values->id_passport;
        $deno=$values->denomination;
        $marks=$values->points;
        $regno=$values->registration_no;
        $password=$values->password;
        $email=$values->candidate_email;
      }
      //if (!empty($idnumber) && !empty($deno) && !empty($marks)) {
      if (!empty($idnumber) && !empty($deno)) {
        //return username and password
        $rg=$regno;
        $ps=$password;
        $email=$email;
        return array($rg,$ps,$email);
      }else {
        return false;
      }
    }else{
      return false;
    }
  }//end of function
  public function applicantreference($regno)
  {
    $gets=$this->db->query("SELECT * FROM students join candidates using(reference_no) join applications using (reference_no) where students.registration_no='$regno'");
    $elements=$gets->result_array();
    if (count($elements)>0) {
      foreach ($gets->result() as $values) {
        $reference=$values->reference_no;
        if (!empty($reference)) {
          return $reference;
        }else {
          return false;
        }
      }
    }else {
      return false;
    }
  }//end of function
}//end of class definition
?>
