<?php
require_once(APPPATH.'views/certificate/datareview.php');
require_once(APPPATH.'views/certificate/include.php');
require_once(APPPATH.'views/views_pages/getapplication.php');
require_once(APPPATH.'views/certificate/header.php');
if ($yearOnly==$currentyear) {?>
  <script type="text/javascript" src="<?php  echo base_url() ?>css_scripts/js/custom-applications.js"></script><?php
}
?>
            <div class="navbar-default sidebar" style="background-color:#286090">
                <div class="sidebar-nav navbar-collapse">

                  <div class="col-lg-12 col-md-6">
                    <div><!--   class="panel panel-primary-->
                        <div><!--  class="panel-heading"-->
                            <div class="row">
                                <div class="col-xs-3 col-md-3">
                                  <?php
                                  echo'<img src="' . base_url().'profiles/'.$photo . '" width="190" height="150" class="img img-circle">';
                                   ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <p style="padding-top:50px; color:white;"><?php
                    if ($yearOnly==$currentyear) {
                      echo "Application has been submitted";
                    }else {
                      echo "Application not submitted";
                    }
                     ?>
                    </p>
                  </div>
                </div>
              </nav>
        <div id="page-wrapper">
          <div class="row">
            <?php echo validation_errors('<div class="alert alert-danger" style="height:1px;">','</div>');?>
          </div>
          <div class="row" style="color:red;">
            <?php if (isset($error)) {
              echo $error;
            } ?>
          </div>
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header">Review and Submit Application</h3>
                </div>
            </div>
            <div class="row">
              <div class="panel-body">
                  <div class="panel-group" id="accordion">
                      <div class="panel panel-primary">
                          <div id="collapseOne" class="panel-collapse collapse in">
                              <div class="panel-body">
                                    <ul class="nav nav-tabs">
                                      <li class="active"><a href="#personal-data" data-toggle="tab">Personal Data</a>
                                      </li>
                                        <li><a href="#application-details" data-toggle="tab">Application Details </a>
                                        </li>
                                        <li><a href="#experience-details" data-toggle="tab">Church Experience</a>
                                        </li>
                                        <li><a href="#file-uploads" data-toggle="tab">File uploads</a>
                                        </li>
                                        <li><a href="#education" data-toggle="tab">Education Background</a>
                                        </li>
                                        <li>
                                          <a href="<?php echo base_url();?>index.php/SubmitApplication" id="submitapplicationreview">Submit Application</a>
                                        </li>
                                      </ul>
                                      <div class="tab-content">
                                        <div class="tab-pane fade" id="education">
                                          <div class="col-xs-10 col-sm-10 col-md-12 col-lg-12">
                                            <?php if (!($yearOnly==$currentyear)){?>
                                              <h5>Please click update if you wish to make changes</h5>
                                              <a href="<?php echo base_url(); ?>index.php/Update?submitMainupdate" id="submitMainupdate" class="btn btn-primary">Update</a><hr>
                                            <?php }?>
                                            <form class="" method="post">
                                              <div class="form-group col-xs-10 col-sm-10 col-md-4 col-lg-4">
                                                <label for="study">Previous study level</label>
                                                <input type="text" name="" value="<?php echo $edu; ?>" class="form-control" id="stinput1">
                                              </div>
                                              <div class="form-group col-xs-10 col-sm-10 col-md-4 col-lg-4">
                                                <label for="studyfield">Field of study/Subject</label>
                                                <input type="text" name="" value="<?php echo $sub; ?>" class="form-control" id="stinput2">
                                              </div>
                                              <div class="form-group col-xs-10 col-sm-10 col-md-4 col-lg-4">
                                                <label for="graduatedate">Date graduated</label>
                                                <input type="text" name="" value="<?php echo $grdate; ?>" class="form-control" id="stinput3">
                                              </div>
                                              <div class="form-group col-xs-10 col-sm-10 col-md-4 col-lg-4">
                                                <label for="studycollege">University/College</label>
                                                <input type="text" name="" value="<?php echo $colg; ?>" class="form-control" id="stinput4">
                                              </div>
                                              <div class="form-group col-xs-10 col-sm-10 col-md-4 col-lg-4">
                                                <label for="studylocation">University/College location</label>
                                                <input type="text" name="" value="<?php echo $colglocation; ?>" class="form-control" id="stinput5">
                                              </div>
                                              <div class="form-group col-xs-10 col-sm-10 col-md-4 col-lg-4">
                                                <label for="studydegree">Degree obtained</label>
                                                <input type="text" name="" value="<?php echo $hgdegree; ?>" class="form-control" id="stinput6">
                                              </div>
                                            </form>
                                          </div>
                                        </div>
                                        <div class="tab-pane fade" id="file-uploads">
                                          <?php if (!($yearOnly==$currentyear)){?>
                                            <h5>Please click update if you wish to make changes in uploads</h5>
                                            <a href="<?php echo base_url(); ?>index.php/Update?fileseupdate" id="fileseupdate" class="btn btn-primary">Update</a><hr>
                                          <?php }?>
                                          <?php require_once(APPPATH.'views/views_pages/viewfiles.php'); ?>
                                        </div>

                                        <div class="tab-pane fade" id="experience-details">
                                          <?php if (!($yearOnly==$currentyear)){?>
                                            <h5>Please click update if you wish to make changes</h5>
                                            <a href="<?php echo base_url(); ?>index.php/Update?churchexperienceupdate" id="churchexperienceupdate" class="btn btn-primary">Update</a><hr>
                                          <?php }?>
                                          <?php require_once(APPPATH.'views/views_pages/church_experience.php'); ?>
                                        </div>
                                        <div class="tab-pane fade" id="application-details">
                                          <div class="col-xs-10 col-sm-10 col-md-12 col-lg-12">
                                            <?php if (!($yearOnly==$currentyear)){?>
                                              <h5>Please click update if you wish to make changes</h5>
                                              <a href="" id="#updateprogram" data-toggle="modal" data-target="#updateprogram" class="btn btn-primary">Update</a>
                                            <?php }?>
                                            <h5>Program and Branch to attend</h5>
                                            <form class="" action="" method="post">
                                              <div class="form-group col-xs-10 col-sm-10 col-md-4 col-lg-4">
                                                <label for="program">Program to attend</label>
                                                <input type="text" name="" value="<?php echo $program; ?>" class="form-control" id="proinput1">
                                              </div>
                                              <div class="form-group col-xs-10 col-sm-10 col-md-4 col-lg-4">
                                                <label for="branch">University Branch to attend</label>
                                                <input type="text" name="" value="<?php echo $branch; ?>" class="form-control" id="proinput2">
                                              </div>
                                              <div class="form-group col-xs-10 col-sm-10 col-md-4 col-lg-4">
                                                <label for="location">University location</label>
                                                <input type="text" name="" value="<?php echo $location; ?>" class="form-control" id="proinput3">
                                              </div>
                                            </form>
                                          </div>
                                        </div>
                                        <!-- Modal -->
                                       <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="updateprogram" aria-hidden="true" id="updateprogram">
                                         <div class="modal-dialog">
                                           <!-- Modal content-->
                                           <div class="modal-content">
                                             <div class="modal-header">
                                               <button type="button" class="close" data-dismiss="modal">&times;</button>
                                               <h4 class="modal-title">Update Program to attend at UWMF</h4>
                                             </div>
                                             <div class="modal-body">
                                               <form  action="<?php echo base_url();?>index.php/Update/updateprogram" method="post">
                                                 <div class=" form-group">
                                                   <label for="program">Program To attend</label>
                                                   <select name="program" class="form-control" id="program">
                                                     <option value="">Select program...</option>
                                                     <?php foreach($groups as $each){ ?>
                                                     <option value="<?php echo $each->program_code; ?>"><?php echo $each->program_name; ?></option>';<?php } ?>
                                                   </select>
                                       					</div>
                                                <button type="submit" class="btn btn-primary">Update</button>
                                               </form>
                                               </div>
                                               <div class="modal-footer">
                                                 <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                               </div>
                                             </div>
                                           </div>
                                         </div><!-- end of modal-->
                                        <div class="tab-pane fade in active" id="personal-data">
                                          <div class="col-xs-10 col-sm-10 col-md-12 col-lg-12">
                                            <?php if (!($yearOnly==$currentyear)){?>
                                              <h5>Please click update if you wish to make changes</h5>
                                              <a href="<?php echo base_url(); ?>index.php/Update?submitMainupdate" id="submitMainupdate" class="btn btn-primary">Update</a><hr>
                                            <?php }
                                            require_once(APPPATH.'views/views_pages/personaldata.php'); ?>
                                          </div>
                                        </div>
                                      </div>
                                  </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  <?php require_once(APPPATH.'views/views_pages/copy.php'); ?>
                  </div>
                  <script>
                  // tooltip demo
                  $('.tooltip-demo').tooltip({
                      selector: "[data-toggle=tooltip]",
                      container: "body"
                  })
                  // popover demo
                  $("[data-toggle=popover]")
                      .popover()
                  </script>
                  </body>
                  </html>
