<?php
include'../access.php';
include("header.php");
include("../dboperations.php");
$date=date('Y-m-d');
$user=$_SESSION["username"];
?>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar">
                <div class="sidebar-nav navbar-collapse">

                  <div class="col-lg-12 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
<div class="panel-heading">
                            <div class="row">
<!--
                                <div class="col-xs-3">
                                  profile pic
                                </div>
-->

                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left"><label data-toggle="modal" data-target="#abp">
                                    More about profile details
                                </label></span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>

                            </div>
                        </div>

                    </div>
 <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-list fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                       <div class="huge"><?php
                                            $number=0;
                $qer=mysqli_query($db,"select *from students")or die(mysqli_error($db));
              $recors=mysqli_num_rows($qer); 
                                            echo $recors;
                                       ?> 
                                        </div>
                                        <div><br>Registered Students!</div>
                                    </div>
                                </div>
                            </div>
                            <a href="students.php">
                                <div class="panel-footer">
                                  <span class="pull-left">
                                      View details report
                                  </span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>

                    </div>
                          <!-- /.panel-body -->

                      </div>
                      <!-- /.panel -->
                                            <!-- /.panel -->

                      <!-- /.panel .chat-panel -->
                  </div>

                <!-- /.sidebar-collapse -->

            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Accountant  Dashboard</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
              <div class="panel-body">
                  <div class="panel-group" id="accordion">
                      <div class="panel panel-primary">
                          <?php 
 if(isset($_GET['saveupdates'])){
$id=$_GET['id'];
$program=$_GET['program'];
$reason=$_GET['reason'];
$amount=$_GET['amount'];
$d=mysqli_query($db,"update payments set reason='$reason',amount='$amount',program_id=$program where id=$id");
    if($d){
         echo"<div class='alert alert-info alert-dismissable'>
                            <center> Update done<i class='fa fa-check'></i>  <center>
                            
                        <script>function goto(){
                        window.location='index.php';
                        
                        }
                        setInterval(goto,3000);
                        </script>
                              </div>";    
            
        }
 else{
    echo"<div class='alert alert-info alert-dismissable'>
                            <center> ".mysqli_error($db)."  <center>
                            
                        <script>function goto(){
                        window.location='index.php';
                        
                        }
                        setInterval(goto,3000);
                        </script>
                              </div>";   
 }
 }
                          if(isset($_POST['savepayment'])){
    $program=$_POST['program']; 
    $reason=$_POST['reason'];
    $amount=$_POST['amount'];
    
 
    $savep=mysqli_query($db,"insert into payments(reason,amount,date,program_id) values('$reason','$amount','$date',$program)") or die(mysqli_error($db));
    if($savep){
    echo"<div class='alert alert-info alert-dismissable'>
                            <center> successfully recorded<i class='fa fa-check'></i>  <center>
                            
                        <script>function goto(){
                        window.location='index.php';
                        
                        }
                        setInterval(goto,3000);
                        </script>
                              </div>";
    }else{
     echo"<div class='alert alert-info alert-dismissable'>
                            <center> ".mysqli_error($db)."<i class='fa fa-check'></i>  <center>
                            
                        <script>function goto(){
                        window.location='index.php';
                        
                        }
                        setInterval(goto,3000);
                        </script>
                              </div>";     
        
    }    
}
if(isset($_GET['remove'])){
  $part=explode('-',$_GET['remove']);
$rem=mysqli_query($db,"delete from  students_payment where id={$part[0]} and registration_no='{$part[1]}'");
    if($rem){
          echo"<div class='alert alert-info alert-dismissable'>
                            <center> removered successfully<i class='fa fa-check'></i>  <center>
                            
                        <script>function goto(){
                        window.location='index.php';
                        
                        }
                        setInterval(goto,1000);
                        </script>
                              </div>";     
    }
    else{
        echo mysqli_error($db);
    }
}
 if(isset($_GET['approve'])){
     echo" <div class='alert alert-danger alert-dismissable'>
     Are you sure you want to approve this payment of {$_GET['approve']}?
                                 reg number? <a href='index.php?approves={$_GET['approve']}' title='Approve this candidate'><i class='btn btn-outline btn-danger fa fa-check'> </i></a>|<a href='index.php' title='cancel'><i class='btn btn-outline btn-primary fa fa-times'></i></a></div> ";
     
 }
