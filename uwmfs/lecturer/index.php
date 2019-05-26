<?php
include'../access.php';
include("header.php");
include("../dboperations.php");
$user=$_SESSION["username"];
$lecturer=mysqli_query($db,"select * from users where email='$user'");
$re=mysqli_fetch_array($lecturer);
$user_id=$re['user_id'];
?>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar">
                <div class="sidebar-nav navbar-collapse">

                          <!-- /.panel-body -->

                      </div>
 <div class="sidebar-nav navbar-collapse">

                   <div class="col-lg-12 col-md-6">
                                  <div class="panel panel-primary">
                           
                            <a href="students.php">
                                <div class="panel-footer">
                                  <span class="pull-left">
                                      
             <?php
                                        
                $qer=mysqli_query($db,"SELECT DISTINCT(module_id) FROM `marks` WHERE user_id=$user_id")or die(mysqli_error($db));
              $recors=mysqli_num_rows($qer); 
                                            echo $recors;
                                           ?>
                                    Module's marks available
                                     
                                  </span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
        
 
                      </div></div>
                     
                  </div>
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Lecturer  Dashboard</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
              <div class="panel-body">
                  <div class="panel-group" id="accordion">
                      <div class="panel panel-primary">
                          <?php
                          
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
                          
                          
                          
                          
                          
                          ?>
                     
                          <div id="collapseOne" class="panel-collapse collapse in">
                              <div class="panel-body">
                                                          <!-- Nav tabs -->
                                    <ul class="nav nav-tabs">
                                      <li class="active"><a href="#Module-pills" data-toggle="tab">Marks Management</a>
                                      </li>
                                        <!-- <li><a href="#Lecturer-pills" data-toggle="tab">Time table </a>
                                        </li> -->
                                        <li><a href="#teach-pills" data-toggle="tab">My modules</a>
                                        </li>
                                        <li><a href="#Program-pills" data-toggle="tab">Notifications </a>
                                        </li>

                                    </ul>

                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                              <div class="tab-pane fade" id="teach-pills">

                                            <p>
                                                                                                  <!-- /.panel-body -->

                                                          <div class="col-lg-12">
                                                              <div class="panel panel-primary">
                                                                  <div class="panel-heading">
                                                                    My Modules Agenda
                                                                  </div>
                                                                  <!-- /.panel-heading -->
                                                                  <div class="panel-body">
                                                                      <div class="table-responsive">
                                                                          <table class="table">
                                                                              <thead>
                                                                                  <tr>

                                                                                      <th>Course Code</th>
                                                                                      <th>Course Name</th>
                                                                                      <th>Course Units</th>
                                                                                     
                                                                                  </tr>
                                                                              </thead><tbody>
   <?php
                                                                              
   $mc=mysqli_query($db,"select * from users JOIN modules_programs USING(user_id) JOIN modules using (module_id) where user_id=$user_id");
               if($mc){                                                              
   while($read=mysqli_fetch_array($mc)){
    echo ' <tr>
                                                                                      <td>'.$read['module_code'].'</td>
                                                                                      <td>'.$read['module_name'].'</td>
                                                                                      <td>'.$read['module_credits'].'</td>
                                                                                      
                                                                                  </tr>';
       
   }}
                                                                              else{
 echo ' <tr>
                                                                                      <td colspan=4> you have not yet been assigned to any module<td>
                                                                                  </tr>';
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

                                            </p>
                                        </div>
                                        <div class="tab-pane fade" id="Program-pills">
                                            <h4></h4>
                                            <p>
                        <div class="panel-body">
                            <ul class="timeline">
                                <li>
                                    <div class="timeline-badge"><i class="fa fa-share"></i>
                                    </div>
                                    <div class="timeline-panel">
                                        <div class="timeline-heading">
                                            <h4 class="timeline-title">Lorem ipsum dolor</h4>
                                            <p><small class="text-muted"><i class="fa fa-clock-o"></i> 11 hours ago via Twitter</small>
                                            </p>
                                        </div>
                                        <div class="timeline-body">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Libero laboriosam dolor perspiciatis omnis exercitationem. Beatae, officia pariatur? Est cum veniam excepturi. Maiores praesentium, porro voluptas suscipit facere rem dicta, debitis.</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="timeline-inverted">
                                    <div class="timeline-badge warning"><i class="fa fa-reply"></i>
                                    </div>
                                    <div class="timeline-panel">
                                        <div class="timeline-heading">
                                            <h4 class="timeline-title">Lorem ipsum dolor</h4>
                                        </div>
                                        <div class="timeline-body">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Autem dolorem quibusdam, tenetur commodi provident cumque magni voluptatem libero, quis rerum. Fugiat esse debitis optio, tempore. Animi officiis alias, officia repellendus.</p>
                                        </div>
                                    </div>
                                </li>
 </ul>
                        </div>
                        <!-- /.panel-body -->
                  
                                            </p>
                                        </div>
                                        <div class="tab-pane fade in active" id="Module-pills">
                                            <h4></h4>
                                            <p>
<div class="col-lg-3">
<div class="panel panel-primary">
  <div class="panel-heading">
Record Student Marks (%)
      <?php
      $letter="";
      if(isset($_POST['savemarks'])){
          
  $grade=mysqli_query($db,"SELECT * FROM `grades` WHERE lowerbound<={$_POST['points']} and upperbound>={$_POST['points']} order by grade desc LIMIT 1");
          
if($grade){
$retr=mysqli_fetch_array($grade);
$letter=$retr['grade'];
    
}
else{
    echo mysqli_error($db);
}

   $addmarks=mysqli_query($db,"insert into marks (registration_no,module_id,points,addition_date,user_id,grade)values('{$_POST['regno']}','{$_POST['mdl']}',
   '{$_POST['points']}','{$_POST['dates']}',$user_id,$letter)") ;
          if($addmarks)
          {
          
          echo"<script>function redirect(){
window.location='index.php';
}setInterval(redirect,1000);</script>";
      }else{
          echo"<font color=red>Student marks for this course have been already registered</font>
          <script>function redirect(){
window.location='index.php';
}setInterval(redirect,1000);</script>";
              }
      
      }
      
      
      ?>
      
  </div>
  <div class="panel-body">
    <form role="form" action="#" method="post">
