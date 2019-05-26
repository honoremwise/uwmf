<?php require_once(APPPATH.'views/certificate/include.php');
require_once(APPPATH.'views/certificate/datareview.php');
require_once(APPPATH.'views/views_pages/pageheader.php');
?>
<script type="text/javascript" src="<?php  echo base_url() ?>css_scripts/js/custom-experience.js"></script>
  <!-- End of header-->
	<div class="container">
		<div class="row">
			<div class="col-md-4"></div>
			<div class="col-md-4">
				<img class="img-circle" src="<?php echo base_url();?>css_scripts/vendor/datatables/images/test.png" alt="logo" width="150" height="150">
			</div>
			<div class="col-md-4"></div>
		</div>
		<h5 style="color: #fff">University application|Professional Experience in non-ecclesiastical Positions</h5>
		<div class="form-error">
			<?php echo validation_errors('<div class="alert alert-danger" style="height:1px;">','</div>');?>
		<div class="jumbotron">
      <div style="color:red; padding-bottom:10px;">
        <?php
        if(isset($messageDisplay)){
          echo $messageDisplay;
        }
        ?>
      </div>
			<div class="row jumbotron-content">
				<form role="form" name="userapplicationexperience" action="<?php echo base_url();?>index.php/Crt_dpl_experience" method="post" id="userapplicationexperience">
          <div class="form-group col-xs-10 col-sm-10 col-md-12 col-lg-12">
            <label for="Institution or Company name">Company name</label><span id="error_company"></span>
            <input type="text" name="workcompany" class="form-control" value="<?php echo $churches['realwork_cmp']; ?>" id="workcompany" required>
          </div>
          <div class="form-group col-xs-10 col-sm-10 col-md-12 col-lg-12">
            <label for="position">Position</label><span id="error_position"></span>
            <input type="text" name="workposition" class="form-control" value="<?php echo $churches['realwork_pos']; ?>" id="workposition" required>
          </div>
          <div class="form-group col-xs-10 col-sm-10 col-md-12 col-lg-12">
            <label for="startDate">Start Date</label><span id="error_startdate"></span>
            <input type="text" name="startworkdate" class="form-control" placeholder="yyyy-mm-dd" value="<?php echo $churches['realwork_start']; ?>" id="startworkdate" required pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" title="Enter Date in format: yyy-mm-dd">
          </div>
          <div class="form-group col-xs-10 col-sm-10 col-md-12 col-lg-12">
            <label for="province">State/Province</label><span id="error_workprovince"></span>
            <input type="text" name="worklocation" class="form-control" value="<?php echo $churches['realwork_pro']; ?>" id="worklocation" required>
          </div>
          <div class="form-group col-xs-10 col-sm-10 col-md-12 col-lg-12">
            <label for="district">City/District</label><span id="error_district"></span>
            <input type="text" name="workcitylocation" class="form-control" value="<?php echo $churches['realwork_dist']; ?>" id="workcitylocation" required>
          </div>
					<div class="form-group col-xs-10 col-sm-10 col-md-12 col-lg-12">
						<label for="">Responsibities</label>
						<textarea name="workjobactivities" rows="4" cols="80" class="form-control" placeholder="Write main Responsibities in your last work Position" id="workjobactivities">
						</textarea>
					</div>
					<!-- submit button -->
					<div class="clearfix"></div>
					<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
						<input type="submit" name="submitFormExperience" value="Save and Continue" class="btn btn-primary pull-right">
					</div>
					<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
						<a href="<?php echo base_url();?>index.php/save_step?work_job_attended" id="workcertificate"class="btn btn-primary pull-left">Go Next</a>
					</div>
					<div class="col-xs-10 col-sm-10 col-md-12 col-lg-12">
            <h5>Consider only to go next if you have previously saved</h5>
          </div>
				</form>
			</div>
		</div>
		<?php require_once(APPPATH.'views/views_pages/copy.php'); ?>
	</div>
</body>
</html>
