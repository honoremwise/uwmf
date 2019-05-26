<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>University application</title>
    <link rel="stylesheet" type="text/css" href="<?php  echo base_url() ?>css_scripts/vendor/bootstrap/css/bootstrap.min.css">
    <link href="<?php  echo base_url() ?>css_scripts/dist/css/sb-admin-2.css" rel="stylesheet">
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
                      <h5>Choose New System  Password</h5>
                      <p style="color:red;">
                        <?php
                        if (validation_errors()!="") {
                          echo "Please fill all fields";
                        }
                        
                        ?>
                      </p>
                    </div>
                    <div class="panel-body" style="color: red;">
                        <?php if (isset($messageDisplay)){ echo $messageDisplay;}?>
                        <?php echo form_open('ResetPassword/userresetpassword'); ?>
                        <form role="form" method="post">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Email" name="Useridname" type="text" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="New Password" name="useridPassword" type="password" value="">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Confirm New Password" name="useridconfPassword" type="password" value="">
                                </div>
                                <input type="submit" name="registerlogin" class="btn btn-lg btn-primary btn-block" value="Reset">
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
