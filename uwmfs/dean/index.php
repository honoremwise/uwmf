<?php
include'../access.php';
include("header.php");
include("../dboperations.php");
$user=$_SESSION["username"];

?>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar">
                <div class="sidebar-nav navbar-collapse">

                  <div class="col-lg-12 col-md-6">
                    <div class="panel panel-primary">
                      
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left"><label data-toggle="modal" data-target="#ab">
                                   Personal info
                                </label></span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                    </div>
                       

                      </div>
                   
                  </div>

              
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Dean Dashboard</h1>
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
                          
if(isset($_POST['savegrade'])){
   $a=$_POST['lower']; $b=$_POST['upper'];$c=$_POST['letter'];$date=date('Y-m-d');
$savegrade=mysqli_query($db,"insert into grades(lowerbound,upperbound,letter,establishement_date) values($a,$b,'$c','$date')") or die(mysqli_error($db));
    
if($savegrade){
     echo"<div class='alert alert-info alert-dismissable'>
                            <center><i class='fa fa-check'></i>Grade saved successfully!</center> 
                            
                        <script>function goto(){
                        window.location='index.php';
                        
                        }
                        setInterval(goto,1000);
                        </script>
                              </div>";
    
}
    
}
if(isset($_GET['editgrades'])){
     echo" <div class='alert alert-warning alert-dismissable'>
                                  <Cente>
                                 Proceed to edit the grade with id {$_GET['editgrades']}?<i class='btn btn-outline btn-info fa fa-check' data-toggle='modal' data-target='#abcd' title='edit the grade with with id {$_GET['editgrades']}'>  </i><a href='index.php' title='Cancel'><i class='btn btn-outline btn-primary fa fa-times'>  </i></a><Cente>
                              </div>";
}                          
if(isset($_GET['editgrade'])){
$lowerbound=$_GET['lowerbound'];
$upperbound=$_GET['upperbound'];
$letter=$_GET['letter'];
$grade=$_GET['grade']; 
    
 $update=mysqli_query($db,"update grades set lowerbound=$lowerbound,upperbound=$upperbound,letter='$letter' where grade=$grade");
    if($update){
        echo"<div class='alert alert-warning alert-dismissable'>
        <center>transaction done successfully</center>
        </div>";
    }
    else{
        echo"<div class='alert alert-warning alert-dismissable'>
        <center>".mysqli_error($db)."</center>
        </div>
         <script>function goto(){
                        window.location='index.php';
                        
                        }
                        setInterval(goto,9000);
                        </script>
                              </div>";
    }
    
    
    
    
}
                          ?>
                          
                          <div id="collapseOne" class="panel-collapse collapse in">
                              <div class="panel-body">
                                                          <!-- Nav tabs -->
                                    <ul class="nav nav-tabs">
                                      <li class="active"><a href="#Module-pills" data-toggle="tab">Performance</a>
                                      </li>
                                        <li><a href="#Lecturer-pills" data-toggle="tab">Grades</a>
                                        </li>
                                        <li><a href="#teach-pills" data-toggle="tab">Lecturers_Program_Modules</a>
                                        </li>
<!--
                                        <li><a href="#Program-pills" data-toggle="tab">Notifications </a>
                                        </li>
-->
                                        <li><a href="#unteach-pills" data-toggle="tab">Module without Lecturers</a>
                                        </li>

                                    </ul>

                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                        <div class="tab-pane fade" id="Lecturer-pills">

                                            <p>  <div class="col-lg-4">
                                                <div class="panel panel-primary">
                                                <div class="panel-heading">
                                                    Marking grades
                                                </div>
        <form role="form" action="#" method="post">
       
<div class="form-group">
  
   <input type="number" name="lower" class="form-control" placeholder="Lower bound">
</div>
<div class="form-group">
  
   <input type="number" name="upper" class="form-control" placeholder="Upper bound">
