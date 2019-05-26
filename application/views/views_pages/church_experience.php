<div class="row">
  <div class="col-xs-10 col-sm-10 col-md-6 col-lg-6">
    <h5>Church Information</h5>
    <div class="form-group col-xs-10 col-sm-10 col-md-12 col-lg-12">
      <label for="denomination">Denomination</label>
      <input type="text" name="candidatedenomination" class="form-control" value="<?php echo $churches['denomination']; ?>">
    </div>
    <div class="form-group col-xs-10 col-sm-10 col-md-12 col-lg-12">
			<label for="churchname">Name of the Church</label>
			<input type="text" name="candidatechurch" class="form-control" value="<?php echo $churches['church_name']; ?>">
		</div>
    <div class="form-group col-xs-10 col-sm-10 col-md-12 col-lg-12">
			<label for="address">Address</label>
			<input type="text" name="churchaddress" class="form-control" value="<?php echo $churches['church_address']; ?>">
		</div>
    <div class="form-group col-xs-10 col-sm-10 col-md-12 col-lg-12">
			<label for="Telephone">Phone</label>
			<input type="text" name="contactPhone" class="form-control" value="<?php echo $churches['church_phone']; ?>">
		</div>
    <div class="form-group col-xs-10 col-sm-10 col-md-12 col-lg-12">
			<label for="pastor">Names of the Pastor</label>
			<input type="text" name="pastorName" class="form-control" value="<?php echo $churches['church_pastor']; ?>">
		</div>
  </div>
  <div class="col-xs-10 col-sm-10 col-md-6 col-lg-6">
    <h5>Experience in church positions</h5>
    <div class="form-group col-xs-10 col-sm-10 col-md-12 col-lg-12">
      <label for="name ofchuch ">Name of the church</label>
      <input type="text" name="experiencechurch" class="form-control" value="<?php echo $churches['otherwork_cmp']; ?>">
    </div>
    <div class="form-group col-xs-10 col-sm-10 col-md-12 col-lg-12">
      <label for="position">Position Held</label>
      <input type="text" name="churchposition" class="form-control" value="<?php echo $churches['otherwork_position']; ?>">
    </div>
    <div class="form-group col-xs-10 col-sm-10 col-md-12 col-lg-12">
      <label for="startDate">Start Date</label>
      <input type="text" name="startdate" class="form-control" placeholder="yy-mm-dd" value="<?php echo $churches['otherwork_startdate'];?>">
    </div>
    <div class="form-group col-xs-10 col-sm-10 col-md-12 col-lg-12">
      <label for="province">State/Province</label>
      <input type="text" name="statelocation" class="form-control" value="<?php echo $churches['otherwork_province']; ?>">
    </div>
    <div class="form-group col-xs-10 col-sm-10 col-md-12 col-lg-12">
      <label for="district">City/District</label>
      <input type="text" name="citylocation" class="form-control" value="<?php echo $churches['otherwork_district']; ?>">
    </div>
  </div>
</div>