if(isset($_GET['editp'])){
  echo" <div class='alert alert-warning alert-dismissable'>
                                  <Cente>
                                 Proceed to update the module with id {$_GET['editp']}?<i class='btn btn-outline btn-info fa fa-check' data-toggle='modal' data-target='#ab' title='view more details about applicants with id {$_GET['editp']}'>  </i><a href='index.php' title='view more details about applicants with id {$_GET['editp']}'><i class='btn btn-outline btn-primary fa fa-times'>  </i></a><Cente>
                              </div>";  
    
}
if(isset($_GET['approves'])){
        $vars=$_GET['approves'];
    $fact=explode('-',$vars);
    
    
$update=mysqli_query($db,"update students_payment set payment_status='proved' where id=$fact[0] and registration_no='{$fact[1]}'");
    if($update){
    echo"<div class='alert alert-info alert-dismissable'>
                            <center><i class='fa fa-check'></i>Dear {$user} data update successfully!</center> 
                            
                        <script>function goto(){
                        window.location='index.php';
                        
                        }
                        setInterval(goto,2000);
                        </script>
                              </div>";
}
else{
     echo"<div class='alert alert-info alert-dismissable'>
                            <center><i class='fa fa-check'></i>Dear {$user} something went wrong with your insertion".mysqli_error($db)."!</center> 
                            
                        <script>function goto(){
                        window.location='index.php';
                        
                        }
                        setInterval(goto,2000);
                        </script>
                              </div>";
    
}
}
if(isset($_GET['change']))
     {
$change=mysqli_query($db,"update users set telephone='{$_GET['tel']}',last_name='{$_GET['lname']}',email='{$_GET['email']}',first_name='{$_GET['fname']}',password='{$_GET['pswd']}' where username='$user'");
    if($change){
        echo"<div class='alert alert-info alert-dismissable'>
                            <center><i class='fa fa-check'></i>Dear {$user} your information have been updated successfully!</center> 
                            
                        <script>function goto(){
                        window.location='index.php';
                        
                        }
                        setInterval(goto,2000);
                        </script>
                              </div>";
        
    }
    else {
        echo"<div class='alert alert-danger alert-dismissable'>
                            <center><i class='fa fa-check'></i>Dear {$user} somthing went wrong may be email or tel already exisit!</center> 
                            
                        <script>function goto(){
                        window.location='index.php';
                        
                        }
                        setInterval(goto,2000);
                        </script>
                              </div>";
        
    }
             
     }
if(isset($_POST['cancel'])){
        echo"<script>function goto(){
                        window.location='index.php';
                        
                        }
                        setInterval(goto,1000);
                        </script>
                              </div>";  
     } 
