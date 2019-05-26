<?php
include'../access.php';
include("../dboperations.php");
include("header.php");
$user=$_SESSION["username"];
$date=date('Y-m-d');
?>    <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Applicants panel</h1>
                </div>
              
            </div>
            <!-- /.row -->
            <div class="row">
            <div class="col-lg-3">
            <form role="form" method="post" action="reports.php"> 
<div class="form-group input-group">
 <span class="input-group-addon">
    <button type="submit" name="rejected" class="fa fa-list"></button></span>
<select class="form-control" name="program_name"required>
<?php $dbz=mysqli_query($db,"select * from programs where program_code<'04'");
    while($pr=mysqli_fetch_array($dbz))
       {
     echo "<option value='{$pr['program_code']}"."-".$pr['program_name']."'>{$pr['program_name']}</option>";
    }
   
    ?>    

    </select></div>
                         </div>
                      <div class="col-lg-3">
                     <div class="form-group">
<input type="text" class="form-control" value="Rejected Applications" disabled>

                                              </div></div></form></div>
              <div class="panel-body">
                  <div class="panel-group" id="accordion">
                                            <?php                      
if(isset($_GET['change']))
     {
$change=mysqli_query($db,"update users set telephone='{$_GET['tel']}',last_name='{$_GET['lname']}',email='{$_GET['email']}',first_name='{$_GET['fname']}',password='{$_GET['pswd']}' where email='$user'");
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
  
if(isset($_GET['reject'])){
     echo" <div class='alert alert-danger alert-dismissable'>
                                  <Center>
                                Are you sure you want to reject this applicant with this {$_GET['reject']}?
                                 reference number? <a href='index.php?reject1={$_GET['reject']}' title='Reject this candidate'><i class='btn btn-outline btn-danger fa fa-check'> </i></a>|<a href='index.php' title='cancel Rejection of this applicant'><i class='btn btn-outline btn-primary fa fa-times'>  </i></a><Center>
                              </div>";
}
 if(isset($_GET['reject1'])){
    $reject=mysqli_query($db,"update applications set application_status='rejected' where reference_no={$_GET['reject1']}");
     if($reject){
  echo"<div class='alert alert-info alert-dismissable'>
                            <i class='fa fa-times'></i>Rejected 
                            <script>function goto(){
                        window.location='index.php';
                        
                        }
                        setInterval(goto,1000);
                        </script>
                              </div>"; 
    }
     else
     {
        echo mysqli_error($db)." <script>function goto(){
                        window.location='index.php';
                        
                        }
                        setInterval(goto,3000);
                        </script>";
     }
     
 }           
                                                         
                                                        ?>
                      
                      <div class="panel panel-primary">
                                            <div id="collapseOne" class="panel-collapse collapse in">
                              <div class="panel-body">
                                                          <!-- Nav tabs -->
                                    <ul class="nav nav-tabs">
                                        <li class="active"><a href="#all-pills" data-toggle="tab">All applicants</a>
                                        </li>
                                         <li><a href="#Branches-pills" data-toggle="tab">Bachalor applicants </a>
                                        </li>
                                        <li><a href="#Certificate-pills" data-toggle="tab">Certificate Applicants</a>
                                        </li>
                                        <li><a href="#Diploma-pills" data-toggle="tab">Diploma Applicants </a>
                                        </li>
                                       <li><a href="#Rejected-pills" data-toggle="tab">Rejected Applicants </a>
                                        </li>
                                        


                                    </ul>

                                    <!-- Tab panes -->
                                    <div class="tab-content">
                           
                                        
                                        <div class="tab-pane fade" id="Branches-pills">
                                            <h4></h4>
                                            <p>  <div class="col-lg-12">
                             <div class="panel panel-primary">
                                                  <div class="panel-heading">
                                                     <center>Bachalor Applicants
                                                      
                                                      </center> 
                                                  </div>
                                                    <div class="panel-body">
                                                      <div class="table-responsive">
                                                          <table class="table">
                                                              
                                                                <thead>
                                                                  
                                                                  <tr>
                                                                      <thead>
                                                                      <th>Refference NO</th>
                                                                      <th>Full Names</th>
                                                                      <th>Telephone</th>
                                                                      <th>Email</th>
                                                                    <th>Program</th>
                                                                    <th>Branch</th>
                                                                    
                                                                    <th>Options</th>
                                                                         
                                                                      </thead>
                                                                  </tr>
                                                              </thead>
   
                                                              
                                                              <tbody>
   <?php                                              
                                                                  
    $dbbranches=mysqli_query($db,"select * from candidates join applications USING(reference_no) where applications.program_code='03' and applications.application_status='pending'") or die(mysqli_error($db));
               if(mysqli_num_rows($dbbranches)>0){                                                  
                    while($res=mysqli_fetch_array($dbbranches)){
    echo"<tr>
<td>".$res['reference_no']."</td>
<td>".$res['first_name']." ".$res['last_name']."</td>
<td>".$res['candidate_telephone']."</td>
<td class='center'>".$res['candidate_email']."</td>
<td class='center'>".$res['program_code']."</td>
<td class='center'>".$res['branch_code']."</td>
<td class='center'>
<a href='applicants_detail.php?viewmore={$res['candidate_id']}' title='Click to view more Details applicant'><i class='btn btn-outline btn-primary fa fa-eye'>  </i></a></td></tr>";                                                    
                    }} 
                                                                  
            else
            {
              echo"<tr><td colspan='4'>no data selected</td></tr>";  
            }
                                                                      
                                                                      ?> 
                                                              </tbody>
                                                          </table>
                                                      </div>
                                                      <!-- /.table-responsive -->
                                                  </div>
                                                 
                                              </div>
                                                                                    </div>
                                                                                    </p>
                                    </div>
                                  <div class="tab-pane fade" id="Rejected-pills">
                                <div class="panel panel-primary">
                                                  <div class="panel-heading">
                                                     <center>Rejected Applicants
                                                      </center> 
                                                  </div>
                                                    <div class="panel-body">
                                                      <div class="table-responsive">
                                                          <table class="table">
                                                              
                                                              <thead>
                                                                  
                                                                  <tr>
                                                                      <thead>
                                                                      <th>Refference NO</th>
                                                                      <th>Full Names</th>
                                                                      <th>Telephone</th>
                                                                      <th>Email</th>
                                                                    <th>Program</th>
                                                                    <th>Branch</th>
                                                                    
                                                                    <th>Options</th>
                                                                         
                                                                      </thead>
                                                                  </tr>
                                                              </thead>
   
                                                              
                                                              <tbody>
   <?php                                              
                                                                  
    $dbbranches=mysqli_query($db,"select * from candidates join applications USING(reference_no) where applications.application_status='rejected'") or die(mysqli_error($db));
               if(mysqli_num_rows($dbbranches)>0){                                                  
                    while($res=mysqli_fetch_array($dbbranches)){
    echo"<tr>
<td>".$res['reference_no']."</td>
<td>".$res['first_name']." ".$res['last_name']."</td>
<td>".$res['candidate_telephone']."</td>
<td class='center'>".$res['candidate_email']."</td>
<td class='center'>".$res['program_code']."</td>
<td class='center'>".$res['branch_code']."</td>
<td class='center'>
<a href='applicants_detail.php?viewmore={$res['candidate_id']}' title='Click to view more Details applicant'><i class='btn btn-outline btn-primary fa fa-eye'>  </i></a></td></tr>";                                                    
                    }} 
                                                                  
            else
            {
              echo"<tr><td colspan='4'>no data selected</td></tr>";  
            }
                                                                      
                                                                      ?> 
                                                              </tbody>
                                                          </table>
                                                      </div>
                                                      <!-- /.table-responsive -->
                                                  </div>
                                                 
                                              </div>
                                  
                                  </div>
                                        <div class="tab-pane fade in active" id="all-pills">
                                            <h4></h4>
                                            <p><div class="col-lg-12"> 
                                                 <div class="panel panel-primary">
                                                             
                                      
                                                      <div class="panel-heading">
                                                          <center> All Applicants List</center>
                                                     </div>
                                                      <!-- /.panel-heading -->
                                                      <div class="panel-body">
                                                          <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">  
