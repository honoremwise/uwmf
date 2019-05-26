<form role="form">
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
</form>
