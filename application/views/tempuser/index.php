<?php
$CI = &get_instance();
$CI->load->database();
$host= $CI->db->hostname;
$pass=$CI->db->password;
$user=$CI->db->username;
if (isset($_SESSION['username']) && isset($_SESSION['registration'])) {
  require_once(APPPATH.'views/tempuser/datareview.php');
}
function getallstudents($CI)
{
  return $CI->db->query('SELECT * FROM `students` join candidates using(reference_no) join applications using (reference_no) where applications.application_status!="pending"')->result();
}
 $getall=getallstudents($CI);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>UWMF MIS-user-login</title>
    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url() ?>css_scripts/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?php echo base_url() ?>css_scripts/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="<?php echo base_url() ?>css_scripts/vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="<?php echo base_url() ?>css_scripts/vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url() ?>css_scripts/dist/css/sb-admin-2.css" rel="stylesheet">
    <script type="text/javascript" src="<?php  echo base_url() ?>css_scripts/vendor/jquery/jquery.js"></script>
    <script type="text/javascript" src="<?php  echo base_url() ?>css_scripts/js/custom.js"></script>
    <!-- Custom Fonts -->
    <link href="<?php echo base_url() ?>css_scripts/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="icon" href="<?php  echo base_url() ?>css_scripts/vendor/datatables/images/test.png" width="200" height="150" class="img-circle">
    <script type="text/javascript">
      function getout() {
        document.getElementById('addstyle').style.visibility="hidden";
      }
      function showresults() {
        document.getElementById('addmarksbutton').style.visibility="hidden";
      }
    </script>
