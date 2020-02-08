<?php
require_once(APPPATH.'views/certificate/datareview.php');
require_once(APPPATH.'views/views_pages/pageheader.php');
require_once(APPPATH.'views/views_pages/getdownloads.php');
?>
	<div class="container">
		<div class="row">
			<div class="col-md-4"></div>
			<div class="col-md-4">
				<img class="img-circle" src="<?php echo base_url();?>css_scripts/vendor/datatables/images/test.png" alt="logo" width="150" height="150">
			</div>
			<div class="col-md-4"></div>
		</div>
		<h5 style="color:white;">Please upload the following documents only birth certificate is optional</h5>
		<div class="jumbotron">
      <?php echo validation_errors('<div class="alert alert-danger" style="height:1px;">','</div>');?>
			<div class="row jumbotron-content">
					<div style="color:red;">
						<?php
						if (isset($error_file_upload)) {
							echo $error_file_upload;
						}
						if (isset($minimum_upload)) {
							echo $minimum_upload;
						}
						if (isset($error)) {
							echo $error;
						}
						?>
					</div>
					<div class="row">
						<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
							<form action="<?php echo site_url();?>Uploads/saveid"  method="post" enctype="multipart/form-data">
								<div class="form-group">
									<label for="candidateIDnumber">Identity/Passport</label>
									<input type="file" name="identity" class="form-control">
								</div>
								<input type="submit" class="btn  btn-primary btn-sm" value="Upload file">
								<span>
									<?php if (!empty($row->scanned_id)) {
										?>
										<a href="<?php echo base_url().'profiles/'.$row->scanned_id; ?>" target="_blank">Preview file</a>
										<?php
									} ?>
									</span>
							</form>
						</div>
						<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
							<form  action="<?php echo site_url();?>Uploads/saveid" method="post" enctype="multipart/form-data">
              <div class="form-group">
								<label for="profile ">Profile Picture</label>
								<input type="file" name="photo" class="form-control">
							</div>
							<input type="submit" class="btn  btn-primary btn-sm" value="Upload file">
							<span>
								<?php if (!empty($row->photo)) {
									?>
									<a href="#" class="btn-link">Profile picture uploaded</a>
									<?php
								} ?>
								</span>
							</form>
						</div>
						<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
							<form action="<?php echo site_url();?>Uploads/saveid"  method="post" enctype="multipart/form-data">
							 <div class="form-group">
								 <label for="candidateDiploma">Degree/Diploma|Advanced certificate</label>
								 <input type="file" name="candidatediploma" class="form-control">
							 </div>
							 <input type="submit" class="btn  btn-primary btn-sm" value="Upload file">
							 <span>
								 <?php if (!empty($row->degree_copy)) {
								 	?><a href="<?php echo base_url().'profiles/'.$row->degree_copy; ?>" target="_blank">Preview file</a>
									<?php
								 } ?>
							 </span>
							</form>
						</div>
						<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
							<form action="<?php echo site_url();?>Uploads/saveid"  method="post" enctype="multipart/form-data">
								<div class="form-group">
									<label for="candidatemotivation">Autobiographical Essay</label>
									<input type="file" name="candidatemotivation" class="form-control">
								</div>
								<input type="submit" class="btn  btn-primary btn-sm" value="Upload file">
								<span>
									<?php if (!empty($row->motivation_letter)) {
									 ?><a href="<?php echo base_url().'profiles/'.$row->motivation_letter; ?>" target="_blank">Preview file</a>
									 <?php
									} ?>
								</span>
							</form>
						</div>
						<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
							<form action="<?php echo site_url();?>Uploads/saveid"  method="post" enctype="multipart/form-data">
								<div class="form-group">
									<label for="candidateBirth">Birth Certificate</label>
									<input type="file" name="candidateBirth" class="form-control">
								</div>
								<input type="submit" class="btn  btn-primary btn-sm" value="Upload file">
								<span>
									<?php if (!empty($row->birth_certificate) && $row->birth_certificate!='N/A') {
									 ?><a href="<?php echo base_url().'profiles/'.$row->birth_certificate; ?>" target="_blank">Preview file</a>
									 <?php
									} ?>
								</span>
							</form>
						</div>
						<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
								<div class="form-group">
									<form action="<?php echo site_url();?>Uploads/saveid" method="post" enctype="multipart/form-data">
									<label for="candidateBirth">Recommendation</label>
									<input type="file" name="candidateRecomm" class="form-control">
								</div>
								<input type="submit" class="btn  btn-primary btn-sm" value="Upload file">
								<span>
									<?php
									if (!empty($row->recomm_letter)) {
										?>
										<a href="<?php echo base_url().'profiles/'.$row->recomm_letter; ?>" target="_blank">Preview file</a>
										<?php
									}
									 ?>
								</span>
							</form>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
							<form class="" action="<?php echo site_url();?>Uploads/saveid" method="post" enctype="multipart/form-data">
								<div class="form-group">
									<label for="transcriptupload">Academic transcripts|reports</label><span>Upload all transcripts within a single file if you have different copies,zipped files are not allowed</span>
									<input type="file" name="candidatereport" class="form-control">
								</div>
								<input type="submit" class="btn  btn-primary btn-sm" value="Upload file">
								<span>
									<?php
									if (!empty($row->transcript)) {
										?>
										<a href="<?php echo base_url().'profiles/'.$row->transcript; ?>" target="_blank">Preview file</a>
										<?php
									}
									 ?>
								</span>
							</form>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
							<form class="" action="<?php echo site_url();?>Uploads/saveid" method="post" enctype="multipart/form-data">
								<div class="form-group">
									<label for="statement of faith">Statement of faith</label><span>Upload a signed Statement of faith found on our downloads page &nbsp;<a href="#addfile" data-toggle="modal" data-target="#addfile">Download</a></span>
									<input type="file" name="candidatestatement" class="form-control">
								</div>
								<input type="submit" class="btn  btn-primary btn-sm" value="Upload file">
								<span>
									<?php
									if (!empty($row->statement_faith)) {
										?>
										<a href="<?php echo base_url().'profiles/'.$row->statement_faith; ?>" target="_blank">Preview file</a>
										<?php
									}
									 ?>
								</span>
							</form>
						</div>
					</div>
					<h5>Recommendation must be from the Senior Pastor of your church or Professor at your previous university<h5/>
					<div class="row">
						<div class="col-xs-10 col-sm-10 col-md-12 col-lg-12">
							<?php echo form_open('application_Files/'); ?>
							<form enctype="multipart/form-data" method="post">
								<input type="hidden" value="6" class="form-control" name="uploadnumber" id="uploadnumber"> <br>
								<input type="submit" class="btn btn-outline btn-primary pull-right" value="Go Next" style="margin-left:90px;">
							</form>
						</div>
						<div class="col-xs-10 col-sm-10 col-md-3 col-lg-3"></div>
						<div class="col-xs-10 col-sm-10 col-md-3 col-lg-3"></div>
			    </div>
					<div class="modal fade" tabindex="-1" aria-labelledby="addfile" role="modal" aria-hidden="true" id="addfile">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" name="button" class="close" data-dismiss="modal">&times;</button>
									<h4 class="modal-title">Downloads</h4>
								</div>
								<div class="modal-body">
									<table class="table table-condensed">
										<thead>
											<th></th>
											<th></th>
										</thead>
										<tbody>
											<?php
											if ($checkfile==true) {
												foreach ($files as $value) {
													echo "<tr>";
													echo "<td>";
													echo $value->file_usage;
													echo "</td>";
													echo "<td>";
													?>
													<a href="<?php echo base_url().'files/'.$value->file_name; ?>" target="_blank">View</a>
													<?php
													echo "</td>";
													echo "</tr>";
												}
											} else {
												echo "No current uploads to display";
											}
											 ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div><!-- end of modal-->
		</div>
	</div>
	<?php require_once(APPPATH.'views/views_pages/copy.php'); ?>
</body>
</html>