<thead>
<tr>
 <th>Ref no</th>
<th>Full Names</th>
<th>Telephone</th>
<th>Email</th>
<th>Program</th>
<th>Branch</th>
<th>Details</th>
</tr>
</thead>
 <tbody>
<?php                                            
$dbapplicant=mysqli_query($db,"select * from candidates join applications USING(reference_no) where  applications.application_status='pending'") or die(mysqli_error($db));
                    while($res=mysqli_fetch_array($dbapplicant)){
echo"<tr>
<td>".$res['reference_no']."</td>
<td>".$res['first_name']." ".$res['last_name']."</td>
<td>".$res['candidate_telephone']."</td>
<td class='center'>".$res['candidate_email']."</td>
<td class='center'>".$res['program_code']."</td>
<td class='center'>".$res['branch_code']."</td>
<td class='center'>
<a href='applicants_detail.php?viewmore={$res['candidate_id']}' title='Click to view more Details applicant'><i class='btn btn-outline btn-primary fa fa-eye'>  </i></a></td></tr>";
}?></tbody></table><!-- /.table-responsive -->
</div><!-- /.panel-body -->
    </div></div>

                                            <div class="col-lg-12"><br></div>
                                                         
                                  </p>
                                  </div>

                                            
                                        
                                        <div class="tab-pane fade" id="Certificate-pills">
                                            <h4></h4>
                                            <p>
                                             <div class="col-lg-12">
                                              <div class="panel panel-primary">
                                                  <div class="panel-heading">
                                                      <center>Certificate Program applicants list</center>
                                                  </div>
                                                  <!-- /.panel-heading -->
                                                  <div class="panel-body">
                                                      <div class="table-responsive">
                                                          <table class="table">
                                                              <thead>
                                                                  
                                                                  <tr>
                                                                      <thead>
                                                                      <th>Refference NO</th>
                                                                      <th>Full Names</th>
                                                                      <th>Telephone</th>
                                                                      <th>Email</th>
                                                                    <th>Program</th>
                                                                    <th>Branch</th>
                                                                    
                                                                    <th>Options</th>
                                                                         
                                                                      </thead>
                                                                  </tr>
                                                              </thead>
                                                              <tbody>
                                                             
                                                                      <?php                                              
                                                                  
    $dbapplicant=mysqli_query($db,"select * from candidates join applications USING(reference_no) where applications.program_code='02' and applications.application_status='pending'") or die(mysqli_error($db));
                    while($res=mysqli_fetch_array($dbapplicant)){
    echo"<tr>
<td>".$res['reference_no']."</td>
<td>".$res['first_name']." ".$res['last_name']."</td>
<td>".$res['candidate_telephone']."</td>
<td class='center'>".$res['candidate_email']."</td>
<td class='center'>".$res['program_code']."</td>
<td class='center'>".$res['branch_code']."</td>
<td class='center'>
<a href='applicants_detail.php?viewmore={$res['candidate_id']}' title='Click to view more Details applicant'><i class='btn btn-outline btn-primary fa fa-eye'>  </i></a></td></tr>";                                                    
                    }
                                                                  
                                                                      
                                                                      
                                                                      ?>                                              
                                                                      
                                                                      
                                                                  
                                                                 
                                                              </tbody>
                                                          </table>
                                                      </div>
                                                      <!-- /.table-responsive -->
                                                  </div>
                                                  <!-- /.panel-body -->
                                              </div></div></p>
                                        </div>
                           <div class="tab-pane fade" id="Diploma-pills">
                                            <h4></h4>
                                            <p>
                                              <div class="col-lg-12">
                                              <div class="panel panel-primary">
                                                  <div class="panel-heading">
                                                     <center>Diploma applicants list
                                                                          </center> 
                                                  </div>
                                                    <div class="panel-body">
                                                      <div class="table-responsive">
                                                          <table class="table">
                                                              
                                                                  <tr>
                                                                      <thead>
                                                                      <th>Refference NO</th>
                                                                      <th>Full Names</th>
                                                                      <th>Telephone</th>
                                                                      <th>Email</th>
                                                                    <th>Program</th>
                                                                    <th>Branch</th>
                                                                    
                                                                    <th>Options</th>
                                                                         
                                                                      </thead>
                                                                  </tr>
   
                                                              
                                                              <tbody>
   <?php                                              
                                                                  
    $dbbranches=mysqli_query($db,"select * from candidates join applications USING(reference_no) where applications.program_code='01' and applications.application_status='pending'") or die(mysqli_error($db));
               if(mysqli_num_rows($dbbranches)>0){                                                  
                    while($res=mysqli_fetch_array($dbbranches)){
    echo"<tr>
<td>".$res['reference_no']."</td>
<td>".$res['first_name']." ".$res['last_name']."</td>
<td>".$res['candidate_telephone']."</td>
<td class='center'>".$res['candidate_email']."</td>
<td class='center'>".$res['program_code']."</td>
<td class='center'>".$res['branch_code']."</td>
<td class='center'>
<a href='applicants_detail.php?viewmore={$res['candidate_id']}' title='Click to view more Details applicant'><i class='btn btn-outline btn-primary fa fa-eye'>  </i></a></td></tr>";                                                    
                    }} 
                                                                  
            else
            {
              echo"<tr><td colspan='4'>no data selected</td></tr>";  
            }
                                                                      
                                                                      ?> 
                                                              </tbody>
                                                          </table>
                                                      </div>
                                                      <!-- /.table-responsive -->
                                                  </div>
                                                 
                                              </div></div></p>
                                        </div>           
                                      
                      
                                      
                                     
