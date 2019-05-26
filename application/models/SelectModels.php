<?php
/**
 * This model is for working with all data access(selection) from database
 */
class SelectModels extends CI_Model
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
		$this->db->select('candidate_email','password','program_code');
		$this->db->from('candidates');
		$this->db->where('candidate_email',$user);
		$this->db->where('password',$pass);
		$this->db->limit(1);
		$query=$this->db->get();
		if ($query->num_rows()==1) {
			$sql=$this->db->query("SELECT program_code,candidate_email,password FROM candidates WHERE candidate_email LIKE '$user'");
			foreach ($sql->result() as $row) {
				$programID=$row->program_code;//
				$validuser=$row->candidate_email;
				$validpass=$row->password;
				if ($validuser==$user && $validpass==$pass) {
					return $programID;
				}else {
					return false;
				}
			}
		} else {
			return false;
		}
	}//end of function definition
	public function saveData($user)
	{
		//select a record from the database to check a valid login
		$query=$this->db->query("SELECT first_name,last_name,program_code FROM candidates WHERE candidate_email LIKE '$user'");
		foreach($query->result() as $row) {
			$first=$row->first_name;
			$last=$row->last_name;
			$program=$row->program_code;
			if ($first!="" && $last!="" && $program!="") {
				return $program;
			}else {
				return FALSE;
			}
		}
	}//end of function definition
	public function savework($user)
	{
		$query=$this->db->query("SELECT denomination,	church_name,church_phone FROM church_information WHERE reference_no LIKE '$user'");
		$values=$query->result_array();
		if (count($values)>0) {
			$query=$this->db->query("SELECT program_code FROM candidates WHERE reference_no LIKE '$user'");
			foreach($query->result() as $row){
				return $row->program_code;
			}
		}else {
			return FALSE;
		}
	}//end of function definition
	public function checkexperience($user)
	{
		$query=$this->db->query("SELECT realwork_cmp,realwork_start FROM church_information WHERE reference_no LIKE '$user'");
		$values=$query->result_array();
		if (count($values)>0){
			foreach ($query->result() as $value) {
				$work=$value->realwork_cmp;
				$date=$value->realwork_start;
			}
			if ($work!="" && $date!="") {
				$query=$this->db->query("SELECT program_code FROM candidates WHERE reference_no LIKE '$user'");
				foreach($query->result() as $row){
					return $row->program_code;
				}
			}else {
				return FALSE;
			}
		}else {
			return FALSE;
		}
	}
	//function to retrieve all emails to check uniqueness while creating account
	public function checkuseremail($condition)
	{
		$resultset=$this->db->get_where("candidates",$condition);
		$elements=$resultset->result_array();
		if (count($elements) >0) {
			return false;
		} else {
			return true;
		}
	}//end of function
	//check if a user is a student
	public function checkstudent($condition)
	{
		$resultset=$this->db->get_where("students",$condition);
		$elements=$resultset->result_array();
		if (count($elements) >0) {
			return true;
		} else {
			return false;
		}
	}//end of function
	public function checkuser($user,$pass)
	{
		$condition=array('email'=>$user,
		'password'=>$pass,
		'status'=>'Active',
	);
	$resultset=$this->db->get_where("users",$condition);
	$elements=$resultset->result_array();
	if (count($elements) >0) {
		return true;
	} else {
		return false;
	}
}//end of function
	public function getusers()
	{
		return $this->db->query("SELECT * FROM users join users_responsabilities using(user_respo_id)")->result();
	}//end of function
	public function getpositions()
	{
		return $this->db->query("SELECT * FROM users_responsabilities")->result();
	}//end of function
	public function getfiles()
	{
		return $this->db->query("SELECT * FROM files")->result();
	}//end of function
	public function checkUserPassword($data)
	{
		$resultset=$this->db->get_where('candidates',$data);
		$values=$resultset->result_array();
		if (count($values)>0) {
			return true;
		}else {
			return false;
		}
	}
	public function resetPassword($data,$email)
	{
		$this->db->where('candidate_email',$email);
		$this->db->update('candidates',$data);
		if ($this->db->affected_rows()>0) {
			return true;
		} else {
			return false;
		}
	}
	public function checkUserexistPassword($data)
	{
		$resultset=$this->db->get_where('users',$data);
		$values=$resultset->result_array();
		if (count($values)>0) {
			return true;
		}else {
			return false;
		}
	}
	public function resetuserPassword($data,$email)
	{
		$this->db->where('email',$email);
		$this->db->update('users',$data);
		if ($this->db->affected_rows()>0) {
			return true;
		} else {
			return false;
		}
	}//end of function
	public function editfile($id,$data)
	{
		$this->db->where('file_id',$id);
		$this->db->update('files',$data);
		if ($this->db->affected_rows()>0) {
			return true;
		} else {
			return false;
		}
	}
}
?>
