<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>UWMF-MIS-Application</title>
    <link rel="icon" href="<?php  echo base_url() ?>css_scripts/vendor/datatables/images/test.png" width="200" height="150" class="img-circle">
    <link href="<?php echo base_url(); ?>css_scripts/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>css_scripts/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>css_scripts/dist/css/sb-admin-2.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>css_scripts/vendor/morrisjs/morris.css" rel="stylesheet">
    <link rel="icon" href="<?php  echo base_url() ?>css_scripts/vendor/datatables/images/test.png" width="200" height="150" class="img-circle">
    <link href="<?php echo base_url(); ?>css_scripts/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="<?php echo base_url(); ?>css_scripts/vendor/jquery/jquery.js"></script>
    <script type="text/javascript" src="<?php  echo base_url() ?>css_scripts/js/custom.js"></script>
    <script type="text/javascript">
    function validMessage(){
      alert("Data successfuly saved");
    }
    </script>
    <style media="screen">
      .spanstyle{
        color: red;
      }
    </style>
</head>
<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
          <img class="navbar-brand" src="<?php echo base_url();?>css_scripts/vendor/datatables/images/test.png" alt="logo">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Manage<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="#getaccount" data-toggle="modal" data-target="#getaccount"><i class="fa fa-user fa-fw"></i>&nbsp;Create account</a>
                                </li>
                                <li>
                                    <a href="<?php echo site_url();?>LoadPages/ResumeApplication"><i class="fa fa-sign-out fa-fw"></i> Login</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                          <a href="#"><i class="fa fa-bar"></i>Contact us<span class="fa arrow"></span></a>
                          <ul class="nav nav-second-level">
                            <li><a href="#">Tel:+250781403982</a>
                            </li>
                            <li><a href="#">Email:</a>
                            </li>
                            </li>
                          </ul>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div><!-- end here -->
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            <div class="row">
              <div class="form_error">
                <?php echo validation_errors('<div class="" style="color:red; padding-top:10px;">','</div>');?>
              </div>
              <div style="color:red;">
                <?php if (isset($erroruser)) {
                  echo $erroruser;
                }?>
              </div>
              <div class="row">
                <div class="col-lg-12">
                  <?php
                  if (isset($account)) {
                    ?>
                    <div class="alert alert-success" style="height:5px;">
                      <?php echo $account;
                       ?>
                    </div>
                    <?php
                  }
                   ?>
                </div>
              </div>
                <div class="col-lg-12">
                  <h3 class="page-header">Student application</h3>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
              <div class="panel-body">
                  <div class="panel-group" id="accordion">
                      <div class="panel panel-primary">
                          <div id="collapseOne" class="panel-collapse collapse in">
                              <div class="panel-body">
                                    <ul class="nav nav-tabs">
                                        <li class="active"><a href="#viewbackground" data-toggle="tab">About Us</a>
                                        </li>
                                        <li ><a href="#userlistviewprograms" data-toggle="tab">Our Programs</a>
                                        </li>
                                      </ul>
                                      <div class="tab-content">
                                        <div class="tab-pane fade in active" id="viewbackground">
                                          <div class="row">
                                          <div class="col-md-12 col-lg-12" style="font-size:17px; text-align:justify;">
                                            University of World Mission Frontier was estabished in Kampala, Uganda, in 2012 by Dr. Pyung Lyuk Kim (Paul Kim),the founder of Christian Life World Mission Frontiers to provide affordable theological education for Christian leaders.
                                            It began as Kingdom Builders Bible Academy(KBBA) offering Certificate,Diploma and Bachelors programs but changed to the current name in 2013 as its vision widened to train Christian professional leaders.
                                            In 2015 UWMF launched the graduate school with the Master of Divinity program.UWMF is owned and sponsored by CLWMF organization.
                                            UWMF has also applied to Association of Christian Theological Education in Africa(ACTEA) based in Nairobi; for accreditation of its theological programs and still at affiliation stage.
                                            <h3>Vision of UWMF</h3>
                                            The vision of UWMF is to be a theological institution that provides excellent spiritual, academic and holistic training to the church for transformation of Africa.
                                            <h3>Mission Statement</h3>
                                            The mission of UWMF is exalting God and serving His church through availing basic, standard and advanced Christian education centered on Holy Scripture, thus preparing faithful and transformed servants who preach Jesus Christ and spread Scripture Holiness and transformation throughout Africa and the world.
                                          </div>
                                          </div>
                                        </div>
                                        <div class="tab-pane" id="userlistviewprograms">
                                          <div class="row">
                                            <div class="col-md-12 col-lg-12" style="font-size:17px; text-align:justify;">
                                              University of World Mission Frontier is based in Nsangi-Kampala,Uganda as its main campus and has an extension campus in Kigali,Rwanda. <br>It comprises undergraduate campuses namely:Nyamasheke (church based), Kayonza (Church based) and Kigali as main extension campus offering only Bachelors, two graduate classes based in Kigali.
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="getaccount" aria-hidden="true" id="getaccount">
                                        <div class="modal-dialog">
                                          <!-- Modal content-->
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                                              <h4 class="modal-title">Create account</h4>
                                            </div>
                                            <div class="modal-body">
                                              <form name="userregistermain" action="<?php echo site_url();?>SaveRegister/RegisterMainData" id="userregistermain" method="post">
                                                  <div class="form-group">
                                                      <label for="inputEmail">Email</label>
                                                      <input type="email" class="form-control" name="CandidateEmail" id="CandidateEmail" required>
                                                      <span id="email_err_msg" class="spanstyle"></span>
                                                  </div>
                                                  <div class="form-group">
                                                      <label for="inputPassword">Password</label>
                                                      <input type="password" class="form-control" name="CandidatePassword" id="CandidatePassword" required>
                                                      <span id="password_err_msg" class="spanstyle"></span>
                                                  </div>
                                                  <div class="form-group">
                                                      <label for="inputPassword">Confirm Password</label>
                                                      <input type="password" class="form-control" name="CandidatePasswordConf"  id="CandidatePasswordConf" required>
                                                      <span id="retypepassword_err_msg" class="spanstyle"></span>
                                                  </div>
                                                  <div class=" form-group">
                                                  <label for="program">Program applying for</label>
                                                  <select name="program" class="form-control" id="program">
                                                    <option>Select program...</option>
                                                    <?php foreach($groups as $each){ ?>
                                                    <option value="<?php echo $each->program_code; ?>"><?php echo $each->program_name; ?></option>';<?php } ?>
                                                  </select>
                                                  <span id="program_err_msg" class="spanstyle"></span>
                                                </div>
                                                  <input type="submit" name="" value="Create Account"class="btn btn-outline btn-primary" id="btnsubmit">
                                              </form>
                                            </div>
                                            <div class="modal-footer">
                                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            </div>
                                          </div>
                                        </div>
                                      </div><!-- end of modal-->
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
            <!-- /.row -->
        </div>
    </div>
    <script type="text/javascript" src="<?php  echo base_url() ?>css_scripts/vendor/jquery/jquery.js"></script>
    <script src="<?php echo base_url(); ?>css_scripts/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>css_scripts/vendor/metisMenu/metisMenu.min.js"></script>
    <script src="<?php echo base_url(); ?>css_scripts/vendor/raphael/raphael.min.js"></script>
    <script src="<?php echo base_url(); ?>css_scripts/vendor/morrisjs/morris.min.js"></script>
    <script src="<?php echo base_url(); ?>css_scripts/data/morris-data.js"></script>
    <script src="<?php echo base_url(); ?>css_scripts/dist/js/sb-admin-2.js"></script>
</body>
</html>
