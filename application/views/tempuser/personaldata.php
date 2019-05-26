     <div class="row jumbotron-content" style="width:100%;">
				<form role="form" name="userapplicationmain" action="<?php echo base_url();?>index.php/TempLoad/registerData" method="post" id="userapplicationmain">
					<div class="col-xs-10 col-sm-10 col-md-12 col-lg-12">
						<h4>Basic Information</h4>
					</div>
					<div class="form-group col-xs-10 col-sm-10 col-md-6 col-lg-6">
						<label for="firstname">Firstname</label><span id="error_fname"></span>
						<input type="text" name="CandidateFname" class="form-control"  id="CandidateFname" required>
					</div>
					<div class="form-group col-xs-10 col-sm-10 col-md-6 col-lg-6">
						<label for="lastname">Lastname</label><span id="error_lname"></span>
						<input type="text" name="CandidateLname" class="form-control"  id="CandidateLname" required>
					</div>
          <div class="form-group col-xs-10 col-sm-10 col-md-6 col-lg-6">
            <label for="student number">Student number</label>
            <input type="text" name="candidatenumber" id="Candidatenumber" class="form-control" required>
          </div>
					<div class=" form-group col-xs-10 col-sm-10 col-md-6 col-lg-6">
						<label for="email">Email</label><span id="error_email"></span>
						<input type="email" name="CandidateEmail" class="form-control"  id="CandidateEmail" required>
					</div>
					<div class="form-group col-xs-10 col-sm-10 col-md-6 col-lg-6">
						<label for="telephone">Telephone</label><span id="error_telephone"></span>
						<input type="number" name="CandidatePhone" class="form-control"  id="CandidatePhone" required>
					</div>
					<div class="form-group col-xs-10 col-sm-10 col-md-6 col-lg-6">
						<label for="IDNumber">ID Number/Passport</label><span id="error_idnumber"></span>
						<input type="text" name="CandidateIDnumber" class="form-control"  id="CandidateIDnumber" required>
					</div>
					<div class=" form-group col-xs-10 col-sm-10 col-md-6 col-lg-6">
						<label for="gender">Gender</label><span id="error_gender"></span>
						<select class="form-control" name="CandidateGender" id="CandidateGender" required>
							<option value="Male">Male</option>
							<option value="Female">Female</option>
						</select>
					</div><!-- Four columns to be diplayed horizontally  -->

					<div class="form-group col-xs-10 col-sm-10 col-md-6 col-lg-6">
						<label for="date">Date of birth</label><span id="error_date"></span>
						<input type="text" name="CandidateBirthDate" class="form-control" placeholder="yyy-mm-dd"  id="CandidateBirthDate" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" title="Enter Date in format: yyy-mm-dd" required>
					</div>
					<div class="form-group col-xs-10 col-sm-10 col-md-6 col-lg-6">
						<label for="nationality">Nationality(Citizenship)</label><span id="error_nationality"></span>
						<input type="text" name="CandidateNationality" class="form-control"  id="CandidateNationality" required>
					</div>

					<div class="form-group col-xs-10 col-sm-10 col-md-6 col-lg-6">
						<label for="provice">Province/City of birth</label><span id="error_province"></span>
						<input type="text" name="CandidateProvince" class="form-control"  id="CandidateProvince" required>
					</div>
					<div class="form-group col-xs-10 col-sm-10 col-md-6 col-lg-6">
						<label for="district">District of birth</label><span id="error_district"></span>
						<input type="text" name="CandidateDistrict" class="form-control"  id="CandidateDistrict" required>
					</div>

					<div class="form-group col-xs-10 col-sm-10 col-md-6 col-lg-6">
						<label for="address">Current Address</label><span id="error_address"></span>
						<input type="text" name="candidateaddress" class="form-control" placeholder="Province/district"  id="candidateaddress" required>
					</div>
          <div class=" form-group col-xs-10 col-sm-10 col-md-6 col-lg-6">
						<label for="universityBranch">University Branch to attend</label><span id="error_branch"></span>
						<select name="Candidatebranch" class="form-control" id="Candidatebranch">
							<?php foreach($branches as $each){ ?>
              <option value="<?php echo $each->branch_code; ?>"><?php echo $each->branch_name; ?></option>';<?php } ?>
						</select>
					</div>
					<div class="form-group col-xs-10 col-sm-10 col-md-6 col-lg-6">
						<label for="englishlevel">Level of English</label><span id="error_english"></span>
						<select class="form-control" name="Candidateenglish" id="Candidateenglish">
							<option value="Poor">Poor</option>
							<option value="Intermediate">Intermediate</option>
							<option value="Good">Good</option>
							<option value="Very Good">Very Good</option>
						</select>
					</div>
					<div class="form-group col-xs-10 col-sm-10 col-md-6 col-lg-6">
						<label for="nativelanguage">Native language(s)</label><span id="error_native"></span>
						<input type="text" name="CandidateNative" class="form-control" id="CandidateNative" required>
					</div>
					<div class="form-group col-xs-10 col-sm-10 col-md-6 col-lg-6">
						<label for="studyLevel">Previous Level</label><span id="error_level"></span>
						<select class="form-control" name="Candidatestudy" id="Candidatestudy">
              <option value="Primary education">Primary education</option>
							<option value="Ordinary level">Ordinary level Completion</option>
							<option value="High school">High school completion</option>
							<option value="Diploma">Diploma</option>
							<option value="Bachelors">Bachelors degree</option>
							<option value="Masters">Masters degree</option>
						</select>
					</div>

					<div class="form-group col-xs-10 col-sm-10 col-md-6 col-lg-6">
						<label for="mojor">Mojor Field(Study subject)</label><span id="error_fieldstudy"></span>
						<input type="text" name="candidatemajor" class="form-control" id="candidatemajor" required>
					</div>

					<div class="form-group col-xs-10 col-sm-10 col-md-6 col-lg-6">
						<label for="graduatedate">Date graduated</label><span id="error_graduatedate"></span>
						<input type="text" name="candidategraduation" class="form-control" placeholder="yyy-mm-dd"  id="candidategraduation" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" title="Enter Date in format: yyy-mm-dd" required>
					</div>

					<div class="form-group col-xs-10 col-sm-10 col-md-6 col-lg-6">
						<label for="school">University/School name</label><span id="error_schoolname"></span>
						<input type="text" name="candidateschool" class="form-control"  id="candidateschool">
					</div>
					<div class="form-group col-xs-10 col-sm-10 col-md-6 col-lg-6">
						<label for="schoollocation">Location</label><span id="error_schoollocation"></span>
						<input type="text" name="candidatelocation" placeholder="Country/Provice/city(district)"class="form-control"  class="form-control" id="candidatelocation" required>
					</div>
					<div class="form-group col-xs-10 col-sm-10 col-md-12 col-lg-12">
						<label for="studyLevel">Degree Awarded</label><span id="error_degree"></span>
						<select class="form-control" name="studydegree" id="studydegree">
              <option value="Primary level Completion">Primary level completion</option>
							<option value="Ordinary level">Ordinary level certificate</option>
							<option value="Advanced Certificate">Advanced Certificate</option>
							<option value="Diploma">Diploma</option>
							<option value="Bachelors degree">Bachelors degree</option>
							<option value="Masters degree">Masters degree</option>
						</select>
					</div>
					<div class="col-xs-10 col-sm-10 col-md-6 col-lg-6">
            <input type="submit" name="submitMainData" value="Add Student" class="btn btn-primary">
					</div>
				</form>
			</div>
