<?php require_once(APPPATH.'views/certificate/include.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>UWMF-MIS-Reset-Password</title>
    <link rel="stylesheet" type="text/css" href="<?php  echo base_url() ?>css_scripts/vendor/bootstrap/css/bootstrap.min.css">
    <link href="<?php  echo base_url() ?>css_scripts/dist/css/sb-admin-2.css" rel="stylesheet">
    <link rel="icon" href="<?php  echo base_url() ?>css_scripts/vendor/datatables/images/test.png" width="200" height="150" class="img-circle">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                  <center>
                    <img src="<?php  echo base_url() ?>css_scripts/vendor/datatables/images/test.png" width="200" height="150" class="img-circle">
                  </center>
                    <div class="panel-heading">
                      <h5>Password Reset</h5>
                        <p style="color: red;">
                          <?php
                          if (validation_errors()!="") {
                            echo "Please fill all fields";
                          }
                          ?>
                          <?php if (isset($messageDisplay)){ echo $messageDisplay;}?>
                        </p>
                        <?php
                        if (isset($success)) {
                          ?>
                          <div class="alert alert-success alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <?php
                            echo $success;
                             ?>
                          </div>
                          <?php
                        }
                         ?>
                    </div>
                    <div class="panel-body">
                        <!-- username and password not valid -->
                        <?php echo form_open('ResetPassword/confirmReset'); ?>
                        <form role="form" method="post">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Email" name="Useridname" type="email" id="Useridname" autofocus required>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="ID/Passport number" name="userpassidname" type="text" id="userpassidname">
                                </div>
                                <div class="form-group">
                                  <input type="text" name="userbirthdate" placeholder="Date of birth/format:yyy-mm-dd" class="form-control" id="userbirthdate" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" title="Enter Date in format: yyy-mm-dd">
                                </div>
                                <input type="submit" name="registerloginreset" class="btn btn-lg btn-primary btn-block" value="Reset">
                            </fieldset>
                        </form>
                        <h5 style="color: black;">&copy;<?php echo date('Y'); ?>&nbsp;&nbsp;University of World Mission Frontier</h5>
                    </div>
                </div>
                <?php
                if (isset($login)) {
                  echo $login;
                }
                 ?>
            </div>
        </div>
    </div>
</body>
</html>