if(isset($_POST['savestudent'])){
    
$student = $_POST['student'];
$reason = $_POST['reason'];
$amount = $_POST['amount'];
    
$bankslip = $_FILES['file_array']['name'];
$tmp_name_array = $_FILES['file_array']['tmp_name'];
for($i = 0 ;$i < count($tmp_name_array); $i++){ 
    if(move_uploaded_file($tmp_name_array[$i],"../../profiles/".$bankslip[$i])){
        
    $recordpayment=mysqli_query($db,"insert into students_payment (registration_no,id,date,bankslip,bankslip_amount,payment_status) values('$student','$reason','$date','$bankslip[0]','$amount','proved')");
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
?>
                          <div id="collapseOne" class="panel-collapse collapse in">
                              <div class="panel-body">
                                                          <!-- Nav tabs -->
                                    <ul class="nav nav-tabs">
                                      <li class="active"><a href="#Module-pills" data-toggle="tab">Student Payment Records</a>
                                      </li>
                                        <li><a href="#teach-pills" data-toggle="tab">Manage payment Info</a>
                                        </li>

                                    </ul>

                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                    
                                        <div class="tab-pane fade" id="teach-pills">

                                            <p>
                                              <div class="col-lg-3">
                                              <div class="panel panel-info">
                                                    <div class="panel-heading">
                                                    <center> Record Payment information</center>
                                                        
                                                    </div>
                                               
<form role="form" method="post" action="#">
<br>
<div class="form-group input-group">
<span class="input-group-addon"><i class="fa fa-graduation-cap"></i></span>
    <select class="form-control" name="program" id="program">
            <?php
    $qry=mysqli_query($db,"select * from programs")or die(mysqli_query($db));
    if(mysqli_num_rows($qry)>0)
    {
    while($pro=mysqli_fetch_array($qry))
    {
echo "<option value=".$pro['program_id'].">".$pro['program_name']."</option>";
        
    }}
         else{
      echo "<option>no program record found</option>";  
    }
    
    ?>
    
</select>
</div>
 <div class="form-group">
<input type="text" class="form-control" name="reason" placeholder="input payment justification " >
   
</div> 
    <div class="form-group">
<input type="text" class="form-control" name="amount" placeholder="input ammount to be paid" >
   
</div>
<center>
 <button type="submit" name="savepayment" class="btn btn-outline btn-primary ">Record</button></center>

                                              <br>
                                                              </form>
                                              </div>
                      
                      </div>

                                                        <!-- /.panel-body -->

                                                          <div class="col-lg-9">
                                                              <div class="panel panel-info">
                                                                  <div class="panel-heading">
                                                                   <center>Payment infos</center> 
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
                                                                                      <th>Option</th>
                                                                                      
                                                                                  </tr>
                                                                              </thead>
                                                                              <tbody><?php
$payinf=mysqli_query($db,"SELECT * FROM `payments` join programs USING(program_id) ORDER BY payments.program_id DESC");
    while($readdata=mysqli_fetch_array($payinf)){
          
echo'<tr><td>'.$readdata['program_name'].'</td><td>'.$readdata['amount'].'</td><td>'.$readdata['reason'].'</td><td>'.$readdata['date'].'</td><td><a href="index.php?editp='.$readdata['id'].'"title="edit this"><i class="btn btn-outline btn-warning fa fa-check">  </i></a></td></tr>';  
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

                                            </p>
                                        </div>
                                        <div class="tab-pane fade" id="Program-pills">
                                            <h4></h4>
                                            <p><div class="alert alert-success alert-dismissable">
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. <a href="#" class="alert-link">Alert Link</a>.
                                            </div>
                                            <div class="alert alert-info alert-dismissable">
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. <a href="#" class="alert-link">Alert Link</a>.
                                            </div></p>
                                        </div>
                                        <div class="tab-pane fade in active" id="Module-pills">
                                            <h4></h4>
                                            <p>
<div class="col-lg-3">
<div class="panel panel-info">
  <div class="panel-heading">
record payment
  </div>
  <div class="panel-body">
    <form role="form" method="POST" action="#" enctype="multipart/form-data">
<br>
<div class="form-group">
    <select class="form-control" name="student" required>
        <option>select a student reg no</option>
<?php
    $qry=mysqli_query($db,"select * from students")or die(mysqli_query($db));
    if(mysqli_num_rows($qry)>0)
    {
    while($pro=mysqli_fetch_array($qry))
    {
echo "<option value=".$pro['registration_no'].">".$pro['registration_no']."</option>";
        
    }}
         else{
      echo "<option>no program record found</option>";  
    }
    
    ?>
</select>
</div>
        <div class="form-group">
    <select class="form-control" name="reason" required>
        <option>select payment reason </option>
<?php
    $qry=mysqli_query($db,"select * from payments join programs using(program_id) ")or die(mysqli_query($db));
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

  </div>

</div>


</div>

                                               <div class="col-lg-9">
                                               <div class="panel panel-info">
                                                      <div class="panel-heading">
                                                          <center>Students payment records</center>
                                                      </div>
                                                      <!-- /.panel-heading -->
                                                      <div class="panel-body">
                                                          <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                                              <thead>
                                                                  <tr>
                                                                      <th>Reg no</th>
                                                                      <th>date</th>
                                                                      <th>Prove</th>
                                                                      <th>Amount</th>
                                                                      <th>Justification</th>
                                                                      <th>Status</th>
                                                                      <th>Option</th>
                                                                  </tr>
                                                              </thead>
                                                              <tbody>
 <?php
$stdpayinf=mysqli_query($db,"SELECT * FROM students_payment join payments USING(id)")or die(mysqli_error($db));
    while($readpay=mysqli_fetch_array($stdpayinf)){
echo'<tr><td>'.$readpay['registration_no'].'</td><td>'.$readpay['date'].'</td><td><a href=\../../real/profiles/'.$readpay['bankslip'].'>View File<a/></td><td>'.$readpay['bankslip_amount'].'</td><td>'.$readpay['reason'].'</td><td>'.$readpay['payment_status'].'</td><td><a href="index.php?approve='.$readpay['id'].'-'.$readpay['registration_no'].'"title="Approve"><i class="btn btn-outline btn-warning fa fa-check">  </i></a>||<a href="index.php?remove='.$readpay['id'].'-'.$readpay['registration_no'].'"title="Approve"><i class="btn btn-outline btn-warning fa fa-trash">  </i></a></td></tr>'; 
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
                                            <h4 class="modal-title" id="myModalLabel">
                                          
                                            
                                            </h4>
                                        </div>
                                        <div class="modal-body">

                                          <div class="panel-body">
           
                                             <?php
       
                                              if(isset($_GET['editp'])){
                                              
   $dt=$_GET['editp'];    
$ret=mysqli_query($db,"select * from payments where id=$dt") or die(mysqli_error($db));
    if($ret){
$fetch=mysqli_fetch_array($ret);
$reason=$fetch['reason'];
$amount=$fetch['amount'];
$program_id=$fetch['program_id'];
$id=$fetch['id'];

    
    }                                             
 }                                           
                                              
                                              ?>
                                              
<form role="form" method="get" action="#">
    
   
    <div class="form-group">
<input type="number" name="id" value="<?php echo $id;?>" hidden>
    </div>
<br>
 <div class="form-group">
     <label>Payment Identification no:</label>
<input type="text" class="form-control" value="<?php echo $id;?>" disabled>
   
</div>
<div class="form-group">
<label>Program identification</label>
    <select class="form-control" name="program" id="program">
        <option value="<?php echo $program_id; ?>"><?php echo $program_id ?></option>
            <?php
    $qry=mysqli_query($db,"select * from programs")or die(mysqli_query($db));
    if(mysqli_num_rows($qry)>0)
    {
    while($pro=mysqli_fetch_array($qry))
    {
echo "<option value=".$pro['program_id'].">".$pro['program_id']."-".$pro['program_name']."</option>";
        
    }}
         else{
      echo "<option>no program record found</option>";  
    }
    
    ?>
    
</select>
</div>
 <div class="form-group">
     <label>Justification</label>
<input type="text" class="form-control" name="reason" value="<?php echo $reason ?>" >
   
</div> 
    <div class="form-group">
        <label>Paid Ammount</label>
<input type="text" class="form-control" name="amount" value="<?php echo $amount?>" >
   
</div>


                                              <br>
                                                             

                                        <div class="modal-footer">
                                            <a href="index.php" class="btn btn-primary">back</a>
                                            <button type="submit" name="saveupdates"class="btn btn-primary">Save changes</button>
                                        </div>
     </form>                                              
                                              
                                          </div>
                                                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
    
               <div class="modal fade" id="abp" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel"><center> My Credithentials</center></h4>
                                        </div>
                                        <div class="modal-body">

                                          <div class="panel-body">
                                              
        
                                                    
                    <?php
                                                                                            
      $data=mysqli_query($db,"select * from users where email='$user'")or die (mysqli_error($db));
        $ret=mysqli_fetch_array($data); 
        $fname=$ret['first_name'];
        $lname=$ret['last_name'];
       $email=$ret['email'];
    $password=$ret['password'];
    $telephone=$ret['telephone'];
   
                                                                                             
?>
                                                   
                                                <form role="form" method="get" action="#">
                                              <br>
  <div class="form-group">
      <label>Current Firstname:</label>                                          
    <input type="text" class="form-control" name="fname" value="<?php echo $fname;?>">
  </div> 
<div class="form-group">
<label>Current Lastname:</label>  
<input type="text" class="form-control" name="lname" value="<?php echo $lname;?>">
</div>
<div class="form-group ">
<label>Current Telephone:</label> 
<input type="number" class="form-control" name="tel" value="<?php echo $telephone;?>" maxlength="10">
</div> 
<div class="form-group">
<label>Current Email Address:</label>
<input type="text" class="form-control" name="email" value="<?php echo $email;?>">
</div> 
 <div class="form-group">
<label>Current Password:</label>
<input type="text" class="form-control" name="pswd" value="<?php echo $password;?>"></div>
                                                <center>
                                              <button type="submit" class="btn btn-outline btn-info btn-sm " name="change" required>Save update</button>|
                                                    <button type="submit" class="btn btn-outline btn-primary btn-sm " name="cancel" required>Back</button>
                                                    
                                                    
                                                    </center>

                                              <br>
                                              </form>
                                             
                                          </div>
                                                                        </div>

                                     
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div> 
</div>

<!-- end of student learning stutas  -->
    <!-- jQuery -->
    <!-- Page-Level Demo Scripts - Notifications - Use for reference -->


<?php include("footer.php");?>
