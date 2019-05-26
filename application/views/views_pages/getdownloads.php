<?php
$CI = &get_instance();
$CI->load->database();
$host= $CI->db->hostname;
$pass=$CI->db->password;
$user=$CI->db->username;
$myconnection= mysqli_connect($host,$user,$pass,'uwmf');
if ($myconnection && isset($_SESSION['username'])) {
  // get all required file to be downloaded by an applicant
  $records=$CI->db->get_where('files');
  $elements=$records->result_array();
  if (count($elements)>0) {
    $files=$records->result();
    $checkfile=true;
  }else {
    $checkfile=false;
  }
} else {
  die('Could not establish the server connection');
}
 ?>
