<?php include('include.php');
require_once(APPPATH.'views/views_pages/pageheader.php');
require_once(APPPATH.'views/certificate/datareview.php');
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
		<h5 style="color:white;">Please upload the following documents to support your application</h5>
		<div class="jumbotron">
      <?php echo validation_errors('<div class="alert alert-danger" style="height:1px;">','</div>');?>
			<div class="row jumbotron-content">
					<div style="color:red; padding-bottom:0px;">
						<?php
						if (isset($error_file_upload)) {
							echo $error_file_upload;
						}
						if (isset($minimum_upload)) {
							echo $minimum_upload;
						}
						?>
					</div>
					<div class="row">
						<div class="col-xs-10 col-sm-10 col-md-6 col-lg-6">
							<form action="<?php echo base_url();?>index.php/IdentityFiles/saveFiles"  method="post" enctype="multipart/form-data">
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
						<div class="col-xs-10 col-sm-10 col-md-6 col-lg-6">
							<form action="<?php echo base_url();?>index.php/PictureFiles/saveFiles" method="post" enctype="multipart/form-data">
              <div class="form-group">
								<label for="profile ">Profile Picture</label>
								<input type="file" name="picture" class="form-control">
							</div>
							<input type="submit" class="btn  btn-primary btn-sm" value="Upload file">
							<span>
								<?php if (!empty($row->photo)) {
								 ?><a href="#">Profile picture uploaded</a>
								 <?php
								} ?>
							</span>
							</form>
						</div>
					</div>

					<div class="row" style="margin-top:20px;">
						<div class="col-xs-10 col-sm-10 col-md-6 col-lg-6">
							<form action="<?php echo base_url();?>index.php/DegreeFiles/saveFiles"  method="post" enctype="multipart/form-data">
               <div class="form-group">
								 <label for="candidateDiploma">Certificate</label>
								 <span style="border-left:ridge;">Upload General advanced certificate,diploma or Results slip</span>
								 <input type="file" name="candidatediploma" class="form-control">
							 </div>
							 <input type="submit" class="btn  btn-primary btn-sm" value="Upload file">
							 <span>
								 <?php if (!empty($row->degree_copy)) {
								 	?><a href="<?php echo base_url().'profiles/'.$row->degree_copy; ?>"target="_blank">Preview file</a>
									<?php
								 } ?>
							 </span>
							</form>
						</div>
						<div class="col-xs-10 col-sm-10 col-md-6 col-lg-6">
							<form action="<?php echo base_url();?>index.php/RecommendationFiles/saveFiles" method="post" enctype="multipart/form-data">
								<div class="form-group">
									<label for="candidateBirth">Recommendation</label>
									<span style="border-left:ridge;">Recommendation must be from the Pastor of your Church</span>
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
						<div class="col-xs-10 col-sm-10 col-md-6 col-lg-6">
							<form class="" action="<?php echo base_url();?>index.php/TranscriptFiles/saveFiles" method="post" enctype="multipart/form-data">
								<div class="form-group">
									<label for="transcriptupload">Academic transcripts or reports</label><span style="border-left:ridge;">Upload all transcripts or reports within a single file if you have different copies,zipped files are not allowed</span>
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
						<div class="col-xs-10 col-sm-10 col-md-6 col-lg-6">
							<form class="" action="<?php echo base_url();?>index.php/TranscriptFiles/savefaith" method="post" enctype="multipart/form-data">
								<div class="form-group">
									<label for="statement of faith">Statement of faith</label><span style="border-left:ridge;">Upload a signed Statement of faith found on our downloads page &nbsp;<a href="#addfile" data-toggle="modal" data-target="#addfile">Downloads</a>
									</span>
									<input type="file" name="candidatereport" class="form-control">
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
					<h5>Recommendation must be from the Senior Pastor of your church<h5/>
					<div class="row">
						<div class="col-xs-10 col-sm-10 col-md-12 col-lg-12">
							<?php echo form_open('application_Files'); ?>
							<form enctype="multipart/form-data" method="post">
								<input type="hidden" value="6" class="form-control" name="uploadnumber" id="uploadnumber"> <br>
								<input type="submit" class="btn btn-primary pull-right" value="Go next" style="margin-right:10px; margin-bottom:40px;">
							</form>
						</div>
					</div>
					<div class="modal fade" tabindex="-1" aria-labelledby="adduser" role="modal" aria-hidden="true" id="addfile">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" name="button" class="close" data-dismiss="modal">&times;</button>
									<h4 class="modal-title">Downloads</h4>
								</div>
								<div class="modal-body">
									<table class="table table-condensed">
										<thead>
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
	</html>