<!--
                                        <div class="tab-pane fade in active" id="applicants-pills">
                                            
                                              ss</div>
-->

 
        <!-- /#page-wrapper -->

  
<div class="row">
    <div class="modal fade" id="abcd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel"><center>Update Module</center></h4>
                                        </div>
                                        <div class="modal-body">
                                           <?php
                                            if(isset($_GET['editmodule'])){
                                                
$getmdl=mysqli_query($db,"select * from modules where module_id={$_GET['editmodule']}");
    if($getmdl){
$fetch=mysqli_fetch_array($getmdl); 
    $module_code=$fetch['module_code'];
    $module_name=$fetch['module_name'];
    $module_credits=$fetch['module_credits'];
    $study_hours=$fetch['study_hours'];
    $module_id=$fetch['module_id'];

    }
                                                
   }
                                            
                                            ?>
<form role="form" method="get" action="index.php">
                                              <br>
     <input type="text"  placeholder="program name" name="module_id" value="<?php echo $module_id ?>" hidden>
    <div class="form-group">
    <label>Module identification no:</label>
    <input type="text"  class="form-control" placeholder="program name" name="mdl" value="<?php echo $module_id ?>" disabled>
    </div><div class="form-group">
    <label>Module Name:</label>
    <input type="text"  class="form-control" placeholder="program name" name="mdl" value="<?php echo $module_name ?>" >
    </div>
                                                <div class="form-group">
    <label>Module Code:</label>
    <input type="text"  class="form-control" placeholder="program name" name="code" value="<?php echo $module_code ?>">
                                                        </div>
    
                                              
    <div class="form-group">
        <label>Course units:</label>
