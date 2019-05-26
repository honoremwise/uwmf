<?php
include'../access.php';
include("../dboperations.php");
include("header.php");
$user=$_SESSION["username"];
$date=date('Y-m-d');
?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Assistant Registor Dashboard</h1>
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
                                                          <!-- Nav tabs -->
                                    <ul class="nav nav-tabs">
                                      <li class="active"><a href="#Module-pills" data-toggle="tab">Applicants English Results Panel</a>
                                      </li>
<!--
                                        <li><a href="#Lecturer-pills" data-toggle="tab">Manage Students</a>
                                        </li>
                                        <li><a href="#teach-pills" data-toggle="tab">Lecturers_Program_Modules</a>
                                        </li>
                                        <li><a href="#Program-pills" data-toggle="tab">Notifications </a>
                                        </li>
-->

                                    </ul>

                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                        <div class="tab-pane fade" id="Lecturer-pills">
                                            
                                          
                                    </div>
                                        <div class="tab-pane fade" id="teach-pills">
                                            <h4>Lecturers With their Courses</h4>
                                           
                                        </div>
                                        
                                        <div class="tab-pane fade in active" id="Module-pills">
                                            <h4></h4>
                                              <p>
<div class="col-lg-3">
<div class="panel panel-primary">
  <div class="panel-heading">
Applicants english Marks (%)
      <?php
           if(isset($_POST['savemarks'])){
        $refno=$_POST['refno'];
$points=$_POST['points'];
$wpoints=$_POST['wpoints'];


   $addmarks=mysqli_query($db,"update applications set english_reading_test=$wpoints,english_interview_test=$points where reference_no=$refno") ;
          if($addmarks)
          {
          
          echo"marks added
          <script>function redirect(){
window.location='index.php';
}setInterval(redirect,6000);</script>";
      }else{
          echo"<font color=red>Student marks for this course have been already registered</font>
          <script>function redirect(){
window.location='index.php';
}setInterval(redirect,3000);</script>";
              }
      
      }
      
      
      ?>
      
  </div>
  <div class="panel-body">
    <form role="form" action="#" method="post">
<br>
<div class="form-group ">

<input type="text" placeholder="applicant reff no" class="form-control" name="refno">
 

</div>

<div class="form-group ">

<input type="number" class="form-control" placeholder="marks obtained interview" name="points">

</div>
<div class="form-group ">

<input type="number" class="form-control" placeholder="marks obtained written" name="wpoints">

</div>
<center>
<button type="submit" class="btn btn-outline btn-primary" name="savemarks">Record</button></center>

<br>
</form>

  </div>

</div>


</div>

                                               <div class="col-lg-9">
                                               <div class="panel panel-primary">
                                                      <div class="panel-heading">
                                                        <center>English Marks Records</center>
                                                      </div>
                                                      
                                                      <div class="panel-body">
                                                           <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                                              <thead>
                                                                  <tr>
                                                                      <th>Ref no</th>
                                                                      <th>Interview</th>
                                                                      <th>Written</th>
                                                                                                                           
                                                                      <th>Program</th>
                                                                     <th>Delete</th>
                                                                  </tr>
                                                              </thead>
                                                              <tbody>

                                                                     <?php
                                                                
      $result=mysqli_query($db,"select * from applications WHERE (program_code='03' or program_code='04') AND (english_reading_test!='' or english_interview_test!='') AND application_status='pending'")or die(mysqli_queiry($db));
           if($result) {                                                      
while($userd=mysqli_fetch_array($result)){
  echo "<tr>
<td>".$userd['reference_no']."</td>
 <td>".$userd['english_reading_test']."</td>
 <td>".$userd['english_interview_test']."</td>
 <td>".$userd['program_code']."</td>
 <td><a href='index.php?delete={$userd['reference_no']}' title='to delete this record'><i class='btn btn-outline btn-danger fa fa-trash'> </i></a></td>
                                                                      
                                                                  </tr>";
    
}}
                                                                  else{
                                                                      echo mysqli_error($db);
                                                                  }
if(isset($_GET['delete'])){
    echo "what";
    $dv=$_GET['delete'];
$del=mysqli_query($db,"update applications set english_interview_test=NULL,english_reading_test=NULL where reference_no=$dv");
if($del){
    echo"<script>function redirect(){
window.location='index.php';
}setInterval(redirect,1000);</script>";
}
    else{
        echo mysqli_error();
    }
}
                                                                  
                                                                  
                                                                  
                                                                  ?>

                                                              </tbody>
                                                          </table>
          
                                                          <!-- /.table-responsive -->
                                                      </div>
                                                      <!-- /.panel-body -->
    </div></div>

                                                  </p>
                                        </div>
                                    </div>

    </div>
                      </div>  </div>

                      </div>
              </div>
            </div>
            <!-- /.row -->
                      <!-- /.col-lg-4 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
<!-- student learning status model -->
<div class="row">
    <div class="modal fade" id="abc" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title" id="myModalLabel">School notifications</h4>
                            </div>
                            <div class="modal-body">
                              <div class="alert alert-success alert-dismissable">
                                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                  Lorem ipsum dolor sit amet, consectetur adipisicing elit. <a href="#" class="alert-link">Alert Link</a>.
                              </div>
                              <div class="alert alert-info alert-dismissable">
                                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                  Lorem ipsum dolor sit amet, consectetur adipisicing elit. <a href="#" class="alert-link">Alert Link</a>.
                              </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save changes</button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <div class="modal fade" id="abcd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">Published Marks</h4>
                                        </div>
                                        <div class="modal-body">
                                            sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>

                <div class="modal fade" id="ab" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">Module Learning Status</h4>
                                        </div>
                                        <div class="modal-body">

                                          <div class="panel-body">
                                              <!-- Nav tabs -->
                                              <ul class="nav nav-pills">
                                                  <li class="active"><a href="#home-pills" data-toggle="tab">Home</a>
                                                  </li>
                                                  <li><a href="#profile-pills" data-toggle="tab">Profile</a>
                                                  </li>
                                                  <li><a href="#messages-pills" data-toggle="tab">Messages</a>
                                                  </li>
                                                  <li><a href="#settings-pills" data-toggle="tab">Settings</a>
                                                  </li>
                                              </ul>

                                              <!-- Tab panes -->
                                              <div class="tab-content">
                                                  <div class="tab-pane fade in active" id="home-pills">
                                                      <h4>Home Tab</h4>
                                                      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                                                  </div>
                                                  <div class="tab-pane fade" id="profile-pills">
                                                      <h4>Profile Tab</h4>
                                                      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                                                  </div>
                                                  <div class="tab-pane fade" id="messages-pills">
                                                      <h4>Messages Tab</h4>
                                                      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                                                  </div>
                                                  <div class="tab-pane fade" id="settings-pills">
                                                      <h4>Settings Tab</h4>
                                                      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                                                  </div>
                                              </div>
                                          </div>
                                                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                <!-- /.modal -->

            <!-- .panel-body -->

        <!-- /.panel -->

    <!-- /.col-lg-6 -->

    <!-- /.col-lg-6 -->
</div>

<!-- end of student learning stutas  -->
    <!-- jQuery -->
    <!-- Page-Level Demo Scripts - Notifications - Use for reference -->

<?php include("footer.php");?>
