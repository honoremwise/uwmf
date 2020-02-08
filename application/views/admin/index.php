<?php
//require_once(APPPATH.'views/certificate/include.php');
$CI = &get_instance();
$CI->load->database();
$host= $CI->db->hostname;
$pass=$CI->db->password;
$user=$CI->db->username;
$dates=$CI->db->query('SELECT application_start_date,application_close_date FROM academic_schedule');
$results=$dates->result();
foreach ($results as $value) {
  $start=$value->application_start_date;
  $close=$value->application_close_date;
}
if (!empty($start) && !empty($close)) {
  // code...
}else {
  $start="";
  $close="";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>UWMF-MIS-Administrator</title>
    <link href="<?php  echo base_url() ?>css_scripts/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php  echo base_url() ?>css_scripts/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
    <script type="text/javascript" src="<?php  echo base_url() ?>css_scripts/vendor/jquery/jquery.js"></script>
    <link href="<?php  echo base_url() ?>css_scripts/dist/css/sb-admin-2.css" rel="stylesheet">
    <link href="<?php  echo base_url() ?>css_scripts/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="icon" href="<?php  echo base_url() ?>css_scripts/vendor/datatables/images/test.png" width="200" height="150" class="img-circle">
    <style media="screen">
  		.disabledstyle{
  			color:white;
        cursor: not-allowed;
        text-decoration: none;
        pointer-events: none;
  		}
  	</style>
</head>
<body>
    <div id="wrapper"  style="background-color:#286090;"> <!-- This color will be removed later-->
        <nav class="navbar navbar-default navbar-static-top" role="navigation">
          <img class="navbar-brand" src="<?php echo base_url();?>css_scripts/vendor/datatables/images/test.png" alt="logo">
                  <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                  </div>
                  <!-- /.navbar-header -->
                  <ul class="nav navbar-top-links navbar-right">
                      <li class="dropdown">
                          <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                              <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                          </a>
                          <ul class="dropdown-menu dropdown-user">
                              <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                              </li>
                              <li class="divider"></li>
                              <li><a href="<?php echo site_url();?>Adminuser/logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                              </li>
                          </ul>
                      </li>
                  </ul>
                  <div class="navbar-default sidebar" role="navigation">
                      <div class="sidebar-nav navbar-collapse">
                          <ul class="nav" id="side-menu">
                            <li><a href="#"><i class="fa fa-bar"></i>Manage Users<span class="fa arrow"></span></a>
                              <ul class="nav nav-second-level">
                                <li>
                                  <a href="#adduser" data-toggle="modal" data-target="#adduser">Add a system user</a>
                                </li>
                                <li><a href="#useresponsability" data-toggle="modal" data-target="#useresponsability">User Positions</a>
                                </li>
                                <li>
                                  <a href="#editemail" data-toggle="modal" data-target="#editemail">Edit student email</a>
                                </li>
                              </ul>
                            </li>
                              <li>
                                <a href="#"><i class="fa fa-bar"></i>Manage uploads<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                  <li>
                                    <a href="#addfile" data-toggle="modal" data-target="#addfile">Upload a file</a>
                                  </li>
                                  <li>
                                    <a href="#viewfiles" data-toggle="modal" data-target="#viewfiles">View uploads</a>
                                  </li>
                                  <li>
                                    <a href="#addfiletitle" data-toggle="modal" data-target="#addfiletitle">Add file title</a>
                                  </li>
                                </ul>
                              </li>
                              <li><a href="#"><i class="fa fa-bar"></i>Academic Activities<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                  <li>
                                    <a href="#addschedule" data-toggle="modal" data-target="#addschedule">Add Application Date</a>
                                  </li>
                                </ul>
                              </li>
                          </ul>
                      </div>
                      <!-- /.sidebar-collapse -->
                  </div><!-- end here -->
            </nav>
          </div>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header">Administrator Panel</h3>
                </div>
            </div>
            <div class="form_error">
              <?php echo validation_errors('<div class="alert alert-danger" style="height:1px;">','</div>');?>
            </div>
            <?php
            if (isset($recorderror)) {
              ?>
              <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <?php
                echo $recorderror;
                 ?>
              </div>
              <?php
            }
            if (isset($errorfile)) {
              ?><div style="color:red;">
                <?php echo $errorfile; ?>
              </div><?php
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
            <div class="row">
              <div class="panel-body">
                  <div class="panel-group" id="accordion">
                      <div class="panel panel-primary">
                          <div id="collapseOne" class="panel-collapse collapse in">
                              <div class="panel-body">
                                    <ul class="nav nav-tabs">
                                        <li><a href="#usersviewblocked" data-toggle="tab">Blocked Users</a>
                                        </li>
                                        <li class="active"><a href="#userslistview" data-toggle="tab">View users</a>
                                        </li>
                                      </ul>
                                      <div class="tab-content">
                                        <div class="tab-pane fade in active" id="userslistview">
                                          <!-- /.panel-heading -->
                                            <div class="panel-body">
                                                <div class="table-responsive">
                                                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                                        <thead>
                                                            <tr>
                                                              <th >No</th>
                                                              <th >Firstname</th>
                                                              <th >Lastname</th>
                                                              <th >Email</th>
                                                              <th >Telephone</th>
                                                              <th >Status</th>
                                                              <th>Responsability</th>
                                                              <th>Change Status</th>
                                                            </tr>
                                                          </thead>
                                                          <tbody>
                                                            <?php
                                                            foreach ($users as $value) {
                                                              if ($value->status=='Blocked') {
                                                                $blocked=TRUE;
                                                              }
                                                              echo "<tr>";
                                                              echo "<td>";
                                                              //echo "<center>";
                                                              echo $value->user_id;
                                                              //echo "</center>";
                                                              echo "</td>";

                                                              echo "<td><center>";
                                                              echo $value->first_name;
                                                              echo "</center></td>";
                                                              echo "<td><center>";
                                                              echo $value->last_name;
                                                              echo "</center></td>";
                                                              echo "<td><center>";
                                                              echo $value->email;
                                                              echo "</center></td>";
                                                              echo "<td><center>";
                                                              echo $value->telephone;
                                                              echo "</center></td>";
                                                              echo "<td><center>";
                                                              echo $value->status;
                                                              echo "</center></td>";
                                                              echo "<td><center>";
                                                              echo $value->responsability;
                                                              echo "</center></td>";
                                                              ?>
                                                              <td>
                                                                <form class="" action="<?php echo site_url();?>Adminuser/statusblock" method="post">
                                                                  <input type="hidden" name="userstatusid" value="<?php echo $value->status;?>" id="userstatusid">
                                                                  <input type="hidden" name="useridvalue" value="<?php echo $value->email; ?>" id="useridvalue">
                                                                  <button type="submit" name="buttonblock" class="btn btn-small glyphicon glyphicon-off" id="buttonblock"></button>
                                                                  <span>
                                                                    <button type="submit" name="buttonactivate" class="btn btn-Small glyphicon glyphicon-user"></button>
                                                                  </span>
                                                                </form>
                                                              </td>
                                                              <?php
                                                              echo "</tr>";
                                                            }
                                                            ?>
                                                          </tbody>
                                                      </table>
                                                  </div>
                                                  <!-- /.table-responsive -->
                                              </div>
                                          <!-- till here -->

                                        </div>
                                        <div class="tab-pane fade" id="usersviewblocked">
                                          <div class="panel-body">
                                            <div class="table-responsive">
                                              <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example1">
                                                <?php
                                                if ($blocked==TRUE) {
                                                  ?>
                                                  <thead>
                                                    <tr>
                                                      <th>No</th>
                                                      <th>Firstname</th>
                                                      <th>Lastname</th>
                                                      <th>Email</th>
                                                      <th>Telephone</th>
                                                      <th>Status</th>
                                                      <th>Responsability</th>

                                                    </tr>
                                                  </thead>
                                                  <?php
                                                  foreach ($users as $values) {
                                                    if ($values->status=='Blocked') {
                                                      ?>
                                                      <tbody>
                                                        <tr>
                                                          <td><?php echo $values->user_id;?></td>
                                                          <td><?php echo $values->first_name;?></td>
                                                          <td><?php echo $values->last_name;?></td>
                                                          <td><?php echo $values->email;?></td>
                                                          <td><?php echo $values->telephone;?></td>
                                                          <td><?php echo $values->status;?></td>
                                                          <td><?php echo $values->responsability;?></td>
                                                        </tr>
                                                      </tbody>
                                                      <?php
                                                    }
                                                  }
                                                }else {
                                                  echo "No Blocked users";
                                                }
                                                 ?>
                                              </table>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="adduser" aria-hidden="true" id="adduser">
                                        <div class="modal-dialog">
                                          <!-- Modal content-->
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                                              <h4 class="modal-title">Add system users</h4>
                                            </div>
                                            <div class="modal-body">
                                              <form class="" action="<?php echo site_url();?>Adminuser/addUserdata" method="post">
                                                <div class="form-group">
                                                  <label for="firstname">Firstname</label>
                                                  <input type="text" name="userfname" value="" id="userfname" class="form-control" required>
                                                </div>
                                                <div class="form-group">
                                                  <label for="lastname">Lastname</label>
                                                  <input type="text" name="userlname" value="" id="userlname" class="form-control" required>
                                                </div>
                                                <div class="form-group">
                                                  <label for="email">Email</label>
                                                  <input type="email" name="useremail" value="" id="useremail" class="form-control" required>
                                                </div>
                                                <div class="form-group">
                                                  <label for="telephone">Telephone</label>
                                                  <input type="number" name="usertelephone" value="" id="usertelephone" class="form-control" required>
                                                </div>
                                                <div class="form-group">
                                                  <label for="module">User Position</label>
                                      						<select name="responsability" class="form-control" id="responsability">
                                      							<option value="">User Position...</option>
                                      							<?php foreach($positions as $each){ ?>
                                                    <option value="<?php echo $each->user_respo_id; ?>"><?php echo $each->responsability; ?></option>';<?php } ?>
                                      						</select>
                                                </div>
                                                <input type="submit" name="getmarksid" value="Save" name="getmarksid" class="btn btn-outline btn-primary">
                                              </form>
                                            </div>
                                            <div class="modal-footer">
                                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            </div>
                                          </div>
                                        </div>
                                      </div><!-- end of modal-->
                                      <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addfiletitle" aria-hidden="true" id="addfiletitle">
                                        <div class="modal-dialog">
                                          <!-- Modal content-->
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                                              <h4 class="modal-title">Add system users</h4>
                                            </div>
                                            <div class="modal-body">
                                              <form class="" action="<?php echo site_url();?>Adminuser/addfiledata" method="post">
                                                <div class="form-group">
                                                  <label for="telephone">File title</label>
                                                  <input type="text" name="userfileid" value="" id="userfileid" class="form-control" required>
                                                </div>

                                                <input type="submit" name="addfile" value="Save" name="addfile" class="btn btn-outline btn-primary">
                                              </form>
                                            </div>
                                            <div class="modal-footer">
                                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            </div>
                                          </div>
                                        </div>
                                      </div><!-- end of modal-->
                                      <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="useresponsability" aria-hidden="true" id="useresponsability">
                                        <div class="modal-dialog">
                                          <!-- Modal content-->
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <button type="button" name="button" class="close" data-dismiss="modal">&times;</button>
                                              <h4 class="modal-title">Define user position</h4>
                                            </div>
                                            <div class="modal-body">
                                              <form action="<?php echo site_url();?>Adminuser/addUser" method="post">
                                                <div class="form-group">
                                                  <label for="position">Position</label>
                                                  <input type="text" name="positiontype" id="positiontype" class="form-control" required>
                                                </div>
                                                <input type="submit" name="addUsertype" value="Save" class="btn btn-outline btn-primary">
                                              </form>
                                            </div>
                                            <div class="modal-footer">
                                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            </div>
                                          </div>
                                        </div>
                                      </div><!-- end of modal-->
                                      <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="editemail" aria-hidden="true" id="editemail">
                                        <div class="modal-dialog">
                                          <!-- Modal content-->
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                                              <h4 class="modal-title">Change student number</h4>
                                            </div>
                                            <div class="modal-body">
                                              <form class="" action="<?php echo site_url();?>Adminuser/changeuser" method="post">
                                                <div class="form-group">
                                                  <label for="old email">Enter old email</label>
                                                  <input type="email" name="useremailid" value="" id="useremaileid" class="form-control" required>
                                                </div>
                                                <div class="form-group">
                                                  <label for="new email">Enter new email</label>
                                                  <input type="email" name="emailid" value="" id="emaileid" class="form-control" required>
                                                </div>
                                                <input type="submit" name="addemail" value="Update" name="addemail" class="btn btn-outline btn-primary">
                                              </form>
                                            </div>
                                            <div class="modal-footer">
                                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            </div>
                                          </div>
                                        </div>
                                      </div><!-- end of modal-->
                                      <div class="modal fade" tabindex="-1" aria-labelledby="addfile" role="modal" aria-hidden="true" id="addfile">
                            						<div class="modal-dialog">
                            							<div class="modal-content">
                            								<div class="modal-header">
                            									<button type="button" name="button" class="close" data-dismiss="modal">&times;</button>
                            									<h4 class="modal-title">Uploads</h4>
                            								</div>
                            								<div class="modal-body">
                                              <form action="<?php echo site_url(); ?>Adminuser/uploads" method="post" enctype="multipart/form-data">
                                                <h5>Upload a file</h5>
                                                <div class="form-group">
                                                  <label for=""></label>
                                                  <input type="file" name="fileuploadid" class="form-control" id="fileuploadid">
                                                </div>
                                                <div class="form-group">
                                                  <label for="filetitle">File title</label>
                                                  <select name="fileusetype" id="fileusetype" class="form-control">
                                                    <option>Select file description</option>
                                                    <?php foreach($files as $each){ ?>
                                                    <option value="<?php echo $each->file_id; ?>"><?php echo $each->file_usage; ?></option>';<?php } ?>
                                                  </select>
                                                </div>
                                                <div class="form-group">
                                                  <button type="submit" name="button" class="btn btn-success btn-outline btn-primary">Upload</button>
                                                </div>
                                              </form>
                                              <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                              </div>
                            								</div>
                            							</div>
                            						</div>
                            					</div><!-- end of modal-->
                                      <!-- modal -->
                                      <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="viewfiles" aria-hidden="true" id="viewfiles">
                                        <div class="modal-dialog">
                                          <!-- Modal content-->
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                                              <h4 class="modal-title">Uploads</h4>
                                            </div>
                                            <div class="modal-body">
                                            <table class="table table-sm">
                                              <thead>
                                                <th>File Description</th>
                                                <th>Live Preview</th>
                                              </thead>
                                              <tbody>
                                                <?php
                                                foreach ($files as $getfiles) {
                                                  ?>
                                                  <tr>
                                                    <td><?php echo $getfiles->file_usage; ?></td>
                                                    <td><a href="<?php echo base_url().'files/'.$getfiles->file_name; ?>" target="_blank">Preview file</a></td>
                                                  </tr>
                                                  <?php
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
                                     <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addschedule" aria-hidden="true" id="addschedule">
                                       <div class="modal-dialog">
                                         <div class="modal-content">
                                           <div class="modal-header">
                                             <button type="button" class="close" data-dismiss="modal">&times;</button>
                                             <h4 class="modal-title">Add Application start and end date</h4>
                                            </div>
                                           <div class="modal-body">
                                             <form class="" action="<?php echo site_url(); ?>Adminuser/updatedate" method="post">
                                               <div class="form-group">
                                                 <label for="">Application start date</label>
                                                 <input type="text" name="addstartdate" value="<?php echo $start; ?>" id="addstartdate" class="form-control" required placeholder="yyy-mm-dd" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" title="Enter Date in format: yyy-mm-dd" required>
                                               </div>
                                               <div class="form-group">
                                                 <label for="">Application close date</label>
                                                 <input type="text" name="addclosedate" value="<?php echo $close; ?>" id="addclosedate" class="form-control" required placeholder="yyy-mm-dd" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" title="Enter Date in format: yyy-mm-dd" required>
                                               </div>
                                               <input type="submit" name="savedate" value="Update" class="btn btn-outline btn-primary">
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
                  <?php require_once(APPPATH.'views/views_pages/copy.php'); ?>
                  </div>
                  <script>
                  $(document).ready(function() {
                     $('#dataTables-example').DataTable({
                         responsive: true
                     });
                 });
                 $(document).ready(function() {
                    $('#dataTables-example1').DataTable({
                        responsive: true
                    });
                 });
                  </script>
                  <script src="<?php echo base_url(); ?>css_scripts/vendor/bootstrap/js/bootstrap.min.js"></script>
                  <script src="<?php echo base_url(); ?>css_scripts/vendor/metisMenu/metisMenu.min.js"></script>
                  <script src="<?php echo base_url(); ?>css_scripts/vendor/raphael/raphael.min.js"></script>
                  <script src="<?php echo base_url(); ?>css_scripts/vendor/morrisjs/morris.min.js"></script>
                  <script src="<?php echo base_url(); ?>css_scripts/data/morris-data.js"></script>
                  <script src="<?php echo base_url(); ?>css_scripts/dist/js/sb-admin-2.js"></script>
                  <script src="<?php echo base_url() ?>/css_scripts/vendor/datatables/js/jquery.dataTables.min.js"></script>
                  <script src="<?php echo base_url() ?>/css_scripts/vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
                  <script src="<?php echo base_url() ?>/css_scripts/vendor/datatables-responsive/dataTables.responsive.js"></script>
                  </body>
                  </html>