<input type="text" class="form-control" placeholder="program name" name="credits" value="<?php echo $module_credits ?>"required></div> 
    <div class="form-group">
        <label>learning hours</label>
<input type="text" class="form-control" placeholder="program name" name="hours" value="<?php echo $study_hours ?>" required></div>
<br>
                                             
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-default" name="back">Close</button>
                                            <button type="submit" class="btn btn-primary" name="updatemodule">Save changes</button>
                                        </div> </form>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div> 
    <div class="modal fade" id="abcde" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel"><center>Update Branch infos</center></h4>
                                        </div>
                                        <div class="modal-body">
                                           <?php
                                            if(isset($_GET['editbranch'])){
                                                
$getmdl=mysqli_query($db,"select * from branches where 	branch_id={$_GET['editbranch']}");
    if($getmdl){
$fetch=mysqli_fetch_array($getmdl); 
    $branch_id=$fetch['branch_id'];
    $branch_name=$fetch['branch_name'];
    $branch_code=$fetch['branch_code'];
    $branch_location=$fetch['branch_location'];
    $branch_country=$fetch['branch_country'];
    
    }
                                                
   }
                                            
                                            ?>
<form role="form" method="get" action="index.php">
                                              <br>
     <input type="text"  placeholder="program name" name="branch_id" value="<?php echo $branch_id ?>" hidden>
    <div class="form-group">
    <label>Branch Identification No:</label>
    <input type="text"  class="form-control" placeholder="program name" name="branch_id" value="<?php echo $branch_id ?>" disabled>
    </div>
    <div class="form-group">
    <label>Branch name:</label>
    <input type="text"  class="form-control" placeholder="program name" name="branch_name" value="<?php echo $branch_name ?>" >
    </div>
    <div class="form-group">
    <label>Branch Code:</label>
    <input type="text"  class="form-control" placeholder="program name" name="branch_code" value="<?php echo $branch_code ?>" >
    </div>
                                                <div class="form-group">
    <label>Branch Location:</label>
    <input type="text"  class="form-control" placeholder="program name" name="branch_location" value="<?php echo $branch_location ?>">
                                                        </div>
    
                                              
    <div class="form-group">
        <label>Branch Country</label>