<br>
<div class="form-group ">

<input type="text" placeholder="Student reg no" class="form-control" name="regno">
 

</div>
<div class="form-group ">

<select class="form-control" name="mdl">
    <option>select Module-code</option>
    
    <?php
     $mdl=mysqli_query($db,"select * from modules")or die(mysqli_query($db));
    if(mysqli_num_rows($mdl)>0)
    {
    while($md=mysqli_fetch_array($mdl))
    {
echo "<option value=".$md['module_id'].">".$md['module_code']."-".$md['module_name']."</option>";
        
    }}
    else{
      echo "<option>no programs in db</option>";  
    }
    
    ?>
    </select>

</div>
<div class="form-group ">

<input type="number" class="form-control" placeholder="marks obtained" name="points">

</div>
<div class="form-group ">

<input type="date" class="form-control" placeholder="date of the exam" name="dates">

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
                                                        <center>Marks Records</center>
                                                      </div>
                                                      
                                                      <div class="panel-body">
                                                           <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                                              <thead>
                                                                  <tr>
                                                                      <th>Reg no</th>
                                                                      <th>Module-Code</th>
                                                                      <th>Module</th>
                                                                      <th>Marks</th>
                                                                      <th>date</th>
                                                                      <th>Grade</th>
                                                                     <th>Delete</th>
                                                                  </tr>
                                                              </thead>
                                                              <tbody>

                                                                     <?php
                                                                
      $result=mysqli_query($db,"select * from marks join modules USING(module_id) join users USING(user_id) join grades using(grade) WHERE user_id=$user_id");
                                                                  
while($userd=mysqli_fetch_array($result)){
  echo "<tr>
<td>".$userd['registration_no']."</td>
 <td>".$userd['module_code']."</td>
 <td>".$userd['module_name']."</td>
 <td>".$userd['points']."</td>
 <td>".$userd['addition_date']."</td>
 <td>".strtoupper($userd['letter'])."</td>
 <td><a href='index.php?delete={$userd['module_id']}' title='to delete this record'><i class='btn btn-outline btn-danger fa fa-trash'> </i></a></td>
                                                                      
                                                                  </tr>";
    
}
if(isset($_GET['delete'])){
$del=mysqli_query($db,"delete from marks where module_id='{$_GET['delete']}'");
if($del){
    echo"<script>function redirect(){
window.location='index.php';
}setInterval(redirect,1000);</script>";
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
                                            <h4 class="modal-title" id="myModalLabel"> <center>My infos</center></h4>
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
<!--                                                    <button type="submit" class="btn btn-outline btn-primary btn-sm " name="cancel" required>Back</button>-->
                                                    <a href="index.php" class="btn btn-outline btn-primary btn-sm ">Back</a>
                                                    
                                                    
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
