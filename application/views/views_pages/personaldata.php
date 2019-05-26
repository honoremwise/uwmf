<form class="" action="index.html" method="post">
  <div class="form-group col-xs-10 col-sm-10 col-md-4 col-lg-4">
    <label for="firstname">Firstname</label>
    <input type="text" name="" value="<?php echo $fname; ?>" class="form-control" id="input1">
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
  <div class="clearfix"></div>
  <div class="col-xs-10 col-sm-10 col-md-12 col-lg-12">
  </div>
</form>