<input type="text" class="form-control" placeholder="program name" name="branch_country" value="<?php echo $branch_country ?>"required></div> 

<br>
                                             
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" name="back" class="btn btn-default" >Close</button>
                                            <button type="submit" class="btn btn-primary" name="updatebranch">Save changes</button>
                                        </div> </form>
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
                                            <h4 class="modal-title" id="myModalLabel">Existing Program details</h4>
                                        </div>
                                        <div class="modal-body">

                                          <div class="panel-body">
                                              <?php
     if(isset($_GET['programdetails']))
                            {                         
                                 
$vars=mysqli_query($db,"select * from programs where program_id={$_GET['programdetails']}");
                                 
  if($vars){
      $retr=mysqli_fetch_array($vars);
      $program_name=$retr['program_name'];
      $number_of_levels=$retr['number_of_levels']; 
      $description=$retr['description'];
      $program_code=$retr['program_code'];
      $program_id=$retr['program_id'];
      $maximum_modules=$retr['maximum_modules'];
  }}?>
<form role="form" method="get" action="index.php">
                                              <br>
     <input type="text"  placeholder="program name" name="program_id" value="<?php echo $program_id ?>" hidden>
                                                <div class="form-group input-group">
    <span class="input-group-addon"><i class="fa fa-key"></i></span>
    <input type="text"  class="form-control" placeholder="program name" value="<?php echo $program_id ?>" disabled>
                                                        </div>
                                              <div class="form-group input-group">
                                              <span class="input-group-addon"><i class="fa fa-graduation-cap"></i></span>
                                              <input type="text" class="form-control" placeholder="program name" name="program" value="<?php echo $program_name ?>"required>

                                              </div> 
                                            
                                              <div class="form-group ">
                                                  <label>Learning Period</label>
                                                <select class="form-control" name="levels" required>
                                                  <option value="<?php echo $number_of_levels ?>"><?php echo $number_of_levels ?></option> 
                                                  <option value="1">1</option>
                                                  <option value="2">2</option>
                                                  <option value="3">3</option>
                                                  <option value="4">4</option>
                                                  </select>
                                              </div>
                                         <div class="form-group">
                                             <label>Program code:</label>
                                                 <input type="text" class="form-control" placeholder="program code" name="code" required value="<?php echo $program_code ?>">

                                              </div>
                                        <div class="form-group">
                                            <label>Number of modules:</label>
                                                 <input type="text" class="form-control" placeholder="program code" name="modules" required value="<?php echo $maximum_modules ?>">

                                              </div>
                                             <div class="form-group">
                                                 <textarea rows="6" class="form-control" placeholder="new program descriptions" name="desc"></textarea>

                                              </div>
                                       

                                              <center>
                                              <input type="submit" class="btn btn-outline btn-primary btn-sm" name="updatethis">|<input type="submit" class="btn btn-outline btn-primary btn-sm" name="back" value="Back"></center>

                                              <br>
                                              </form>
                                            
                                          </div>
                                                                        </div>

                                        
                                    </div>
                                </div>
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
                                                    <a href="index.php" class="btn btn-outline btn-primary btn-sm " name="cancel" required>Back</a>
                                                    
                                                    
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

 <script type="text/javascript">     
        function PrintDiv() {    
           var divToPrint = document.getElementById('divToPrint');
           var popupWin = window.open('', '_blank', 'width=300,height=300');
           popupWin.document.open();
           popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
            popupWin.document.close();
                }
     </script>
	<script type="text/javascript" src="jquery.min.js"></script>
<script type="text/javascript" src="js.js"></script>
<?php include("footer.php");?>
