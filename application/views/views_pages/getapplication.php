<?php
$CI = &get_instance();
$CI->load->database();
$host= $CI->db->hostname;
$pass=$CI->db->password;
$user=$CI->db->username;
$myconnection= mysqli_connect($host,$user,$pass);
if ($myconnection && mysqli_select_db($myconnection,'uwmf')) {
  // select required data from database
  $condition=array(
    'candidate_email'=>$_SESSION['username'],
  );
  $data=$CI->db->get_where('candidates',$condition);
  $elements=$data->result_array();
  if (count($elements)>0) {
    foreach ($data->result() as $row) {
    $reference=$row->reference_no;
    }
    $condapplication=array(
      'reference_no'=>$reference,
    );
    $numberapp=getapplication($condapplication,$CI)[0];
    $yearapp=getapplication($condapplication,$CI)[1];
    $yearOnly=substr($yearapp,0,4);
    $currentyear=date("Y");
  }else {//retrieve error
    // redirect to another page
    exit('An error occured, please try again');
   }
}else {
  die('Could not establish a database connection');
}
//function to retrieve application details
function getapplication($cond,$CI)
{
  // select branch to study
  $details=$CI->db->get_where('applications',$cond);
  foreach ($details->result() as $row) {
    $numberapplications=$row->number_of_application;
    $yearapplication=$row->year_last_application;
    return array($numberapplications,$yearapplication);
  }
}
 ?>