</div>
<div class="form-group">
 
   <input type="text" name="letter" class="form-control" placeholder="Corresponding letter">
</div>
<center>
 <button type="submit" name="savegrade" class="btn btn-outline btn-primary">Save</button></center>

                        <br>
                                                      </form>
        </div>

                                                                                      </div>
<div class="col-lg-8">
                                                                                        <div class="panel panel-info">
                                                                                        <div class="panel-heading">
                                                                                          Grade records
                                                                                        </div>
                                                                                        <div class="table-responsive">
                                                                                            <table class="table">
                                                                                                <thead>
                                                                                                    
                                                                                                    <tr>
                                                                                                        <th>lower bound</th>
                                                                                                        <th>upper bound</th>
                                                                                                        <th>letter</th>
                                                                                                       <th>date</th> <th>Options</th>
                                                                                                    </tr>
                                                                                                </thead>
                                                                                                <tbody>
     <?php $sqr=mysqli_query($db,"select * from grades"); 
                                                                                                   
  while($viewrecs=mysqli_fetch_array($sqr)){
      echo"<tr class='success'>
     <td>".$viewrecs['lowerbound']."</td><td>".$viewrecs['upperbound']."</td><td>".$viewrecs['letter']."</td><td>".$viewrecs['establishement_date']."</td><td><a href='index.php?editgrades=".$viewrecs['grade']."'title='Click to edit this module to this lecturer'><i class='btn btn-outline btn-warning fa fa-edit'>  </i></a></td></tr>"; 
  } ?>                                                                                            

                                                                                                </tbody>
                                                                                            </table>
                                                                                        </div>
                                                                                      </div>
                                                                                    </div>
                                                                                    </p>
                                    </div>
                                        <div class="tab-pane fade" id="teach-pills">

                                            <p>

                                                        <!-- /.panel-body -->

                                                          <div class="col-lg-12">
                                                              <div class="panel panel-info">
                                                                  <div class="panel-heading">
                                                                     <center>Teachers History</center> 
                                                                  </div>
                                                                  <!-- /.panel-heading -->
                                                                  <div class="panel-body">
                                                                      <div class="table-responsive">
<table class="table"><thead><tr><th>Names</th><th>Tel</th><th>program</th><th>Program</th><th>Module Name</th><th>Module Credits</th><th>Total Hours</th></tr></thead><tbody><?php
$teach=mysqli_query($db,"select * from users join modules_programs using(user_id) join modules using (module_id) join programs using(program_id) join users_responsabilities using(user_respo_id)");
while($lines=mysqli_fetch_array($teach)){
echo'<tr class="success"><td>'.$lines['first_name'].' '.$lines['last_name'].'</td><td>'.$lines['telephone'].'</td><td>'.$lines['program_name'].'</td><td>'.$lines['module_code'].'</td><td>'.$lines['module_name'].'</td><td>'.$lines['module_credits'].'</td><td>'.$lines['study_hours'].'</td></tr>';   
    
}?>                                                                 
                                                                              </tbody>
                                                                          </table>
                                                                      </div>
                                                                      
                                                                  </div>
                                                                  <!-- /.panel-body -->
                                                              </div>
                                                              <!-- /.panel -->
                                                          </div>

                                            </p>
                                        </div>
                                        <div class="tab-pane fade" id="Program-pills">
                                            <h4>Notifications</h4>
                                            <p><div class="alert alert-success alert-dismissable">
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. <a href="#" class="alert-link">Alert Link</a>.
                                            </div>
                                            <div class="alert alert-info alert-dismissable">
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. <a href="#" class="alert-link">Alert Link</a>.
                                            </div></p>
                                        </div>   
        <div class="tab-pane fade" id="unteach-pills">
                                            <h4></h4>
                                            <p> <div class="panel panel-info">
                                                                  <div class="panel-heading">
                                                                    <center>Modules without Lecturers</center>
                                                                  </div>
                                                                  <!-- /.panel-heading -->
                                                                  <div class="panel-body">
                                                                      <div class="table-responsive">
