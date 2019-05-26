<div class="row jumbotron-content">
  <form role="form" name="userapplicationexperience" action="<?php echo base_url();?>index.php/TempLoad/experience" method="post" id="userapplicationexperience">
    <div class="col-xs-10 col-sm-10 col-md-12 col-lg-12">
      <h5>Professional Experience in non-ecclesiastical Positions</h5>
    </div>
    <div class="form-group col-xs-10 col-sm-10 col-md-6 col-lg-6">
      <label for="student number">Student Number</label>
      <input type="text" name="candidatenumber" class="form-control" required>
    </div>
    <div class="form-group col-xs-10 col-sm-10 col-md-6 col-lg-6">
      <label for="Institution or Company name">Company name</label><span id="error_company"></span>
      <input type="text" name="workcompany" class="form-control" id="workcompany" required>
    </div>
    <div class="form-group col-xs-10 col-sm-10 col-md-6 col-lg-6">
      <label for="position">Position</label><span id="error_position"></span>
      <input type="text" name="workposition" class="form-control"  id="workposition" required>
    </div>
    <div class="form-group col-xs-10 col-sm-10 col-md-6 col-lg-6">
      <label for="startDate">Start Date</label><span id="error_startdate"></span>
      <input type="text" name="startworkdate" class="form-control" placeholder="yyyy-mm-dd"id="startworkdate" required>
    </div>
    <div class="form-group col-xs-10 col-sm-10 col-md-6 col-lg-6">
      <label for="province">State/Province</label><span id="error_workprovince"></span>
      <input type="text" name="worklocation" class="form-control"id="worklocation" required>
    </div>
    <div class="form-group col-xs-10 col-sm-10 col-md-6 col-lg-6">
      <label for="district">City/District</label><span id="error_district"></span>
      <input type="text" name="workcitylocation" class="form-control" id="workcitylocation" required>
    </div>
    <div class="col-xs-10 col-sm-10 col-md-3 col-lg-3">
      <input type="submit" name="submitFormExperience" value="Save" class="btn btn-primary">
    </div>
  </form>
</div>