</head>
<body>
    <div id="wrapper" style="background-color:#286090;">
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0;">
          <img class="navbar-brand" src="<?php echo base_url();?>css_scripts/vendor/datatables/images/test.png" alt="logo" class="img img-circle">
            <ul class="nav navbar-top-links navbar-right">
                <!-- /.dropdown -->
                <li>
                  <?php
                  if (isset($_SESSION['username'])){
                    ?>
                    <!--<button id="addmarksbutton" type="button" class="btn btn-info" data-toggle="modal" data-target="#myMarks" onclick="showresults()">View Marks</button> -->
                    <button id="addstyle" type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal" onclick="getout()">View results</button>
                    <?php
                  }
                    ?>
                  </li>
                <li class="sidebar-search">
                      <div class="custom-search-form">
                        <form class="form-inline" action="<?php echo base_url();?>index.php/TempLoad/review" method="post">
                          <div class="form-group">
                            <input type="text" class="form-control" placeholder="Search student..." name="searchitem" id="searchitem">
                          </div>
                          <button class="btn btn-default" type="submit">
                              <i class="fa fa-search"></i>
                          </button>
                        </form>
                      </div>
                  </li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li class="divider"></li>
                        <li><a href="<?php echo base_url();?>index.php/TempLoad/Logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->
            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="#">Add Student<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                  <a href="#application-details" data-toggle="modal" data-target="#application-details">Create Account</a>
                                </li>
                                <li>
                                    <a href="#addnewstudent" data-toggle="modal" data-target="#addnewstudent">Personal Data</a>
                                </li>
                                <li>
                                    <a href="#working_experience" data-toggle="modal" data-target="#working_experience">Church Information</a>
                                </li>
                                <li>
                                  <a href="#job-experience" data-toggle="modal" data-target="#job-experience">Work Experience</a>
                                </li>
                                <li>
                                    <!-- <a href="#file-uploads" data-toggle="modal" data-target="#file-uploads">Uploads</a> -->
                                </li>
                                <li>
                                  <a href="#studentaccountid" data-toggle="modal" data-target="#studentaccountid">Confirm Student</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                          <a href="#">Manage Student<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                  <a href="#bannerformmodal" data-toggle="modal" data-target="#bannerformmodal">Edit student number</a>
                                </li>
                                <li>
                                  <a href="#editprogram" data-toggle="modal" data-target="#editprogram">Edit Student Program</a>
                                </li>
                                <li>
                                  <a href="#editacademic" data-toggle="modal" data-target="#editacademic">Edit Academic records</a>
                                </li>
                            </ul>
                        </li> <!-- Comments can be removed later
                        <li>
                          <a href="#">Manage Marks<span class="fa arrow"></span></a>
                          <ul class="nav nav-second-level">
                              <li>
                                <a href="#addmarks" data-toggle="modal" data-target="#addmarks">Add student marks</a>
                              </li>
                              <li>
                                <a href="#editmarks" data-toggle="modal" data-target="#editmarks">Edit Marks</a>
                              </li>
                          </ul>
                        </li> -->
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
        <div id="page-wrapper">
          <div class="form_error">
            <?php echo validation_errors('<div class="alert alert-danger" style="height:1px;">','</div>');?>
          </div>
          <div class="row" style="color:red;">
    				<?php if (isset($erroruser)) {
              ?>
              <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <?php
                echo $erroruser;
                unset($erroruser);
                 ?>
              </div>
              <?php
    				}
            if (isset($recorderror)) {
              ?>
              <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <?php
                echo $recorderror;
                unset($recorderror);
                 ?>
              </div>
              <?php
            }
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
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="tab-content">
              <div class="tab-pane fade in active" id="studentsview">
                <?php
                if (count($getall)>0) {
                  ?>
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="table-responsive">
                        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                              <th>Student number</th>
                              <th>Firstname</th>
                              <th>Lastname</th>
                              <th>Email</th>
                              <th>Telephone</th>
                              <th>ID Number</th>
                            </thead>
                            <tbody>
                              <?php
                              foreach ($getall as $students) {
                                ?>
                                <tr class="odd gradeA">
                                  <td><?php echo $students->registration_no; ?></td>
                                  <td><?php echo $students->first_name; ?></td>
                                  <td><?php echo $students->last_name; ?></td>
                                  <td><?php echo $students->candidate_email; ?></td>
                                  <td><?php echo $students->candidate_telephone; ?></td>
                                  <td><?php echo $students->id_passport; ?></td>
                                </tr>
                                <?php
                              }
                               ?>
                            </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                  <?php
                } else {
                  echo "No current students to show";
                }
                 ?>
              </div>

              <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="bannerformmodal" aria-hidden="true" id="bannerformmodal">
                <div class="modal-dialog">
                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">Edit student number</h4>
                    </div>
                    <div class="modal-body">
                      <form class="" action="<?php echo base_url();?>index.php/TempLoad/getreference" method="post">
                        <div class="form-group">
                          <label for="student number">Student number</label>
                          <input type="text" name="candidatenumberid" value="" id="candidatenumberid" class="form-control" required>
                        </div>
                        <div class="form-group">
                          <label for="newnumber">New student number</label>
                          <input type="text" name="studentnumberid" id="studentnumberid" class="form-control" required>
                        </div>
                        <input type="submit" name="getnumberid" value="Edit" name="getnumberid" class="btn btn-success">
                      </form>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                  </div>
                </div>
              </div> <!-- end of modal here-->

              <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="editmarks" aria-hidden="true" id="editmarks">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">Edit marks</h4>
                    </div>
                    <div class="modal-body">
                      <form class="" action="<?php echo base_url();?>index.php/Addmarks/editmarks" method="post">
                        <div class="form-group">
                          <label for="student number">Student number</label>
                          <input type="text" name="candidatenumberid" value="" id="candidatenumberid" class="form-control" required>
                        </div>
                        <div class="form-group">
                          <label for="module">Module Code</label>
              						<select name="moduleidcode" class="form-control" id="moduleidcode">
              							<option value="">Select Module...</option>
              							<?php foreach($modules as $each){ ?>
                            <option value="<?php echo $each->module_id; ?>"><?php echo $each->module_code; ?></option>';<?php } ?>
              						</select>
                        </div>
                        <div class="form-group">
                          <label for="marksadd">Marks</label>
                          <input type="number" name="marksdataid" value="" id="marksdataid" class="form-control">
                        </div>
                        <div class="form-group">
                          <label for="marksdate">Marks submited date</label>
                          <input type="text" name="marksdatetime" value="" class="form-control" id="marksdatetime" required placeholder="yyy-mm-dd" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" title="Enter Date in format: yyy-mm-dd">
                        </div>
                        <input type="submit" name="getmarksid" value="Save" name="getmarksid" class="btn btn-primary">
                      </form>
                    </div>
                  </div>
                </div>
              </div><!-- end of modal here-->
              <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addmarks" aria-hidden="true" id="addmarks"><!-- add student marks -->
                <div class="modal-dialog">
                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">Add student marks</h4>
                    </div>
                    <div class="modal-body">
                      <form class="" action="<?php echo base_url();?>index.php/Addmarks/studentMarks" method="post">
                        <div class="form-group">
                          <label for="student number">Student number</label>
                          <input type="text" name="candidatenumberid" value="" id="candidatenumberid" class="form-control" required>
                        </div>
                        <div class="form-group">
                          <label for="module">Module Code</label>
              						<select name="moduleidcode" class="form-control" id="moduleidcode">
              							<option value="">Select Module...</option>
              							<?php foreach($modules as $each){ ?>
                            <option value="<?php echo $each->module_id; ?>"><?php echo $each->module_code; ?></option>';<?php } ?>
              						</select>
                        </div>
                        <div class="form-group">
                          <label for="marksadd">Marks</label>
                          <input type="number" name="marksdataid" value="" id="marksdataid" class="form-control">
                        </div>
                        <div class="form-group">
                          <label for="marksdate">Marks submited date</label><span>(Consider to enter a valid date)</span>
                          <input type="text" name="marksdatetime" value="" class="form-control" id="marksdatetime" required placeholder="yyy-mm-dd" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" title="Enter Date in format: yyy-mm-dd">
                        </div>
                        <input type="submit" name="getmarksid" value="Save" name="getmarksid" class="btn btn-primary">
                      </form>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                  </div>
                </div>
              </div><!-- end of modal-->
              <!-- Modal -->
              <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="studentaccountid" aria-hidden="true" id="studentaccountid"><!-- add student marks -->
                <div class="modal-dialog">
                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">Student Confirmation</h4>
                    </div>
                    <div class="modal-body">
                      <form class="" action="<?php echo base_url();?>index.php/TempLoad/send" method="post">
                        <div class="form-group">
                          <label for="email">Email address</label>
                          <input type="email" name="emailid" id="emailid" class="form-control">
                        </div>
                        <div class="form-group">
                          <label for="studentid">Student number</label>
                          <input type="text" name="studentidentity" name="studentidentity" class="form-control">
                        </div>
                        <input type="submit" name="sendbutton" value="Get student" class="btn btn-primary">
                      </form>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                  </div>
                </div>
              </div><!-- end of modal-->
              <div style="color:red; padding-bottom:30px;">
    						<?php
    						if (isset($error_file_upload)) {
                  ?>
                  <script type="text/javascript">
                    var errorFile='<?php echo $error_file_upload; ?>';
                    alert(errorFile);
                  </script>
                  <?php
    						}
    						if (isset($minimum_upload)) {
    							echo $minimum_upload;
    						}
    						?>
    					</div>
              <div class="">
                <?php
                if (!empty($validsearch) && $validsearch==true) {
                  ?>
                  <!-- BUTTON HERE-->
                  <div class="modal fade" id="myModal" role="dialog">
                    <div class="modal-dialog">
                      <!-- Modal content-->
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <h4 class="modal-title">Search result</h4>
                        </div>
                        <div class="modal-body">
                          <?php require_once(APPPATH.'views/tempuser/data.php');?>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <?php
                }
                ?>
              </div>
            <!-- Modal -->
            <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="application-details" aria-hidden="true" id="application-details"><!-- add student marks -->
              <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add student account</h4>
                  </div>
                  <div class="modal-body">
                  <form name="userregistermain" action="<?php echo base_url();?>index.php/TempLoad/RegisterMainData" id="userregistermain" method="post">
                      <div class="form-group">
                          <label for="inputEmail">Email</label><span id="email_err_msg" style="color:red;"></span>
                          <input type="email" class="form-control" name="CandidateEmail" id="CandidateEmail" required>
                      </div>
                      <div class="form-group">
                          <label for="Email">Confirm Email</label>
                          <input type="text" class="form-control" name="CandidateEmailConfirm" id="CandidateEmailConfirm" required>
                          <span id="password_err_msg" class="spanstyle"></span>
                      </div>
                      <div class="form-group">
                        <label for="firstname">Firstname</label><span id="error_fname" style="color:red;"></span>
                        <input type="text" name="CandidateFname" class="form-control" id="CandidateFname" required>
                      </div>
                      <div class="form-group">
                        <label for="lastname">Lastname</label><span id="error_lname" style="color:red;"></span>
                        <input type="text" name="CandidateLname" class="form-control" id="CandidateLname" required>
                      </div>
                      <div class="form-group">
                          <label for="date">Date of application</label>
                          <input type="text" class="form-control" name="CandidateDate" id="CandidateDate" placeholder="yyy-mm-dd" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" title="Enter Date in format: yyy-mm-dd" required>
                          <span id="retypepassword_err_msg" class="spanstyle"></span>
                      </div>
                      <div class=" form-group">
                      <label for="program">Program applyied</label><span id="program_err_msg" style="color:red;"></span>
                      <select name="program" class="form-control" id="program">
                        <option value="">Select program...</option>
                        <?php foreach($groups as $each){ ?>
                        <option value="<?php echo $each->program_code; ?>"><?php echo $each->program_name; ?></option>';<?php } ?>
                      </select>
                     </div>
                     <input type="submit" name="" value="Create Account"class="btn btn-primary" id="btnsubmit">
                  </form>
                  </div>
                </div>
              </div>
            </div><!-- end of modal-->
            <!-- Modal -->
            <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="application-details" aria-hidden="true" id="myMarks"><!-- add student marks -->
              <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Student Marks</h4>
                  </div>
                  <div class="modal-body">
                    <table class="table table-sm">
                      <?php
                      if (isset($_SESSION['registration']) && !empty($marks[0]->points)) {
                        ?>
                        <thead>
                          <th>Module Code</th>
                          <th>Module name</th>
                          <th>Marks</th>
                          <th>Grade</th>
                          <th>Submitted date</th>
                        </thead>
                        <?php
                      }
                       ?>
                      <tbody>
                        <?php if (isset($_SESSION['registration']) && !empty($marks[0]->points)){
                          foreach ($marks as $values) {
                            echo "<tr>";
                            echo "<td>";
                            echo $values->module_code;
                            echo "</td>";
                            echo "<td>";
                            echo $values->module_name;
                            echo "</td>";
                            echo "<td>";
                            echo $values->points;
                            echo "</td>";
                            echo "<td>";
                            echo $values->letter;
                            echo "</td>";
                            echo "<td>";
                            echo $values->addition_date;
                            echo "</td>";
                            echo "</tr>";
                          }
                        }
                        else {
                          echo "No current marks for selected student";
                        }
                        ?>
                      </tbody>
                    </table>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div><!-- end of modal-->
            <!-- Modal -->
          <div class="modal fade" role="dialog" aria-labelledby="addnewstudent" aria-hidden="true" id="addnewstudent"><!-- add student marks -->
          <div class="modal-dialog">
         <!-- Modal content-->
        <div class="modal-content">
         <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">New student</h4>
        </div>
        <div class="modal-body">
        <?php require_once(APPPATH.'views/tempuser/personaldata.php'); ?>
       </div>
      </div>
      </div>
      </div><!-- end of modal-->

              <!-- Modal -->
              <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="working_experience" aria-hidden="true" id="working_experience"><!-- add student marks -->
                <div class="modal-dialog">
                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">Church Information</h4>
                    </div>
                    <div class="modal-body">
                      <?php require_once(APPPATH.'views/tempuser/church_experience.php'); ?>
                    </div>
                  </div>
                </div>
              </div><!-- end of modal-->

              <!-- Modal -->
              <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="job-experience" aria-hidden="true" id="job-experience"><!-- add student marks -->
                <div class="modal-dialog">
                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">Work Experience</h4>
                    </div>
                    <div class="modal-body">
                      <?php require_once(APPPATH.'views/tempuser/job_experience.php'); ?>
                    </div>
                  </div>
                </div>
              </div><!-- end of modal-->

              <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="file-uploads" aria-hidden="true" id="file-uploads"><!-- add student marks -->
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">Documents Upload</h4>
                    </div>
                    <div class="modal-body">
                      <?php require_once(APPPATH.'views/tempuser/fileuploads.php');?>
                    </div>
            </div>
        </div>
        <!-- /#page-wrapper -->
        </div>
    <!-- Modal -->
     <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="#editprogram" aria-hidden="true" id="editprogram">
    <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit student program</h4>
      </div>
      <div class="modal-body">
        <form  action="<?php echo base_url();?>index.php/TempLoad/updateprogram" method="post">
          <div class="form-group">
            <label for="student number">Student Number</label>
            <input type="text" name="candidatenumber" class="form-control" required>
          </div>
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
<!-- update academic records-->
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="#editacademic" aria-hidden="true" id="editacademic">
  <div class="modal-dialog">
  <!-- Modal content-->
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title">Edit Academic Record</h4>
    </div>
    <div class="modal-body">
      <form method="post" action="<?php echo base_url();?>index.php/TempLoad/updateacademic">
        <div class="form-group">
          <label for="program">Program Attended</label>
          <input type="text" name="" value="<?php echo $program; ?>" class="form-control" id="proinput1"/>
        </div>
        <div class=" form-group">
          <label for="universityBranch">University Branch to attend</label><span id="error_branch"></span>
          <select name="branchesid" class="form-control" id="Candidatebranch">
            <?php foreach($branches as $each){ ?>
            <option value="<?php echo $each->branch_code; ?>"><?php echo $each->branch_name; ?></option>';<?php } ?>
          </select>
        </div>
        <div class="form-group">
          <label for="location">University location</label>
          <input type="text" name="branchlocationid" value="<?php echo $location; ?>" class="form-control" id="proinput3">
        </div>
        <div class="form-group">
          <input type="hidden" name="custidreference" id="custidreference" value="<?php echo $reference; ?>" class="form-control">
        </div>
        <div class="form-group">
          <label for="date registered">Date registered</label>
          <input type="text" name="dateappliedid" value="<?php echo $dateapplication; ?>" class="form-control">
        </div>
        <div class="form-group">
          <label for="study">Previous study level</label>
          <input type="text" name="studyidlevel" value="<?php echo $edu; ?>" class="form-control" id="stinput1">
        </div>
        <div class="form-group">
          <label for="studyfield">Field of study/Subject</label>
          <input type="text" name="studyfieldid" value="<?php echo $sub; ?>" class="form-control" id="stinput2">
        </div>
        <div class="form-group">
          <label for="graduatedate">Date graduated</label>
          <input type="text" name="graduatedateid" value="<?php echo $grdate; ?>" class="form-control" id="stinput3">
        </div>
        <div class="form-group">
          <label for="studycollege">University/College</label>
          <input type="text" name="collegeid" value="<?php echo $colg; ?>" class="form-control" id="stinput4">
        </div>
        <div class="form-group">
          <label for="studylocation">Location</label>
          <input type="text" name="collegeidlocation" value="<?php echo $colglocation; ?>" class="form-control" id="stinput5">
        </div>
        <div class="form-group">
          <label for="studydegree">Degree obtained</label>
          <input type="text" name="degreetypeid" value="<?php echo $hgdegree; ?>" class="form-control" id="stinput6">
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn-primary">Update</button>
        </div>
      </form>
    </div>
    <div class="modal-footer" style="background-color:#286090;">

    </div>
  </div>
</div>
</div> <!-- /end of modal -->
    <!-- /#wrapper -->
    <!-- jQuery -->
    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo base_url() ?>css_scripts/vendor/metisMenu/metisMenu.min.js"></script>
    <script src="<?php echo base_url() ?>css_scripts/vendor/jquery/jquery.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url() ?>css_scripts/vendor/bootstrap/js/bootstrap.min.js"></script>
    <!-- DataTables JavaScript -->
    <script src="<?php echo base_url() ?>css_scripts/vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url() ?>css_scripts/vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo base_url() ?>css_scripts/vendor/datatables-responsive/dataTables.responsive.js"></script>
    <!-- Custom Theme JavaScript -->
  <script src="<?php echo base_url() ?>css_scripts/dist/js/sb-admin-2.js"></script>
    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true
        });
    });
    </script>
</body>
</html>
