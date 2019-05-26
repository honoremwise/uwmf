<?php require_once(APPPATH.'views/certificate/include.php');
require_once(APPPATH.'views/certificate/datareview.php');
require_once(APPPATH.'views/views_pages/pageheader.php');
?>
<script type="text/javascript" src="<?php  echo base_url() ?>css_scripts/js/custom-exp.js"></script>
<script type="text/javascript">
	$('workactivities').html('Faustin');
</script>
  <!-- End of header-->
	<div class="container">
		<div class="row">
			<div class="col-md-4"></div>
			<div class="col-md-4">
				<img class="img-circle" src="<?php echo base_url();?>css_scripts/vendor/datatables/images/test.png" alt="logo" width="150" height="150">
			</div>
			<div class="col-md-4"></div>
		</div>
		<h5 style="color: #fff">University application|Church Information</h5>
		<div class="form-error">
			<?php echo validation_errors('<div class="alert alert-danger" style="height:1px;">','</div>');?>
		<div class="jumbotron">
      <div style="color:red; padding-bottom:30px;">
        <?php
        if(isset($messageDisplay)){
          echo $messageDisplay;
        }
        ?>
      </div>
			<div class="row jumbotron-content">
				<form form name="userchurchexperience" action="<?php echo base_url();?>index.php/Crt_dpl_experience/" method="post" id="userchurchexperience">
					<div class="form-group col-xs-10 col-sm-10 col-md-12 col-lg-12">
						<label for="denomination">Denomination</label><span id="error_denomination"></span>
						<input type="text" name="candidatedenomination" class="form-control" value="<?php echo $churches['denomination']; ?>" id="candidatedenomination" required>
					</div>
					<div class="form-group col-xs-10 col-sm-10 col-md-12 col-lg-12">
						<label for="churchname">Name of the Church</label><span id="error_church"></span>
						<input type="text" name="candidatechurch" class="form-control" value="<?php echo $churches['church_name']; ?>" id="candidatechurch" required>
					</div>
					<div class="form-group col-xs-10 col-sm-10 col-md-12 col-lg-12">
						<label for="address">Address</label><span id="error_churchaddress"></span>
						<input type="text" name="churchaddress" class="form-control" value="<?php echo $churches['church_address']; ?>" id="churchaddress" required>
					</div>

					<div class="form-group col-xs-10 col-sm-10 col-md-12 col-lg-12">
						<label for="Telephone">Phone</label><span id="error_churchphone"></span>
						<input type="number" name="contactPhone" class="form-control" value="<?php echo $churches['church_phone']; ?>" id="contactPhone" required>
					</div>
					<div class="form-group col-xs-10 col-sm-10 col-md-12 col-lg-12">
						<label for="pastor">Names of the Pastor</label><span id="error_pastor"></span>
						<input type="text" name="pastorName" class="form-control" value="<?php echo $churches['church_pastor']; ?>" id="pastorName" required>
					</div>
					<div class="clearfix"></div>
					<div class="col-xs-10 col-sm-10 col-md-12 col-lg-12">
						<h4>Professional Experience in Church related Positions</h4>
					</div>
          <div class="form-group col-xs-10 col-sm-10 col-md-12 col-lg-12">
            <label for="name ofchuch ">Name of the church</label><span id="error_churchexp"></span>
            <input type="text" name="experiencechurch" class="form-control" value="<?php echo $churches['otherwork_cmp']; ?>" id="experiencechurch" required>
          </div>
          <div class="form-group col-xs-10 col-sm-10 col-md-12 col-lg-12">
            <label for="position">Position Held</label><span id="error_churchposition"></span>
						<input type="text" name="churchposition" class="form-control" value="<?php echo $churches['otherwork_position']; ?>" id="churchposition" required>
          </div>
          <div class="form-group col-xs-10 col-sm-10 col-md-12 col-lg-12">
            <label for="startDate">Start Date</label><span id="error_positiondate"></span>
            <input type="text" name="startdate" class="form-control" placeholder="yyyy-mm-dd" value="<?php echo $churches['otherwork_startdate'];?>" id="startdate" required pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" title="Enter Date in format: yyy-mm-dd">
          </div>
          <div class="form-group col-xs-10 col-sm-10 col-md-12 col-lg-12">
            <label for="province">State/Province</label><span id="error_churchprovince"></span>
            <input type="text" name="statelocation" class="form-control" value="<?php echo $churches['otherwork_province']; ?>" id="statelocation" required>
          </div>
          <div class="form-group col-xs-10 col-sm-10 col-md-12 col-lg-12">
            <label for="district">City/District</label><span id="error_churchdistrict"></span>
            <input type="text" name="citylocation" class="form-control" value="<?php echo $churches['otherwork_district']; ?>" id="citylocation" required>
          </div>
					<div class="form-group col-xs-10 col-sm-10 col-md-12 col-lg-12">
						<label for="">Responsibities</label>
						<textarea name="workactivities" rows="4" cols="80" class="form-control" id="workactivities" placeholder="Write main Responsibities in Church Position" id="workactivities">
						</textarea>
					</div>
					<!-- submit button -->
					<div class="clearfix"></div>
					<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
						<input type="submit" name="submitMainForm" value="Save and Continue" class="btn btn-primary pull-right">
					</div>
					<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
						<a href="<?php echo base_url();?>index.php/Save_step?workapplication" id="workcertificate"class="btn btn-primary pull-left">Go next</a>
					</div>
				</form>
			</div>
		</div>
		<?php require_once(APPPATH.'views/views_pages/copy.php'); ?>
	</div>
</body>
</html>
