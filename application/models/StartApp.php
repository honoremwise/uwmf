<?php
/**
 * This checks whether an application is open or closed
 */
class StartApp extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
	}
	public function checkApplication()
	{
		//get the current time and date
		$date_current=date('Y-m-d',time());
		//retrieve data from database
		$query=$this->db->query('SELECT application_start_date,application_close_date FROM academic_schedule');
		foreach ($query->result() as $value) {
			$start=$value->application_start_date;
			$end=$value->application_close_date;
			$dateendnumber=strtotime($end);
			$currentdate=strtotime($date_current);
		}
		if ($dateendnumber>=$currentdate){
			return true;
		} else {
			return false;
		}
	}
}
?>
