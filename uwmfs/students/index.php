<?php
include'../access.php';
include("header.php");
include("../dboperations.php");
$std=$_SESSION["registration_no"];
$refdt=mysqli_query($db,"select * from students where registration_no='$std'");
$stddata=mysqli_fetch_array($refdt);
$refernce_number=$stddata['reference_no'];
$program=substr($std,5,2);
$date=date('Y-m-d');
?>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar">
                <div class="sidebar-nav navbar-collapse">

                  <div class="col-lg-12 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                  profile pics
                                </div>

                            </div>
                        </div>

                    </div>

                    </div>
                     
                      </div>
                                    </div>

        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Student Dashboard</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
              <div class="panel-body">
                  <div class="panel-group" id="accordion">
                      <div class="panel panel-primary">                      
                          <?php  if(isset($_GET['change']))
     {
    $vars=$_GET['pswd'];
    echo "$vars";
         $change=mysqli_query($db,"update candidates set password='$vars' where reference_no=$refernce_number");
    if($change){
        echo"<div class='alert alert-info alert-dismissable'>
                            <center><i class='fa fa-check'></i> password updated successfully!</center> 
                            
                        <script>function goto(){
                        window.location='../logout.php';
                        
                        }
                        setInterval(goto,3000);
                        </script>
                              </div>";
        
    }
    else{
        echo mysqli_error($db);
    }
             
     }                         
                          
                          ?>

                          <div id="collapseOne" class="panel-collapse collapse in">
                              <div class="panel-body">
                                                          <!-- Nav tabs -->
                                    <ul class="nav nav-tabs">
                                      <li class="active"><a href="#Module-pills" data-toggle="tab">Published Results</a>
                                      </li>
                                         <li><a href="#Program-pills" data-toggle="tab">Notifications </a>
                                        </li>
                                        <li><a href="#Lecturer-pills" data-toggle="tab">My access right </a>
                                        </li>
                                          <li><a href="#teach-pills" data-toggle="tab">Payment info</a>
                                        </li>
                                       
                                    </ul>

                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                        <div class="tab-pane fade" id="Lecturer-pills">
                                             <div class="col-lg-2">
                                            </div>

                                            <p>          <div class="col-lg-8">
                                                                                        <div class="panel panel-primary">
                                                    <div class="panel-heading">
                                                        
                                                    <center> My Credithentials</center>
                                                    </div>
                    <?php
                                                                                            
      $data=mysqli_query($db,"select * from students join candidates using(reference_no) where registration_no='$std'")or die (mysqli_error($db));
        $ret=mysqli_fetch_array($data); 
        $reg=$ret['registration_no'];
        $password=$ret['password'];
     
                                                                                            
                                                                                            
                                                                                            ?>
                                                   
                                                <form role="form" method="get" action="#">
                                              <br>
                                              <div class="form-group input-group">
                                              <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                              <input type="text" class="form-control" name="program" value="<?php 
                                                                                                            echo $reg;
                                                                                                            ?>" disabled>

                                              </div> 
                                                <div class="form-group input-group">
                                              <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                              <input type="text" class="form-control" name="pswd" value="<?php 
                                                                                                            echo $password;
                                                                                                            ?>" >

                                              </div>
                                                <center>
                                              <button type="submit" class="btn btn-outline btn-primary btn-sm " name="change" required>Chaange Passoward</button></center>

                                              <br>
                                              </form>
                                              </div>
                                                                                    </div>
                                                                                   
                                                                                    </p>
                                        <div class="col-lg-2">
                                            </div>

                                    </div>
                                        <div class="tab-pane fade" id="teach-pills">

                                            <p>
  <?php
                                                
if(isset($_POST['savestudent'])){

$reason = $_POST['reason'];
$amount = $_POST['amount'];
    
$bankslip = $_FILES['file_array']['name'];
$tmp_name_array = $_FILES['file_array']['tmp_name'];
for($i = 0 ;$i < count($tmp_name_array); $i++){ 
    if(move_uploaded_file($tmp_name_array[$i],"../../profiles/".$bankslip[$i])){
        
    $recordpayment=mysqli_query($db,"insert into students_payment (registration_no,id,date,bankslip,bankslip_amount) values('$std','$reason','$date','$bankslip[0]','$amount')");
        if($recordpayment){
echo "<div class='alert alert-info alert-dismissable'> <center>payment recorded successfully !<i class='fa fa-check'></i>  <center>
                            
                        <script>function goto(){
                        window.location='index.php';
                        
                        }
                        setInterval(goto,3000);
                        </script>
                              </div>";
            
        }
        else
        {
 echo "<div class='alert alert-danger alert-dismissable'>
                            <center> ".mysqli_error($db)."meaning payment already recorded<i class='fa fa-close'></i>  <center>
                            
                        <script>function goto(){
                        window.location='index.php';
                        
                        }
                        setInterval(goto,3000);
                        </script>
                              </div>";  
        }
       
}}    
}
if(isset($_POST['send'])){
$user=$_POST['user'];
$msg=$_POST['msg'];
echo $user.$msg;                                 
}
?>                                              
                                              

