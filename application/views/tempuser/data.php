<div class="row">
  <div class="col-lg-12">
    <h5>Personal Data</h5>
  </div>
</div>
<form class="" action="<?php echo base_url();?>index.php/TempLoad/personaldata" method="post">
  <div class="form-group col-xs-10 col-sm-10 col-md-4 col-lg-4">
    <label for="firstname">Firstname</label>
    <input type="text" name="CandidateFname" value="<?php echo $fname; ?>" class="form-control" id="input1">
  </div>
  <div class=" form-group col-xs-10 col-sm-10 col-md-4 col-lg-4">
    <label for="lastname">Lastname</label>
    <input type="text" name="CandidateLname" class="form-control" value="<?php echo $lname; ?>" id="input2">
  </div>
  <div class="form-group col-xs-10 col-sm-10 col-md-4 col-lg-4">
    <label for="telephone">Telephone</label>
    <input type="number" name="CandidatePhone" class="form-control" value="<?php echo $tel; ?>" id="input3">
  </div>
  <div class="form-group col-xs-10 col-sm-10 col-md-4 col-lg-4">
    <label for="IDNumber">ID Number/Passport</label>
    <input type="text" name="CandidateIDnumber" class="form-control" value="<?php echo $passport;  ?>" id="input4">
  </div>
  <div class="form-group col-xs-10 col-sm-10 col-md-4 col-lg-4">
    <label for="date">Date of birth</label>
    <input type="text" name="CandidateBirthDate" class="form-control" placeholder="yyy-mm-dd" value="<?php echo $date; ?>" id="input5">
  </div>
  <div class=" form-group col-xs-10 col-sm-10 col-md-4 col-lg-4">
    <label for="gender">Gender</label>
    <input type="text" name="CandidateGender" value="<?php echo $gender; ?>" class="form-control">
  </div>
  <div class="form-group col-xs-10 col-sm-10 col-md-4 col-lg-4">
    <label for="nationality">Nationality(Citizenship)</label>
    <input type="text" name="CandidateNationality" class="form-control" value="<?php echo $nat; ?>" id="input6">
  </div>
  <div class="form-group col-xs-10 col-sm-10 col-md-4 col-lg-4">
    <label for="provice">Province/City of birth</label>
    <input type="text" name="CandidateProvince" class="form-control" value="<?php echo $pro; ?>" id="input7">
  </div>
  <div class="form-group col-xs-10 col-sm-10 col-md-4 col-lg-4">
    <label for="district">District of birth</label>
    <input type="text" name="CandidateDistrict" class="form-control" value="<?php echo $dist; ?>" id="input8">
  </div>
  <div class="form-group col-xs-10 col-sm-10 col-md-4 col-lg-4">
    <label for="address">Current Address</label>
    <input type="text" name="candidateaddress" class="form-control" placeholder="Province/district" value="<?php echo $addr; ?>" id="input9">
  </div>
  <div class="form-group col-xs-10 col-sm-10 col-md-4 col-lg-4">
    <label for="englishlevel">Level of English</label>
    <input type="text" name="Candidateenglish" value="<?php echo $proficny ?>" class="form-control">
  </div>
  <div class="form-group col-xs-10 col-sm-10 col-md-4 col-lg-4">
    <label for="nativelanguage">Native language(s)</label>
    <input type="text" name="CandidateNative" class="form-control" value="<?php echo $lanaguage; ?>">
  </div>
  <div class="form-group col-xs-10 col-sm-10 col-md-4 col-lg-4">
    <input type="hidden" name="custidreference" id="custidreference" value="<?php echo $reference; ?>" class="form-control">
  </div>
  <div class="form-group col-xs-10 col-sm-10 col-md-4 col-lg-4">

  </div>
  <div class="col-xs-10 col-sm-10 col-md-4 col-lg-4">
    <input type="submit" name="dataexperience" value="Save changes" class="btn btn-primary">
  </div>
</form>
<form action="<?php echo base_url();?>index.php/tempLoad/churchdata" method="post">
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
  <div class="form-group col-xs-10 col-sm-10 col-md-12 col-lg-12">
    <input type="hidden" name="custidreference" id="custidreference" value="<?php echo $reference; ?>" class="form-control">
  </div>
  <div class="col-xs-10 col-sm-10 col-md-4 col-lg-4"></div>
  <div class="col-xs-10 col-sm-10 col-md-4 col-lg-4"></div>
  <div class="col-xs-10 col-sm-10 col-md-4 col-lg-4">
    <input type="submit" name="churchdata" value="Save changes" class="btn btn-primary">
  </div>
</form>
<form method="post" action="<?php echo base_url();?>index.php/TempLoad/churchexperience">
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
  <div class="form-group col-xs-10 col-sm-10 col-md-12 col-lg-12">
    <input type="hidden" name="custidreference" id="custidreference" value="<?php echo $reference; ?>" class="form-control">
  </div>
  <div class="col-xs-10 col-sm-10 col-md-4 col-lg-4"></div>
  <div class="col-xs-10 col-sm-10 col-md-4 col-lg-4"></div>
  <div class="col-xs-10 col-sm-10 col-md-4 col-lg-4">
    <input type="submit" name="churchexperience" value="Save changes" class="btn btn-primary">
  </div>
