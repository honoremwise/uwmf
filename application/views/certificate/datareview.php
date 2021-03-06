<?php
$CI = &get_instance();
$CI->load->database();
$host= $CI->db->hostname;
$pass=$CI->db->password;
$user=$CI->db->username;
$myconnection= mysqli_connect($host,$user,$pass);
if ($myconnection && mysqli_select_db($myconnection,'uwmf') && isset($_SESSION['username'])) {
  // select required data from database
  $condition=array(
    'candidate_email'=>$_SESSION['username'],
  );
  $data=$CI->db->get_where('candidates',$condition);
  $elements=$data->result_array();
  if (count($elements)>0) {
    foreach ($data->result() as $row) {
      $reference=$row->reference_no;$prog=$row->program_code;$bracode=$row->branch_code;$fname=$row->first_name;
      $lname=$row->last_name;$email=$row->candidate_email;$tel=$row->candidate_telephone;
      $passport=$row->id_passport;$date=$row->dob;$gender=$row->gender;$nat=$row->nationality;$pro=$row->address_province;
      $dist=$row->address_district;$addr=$row->current_address;
      $college=$row->college_name;$lanaguage=$row->native_language;$edu=$row->education_background;
      $colg=$row->college_name;$sub=$row->previous_subject;$grdate=$row->date_graduated;$hgdegree=$row->highest_degree;
      $colglocation=$row->college_location;$proficny=$row->english_proficiency;$photo=$row->photo;$idcopy=$row->scanned_id;
      $degreefile=$row->degree_copy;$brtcert=$row->birth_certificate;$recolet=$row->recomm_letter;$mot_letr=$row->motivation_letter;
      if (empty($fname)) {
        $tel="";
        $date="";
        $grdate="";
        $gender="";
      }
      //get all programs
      $groups=getallprograms($CI);
      //get program name
      $condpro=array(
        'program_code'=>$prog,
      );
      $condbran=array(
        'branch_code'=>$bracode,
      );
      $cn=array('reference_no'=>$reference,);
      $program=getapplications($condpro,$CI);
      $branch=getbranches($condbran,$CI)[0];
      $location=getbranches($condbran,$CI)[1];
      $profilepic='profiles/'.$photo;
      $churches=getexperience($cn,$CI);
      if (empty($churches['realwork_cmp'])) {
        $churches['realwork_start']="";
      }
      if (!isset($churches['denomination'])) {
        $churches=array(
         'denomination' => '','church_name' => '',
         'church_address' => '','church_phone' => "",
         'church_pastor' => '','otherwork_cmp' => '','otherwork_position' => '',
         'otherwork_startdate' => '', 'otherwork_province' => '' ,
         'otherwork_district' => '', 'realwork_cmp' => '',
         'realwork_pos' => '', 'realwork_start' => '' ,
         'realwork_pro' => '', 'realwork_dist' => '', );
      }
    }
  }else {//retrieve error
    // redirect to another page
    exit('No records');
   }
}else {
  die('Could not establish a database connection');
}
//function to retrieve application details
function getapplications($Condition,$CI){
  //select program
  $progm=$CI->db->get_where('programs',$Condition);
  //$pro=$this->db->query("SELECT program_name FROM programs WHERE program_code LIKE '$pro'");
  foreach ($progm->result() as $row) {
    return $row->program_name;
  }
}
//function to retrieve branches
function getbranches($cond,$CI)
{
  // select branch to study
  $bran=$CI->db->get_where('branches',$cond);
  foreach ($bran->result() as $row) {
    $br=$row->branch_name;
    $loc=$row->branch_location;
    return array($br,$loc);
  }
}
//function to retrieve applicant experience
function getexperience($cn,$CI){
  $exp=$CI->db->get_where('church_information',$cn);
  $elements=$exp->result_array();
  if ($elements>0) {
    $results = $exp->row_array();
    return $results;
  }else {//no records to show
  }
}//end of function
function getallprograms($CI)
{
  return $CI->db->query('SELECT program_code,program_name FROM programs')->result();
}//end of function
 ?>
