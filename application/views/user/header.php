<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>UWMS-MIS-Student</title>
    <link href="<?php  echo base_url() ?>css_scripts/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php  echo base_url() ?>css_scripts/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
    <script type="text/javascript" src="<?php  echo base_url() ?>css_scripts/vendor/jquery/jquery.js"></script>
    <link href="<?php  echo base_url() ?>css_scripts/dist/css/sb-admin-2.css" rel="stylesheet">
    <link href="<?php  echo base_url() ?>css_scripts/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="icon" href="<?php  echo base_url() ?>css_scripts/vendor/datatables/images/test.png" width="200" height="150" class="img-circle">
</head>
<body>
    <div id="wrapper"  style="background-color:#286090;"> <!-- This color will be removed later-->
        <nav class="navbar navbar-default navbar-static-top" role="navigation">
                  <div class="navbar-header">
                    <img class="navbar-brand" src="<?php echo base_url();?>css_scripts/vendor/datatables/images/test.png" alt="logo">
                  </div>
                  <!-- /.navbar-header -->
                  <ul class="nav navbar-top-links navbar-right">
                      <li class="dropdown">
                          <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                              <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                          </a>
                          <ul class="dropdown-menu dropdown-user">
                              <li><a href="#getprofile" data-toggle="modal" data-target="#getprofile"><i class="fa fa-user fa-fw"></i> User Profile</a>
                              </li>
                              <li><a href="#getpassword" data-toggle="modal" data-target="#getpassword"><i class="fa fa-user fa-fw"></i> Change Password</a>
                              </li>
                              <li class="divider"></li>
                              <li><a href="<?php echo base_url();?>index.php/Logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                              </li>
                          </ul>
                      </li>
                  </ul>
