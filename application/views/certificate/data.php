<?php
$CI = &get_instance();
$CI->load->database();
$host= $CI->db->hostname;
$pass=$CI->db->password;
$user=$CI->db->username;
$myconnection= mysqli_connect($host,$user,$pass);
if ($myconnection && mysqli_select_db($myconnection,'uwmf') && !empty($_SESSION['username'])){
  require_once(APPPATH.'views/certificate/include.php');
  require_once(APPPATH.'views/user/header.php');
  //get student registration number
  $user=$_SESSION['username'];
  $regno=$CI->db->query("SELECT * FROM students JOIN candidates USING(reference_no) WHERE candidates.candidate_email='$user'");
  foreach ($regno->result() as $value) {
    $reg=$value->registration_no;
    $photo=$value->photo;
    $degree=$value->degree_copy;
    $idcard=$value->scanned_id;
    $transcript=$value->transcript;
    $pro=$value->program_code;
    $first=$value->first_name;
    $last=$value->last_name;
    $statement=$value->statement_faith;
    $motiv=$value->motivation_letter;
    $recommend=$value->recomm_letter;
    $bd=$value->birth_certificate;
  }
//get all students marks
$getall=getresults($CI,$reg);
//get users
$users=getusers($CI);
//get notifications
$notifications=getlastmessage($CI,$reg);
// getpayementlist
$payementlist=getpayementlist($CI,$pro);
//get payed list
$payed=getpayed($CI,$reg);
}else {
die('Unable to connect to the database server');
}
function getresults($CI,$reg){ //get all marks
if (!empty($reg)){
  $sqlval=$CI->db->query("SELECT * FROM `marks` join modules using(module_id) join grades USING (grade) join users using(user_id) WHERE registration_no='$reg'");
  $count=$sqlval->result_array();
  if (count($count)>0) {
    $marks=$sqlval->result();
    return $marks;
  }else {
    return array('module_code'=>'','module_name'=>'','points'=>'','letter'=>'','addition_date'=>'');
  }
}else {//no such session
  return false;
}
}//end of function
function getpayed($CI,$reg)
{
return $CI->db->query("SELECT * FROM students_payment join payments USING(id) where registration_no='$reg'")->result();
}
function getusers($CI)
{
return $CI->db->query("SELECT * from users join users_responsabilities USING(user_respo_id) WHERE users.email!='superuser.uwmf@gmail.com' <>12")->result();
}//end of function
function getlastmessage($CI,$reg)
{
return $CI->db->query("SELECT * from notifications  WHERE receiver LIKE '$reg'")->result();
}//end of function
function getpayementlist($CI,$pro)
{
return $CI->db->query("SELECT * from payments join programs using(program_id) where program_code='$pro'")->result();
}
 ?>
