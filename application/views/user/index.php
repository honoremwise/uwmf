<?php
require_once(APPPATH.'views/certificate/data.php');
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
                        ?> <!--
                        <a href="#file-uploads" data-toggle="modal" data-target="#file-uploads"class="btn btn-link" style="color:white;">My uploads</a> -->
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
                echo "Your Account is Missing supporting Documents, Click My uploads on the left side to complete";
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
                                        <li><a href="#payement-details" data-toggle="tab">Payment information</a>
                                        </li>
                                      </ul>
                                      <div class="tab-content">
                                        <div class="tab-pane fade in active" id="personal-marks">
                                          <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
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
                                                  foreach ($getall as $value){
                                                    ?>
                                                      <tr>
                                                        <td><center><?php echo $value->module_code;?></center></td>
                                                        <td><center><?php echo $value->points;?></center></td>
                                                        <td><center><?php echo $value->letter;?></center></td>
                                                        <td><center><?php echo $value->addition_date;?></center></td>
                                                        <td><center><?php echo "$value->first_name $value->telephone";?></center></td>
                                                        <td><center><?php echo $value->email;?></center></td>
                                                      </tr>
                                                      <?php
                                                  }
                                                  ?>
                                                </tbody>
                                            </table>
                                          </div>
                                        </div>
                                        <div class="tab-pane fade" id="payement-details">
                                          <div class="col-lg-5">
                                          <div class="panel panel-info">
                                            <div class="panel-heading">
                                          Record payment
                                            </div>
                                            <div class="panel-body">
                                              <form  action="<?php echo site_url();?>SaveRegister/savepayement" method="post" enctype="multipart/form-data">
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
                                                                        <table class="table table-striped table-bordered table-hover" id="dataTables-example1">
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
                                                <form role='form' method="POST" action="<?php echo site_url();?>SaveRegister/saveNotification" name="addclaim" id="formclaim">
                                                  <div class="form-group input-group">
                                                  <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                                  <select class="form-control" name="useridnumber" id="useridnumber">
                                                    <option>Select receiver position</option>
                                                    <?php foreach($users as $each){ ?>
                                                    <option value="<?php echo $each->user_respo_id; ?>"><?php echo $each->responsability; ?></option>';<?php } ?>
                                                  </select>
                                                </div>
                                                <div class="form-group input-group">
                                                  <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                                  <select class="form-control" name="referenceid" id="referenceid" disabled>
                                                    <option>select receiver name</option>
                                                  </select>
                                                </div>
                                                <div class="form-group">
                                                  <input type="hidden" name="Useridname" value="<?php echo $reg; ?>" id="Useridname">
                                                </div>
                                                <div class="form-group">
                                                  <input type="text" class="form-control input-lg" name="msgidrequest" id="msgrequestid" placeholder="Type briefly your claim or view here..." />
                                                  <span></span>
                                                  </div>
                                                  <center><input type="submit" value="Submit" class="btn btn-outline btn-primary"></center>
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
                                                <form name="userregistermain" action="<?php echo site_url();?>SaveRegister/changePassword" id="userregistermain" method="post">
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
                                                    <input type="submit" name="" value="Update"class="btn btn-outline btn-primary" id="btnsubmit">
                                                </form>
                                              </div>
                                              <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                              </div>
                                            </div>
                                          </div>
                                        </div><!-- end of modal -->
                                        <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="file-uploads" aria-hidden="true" id="file-uploads"><!-- add student marks -->
                                          <div class="modal-dialog">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">Documents Upload</h4>
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
                  /*
                  $('.tooltip-demo').tooltip({
                      selector: "[data-toggle=tooltip]",
                      container: "body"
                  })
                  // popover demo
                  $("[data-toggle=popover]")
                      .popover()
                      */
                  </script>
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
<script type="text/javascript">
$(document).ready(function(){
  $(document).on("change","#useridnumber",function(){
    var userposition=$("#useridnumber").val();
    if (userposition!="" && userposition>0){
      //ajax
      $.ajax({
        type:'POST',
        url:'<?php echo base_url()?>SaveRegister/users',
        dataType:'json',
        data:{userid:userposition},
        async:false,
        success:function(data){
          if (data.length>0){
            $("#referenceid").removeAttr('disabled','disabled');
            $("#referenceid").html('select receiver name');
            //$("#msgidrequest").removeAttr('disabled','disabled');
            for (var i = 0; i < data.length; i++) {
              var usermessageid=data[i]['user_id'];
              var userfirstname=data[i]['first_name'];
              var userlastname=data[i]['last_name'];
              var name=userfirstname+" "+userlastname;
              //fill select options
              $("#referenceid").append("<option value='"+usermessageid+"'>"+name+"</option>");
            }
          }
           else{
             $("#referenceid").html('select receiver name');
             $("#referenceid").attr('disabled','disabled');
          }
        },
        error:function(){
          $("#referenceid").html('select receiver name');
          $("#referenceid").attr('disabled','disabled');
        }
      });
    }else{
      $("#referenceid").html("select receiver name");
      $("#referenceid").attr('disabled','disabled');
    }
  });
});
$(function(){
  function getformvalidate(){
    var userid=$("#useridnumber").val();
    var getuser=$("#referenceid").val();
    var addclaim=$("#msgidrequest").val();
    if (userid=="" || isNaN(userid)){
      return false;
    } else {
      if (getuser=="" || isNaN(getuser) || $("#referenceid").prop("disabled")==true){
        return false;
      } else {
        if (addclaim!="" && isNaN(addclaim)){
          if (typeof(addclaim)!="undefined"){
            return true;
          } else {
            return false;
          }
        } else {
          return false;
        }
      }
    }
  }
  $("#formclaim").submit(function() {
    var test=getformvalidate();
    if (test==true) {
      return true;
    } else {
      alert("Please enter in all fields!");
      return false;
    }
  });
});
</script>
<script src="<?php echo base_url() ?>/css_scripts/vendor/datatables/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url() ?>/css_scripts/vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url() ?>/css_scripts/vendor/datatables-responsive/dataTables.responsive.js"></script>
</body>
</html>
