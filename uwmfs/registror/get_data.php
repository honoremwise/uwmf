<?php include('db.php');?>

<?php

if (isset($_POST['continent_id'])) {
	
	$qry = "select * from countries where continent_id=".mysqli_real_escape_string($con,$_POST['continent_id'])." order by country";
	$res = mysqli_query($con, $qry);
	if(mysqli_num_rows($res) > 0) {
		echo '<option value="">------- Select -------</option>';
		while($row = mysqli_fetch_object($res)) {
			echo '<option value="'.$row->country_id.'">'.$row->country.'</option>';
		}
	} else {
		echo '<option value="">No Record</option>';
	}

} else if(isset($_POST['country_id'])) {

	$qry = "select * from states where country_id=".mysqli_real_escape_string($con,$_POST['country_id'])." order by state";
	$res = mysqli_query($con, $qry);
	if(mysqli_num_rows($res) > 0) {
		echo '<option value="">------- Select -------</option>';
		while($row = mysqli_fetch_object($res)) {
			echo '<option value="'.$row->state_id.'">'.$row->state.'</option>';
		}
	} else {
		echo '<option value="">No Record</option>';
	}

} else if(isset($_POST['state_id'])) {

	$qry = "select * from cities where state_id=".mysqli_real_escape_string($con,$_POST['state_id'])." order by city";
	$res = mysqli_query($con, $qry);
	if(mysqli_num_rows($res) > 0) {
		echo '<option value="">------- Select -------</option>';
		while($row = mysqli_fetch_object($res)) {
			echo '<option value="'.$row->city_id.'">'.$row->city.'</option>';
		}
	} else {
		echo '<option value="">No Record</option>';
	}
}

?>