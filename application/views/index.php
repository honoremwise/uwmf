<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>University of World Mission Frontier-Kigali</title>
    <link rel="stylesheet" type="text/css" href="<?php  echo base_url() ?>css_scripts/vendor/bootstrap/css/bootstrap.min.css">
    <link href="<?php  echo base_url() ?>css_scripts/dist/css/sb-admin-2.css" rel="stylesheet">
    <link rel="icon" href="<?php  echo base_url() ?>css_scripts/vendor/datatables/images/test.png" width="200" height="150" class="img-circle">
    <?php
    require_once(APPPATH.'views/certificate/include.php');
     ?>
     <script type="text/javascript" src="<?php  echo base_url() ?>css_scripts/js/custom.js"></script>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
              <?php
              if (isset($application)) {
                ?>
                <p style="color:red">
                  <?php echo $application; ?>
                </p>
                <?php
              }
               ?>
                <div class="login-panel panel panel-default">
                  <center>
                    <img src="<?php  echo base_url() ?>css_scripts/vendor/datatables/images/test.png" width="200" height="150" class="img-circle" alt="logo">
                  </center>
                    <div class="panel-heading">
                        <?php
                        if (isset($reset)) {
                          ?>
                          <div class="alert alert-success alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <?php
                            echo $reset;
                             ?>
                          </div>
                          <?php
                        }
                        if (validation_errors()!="") {
                          echo validation_errors('<div class="alert alert-danger" style="height:1px;">','</div>');// <!-- Validation errors -->
                        }
                        ?>
                    </div>
                    <div class="panel-body page" style="color: red;">
                        <span id="errorlogin"></span>
                        <?php if (isset($messageDisplay)){ echo $messageDisplay;}?><!-- username and password not valid -->
                        <?php if (isset($error_login)) {
                          echo $error_login;
                        }?>
                        <?php if (isset($session)){
              						echo $session;
              					}?>
                        <?php if (isset($logout)){
              						echo $logout;
              					}?>
                        <form role="form" method="post" action="<?php echo site_url();?>userLoginAuthentication/userLoginProcess" id="loginuser">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Email" name="Useridname" type="text" id="Useridname"autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="useridPassword" type="password" id="useridPassword">
                                </div>
                                <input type="submit" name="registerlogin" class="btn btn-lg btn-primary btn-block" value="Login">
                                <center><a href="<?php echo site_url()?>ResetPassword/reset"><span style="font-size: 13px;font-weight: 700;">Password Help</span></a></center><hr>
                                <strong style="color:black;">
                                  <label class="control-label"> Don't have an account?</label>
                                  <a href="<?php echo site_url()?>getPrograms"><span style="font-size: 13px;"> Register</span></a></a>
                                </strong>
                            </fieldset>
                        </form>
                    </div>
                </div>
                <h5 style="color: black;">&copy;<?php echo date('Y'); ?>&nbsp;&nbsp;University of World Mission Frontier-Kigali</h5>
            </div>
        </div>
    </div>
</body>
</html>
