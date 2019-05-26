<div class="row">
  <div class="col-xs-6 col-sm-6 col-md-12 col-lg-12">
    <form action="<?php echo base_url();?>index.php/IdentityFiles/studentidentity"  method="post" enctype="multipart/form-data">
      <div class="form-group col-xs-6 col-sm-6 col-md-6 col-lg-6">
        <label for="candidateIDnumber">Identity/Passport</label>
        <input type="file" name="identity" class="form-control">
      </div>
      <div class=" form-group col-xs-10 col-sm-10 col-md-6 col-lg-6">
      <label for="student">Student</label>
      <select name="studentprogram" class="form-control" id="studentprogram">
        <option value="">Select student number</option>
        <?php foreach($getall as $each){ ?>
        <option value="<?php echo $each->registration_no; ?>"><?php echo $each->registration_no; ?></option>';<?php } ?>
      </select>
     </div>
     <div class="form-group col-xs-10 col-sm-10 col-md-6 col-lg-6">
       <input type="submit" class="btn  btn-success btn-sm" value="Upload file">
     </div>
      <span>
        <?php if (!empty($row->scanned_id)) {
          ?>
          <a href="<?php echo base_url().'profiles/'.$row->scanned_id; ?>" target="_blank">Preview file</a>
          <?php
        } ?>
        </span>
    </form>
  </div>
  <div class="col-xs-6 col-sm-6 col-md-12 col-lg-12">
    <form  action="<?php echo base_url();?>index.php/PictureFiles/studentidentity" method="post" enctype="multipart/form-data">
    <div class="form-group col-xs-10 col-sm-10 col-md-6 col-lg-6">
      <label for="profile ">Profile Picture</label>
      <input type="file" name="picture" class="form-control" id="picture">
    </div>
    <div class=" form-group col-xs-10 col-sm-10 col-md-6 col-lg-6">
    <label for="student">Student</label>
    <select name="studentprogram" class="form-control" id="studentprogram">
      <option value="">Select student number</option>
      <?php foreach($getall as $each){ ?>
      <option value="<?php echo $each->registration_no; ?>"><?php echo $each->registration_no; ?></option>';<?php } ?>
    </select>
   </div>
   <div class="form-group col-xs-10 col-sm-10 col-md-6 col-lg-6">
     <input type="submit" class="btn  btn-success btn-sm" value="Upload file">
   </div>
    </form>
  </div>
  <div class="col-xs-6 col-sm-6 col-md-12 col-lg-12">
    <form action="<?php echo base_url();?>index.php/DegreeFiles/studentidentity"  method="post" enctype="multipart/form-data">
     <div class="form-group col-xs-10 col-sm-10 col-md-6 col-lg-6">
       <label for="candidateDiploma">Degree/Diploma</label>
       <input type="file" name="candidatediploma" class="form-control">
     </div>
     <div class="form-group col-xs-10 col-sm-10 col-md-6 col-lg-6">
       <label for="student">Student</label>
       <select name="studentprogram" class="form-control" id="studentprogram">
         <option value="">Select student number</option>
         <?php foreach($getall as $each){ ?>
         <option value="<?php echo $each->registration_no; ?>"><?php echo $each->registration_no; ?></option>';<?php } ?>
       </select>
     </div>
     <div class="form-group col-xs-10 col-sm-10 col-md-6 col-lg-6">
       <input type="submit" class="btn  btn-success btn-sm" value="Upload file">
     </div>
     <span>
       <?php if (!empty($row->degree_copy)) {
        ?><a href="<?php echo base_url().'profiles/'.$row->degree_copy; ?>" target="_blank">Preview file</a>
        <?php
       } ?>
     </span>
    </form>
  </div>
  <div class="col-xs-6 col-sm-6 col-md-12 col-lg-12">
      <div class="form-group col-xs-10 col-sm-10 col-md-6 col-lg-6">
        <form action="<?php echo base_url();?>index.php/MotivationFiles/studentidentity"  method="post" enctype="multipart/form-data">
        <label for="candidatemotivation">Autobiographical Essay</label>
        <input type="file" name="candidatemotivation" class="form-control">
      </div>
      <div class="form-group col-xs-10 col-sm-10 col-md-6 col-lg-6">
        <label for="student">Student</label>
        <select name="studentprogram" class="form-control" id="studentprogram">
          <option value="">Select student number</option>
          <?php foreach($getall as $each){ ?>
          <option value="<?php echo $each->registration_no; ?>"><?php echo $each->registration_no; ?></option>';<?php } ?>
        </select>
      </div>
      <div class="form-group col-xs-10 col-sm-10 col-md-6 col-lg-6">
        <input type="submit" class="btn  btn-success btn-sm" value="Upload file">
      </div>
      <span>
        <?php if (!empty($row->motivation_letter)) {
         ?><a href="<?php echo base_url().'profiles/'.$row->motivation_letter; ?>" target="_blank">Preview file</a>
         <?php
        } ?>
      </span>
    </form>
  </div>
  <div class="col-xs-6 col-sm-6 col-md-12 col-lg-12">
      <div class="form-group col-xs-10 col-sm-10 col-md-6 col-lg-6">
        <form action="<?php echo base_url();?>index.php/BirthcertificateFiles/studentidentity"  method="post" enctype="multipart/form-data">
        <label for="candidateBirth">Birth Certificate</label>
        <input type="file" name="candidateBirth" class="form-control">
      </div>
      <div class="form-group col-xs-10 col-sm-10 col-md-6 col-lg-6">
        <label for="student">Student</label>
        <select name="studentprogram" class="form-control" id="studentprogram">
          <option value="">Select student number</option>
          <?php foreach($getall as $each){ ?>
          <option value="<?php echo $each->registration_no; ?>"><?php echo $each->registration_no; ?></option>';<?php } ?>
        </select>
      </div>
      <div class="form-group col-xs-10 col-sm-10 col-md-6 col-lg-6">
        <input type="submit" class="btn  btn-success btn-sm" value="Upload file">
      </div>
      <span>
        <?php if (!empty($row->birth_certificate) && strlen($row->birth_certificate)>4) {
         ?><a href="<?php echo base_url().'profiles/'.$row->birth_certificate; ?>" target="_blank">Preview file</a>
         <?php
        } ?>
      </span>
    </form>
  </div>
  <div class="col-xs-6 col-sm-6 col-md-12 col-lg-12">
    <form action="<?php echo base_url();?>index.php/RecommendationFiles/studentidentity" method="post" enctype="multipart/form-data">
      <div class="form-group col-xs-10 col-sm-10 col-md-6 col-lg-6">
        <label for="candidateBirth">Recommendation</label>
        <input type="file" name="candidateRecomm" class="form-control">
      </div>
      <div class="form-group col-xs-10 col-sm-10 col-md-6 col-lg-6">
        <label for="student">Student</label>
        <select name="studentprogram" class="form-control" id="studentprogram">
          <option value="">Select student number</option>
          <?php foreach($getall as $each){ ?>
          <option value="<?php echo $each->registration_no; ?>"><?php echo $each->registration_no; ?></option>';<?php } ?>
        </select>
      </div>
      <div class="form-group col-xs-10 col-sm-10 col-md-6 col-lg-6">
        <input type="submit" class="btn  btn-success btn-sm" value="Upload file">
      </div>
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
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <form class="" action="<?php echo base_url();?>index.php/TranscriptFiles/studentidentity" method="post" enctype="multipart/form-data">
      <div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6">
        <label for="transcriptupload">Transcripts</label>
        <input type="file" name="candidatereport" class="form-control">
      </div>
      <div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6">
        <label for="student">Student</label>
        <select name="studentprogram" class="form-control" id="studentprogram">
          <option value="">Select student number</option>
          <?php foreach($getall as $each){ ?>
          <option value="<?php echo $each->registration_no; ?>"><?php echo $each->registration_no; ?></option>';<?php } ?>
        </select>
      </div>
      <div class="form-group col-xs-10 col-sm-10 col-md-6 col-lg-6">
        <input type="submit" class="btn  btn-success btn-sm" value="Upload file">
      </div>
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
</div>
