      <div>
      <?php echo validation_errors('<div class="alert alert-danger" style="height:1px;">','</div>');?>
			<div>
					<div style="color:red; padding-bottom:10px;">
						<?php
						if (isset($error_file_upload)) {
							echo $error_file_upload;
						}
						?>
					</div>
					<div class="row">
						<div class="col-xs-10 col-sm-10 col-md-6 col-lg-6">
							<form action="<?php echo site_url();?>Files/saveid"  method="post" enctype="multipart/form-data">
								<div class="form-group">
									<label for="candidateIDnumber">Identity/Passport</label>
									<input type="file" name="identity" class="form-control" accept="application/pdf">
								</div>
								<input type="submit" class="btn btn-success btn-outline btn-primary btn-sm" value="Upload file">
								<span>
									<?php if (!empty($idcard) && file_exists('profiles/'.$idcard)) {
										?>
										<a href="<?php echo base_url().'profiles/'.$idcard; ?>" target="_blank">Preview file</a>
										<?php
									} ?>
									</span>
							</form>
              <form class="" action="<?php echo site_url();?>Files/delete" method="post" enctype="multipart/form-data">
                <input type="hidden" name="fileuploadid" id="fileuploadid" value="<?php echo $idcard;?>">
                <?php
                if (!empty($idcard) && file_exists('profiles/'.$idcard)){
                  ?>
                  <!--<button type="submit" class="btn-link">Delete file</button> -->
                  <?php
                }
                 ?>
              </form>
						</div>
						<div class="col-xs-10 col-sm-10 col-md-6 col-lg-6">
							<form action="<?php echo site_url();?>Files/saveid" method="post" enctype="multipart/form-data">
              <div class="form-group">
								<label for="profile ">Profile Picture</label>
								<input type="file" name="photo" class="form-control" accept="image/*">
							</div>
							<input type="submit" class="btn btn-success btn-outline btn-primary" value="Upload file" >
							<span>
								<?php if (!empty($photo)) {
								 ?><a href="#"></a>
								 <?php
								} ?>
							</span>
							</form>
						</div>
					</div>

					<div class="row" style="margin-top:20px;">
						<div class="col-xs-10 col-sm-10 col-md-6 col-lg-6">
							<form action="<?php echo site_url();?>Files/saveid"  method="post" enctype="multipart/form-data">
               <div class="form-group">
								 <label for="candidateDiploma">Certificate</label>
								 <span style="border-left:ridge;">Upload General advanced certificate,diploma or Bachelor degree</span>
								 <input type="file" name="candidatediploma" class="form-control">
							 </div>
							 <input type="submit" class="btn btn-success btn-outline btn-primary" value="Upload file">
							 <span>
								 <?php if (!empty($degree) && file_exists('profiles/'.$degree)) {
								 	?><a href="<?php echo base_url().'profiles/'.$degree; ?>"target="_blank">Preview file</a>
									<?php
								 } ?>
							 </span>
							</form>
              <form class="" action="<?php echo site_url();?>Files/delete" method="post" enctype="multipart/form-data">
                <input type="hidden" name="fileuploaddegree" id="fileuploaddegree" value="<?php echo $degree;?>">
                <?php
                if (!empty($degree) && file_exists('profiles/'.$degree)){
                  ?>
                  <!--<button type="submit" class="btn-link">Delete file</button> -->
                  <?php
                }
                 ?>
              </form>
						</div>
						<div class="col-xs-10 col-sm-10 col-md-6 col-lg-6">
							<form action="<?php echo site_url();?>Files/saveid" method="post" enctype="multipart/form-data">
								<div class="form-group">
									<label for="candidateBirth">Recommendation</label>
									<span style="border-left:ridge;">Recommendation must be from the Pastor of your Church</span>
									<input type="file" name="candidateRecomm" class="form-control">
								</div>
								<input type="submit" class="btn btn-success btn-outline btn-primary" value="Upload file">
								<span>
									<?php
									if (!empty($recommend) && file_exists('profiles/'.$recommend)) {
										?>
										<a href="<?php echo base_url().'profiles/'.$recommend; ?>" target="_blank">Preview file</a>
										<?php
									}
									 ?>
								</span>
							</form>
              <form class="" action="<?php echo site_url();?>Files/delete" method="post" enctype="multipart/form-data">
                <input type="hidden" name="fileuploadrecom" id="fileuploadrecom" value="<?php echo $recommend;?>">
                <?php
                if (!empty($recommend) && file_exists('profiles/'.$recommend)){
                  ?>
                  <!--<button type="submit" class="btn-link">Delete file</button> -->
                  <?php
                }
                 ?>
              </form>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-10 col-sm-10 col-md-6 col-lg-6">
							<form class="" action="<?php echo site_url();?>Files/saveid" method="post" enctype="multipart/form-data">
								<div class="form-group">
									<label for="transcriptupload">Academic transcripts or reports</label>
									<input type="file" name="candidatereport" class="form-control">
								</div>
								<input type="submit" class="btn btn-success btn-outline btn-primary" value="Upload file">
								<span>
									<?php
									if (!empty($transcript) && file_exists('profiles/'.$transcript)) {
										?>
										<a href="<?php echo base_url().'profiles/'.$transcript; ?>" target="_blank">Preview file</a>
										<?php
									}
									 ?>
								</span>
							</form>
              <form class="" action="<?php echo site_url();?>Files/delete" method="post" enctype="multipart/form-data">
                <input type="hidden" name="fileuploadreport" id="fileuploadreport" value="<?php echo $transcript;?>">
                <?php
                if (!empty($transcript) && file_exists('profiles/'.$transcript)){
                  ?>
                  <!--<button type="submit" class="btn-link">Delete file</button> -->
                  <?php
                }
                 ?>
              </form>
						</div>
						<div class="col-xs-10 col-sm-10 col-md-6 col-lg-6">
							<form class="" action="<?php echo site_url();?>Files/saveid" method="post" enctype="multipart/form-data">
								<div class="form-group">
									<label for="statement of faith">Statement of faith</label>
									</span>
									<input type="file" name="candidatestatement" class="form-control">
								</div>
								<input type="submit" class="btn btn-success btn-outline btn-primary" value="Upload file">
								<span>
									<?php
									if (!empty($statement) && file_exists('profiles/'.$statement)) {
										?>
										<a href="<?php echo base_url().'profiles/'.$statement; ?>" target="_blank">Preview file</a>
										<?php
									}
									 ?>
								</span>
							</form>
              <form class="" action="<?php echo site_url();?>Files/delete" method="post" enctype="multipart/form-data">
                <input type="hidden" name="fileuploadstat" id="fileuploadstat" value="<?php echo $statement;?>">
                <?php
                if (!empty($statement) && file_exists('profiles/'.$statement)){
                  ?>
                  <!--<button type="submit" class="btn-link">Delete file</button> -->
                  <?php
                }
                 ?>
              </form>
						</div>
					</div>
          <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
							<form action="<?php echo site_url();?>Files/saveid"  method="post" enctype="multipart/form-data">
								<div class="form-group">
									<label for="candidatemotivation">Autobiographical Essay</label>
									<input type="file" name="candidatemotivation" class="form-control">
								</div>
								<input type="submit" class="btn btn-success btn-outline btn-primary" value="Upload file">
								<span>
									<?php if (!empty($motiv) && file_exists('profiles/'.$motiv)) {
									 ?><a href="<?php echo base_url().'profiles/'.$motiv; ?>" target="_blank">Preview file</a>
									 <?php
									} ?>
								</span>
							</form>
              <form class="" action="<?php echo site_url();?>Files/delete" method="post" enctype="multipart/form-data">
                <input type="hidden" name="fileuploadmotivid" id="fileuploadmotivid" value="<?php echo $motiv;?>">
                <?php
                if (!empty($motiv) && file_exists('profiles/'.$motiv)){
                  ?>
                  <!--<button type="submit" class="btn-link">Delete file</button> -->
                  <?php
                }
                 ?>
              </form>
						</div>
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
							<form action="<?php echo site_url();?>Files/saveid"  method="post" enctype="multipart/form-data">
								<div class="form-group">
									<label for="candidateBirth">Birth Certificate</label>
									<input type="file" name="candidateBirth" class="form-control">
								</div>
								<input type="submit" class="btn btn-success btn-outline btn-primary" value="Upload file">
								<span>
									<?php if (!empty($bd) && $bd!='N/A' && file_exists('profiles/'.$bd)) {
									 ?><a href="<?php echo base_url().'profiles/'.$bd; ?>" target="_blank">Preview file</a>
									 <?php
									} ?>
								</span>
							</form>
              <form class="" action="<?php echo site_url();?>Files/delete" method="post" enctype="multipart/form-data">
                <input type="hidden" name="fileuploadbd" id="fileuploadbd" value="<?php echo $bd;?>">
                <?php
                if (!empty($bd) && file_exists('profiles/'.$bd)){
                  ?>
                  <!--<button type="submit" class="btn-link">Delete file</button> -->
                  <?php
                }
                 ?>
              </form>
						</div>
          </div>
				</div>
			</div>