</form>
<h5>Professional experience</h5>
<form role="form" action="<?php echo base_url();?>index.php/TempLoad/workdata" method="post">
  <div class="form-group col-xs-10 col-sm-10 col-md-12 col-lg-12">
    <label for="Institution or Company name">Company name</label>
    <input type="text" name="workcompany" class="form-control" value="<?php echo $churches['realwork_cmp']; ?>">
  </div>
  <div class="form-group col-xs-10 col-sm-10 col-md-12 col-lg-12">
    <label for="position">Position</label>
    <input type="text" name="workposition" class="form-control" value="<?php echo $churches['realwork_pos']; ?>">
  </div>
  <div class="form-group col-xs-10 col-sm-10 col-md-12 col-lg-12">
    <label for="startDate">Start Date</label>
    <input type="text" name="startworkdate" class="form-control" placeholder="yy-mm-dd" value="<?php echo $churches['realwork_start']; ?>">
  </div>
  <div class="form-group col-xs-10 col-sm-10 col-md-12 col-lg-12">
    <label for="province">State/Province</label>
    <input type="text" name="worklocation" class="form-control" value="<?php echo $churches['realwork_pro']; ?>">
  </div>
  <div class="form-group col-xs-10 col-sm-10 col-md-12 col-lg-12">
    <label for="district">City/District</label>
    <input type="text" name="workcitylocation" class="form-control" value="<?php echo $churches['realwork_dist']; ?>">
  </div>
  <div class="form-group col-xs-10 col-sm-10 col-md-12 col-lg-12">
    <input type="hidden" name="custidreference" id="custidreference" value="<?php echo $reference; ?>" class="form-control">
  </div>
  <div class="col-xs-10 col-sm-10 col-md-4 col-lg-4"></div>
  <div class="col-xs-10 col-sm-10 col-md-4 col-lg-4"></div>
  <div class="col-xs-10 col-sm-10 col-md-4 col-lg-4">
    <input type="submit" name="professionalexperience" value="Save changes" class="btn btn-primary">
  </div>
</form>
<h5>Program and Branch attended</h5>
<form action="<?php echo base_url();?>index.php/TempLoad/universitydata" method="post">
  <div class="form-group col-xs-10 col-sm-10 col-md-12 col-lg-12">
    <label for="program">Program attended</label>
    <input type="text" name="programid" value="<?php echo $program; ?>" class="form-control" id="proinput1">
  </div>
  <div class="form-group col-xs-10 col-sm-10 col-md-12 col-lg-12">
    <label for="branch">University Branch to attend</label>
    <select name="collegenameid" class="form-control" id="collegenameid">
      <option value="<?php echo $each->$colcode; ?>"><?php echo $branch; ?></option>';
      <?php foreach($branches as $each){ ?>
      <option value="<?php echo $each->branch_code; ?>"><?php echo $each->branch_name; ?></option>';<?php } ?>
    </select>
  </div>
  <div class="form-group col-xs-10 col-sm-10 col-md-12 col-lg-12">
    <label for="date_registered">Date registered</label>
    <input type="text" name="dateregisteredid" value="<?php echo $dataregist;?>" class="form-control">
  </div>
  <div class="form-group col-xs-10 col-sm-10 col-md-12 col-lg-12">
    <label for="location">University location</label>
    <input type="text" name="collegelocation" value="<?php echo $location; ?>" class="form-control">
  </div>
  <div class="form-group col-xs-10 col-sm-10 col-md-12 col-lg-12">
    <input type="hidden" name="custidreference" id="custidreference" value="<?php echo $reference; ?>" class="form-control">
  </div>
  <div class="col-xs-10 col-sm-10 col-md-4 col-lg-4"></div>
  <div class="col-xs-10 col-sm-10 col-md-4 col-lg-4"></div>
  <div class="col-xs-10 col-sm-10 col-md-4 col-lg-4">
    <input type="submit" name="universityexperience" value="Save changes" class="btn btn-primary">
  </div>
</form><br>
<form class="" method="post">
  <div class="form-group col-xs-10 col-sm-10 col-md-4 col-lg-4">
    <label for="study">Previous study Level</label>
    <input type="text" name="" value="<?php echo $edu;?>" class="form-control" id="stinput1">
  </div>
  <div class="form-group col-xs-10 col-sm-10 col-md-4 col-lg-4">
    <label for="studyfield">Field of Study/Subject</label>
    <input type="text" name="" value="<?php echo $sub;?>" class="form-control" id="stinput2">
  </div>
  <div class="form-group col-xs-10 col-sm-10 col-md-4 col-lg-4">
    <label for="graduatedate">Date Graduated</label>
    <input type="text" name="" value="<?php echo $grdate; ?>" class="form-control" id="stinput3">
  </div>
  <div class="form-group col-xs-10 col-sm-10 col-md-4 col-lg-4">
    <label for="studycollege">University/College</label>
    <input type="text" name="" value="<?php echo $colg; ?>" class="form-control" id="stinput4">
  </div>
  <div class="form-group col-xs-10 col-sm-10 col-md-4 col-lg-4">
    <label for="studylocation">Location</label>
    <input type="text" name="" value="<?php echo $colglocation; ?>" class="form-control" id="stinput5">
  </div>
  <div class="form-group col-xs-10 col-sm-10 col-md-4 col-lg-4">
    <label for="studydegree">Degree obtained</label>
    <input type="text" name="" value="<?php echo $hgdegree; ?>" class="form-control" id="stinput6">
  </div>
</form>