<div class="col-lg-5">
<div class="panel panel-info">
  <div class="panel-heading">
record payment
  </div>
  <div class="panel-body">
    <form role="form" method="POST" action="#" enctype="multipart/form-data">
<br>
        <div class="form-group">
    <select class="form-control" name="reason" required>
        <option>select payment reason </option>
<?php
    $qry=mysqli_query($db,"select * from payments join programs using(program_id) where program_code='$program' ")or die(mysqli_query($db));
    if(mysqli_num_rows($qry)>0)
    {
    while($pro=mysqli_fetch_array($qry))
    {
echo "<option value=".$pro['id'].">".$pro['program_name']."_".$pro['reason']."</option>";
        
    }}
         else{
      echo "<option>no program record found</option>";  
    }
    
    ?>
</select>
</div>
<div class="form-group ">

<input type="number" class="form-control" placeholder="Amount Paid in rwf" name="amount" required>

</div>
Attach bank slip copy
<div class="form-group input-group">
<span class="input-group-addon"><i class="fa fa-file"></i></span>
<input type="file" class="form-control" name="file_array[]" accept="application/pdf" required>
</div>
<center>
<button type="submit" name="savestudent"  class="btn btn-outline btn-primary">Record</button></center>

<br>
</form>

  </div> </div>






                                                            </div>

                                                        <!-- /.panel-body -->

                                                          <div class="col-lg-7">
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
$stdpayinf=mysqli_query($db,"SELECT * FROM students_payment join payments USING(id) where registration_no='$std'");
    while($readpay=mysqli_fetch_array($stdpayinf)){
echo'<tr><td>'.$readpay['date'].'</td><td><a href=\../../real/profiles/'.$readpay['bankslip'].'>View File<a/></td><td>'.$readpay['bankslip_amount'].'</td><td>'.$readpay['reason'].'</td><td>'.$readpay['payment_status'].'</td></tr>'; 
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
                                            <div class="col-lg-12"><br></div>
                                            <div class="col-lg-2"></div>
 <div class="col-lg-8">
                                                              <div class="panel panel-info">
                                                                  <div class="panel-heading">
                                                                    Payment infos
                                                                  </div>
                                                                  <!-- /.panel-heading -->
                                                                  <div class="panel-body">
                                                                      <div class="table-responsive">
                                                                          <table class="table">
                                                                              <thead>
                                                                                  <tr>
                                                                                      <th>Program</th>
                                                                                      <th>Amount</th>
                                                                                      <th>Justification</th>
                                                                                      <th>date</th>
                                                                                      
                                                                                  </tr>
                                                                              </thead>
                                                                              <tbody><?php
$payinf=mysqli_query($db,"select * from payments join programs using(program_id) where program_code='$program'");
    while($readdata=mysqli_fetch_array($payinf)){
          
echo'<tr><td>'.$readdata['program_name'].'</td><td>'.$readdata['amount'].'</td><td>'.$readdata['reason'].'</td><td>'.$readdata['date'].'</td></tr>';  
            }             ?>
                                                                                  
                                                                              </tbody>
                                                                          </table>
                                                                      </div>
                                                                      <!-- /.table-responsive -->
                                                                  </div>
                                                                  <!-- /.panel-body -->
                                                              </div>
                                                              <!-- /.panel -->
                                                          </div>
                                            <div class="col-lg-2"></div>

                                            </p>
                                        </div>
                                                                        
                                            <div class="tab-pane fade" id="Program-pills">
                                            <div class="col-lg-6">
                                            <h4>Received Notifications</h4>
                                            <p><div class="alert alert-success alert-dismissable">
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                there is an exam after this comming week.
                                            </div>
                                            <div class="alert alert-info alert-dismissable">
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                Students with school fees problem will not attend this comming week.
                                            </div> </div>
                                             <div class="col-lg-6">
      <div class="chat-panel panel panel-default">
      <div class="panel-heading">
      <i class="fa fa-comments fa-fw"></i>Send briefly your views,claim
</div>
                                                                                          <!-- /.panel-heading -->
                                                                                        <!-- /.panel-body -->
 <div class="panel-footer">
 <form role='form' method="POST" action="index.php">
  <div class="form-group input-group">
 <span class="input-group-addon"><i class="glyphicon glyphicon-user  "></i></span>
  <select class="form-control" name="user">
<?php  

$mdl=mysqli_query($db,"select * from users join users_responsabilities USING(user_respo_id)")or die (mysqli_error($db));
    if(mysqli_num_rows($mdl)>0)
    {
    while($pro=mysqli_fetch_array($mdl))
    {
echo "<option value=".$pro['user_id'].">".$pro['first_name']."-".$pro['responsability']."</option>";
        
    }}
    else{
      echo "<option>No records found in db</option>";  
    }
    
    ?>
</select>
</div>
<div class="input-group">
<input id="btn-input" type="text" class="form-control input-lg" name="msg" placeholder="Type briefly your claim or view here..." />
    <span class="input-group-btn">
     <button  type="submit" name="send" class="btn btn-primary btn-chat btn-lg"><i class="fa fa-send"></i></button></span></div>
     </form> 
<p><div class="alert alert-success alert-dismissable">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                                                                  you have to pay school fees not later than 20th july 2018.
                                                                                              </div>
                                                                                              <div class="alert alert-info alert-dismissable">
                                                                                                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                                                                 you have to pay school fees not later than 20th july 2018.
                                                                                              </div></p>
                                                                                          </div>
                                                                                          <!-- /.panel-footer -->
                                                                                      </div>                                                                                                                           </div>
                                            
                                            
                                            
                                            
                                            </p>
                          
                                        </div>
                                        <div class="tab-pane fade in active" id="Module-pills">
                                            <h4></h4>
                                            <p>    <div class="col-lg-12">
                                               <div class="panel panel-primary">
                                                      <!-- <div class="panel-heading">
                                                          DataTables Advanced Tables
                                                      </div> -->
                                                      <!-- /.panel-heading -->
                                                      <div class="panel-body">
                                                                 <div id="divToPrint" >
                                                          <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                                              
                                                              <thead>
                                      
                                                                  <tr>
                                                                      <th>Course Code</th>
                                                                      <th>Marks/100</th>
                                                                      <th>Grade</th>
                                                                      <th>Exam Date</th>
                                                                      <th>Lecturer& tel</th>
                                                                  </tr>
                                                              </thead>
                                                              <tbody>
<?php 
$result=mysqli_query($db,"SELECT * FROM `marks` join modules using(module_id) join grades USING (grade) join users using(user_id) WHERE registration_no='$std'")or die(mysqli_query($db));
$rows=mysqli_num_rows($result);
    if($result and ($rows>0)){
while($readm=mysqli_fetch_array($result)){       


    
        echo "<tr><td><center>".$readm['module_id']."</center></td><td><center>".$readm['points']."</center></td><td><center>".$readm['letter']."</center></td><td><center>".$readm['addition_date']."</center></td><td><center>".$readm['first_name']." ".$readm['telephone']."</center></td>
                                                                  </tr>";
} 
    }
else
{
echo mysqli_error($db);
}                                                              
                                                                  
                                                                  
                                                                  ?>
                                                                     </tbody>
                                                          </table>
                                                          <!-- /.table-responsive -->
                                                                                                              </div>
                                                          <input type="button" value="printthis" onclick="PrintDiv();" />
                                                      <!-- /.panel-body --></div>
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
                                  the exam is 20th-05-2018 <a href="#" class="alert-link">Alert Link</a>.
                              </div>
                              <div class="alert alert-info alert-dismissable">
                                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                the exam is 20th-05-2018 <a href="#" class="alert-link">Alert Link</a>.
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
</div>
 <script type="text/javascript">
        function PrintDiv() {
           var divToPrint = document.getElementById('divToPrint');
           var popupWin = window.open('', '_blank', 'width=300,height=300');
           popupWin.document.open();
           popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
            popupWin.document.close();
                }
     </script>
<?php include("footer.php");?>
