<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>UWMS-MIS</title>

    <!-- Bootstrap Core CSS -->
    <link href="../../css_scripts/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../../css_scripts/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../../css_scripts/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../../css_scripts/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
               <a class="navbar-brand" href="../logout.php"><img src="http://localhost/real/css_scripts/vendor/datatables/images/test.png" width="40" height="40" class="img-circle"></a>
            
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">

                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                         <li><a href="#" ><i class="fa fa-user fa-fw" data-toggle="modal" data-target="#abp"></i> <label data-toggle="modal" data-target="#abp">
                                    User Profile
                                </label></a>
                        </li>                      
                        <li><a href="../logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
 <div class="navbar-default sidebar">
                 <div class="sidebar-nav navbar-collapse">

                   <div class="col-lg-12 col-md-6">
                                  <div class="panel panel-primary">
                           
                            <a href="students.php">
                                <div class="panel-footer">
                                  <span class="pull-left">
             <?php
                                        
                $qer=mysqli_query($db,"select * from students")or die(mysqli_error($db));
              $recors=mysqli_num_rows($qer); 
                                            echo $recors;
                                           ?>
                                    Students in the database
                                     
                                  </span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
            <div class="panel panel-primary">
                             <a href="index.php">
                                <div class="panel-footer">
                                  <span class="pull-left">
                                      Applicants Test 
                                  </span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div> 
                      <div class="panel panel-primary">
                                    <a href="manage.php">
                                <div class="panel-footer">
                                  <span class="pull-left">
                                      Manage Applicants
                                  </span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div> 
<!--
                         <div class="panel panel-danger">
                                    <a href="rejecteds.php">
                                <div class="panel-footer">
                                  <span class="pull-left">
                                      Rejected Applicants
                                  </span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
-->
                      
                      </div></div></div>
                  
</nav>