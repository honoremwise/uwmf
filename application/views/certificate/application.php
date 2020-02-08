<?php
if (empty($fname)) {
  $tel="";
  $date="";
  $grdate="";
  $gender="";
}
 ?>
 <?php
 require_once(APPPATH.'views/views_pages/pageheader.php');
 require_once(APPPATH.'views/certificate/datareview.php');
 require_once(APPPATH.'views/certificate/include.php');
 ?>

	<div class="container">
    <div class="row">
			<div class="col-md-4"></div>
			<div class="col-md-4">
				<img class="img-circle" src="<?php echo base_url();?>css_scripts/vendor/datatables/images/test.png" alt="logo" width="150" height="150">
			</div>
			<div class="col-md-4"></div>
		</div>
    <h5 style="color: #fff">University application|Basic Information</h5>
		<div class="form-error">
			<?php echo validation_errors('<div class="alert alert-danger" style="height:1px;">','</div>');?>
		<div class="jumbotron">
			<div class="row jumbotron-content">
				<div style="color:red; padding-bottom:30px;">
	        <?php
	        if(isset($messageDisplay)){
	          echo $messageDisplay;
	        }
	        ?>
	      </div>
				<form name="userapplicationmain" action="<?php echo site_url();?>Cert_diploma_load_data/" id="userapplicationmain" method="post">
					<div class="form-group col-xs-10 col-sm-10 col-md-6 col-lg-6">
						<label for="firstname">Firstname</label><span id="error_fname"></span>
						<input type="text" name="CandidateFname" class="form-control" id="CandidateFname" value="<?php echo $fname; ?>" required>
					</div>
					<div class="form-group col-xs-10 col-sm-10 col-md-6 col-lg-6">
						<label for="lastname">Lastname</label><span id="error_lname"></span>
						<input type="text" name="CandidateLname" class="form-control" value="<?php echo $lname; ?>" id="CandidateLname" required>
					</div>

					<div class=" form-group col-xs-10 col-sm-10 col-md-6 col-lg-6">
						<label for="email">Email</label>
						<input type="email" name="CandidateEmail" class="form-control" value="<?php echo $email; ?>" id="CandidateEmail" required>
					</div>
					<div class="form-group col-xs-10 col-sm-10 col-md-6 col-lg-6">
						<label for="telephone">Telephone</label><span id="error_telephone"></span>
						<input type="number" name="CandidatePhone" class="form-control" value="<?php echo $tel; ?>"id="CandidatePhone" required>
					</div>

					<div class="clearfix"></div>
					<div class="form-group col-xs-10 col-sm-10 col-md-6 col-lg-6">
						<label for="IDNumber">ID Number/Passport</label><span id="error_idnumber"></span>
						<input type="text" name="CandidateIDnumber" class="form-control" value="<?php echo $passport;  ?>" id="CandidateIDnumber" required>
					</div>
					<div class=" form-group col-xs-10 col-sm-10 col-md-6 col-lg-6">
						<label for="gender">Gender</label><span id="error_gender"></span>
						<select class="form-control" name="CandidateGender" id="CandidateGender">
							<option value="<?php echo $gender; ?>" selected><?php echo $gender; ?></option>
							<option value="Male">Male</option>
							<option value="Female">Female</option>
						</select>
					</div><!-- Four columns to be diplayed horizontally  -->

					<div class="form-group col-xs-10 col-sm-10 col-md-6 col-lg-6">
						<label for="date">Date of birth</label><span id="error_date"></span>
						<input type="text" name="CandidateBirthDate" class="form-control" placeholder="yyyy-mm-dd" value="<?php echo $date; ?>" id="CandidateBirthDate" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" title="Enter Date in format: yyy-mm-dd" required>
					</div>
					<div class="form-group col-xs-10 col-sm-10 col-md-6 col-lg-6">
						<label for="nationality">Nationality(Citizenship)</label></label><span id="error_nationality"></span>
						<input type="text" name="CandidateNationality" class="form-control" value="<?php echo $nat; ?>" id="CandidateNationality" required>
					</div>

					<div class="form-group col-xs-10 col-sm-10 col-md-6 col-lg-6">
						<label for="provice">Province/City of birth</label><span id="error_province"></span>
						<input type="text" name="CandidateProvince" class="form-control" value="<?php echo $pro; ?>" id="CandidateProvince" required>
					</div>
					<div class="form-group col-xs-10 col-sm-10 col-md-6 col-lg-6">
						<label for="district">District of birth</label><span id="error_district"></span>
						<input type="text" name="CandidateDistrict" class="form-control" value="<?php echo $dist; ?>" id="CandidateDistrict" required>
					</div>

					<div class="form-group col-xs-10 col-sm-10 col-md-6 col-lg-6">
						<label for="address">Current Address</label><span id="error_address"></span>
						<input type="text" name="candidateaddress" class="form-control" value="<?php echo $addr; ?>" id="candidateaddress" required>
					</div>
          <div class=" form-group col-xs-10 col-sm-10 col-md-6 col-lg-6">
						<label for="universityBranch">University Branch to attend</label><span id="error_branch"></span>
						<select name="Candidatebranch" class="form-control" id="Candidatebranch">
							<option value="<?php echo $bracode; ?>" selected><?php echo $branch; ?></option>
							<?php foreach($branches as $each){ ?>
              <option value="<?php echo $each->branch_code; ?>"><?php echo $each->branch_name; ?></option>';<?php } ?>
						</select>
					</div>
					<div class="clearfix"></div>
					<div class="form-group col-xs-10 col-sm-10 col-md-6 col-lg-6">
						<label for="englishlevel">Level of English</label><span id="error_english"></span>
						<select class="form-control" name="Candidateenglish" id="Candidateenglish">
							<option value="<?php echo $proficny ?>" selected><?php echo $proficny; ?></option>
							<option value="Poor">Poor</option>
							<option value="Intermediate">Intermediate</option>
							<option value="Good">Good</option>
							<option value="Very Good">Very Good</option>
						</select>
					</div>
					<div class="form-group col-xs-10 col-sm-10 col-md-6 col-lg-6">
						<label for="nativelanguage">Native language(s)</label><span id="error_native"></span>
						<input type="text" name="CandidateNative" class="form-control" value="<?php echo $lanaguage; ?>" id="CandidateNative" required>
					</div>
					<div class="form-group col-xs-10 col-sm-10 col-md-6 col-lg-6">
						<label for="studyLevel">Previous Level</label><span id="error_level"></span>
						<select class="form-control" name="Candidatestudy" id="Candidatestudy">
							<option value="<?php echo $edu; ?>" selected><?php echo $edu;?></option>
							<option value="High school">High school</option>
							<option value="Ordinary level">Ordinary level Completion</option>
						</select>
					</div>

					<div class="form-group col-xs-10 col-sm-10 col-md-6 col-lg-6">
						<label for="mojor">Field of Study(Subject)</label><span id="error_fieldstudy"></span>
						<input type="text" name="candidatemajor" class="form-control" value="<?php echo $sub; ?>" id="candidatemajor" required>
					</div>

					<div class="form-group col-xs-10 col-sm-10 col-md-6 col-lg-6">
						<label for="graduatedate">Date graduated</label><span id="error_graduatedate"></span>
						<input type="text" name="candidategraduation" class="form-control" placeholder="yyyy-mm-dd" value="<?php echo $grdate; ?>" id="candidategraduation" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" title="Enter Date in format: yyy-mm-dd" required>
					</div>
					<div class="form-group col-xs-10 col-sm-10 col-md-6 col-lg-6">
						<label for="school">School name</label><span id="error_schoolname"></span>
						<input type="text" name="candidateschool" class="form-control" value="<?php echo $college; ?>" id="candidateschool" required>
					</div>
					<div class="form-group col-xs-10 col-sm-10 col-md-6 col-lg-6">
						<label for="schoollocation">Location</label><span id="error_schoollocation"></span>
						<input type="text" name="candidatelocation" class="form-control" value="<?php echo $colglocation; ?>" id="candidatelocation" placeholder="Province/district" required>
					</div>
          <div class="form-group col-xs-10 col-sm-10 col-md-6 col-lg-6">
						<label for="studyLevel">Degree Awarded</label><span id="error_degree"></span>
						<select class="form-control" name="studydegree" id="studydegree">
              <option value="<?php echo $hgdegree; ?>" selected><?php echo $hgdegree;?></option>
							<option value="Advanced Certificate">Advanced Certificate</option>
							<option value="Ordinary level certificate">Ordinary level certificate</option>
						</select>
					</div>
					<!-- submit button -->
					<div class="clearfix"></div>
          <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
            <input type="submit" name="submitMainForm" value="Save and Continue" class="btn btn-outline btn-primary pull-right">
          </div>
          <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
            <a href="<?php echo site_url();?>Save_step?pageapplication" id="applicationidpage"class="btn btn-outline btn-primary">Go next</a>
          </div>
				</form>
			</div>
		</div>
    <?php require_once(APPPATH.'views/views_pages/copy.php'); ?>
	</div>
</body>
</html>
