<form name="userapplicationexperience" action="<?php echo base_url();?>index.php/TempLoad/addexperience" method="post" id="userapplicationexperience">
  <div class="row">
    <div class="clearfix"></div>
    <div class="col-xs-10 col-sm-10 col-md-6 col-lg-6">
      <div class="col-xs-10 col-sm-10 col-md-12 col-lg-12">
        <h5>Church Information</h5>
      </div>
      <div class="form-group col-xs-10 col-sm-10 col-md-12 col-lg-12">
        <label for="denomination">Denomination</label>
        <input type="text" name="candidatedenomination" class="form-control" required>
      </div>
      <div class="form-group col-xs-10 col-sm-10 col-md-12 col-lg-12" required>
  			<label for="churchname">Name of the Church</label>
  			<input type="text" name="candidatechurch" class="form-control" required>
  		</div>
      <div class="form-group col-xs-10 col-sm-10 col-md-12 col-lg-12" required>
  			<label for="address">Address</label>
  			<input type="text" name="churchaddress" class="form-control" required>
  		</div>
      <div class="form-group col-xs-10 col-sm-10 col-md-12 col-lg-12" required>
  			<label for="Telephone">Phone</label>
  			<input type="number" name="contactPhone" class="form-control" required>
  		</div>
      <div class="form-group col-xs-10 col-sm-10 col-md-12 col-lg-12" required>
  			<label for="pastor">Names of the Pastor</label>
  			<input type="text" name="pastorName" class="form-control" required>
  		</div>
    </div>
    <div class="col-xs-10 col-sm-10 col-md-6 col-lg-6">
      <div class="col-xs-10 col-sm-10 col-md-12 col-lg-12">
        <h5>Experience in church positions</h5>
      </div>
      <div class="form-group col-xs-10 col-sm-10 col-md-12 col-lg-12">
        <label for="name ofchuch ">Name of the church</label>
        <input type="text" name="experiencechurch" class="form-control" required>
      </div>
      <div class="form-group col-xs-10 col-sm-10 col-md-12 col-lg-12">
        <label for="position">Position Held</label>
        <input type="text" name="churchposition" class="form-control" required>
      </div>
      <div class="form-group col-xs-10 col-sm-10 col-md-12 col-lg-12">
        <label for="startDate">Start Date</label>
        <input type="text" name="startdate" class="form-control" placeholder="yyy-mm-dd" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" title="Enter Date in format: yyy-mm-dd" required>
      </div>
      <div class="form-group col-xs-10 col-sm-10 col-md-12 col-lg-12">
        <label for="province">State/Province</label>
        <input type="text" name="statelocation" class="form-control" required>
      </div>
      <div class="form-group col-xs-10 col-sm-10 col-md-12 col-lg-12">
        <label for="district">City/District</label>
        <input type="text" name="citylocation" class="form-control" required>
      </div>
    </div>
    <div class="col-xs-10 col-sm-10 col-md-6 col-lg-6">
      <div class="form-group col-xs-10 col-sm-10 col-md-12 col-lg-12">
        <label for="email">Email</label><span id="error_email"></span>
        <input type="email" name="CandidateEmail" class="form-control"  id="CandidateEmail" required>
      </div>
    </div>
    <div class="col-xs-10 col-sm-10 col-md-6 col-lg-6">
      <div class="form-group col-xs-10 col-sm-10 col-md-12 col-lg-12">
        <label for="student number">Student Number</label>
        <input type="text" name="candidatenumber" class="form-control" required>
      </div>
    </div>
  </div>
  <div class="col-xs-10 col-sm-10 col-md-12 col-lg-12">
    <input type="submit" name="submitMainForm" value="Save" class="btn btn-primary">
  </div>
  <br>
</form>