<table class="table"><thead><tr><th>Module Name & code</th><th>Course Units</th><th>program</th><th>Learning Hours</th></tr></thead><tbody><?php
$teach=mysqli_query($db,"SELECT * FROM modules join `modules_programs` USING(module_id) join programs USING (program_id) WHERE user_id=0");
while($lines=mysqli_fetch_array($teach)){
echo'<tr class="success"><td>'.$lines['module_code'].' - '.$lines['module_name'].'</td><td>'.$lines['module_credits'].'</td><td>'.$lines['program_name'].'</td><td>'.$lines['study_hours'].'</td></tr>';   
    
}?>                                                                 
                                                                              </tbody>
                                                                          </table>
                                                                      </div>
                                                                      
                                                                  </div>
                                                                  <!-- /.panel-body -->
                                                              </div>
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
                                                          <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                                              <thead>
                                                                  <tr>
                                                                      <th>Reg No</th>
                                                                      <th>Module</th>
                                                                      <th>Module Name</th>
                                                                      <th>Marks</th>
                                                                      <th>Grade</th>
                                                                      <th>Date</th>
                                                                  </tr>
                                                              </thead>
                                                              <tbody>

                                                                 
<?php
 $result=mysqli_query($db,"SELECT * FROM `marks` join modules using(module_id) join grades USING (grade)");
                                                                  
while($userd=mysqli_fetch_array($result)){
  echo "<tr>
<td>".$userd['registration_no']."</td>
 <td>".strtoupper($userd['module_code'])."</td>
 <td>".$userd['module_name']."</td>
 <td>".$userd['points']."</td>
 <td>".strtoupper($userd['letter'])."</td>
 <td>".$userd['addition_date']."</td>
 
                                                                      
                                                                  </tr>";   }                                                               ?>
                                                                  

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
                                            <h4 class="modal-title" id="myModalLabel"><center>Edit grade details</center></h4>
                                        </div>  <div class="panel-body">
                                        <?php
                                      if(isset($_GET['editgrades'])){
      $data=mysqli_query($db,"select * from grades where grade={$_GET['editgrades']}")or die (mysqli_error($db));
        $ret=mysqli_fetch_array($data); 
        $lowerbound=$ret['lowerbound'];
        $upperbound=$ret['upperbound'];
       $letter=$ret['letter'];
    $establishement_date=$ret['establishement_date'];
    $grade=$ret['grade'];
   }?>
      
      
     <form role="form" method="get" action="test.php">
                                              <br>
  <div class="form-group">
      <label>Grade idendentification No :<?php echo $grade;?> </label>                                          
    <input type="text"  name="grade" value="<?php echo $grade;?>" hidden>
  </div> 
<div class="form-group">
<label>Grade Lower Bound:</label>  
<input type="number" class="form-control" name="lowerbound" value="<?php echo $lowerbound;?>">
</div>
<div class="form-group ">
<label>Grade Upper Bound:</label> 
<input type="number" class="form-control" name="upperbound" value="<?php echo $upperbound;?>" >
</div> 
<div class="form-group">
<label>Grade Corresponding Letter:</label>
<input type="text" class="form-control" name="letter" value="<?php echo $letter;?>">
</div>  
 <div class="form-group">
<label>Establishment date:</label>
<input type="text" class="form-control" name="establishement_date" value="<?php echo  $establishement_date;?>" disabled></div>
                                                <center>
                                              <button type="submit" class="btn btn-outline btn-info btn-sm " name="editgrade" required>Save update</button>|
                                                    <a href="index.php" class="btn btn-outline btn-primary btn-sm ">Back</a>
                                                   
                                                    
                                                    
                                                    </center>

                                              <br>
                                              </form>
                                    </div></div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>

                <div class="modal fade" id="ab" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
