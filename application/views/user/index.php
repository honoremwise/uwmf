<?php
require_once(APPPATH.'views/certificate/data.php');
//get all students marks
$getall=getresults($CI,$reg);
//get users
$users=getusers($CI);
//get notifications
$notifications=getlastmessage($CI,$reg);
// getpayementlist
$payementlist=getpayementlist($CI,$pro);
//get payed list
$payed=getpayed($CI,$reg);
?>
            <div class="navbar-default sidebar" style="background-color:#286090" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                  <div class="col-lg-12 col-md-6">
                    <div>
                        <div>
                            <div class="row">
                                <div class="col-xs-3 col-md-3">
                                  <?php
                                  echo'<img src="' . base_url().'profiles/'.$photo . '" width="190" height="150" class="img img-circle" alt="Profile Picture">';
                                   ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <p><br><br><br>
                      <?php
                      if (empty($photo) || empty($degree) || empty($idcard) || empty($transcript) || empty($statement) || empty($motiv)) {
                        ?>
                        <a href="#file-uploads" data-toggle="modal" data-target="#file-uploads"class="btn btn-link" style="color:white;"> My uploads</a><?php
                      }else {
                        ?>
                        <a href="#file-uploads" data-toggle="modal" data-target="#file-uploads"class="btn btn-link" style="color:white;">My uploads</a>
                      <?php
                      }
                       ?>
                     </p>
                  </div>
                </div>
              </nav>
        <div id="page-wrapper">
          <div class="row">
            <p style="color:white;"><?php
            if (!empty($photo) &&!empty($degree) && !empty($idcard) && !empty($transcript)) {

            }else{
              ?>
              <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <?php
                echo "Your Account is Missing supporting Documents, Click My uploads on the left side to complete for help please call:+250783171711";
                 ?>
              </div>
              <?php
            }
             ?>
            </p>
          </div>
            <div class="row">
              <?php
              if (isset($fillform)) {
                ?>
                <div class="alert alert-danger alert-dismissable">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <?php
                  echo $fillform;
                   ?>
                </div>
                <?php
              }
               ?>
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
              <?php
              if (isset($error)){
                ?>
                <div class="alert alert-danger alert-dismissable">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <?php
                  echo $error;
                   ?>
                </div>
                <?php
              }
               ?>
                <div class="col-lg-12">
                  <h2 class="page-header">Student Dashboard</h2>
                </div>
            </div>
            <div class="row">
              <div class="panel-body">
                  <div class="panel-group" id="accordion">
                      <div class="panel panel-primary">
                          <div id="collapseOne" class="panel-collapse collapse in">
                              <div class="panel-body">
                                    <ul class="nav nav-tabs">
                                      <li class="active"><a href="#personal-marks" data-toggle="tab">Published Results</a>
                                      </li>
                                        <li><a href="#notification-details" data-toggle="tab">Notifications </a>
                                        </li>
                                        <li><a href="#payement-details" data-toggle="tab">Payement information</a>
                                        </li>
                                      </ul>
                                      <div class="tab-content">
                                        <div class="tab-pane fade in active" id="personal-marks">
                                          <div class="table-responsive">
                                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                                <thead>
                                                    <tr>
                                                      <th>Module Code</th>
                                                      <th>Marks/100</th>
                                                      <th>Grade</th>
                                                      <th>Exam submitted date</th>
                                                      <th>Lecturer name & Telephone</th>
                                                      <th>Lecturer Email</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                  <?php
                                                  if (count($getall)>0) {
                                                    foreach ($getall as $value) {
                                                      echo "<tr><td><center>$value->module_code</center></td><td><center>$value->points</center></td><td><center>$value->letter</center></td><td><center>$value->addition_date</center></td><td><center>$value->first_name $value->telephone</center></td>
                                                      <td><center>$value->email</center></td>
                                                      </tr>";
                                                    }
                                                  } else {
                                                    // code...
                                                  }

                                                  ?>
                                                </tbody>
                                            </table>
                                            <div class="alert alert-danger alert-dismissable">
                                              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                              <?php
                                              echo "If you cannot see your marks, please check back soon after being recorded";
                                               ?>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="tab-pane fade" id="payement-details">
                                          <div class="col-lg-5">
                                          <div class="panel panel-info">
                                            <div class="panel-heading">
                                          Record payment
                                            </div>
                                            <div class="panel-body">
                                              <form  action="<?php echo base_url();?>index.php/SaveRegister/savepayement" method="post" enctype="multipart/form-data">
                                          <div class="form-group">
                                          <select class="form-control" name="reasonpayid" required>
                                            <option>Select payment reason </option>
                                            <?php foreach($payementlist as $each){ ?>
                                            <option value="<?php echo $each->id; ?>"><?php echo $each->reason; ?></option>';<?php } ?>
                                          </select>
                                          </div>
                                          <input type="number" class="form-control" placeholder="Amount Paid in rwf" name="amountpayid" name="amountpayid" required>
                                          <div class="form-group">
                                          </div>
                                          <div class="form-group">
                                            <input type="hidden" name="userid" value="<?php echo $reg; ?>" id="userid">
                                          </div>
                                          Attach bank slip copy
                                          <div class="form-group input-group">
                                          <span class="input-group-addon"><i class="fa fa-file"></i></span>
                                          <input type="file" class="form-control" name="fileidupload" accept="application/pdf" id="fileidupload" required>
                                          </div>
                                          <center>
                                          <button type="submit" name="savestudent"  class="btn btn-outline btn-primary">Record</button></center>
                                          </form>
                                          </div>
                                          </div>
                                        </div>
                                          <div class="col-lg-6">
                                                <div class="panel panel-info">
                                                      <div class="panel-heading">
                                                          My payment records
                                                        </div>
                                                              <!-- /.panel-heading -->
                                                                <div class="panel-body">
                                                                    <div class="table-responsive">
                                                                        <table class="table">
                                                                            <thead>
                                                                                <tr>
                                                                                   <th>Date </th>
                                                                                    <th>Bank slip</th>
                                                                                    <th>Paid Ammount</th>
                                                                                    <th>Justification</th>
                                                                                    <th>status</th>
                                                                                </tr>
                                                                              </thead>
                                                                              <tbody>
                                                                                <?php
                                                                                foreach ($payed as $value) {
                                                                                  echo "<tr>";
                                                                                  echo "<td>";
                                                                                  echo "<center>";
                                                                                  echo $value->date;
                                                                                  echo "</center>";
                                                                                  echo "</td>";
                                                                                  echo "<td>";
                                                                                  echo "<center>";
                                                                                  ?>
                                                                                  <a href="<?php echo base_url().'profiles/'.$value->bankslip; ?>" target="_blank">File</a>
                                                                                  <?php
                                                                                  echo "</center></td>";
                                                                                  echo "<td><center>";
                                                                                  echo $value->bankslip_amount;
                                                                                  echo "</center></td>";
                                                                                  echo "<td><center>";
                                                                                  echo $value->reason;
                                                                                  echo "</center></td>";
                                                                                  echo "<td><center>";
                                                                                  echo $value->payment_status;
                                                                                  echo "</center></td>";
                                                                                  echo "</tr>";
                                                                                }
                                                                                ?>
                                                                              </tbody>
                                                                          </table>
                                                                      </div>
                                                                      <!-- /.table-responsive -->
                                                                  </div>
                                                                  <!-- /.panel-body -->
                                                              </div>
                                                              <!-- /.panel -->
                                                          </div>
                                        </div>
                                        <div class="tab-pane fade" id="notification-details">
                                          <div class="col-lg-6">
                                            <h4>Received Notifications</h4>
                                            <?php if (isset($notifications)) {
                                              foreach ($notifications as $value) {
                                                ?>
                                                <div class="alert alert-info alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    <?php echo $value->message; ?>
                                                </div>
                                                <?php
                                              }
                                            }else {
                                              echo "No Incoming message";
                                            } ?>
                                          </div>
                                          <div class="col-lg-6">
                                            <div class="chat-panel panel panel-default">
                                              <div class="panel-heading">
                                                <i class="fa fa-comments fa-fw"></i>Send briefly your views,claim
                                              </div>
                                              <div class="panel-footer">
                                                <form role='form' method="POST" action="<?php echo base_url();?>index.php/SaveRegister/saveNotification">
                                                  <div class="form-group input-group">
                                                  <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                                  <select class="form-control" name="useridnumber" id="useridnumber">
                                                    <option>Select receiver</option>
                                                    <?php foreach($users as $each){ ?>
                                                    <option value="<?php echo $each->user_respo_id; ?>"><?php echo $each->responsability; ?></option>';<?php } ?>
                                                  </select>
                                                </div>
                                                <div class="input-group">
                                                  <input type="hidden" name="Useridname" value="<?php echo $reg; ?>" id="Useridname">
                                                  <input id="btn-input" type="text" class="form-control input-lg" name="msgidrequest" placeholder="Type briefly your claim or view here..." />
                                                  <span class="input-group-btn">
                                                    <button  type="submit" name="send" class="btn btn-primary btn-chat btn-lg"><i class="fa fa-send"></i></button></span></div>
                                                </form>
                                             </div>
                                             <!-- /.panel-footer -->
                                         </div>                                                                                                                           </div>
                                        </div>
                                        <div class="modal" aria-labelledby="getpassword" aria-hidden="true" id="getpassword">
                                          <div class="modal-dialog">
                                            <!-- Modal content-->
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">Change Account Password</h4>
                                              </div>
                                              <div class="modal-body">
                                                <form name="userregistermain" action="<?php echo base_url();?>index.php/SaveRegister/changePassword" id="userregistermain" method="post">
                                                    <div class="form-group">
                                                        <label for="inputPassword"> New Password</label>
                                                        <input type="password" class="form-control" name="CandidatePassword" id="CandidatePassword" required>
                                                        <span id="password_err_msg" class="spanstyle"></span>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="inputPassword">Confirm Password</label>
                                                        <input type="password" class="form-control" name="CandidatePasswordConf"  id="CandidatePasswordConf" required>
                                                        <span id="retypepassword_err_msg" class="spanstyle"></span>
                                                    </div>
                                                    <input type="submit" name="" value="Update"class="btn btn-primary" id="btnsubmit">
                                                </form>
                                              </div>
                                              <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                              </div>
                                            </div>
                                          </div>
                                        </div><!-- end of modal-->
                                        <div class="modal" aria-labelledby="getprofile" aria-hidden="true" id="getprofile">
                                          <div class="modal-dialog">
                                            <!-- Modal content-->
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">Profile</h4>
                                              </div>
                                              <div class="modal-body">
                                                <form name="userregistermain" action="<?php echo base_url();?>index.php/SaveRegister/changePassword" id="userregistermain" method="post">
                                                    <div class="form-group">
                                                        <label for="inputPassword"> Firstname</label>
                                                        <input type="text" class="form-control" value="<?php echo $first; ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="inputPassword">Lastname</label>
                                                        <input type="text" class="form-control" value="<?php echo $last;?>">
                                                    </div>
                                                </form>
                                              </div>
                                            </div>
                                          </div>
                                        </div><!-- end of modal-->
                                        <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="file-uploads" aria-hidden="true" id="file-uploads"><!-- add student marks -->
                                          <div class="modal-dialog">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">Documents Upload please repect that the maximum file size 3 MB </h4>
                                              </div>
                                              <div class="modal-body">
                                                <?php require_once(APPPATH.'views/user/useruploads.php');?>
                                              </div>
                                              <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                              </div>
                                      </div>
                                  </div>
                                </div><!-- end of the modal -->
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
                  <script>
 $(document).ready(function() {
    $('#dataTables-example').DataTable({
        responsive: true
    });
});
</script>
<script src="<?php echo base_url() ?>/css_scripts/vendor/datatables/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url() ?>/css_scripts/vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url() ?>/css_scripts/vendor/datatables-responsive/dataTables.responsive.js"></script>

                  </body>
                  </html>
